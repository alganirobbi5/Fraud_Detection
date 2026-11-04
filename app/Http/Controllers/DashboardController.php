<?php

namespace App\Http\Controllers;

use App\Data;

class DashboardController extends Controller
{
    public function index()
    {
        $summary = Data::query()
            ->selectRaw('COUNT(*) as total_claims')
            ->selectRaw('COALESCE(SUM(claim_amount), 0) as total_amount')
            ->selectRaw("COUNT(DISTINCT NULLIF(city, '')) as total_cities")
            ->selectRaw("COUNT(DISTINCT NULLIF(province, '')) as total_provinces")
            ->selectRaw('MAX(updated_at) as last_updated')
            ->first();

        $totalClaims = (int) $summary->total_claims;
        $hasData = $totalClaims > 0;

        $provinceStats = collect();
        $cityStats = collect();
        $riskDistribution = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
        $riskSegments = [];
        $topDiagnoses = collect();
        $recentClaims = collect();
        $highRiskAreas = 0;
        $totalAreas = 0;

        if ($hasData) {
            $provinceStats = Data::query()
                ->select('province')
                ->selectRaw('COUNT(*) as claims')
                ->selectRaw('COALESCE(SUM(claim_amount), 0) as amount')
                ->whereNotNull('province')
                ->where('province', '<>', '')
                ->groupBy('province')
                ->orderByDesc('claims')
                ->limit(6)
                ->get()
                ->map(function ($row) use ($totalClaims) {
                    $row->share = $totalClaims > 0 ? ($row->claims / $totalClaims) * 100 : 0;

                    return $row;
                });

            $allCities = Data::query()
                ->select('city')
                ->selectRaw('COUNT(*) as claims')
                ->selectRaw('COALESCE(SUM(claim_amount), 0) as amount')
                ->whereNotNull('city')
                ->where('city', '<>', '')
                ->groupBy('city')
                ->orderByDesc('claims')
                ->get();

            $totalAreas = $allCities->count();

            $allCities->each(function ($row) use ($totalClaims, &$riskDistribution, &$highRiskAreas) {
                $row->share = $totalClaims > 0 ? ($row->claims / $totalClaims) * 100 : 0;
                $row->score = $this->scoreForShare($row->share);
                $riskDistribution[$row->score]++;

                if ($row->score >= 4) {
                    $highRiskAreas++;
                }
            });

            $cityStats = $allCities->take(6)->values();
            $riskSegments = $this->buildRiskSegments($riskDistribution, $totalAreas);

            $allDiagnoses = Data::query()
                ->select('diagnosis_1')
                ->selectRaw('COUNT(*) as claims')
                ->whereNotNull('diagnosis_1')
                ->where('diagnosis_1', '<>', '')
                ->groupBy('diagnosis_1')
                ->orderByDesc('claims')
                ->get();

            $totalDiagnoses = $allDiagnoses->sum('claims');

            $topDiagnoses = $allDiagnoses->take(6)->values()->map(function ($row) use ($totalDiagnoses) {
                $row->share = $totalDiagnoses > 0 ? ($row->claims / $totalDiagnoses) * 100 : 0;

                return $row;
            });

            $recentClaims = Data::query()
                ->select('id', 'no_claim', 'insured_name', 'city', 'province', 'claim_amount', 'claim_status', 'claim_date', 'created_at')
                ->orderByDesc('created_at')
                ->orderByDesc('id')
                ->limit(8)
                ->get()
                ->map(function ($row) {
                    $row->status_class = $this->statusClass($row->claim_status);

                    return $row;
                });
        }

        return view('dashboard.dashboard', compact(
            'summary',
            'hasData',
            'totalClaims',
            'provinceStats',
            'cityStats',
            'riskDistribution',
            'riskSegments',
            'topDiagnoses',
            'recentClaims',
            'highRiskAreas',
            'totalAreas'
        ));
    }

    private function scoreForShare($share)
    {
        if ($share <= 30) {
            return 1;
        }

        if ($share <= 50) {
            return 2;
        }

        if ($share <= 70) {
            return 3;
        }

        if ($share <= 80) {
            return 4;
        }

        return 5;
    }

    private function buildRiskSegments(array $distribution, $totalAreas)
    {
        $colors = [
            1 => '#15803d',
            2 => '#b45309',
            3 => '#c2410c',
            4 => '#b42318',
            5 => '#7a271a',
        ];

        $segments = [];
        $cursor = 0;

        foreach ($distribution as $score => $count) {
            $percent = $totalAreas > 0 ? ($count / $totalAreas) * 100 : 0;
            $start = $cursor;
            $cursor += $percent;

            $segments[] = [
                'score' => $score,
                'count' => $count,
                'percent' => $percent,
                'start' => $start,
                'end' => $cursor,
                'color' => $colors[$score],
            ];
        }

        return $segments;
    }

    private function statusClass($status)
    {
        $value = strtolower((string) $status);

        if ($value === '') {
            return 'is-neutral';
        }

        if ($this->contains($value, ['reject', 'tolak', 'decline'])) {
            return 'is-negative';
        }

        if ($this->contains($value, ['paid', 'approve', 'accept', 'selesai', 'settle'])) {
            return 'is-positive';
        }

        if ($this->contains($value, ['pending', 'proses', 'process', 'open'])) {
            return 'is-warning';
        }

        return 'is-neutral';
    }

    private function contains($value, array $needles)
    {
        foreach ($needles as $needle) {
            if (strpos($value, $needle) !== false) {
                return true;
            }
        }

        return false;
    }
}
