@extends('layouts.admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')

@php
    $riskLabels = [
        1 => 'Rendah',
        2 => 'Sedang',
        3 => 'Tinggi',
        4 => 'Sangat Tinggi',
        5 => 'Kritis',
    ];

    $totalAmount = (float) $summary->total_amount;

    if ($totalAmount >= 1000000000) {
        $totalAmountLabel = 'Rp ' . number_format($totalAmount / 1000000000, 1, ',', '.') . ' M';
    } elseif ($totalAmount >= 1000000) {
        $totalAmountLabel = 'Rp ' . number_format($totalAmount / 1000000, 1, ',', '.') . ' jt';
    } elseif ($totalAmount >= 1000) {
        $totalAmountLabel = 'Rp ' . number_format($totalAmount / 1000, 0, ',', '.') . ' rb';
    } else {
        $totalAmountLabel = 'Rp ' . number_format($totalAmount, 0, ',', '.');
    }

    $lastUpdated = $summary->last_updated
        ? \Carbon\Carbon::parse($summary->last_updated)->format('d/m/Y H:i')
        : null;

    $gradientParts = collect($riskSegments)->map(function ($segment) {
        return $segment['color']
            . ' ' . number_format($segment['start'], 4, '.', '') . '%'
            . ' ' . number_format($segment['end'], 4, '.', '') . '%';
    })->implode(', ');

    $maxProvinceClaims = $provinceStats->max('claims') ?: 0;
    $maxDiagnosisClaims = $topDiagnoses->max('claims') ?: 0;
@endphp

<div class="content-wrapper dashboard-page">
    <div class="dash-shell">
        <header class="dash-header">
            <div class="dash-header-main">
                <p class="dash-eyebrow">Ringkasan Operasional</p>
                <h1 class="dash-title">Dashboard Fraud Detection</h1>
                <p class="dash-subtitle">Pantau volume klaim, konsentrasi wilayah, dan area berisiko tinggi.</p>
            </div>
            <div class="dash-header-actions">
                <span class="dash-updated">
                    <i class="far fa-clock" aria-hidden="true"></i>
                    @if($lastUpdated)
                        Diperbarui {{ $lastUpdated }}
                    @else
                        Belum ada data
                    @endif
                </span>
                <a href="/data" class="dash-btn">Kelola Data</a>
            </div>
        </header>

        <section class="dash-kpis" aria-label="Ringkasan utama">
            <article class="dash-kpi">
                <p class="dash-kpi-label"><span class="dash-dot dot-navy" aria-hidden="true"></span>Total Klaim</p>
                <p class="dash-kpi-value">{{ $hasData ? number_format($totalClaims, 0, ',', '.') : '—' }}</p>
                <p class="dash-kpi-meta">{{ $hasData ? 'Seluruh baris data klaim' : 'Belum ada data' }}</p>
            </article>
            <article class="dash-kpi">
                <p class="dash-kpi-label"><span class="dash-dot dot-teal" aria-hidden="true"></span>Total Nominal Klaim</p>
                <p class="dash-kpi-value">{{ $hasData ? $totalAmountLabel : '—' }}</p>
                <p class="dash-kpi-meta">{{ $hasData ? 'Akumulasi nominal klaim' : 'Belum ada data' }}</p>
            </article>
            <article class="dash-kpi">
                <p class="dash-kpi-label"><span class="dash-dot dot-green" aria-hidden="true"></span>Area Terpantau</p>
                <p class="dash-kpi-value">{{ $hasData ? number_format($totalAreas, 0, ',', '.') : '—' }}</p>
                <p class="dash-kpi-meta">{{ $hasData ? number_format($summary->total_provinces, 0, ',', '.') . ' provinsi' : 'Belum ada data' }}</p>
            </article>
            <article class="dash-kpi">
                <p class="dash-kpi-label"><span class="dash-dot dot-red" aria-hidden="true"></span>Area Risiko Tinggi</p>
                <p class="dash-kpi-value">{{ $hasData ? number_format($highRiskAreas, 0, ',', '.') : '—' }}</p>
                <p class="dash-kpi-meta">{{ $hasData ? 'Dari ' . number_format($totalAreas, 0, ',', '.') . ' area' : 'Belum ada data' }}</p>
            </article>
        </section>

        @if(!$hasData)
            <section class="dash-empty" aria-labelledby="empty-title">
                <div class="dash-empty-icon"><i class="fas fa-inbox" aria-hidden="true"></i></div>
                <h2 id="empty-title">Belum ada data klaim</h2>
                <p>Unggah spreadsheet klaim untuk mulai melihat ringkasan, konsentrasi wilayah, dan profil risiko area.</p>
                <a href="/data" class="dash-btn dash-btn-primary">Import Data</a>
            </section>
        @else
            <div class="dash-grid dash-grid-main">
                <section class="dash-card" aria-labelledby="province-title">
                    <div class="dash-card-head">
                        <div>
                            <h2 class="dash-card-title" id="province-title">Konsentrasi Klaim per Provinsi</h2>
                            <p class="dash-card-sub">Top 6 provinsi berdasarkan jumlah klaim</p>
                        </div>
                    </div>
                    <div class="dash-card-body">
                        @forelse($provinceStats as $province)
                            @php
                                $barWidth = $maxProvinceClaims > 0 ? ($province->claims / $maxProvinceClaims) * 100 : 0;
                            @endphp
                            <div class="dash-bar-row">
                                <div class="dash-bar-head">
                                    <span class="dash-bar-label" title="{{ $province->province }}">{{ $province->province }}</span>
                                    <span class="dash-bar-value">{{ number_format($province->claims, 0, ',', '.') }} klaim</span>
                                </div>
                                <div class="dash-bar-track">
                                    <span class="dash-bar-fill" style="width: {{ number_format($barWidth, 2, '.', '') }}%"></span>
                                </div>
                                <div class="dash-bar-foot">
                                    <span>Rp{{ number_format($province->amount, 0, ',', '.') }}</span>
                                    <span>{{ number_format($province->share, 1, ',', '.') }}%</span>
                                </div>
                            </div>
                        @empty
                            <p class="dash-muted">Belum ada data provinsi.</p>
                        @endforelse
                    </div>
                </section>

                <section class="dash-card" aria-labelledby="risk-title">
                    <div class="dash-card-head">
                        <div>
                            <h2 class="dash-card-title" id="risk-title">Profil Risiko Area</h2>
                            <p class="dash-card-sub">Berdasarkan pangsa klaim per kota</p>
                        </div>
                    </div>
                    <div class="dash-card-body">
                        @if($totalAreas > 0)
                            <div class="dash-risk">
                                <div
                                    class="dash-donut"
                                    role="img"
                                    aria-label="Distribusi {{ number_format($totalAreas, 0, ',', '.') }} area berdasarkan skor risiko"
                                    style="background: conic-gradient({{ $gradientParts }});"
                                >
                                    <div class="dash-donut-hole">
                                        <span class="dash-donut-value">{{ number_format($totalAreas, 0, ',', '.') }}</span>
                                        <span class="dash-donut-label">Area</span>
                                    </div>
                                </div>
                                <ul class="dash-legend">
                                    @foreach($riskSegments as $segment)
                                        <li>
                                            <span class="dash-legend-swatch" style="background: {{ $segment['color'] }}"></span>
                                            <span class="dash-legend-label">{{ $riskLabels[$segment['score']] }}</span>
                                            <span class="dash-legend-value">{{ number_format($segment['count'], 0, ',', '.') }}</span>
                                            <span class="dash-legend-pct">{{ number_format($segment['percent'], 1, ',', '.') }}%</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @else
                            <p class="dash-muted">Belum ada data kota untuk dihitung.</p>
                        @endif
                    </div>
                </section>
            </div>

            <div class="dash-grid dash-grid-secondary">
                <section class="dash-card" aria-labelledby="areas-title">
                    <div class="dash-card-head">
                        <div>
                            <h2 class="dash-card-title" id="areas-title">Area dengan Konsentrasi Tertinggi</h2>
                            <p class="dash-card-sub">Top 6 kota berdasarkan jumlah klaim</p>
                        </div>
                    </div>
                    <div class="dash-table-wrap">
                        <table class="dash-table">
                            <thead>
                                <tr>
                                    <th scope="col">Kota</th>
                                    <th scope="col">Provinsi</th>
                                    <th scope="col" class="is-numeric">Klaim</th>
                                    <th scope="col" class="is-numeric">Nominal</th>
                                    <th scope="col" class="is-numeric">Pangsa</th>
                                    <th scope="col">Skor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($cityStats as $city)
                                    <tr>
                                        <td class="dash-cell-strong">{{ $city->city }}</td>
                                        <td class="is-muted">{{ $city->province ?: '—' }}</td>
                                        <td class="is-numeric">{{ number_format($city->claims, 0, ',', '.') }}</td>
                                        <td class="is-numeric">Rp{{ number_format($city->amount, 0, ',', '.') }}</td>
                                        <td class="is-numeric">{{ number_format($city->share, 1, ',', '.') }}%</td>
                                        <td><span class="dash-score risk-{{ $city->score }}">{{ $riskLabels[$city->score] }}</span></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="dash-muted">Belum ada data kota.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="dash-card" aria-labelledby="diagnosis-title">
                    <div class="dash-card-head">
                        <div>
                            <h2 class="dash-card-title" id="diagnosis-title">Diagnosis Teratas</h2>
                            <p class="dash-card-sub">Top 6 diagnosis berdasarkan jumlah klaim</p>
                        </div>
                    </div>
                    <div class="dash-card-body">
                        @forelse($topDiagnoses as $diagnosis)
                            @php
                                $barWidth = $maxDiagnosisClaims > 0 ? ($diagnosis->claims / $maxDiagnosisClaims) * 100 : 0;
                            @endphp
                            <div class="dash-bar-row">
                                <div class="dash-bar-head">
                                    <span class="dash-bar-label" title="{{ $diagnosis->diagnosis_1 }}">{{ $diagnosis->diagnosis_1 }}</span>
                                    <span class="dash-bar-value">{{ number_format($diagnosis->claims, 0, ',', '.') }}</span>
                                </div>
                                <div class="dash-bar-track">
                                    <span class="dash-bar-fill dash-bar-fill-teal" style="width: {{ number_format($barWidth, 2, '.', '') }}%"></span>
                                </div>
                                <div class="dash-bar-foot">
                                    <span>{{ number_format($diagnosis->share, 1, ',', '.') }}% dari diagnosis</span>
                                </div>
                            </div>
                        @empty
                            <p class="dash-muted">Belum ada data diagnosis.</p>
                        @endforelse
                    </div>
                </section>
            </div>

            <div class="dash-grid dash-grid-single">
                <section class="dash-card" aria-labelledby="recent-title">
                    <div class="dash-card-head">
                        <div>
                            <h2 class="dash-card-title" id="recent-title">Klaim Terbaru</h2>
                            <p class="dash-card-sub">8 data yang terakhir ditambahkan</p>
                        </div>
                    </div>
                    <div class="dash-table-wrap">
                        <table class="dash-table">
                            <thead>
                                <tr>
                                    <th scope="col">No. Klaim</th>
                                    <th scope="col">Tertanggung</th>
                                    <th scope="col">Kota / Provinsi</th>
                                    <th scope="col" class="is-numeric">Nominal</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentClaims as $claim)
                                    <tr>
                                        <td class="dash-cell-strong">{{ $claim->no_claim ?: '—' }}</td>
                                        <td>{{ $claim->insured_name ?: '—' }}</td>
                                        <td>
                                            <span>{{ $claim->city ?: '—' }}</span>
                                            @if($claim->province)
                                                <span class="dash-cell-sub">{{ $claim->province }}</span>
                                            @endif
                                        </td>
                                        <td class="is-numeric">Rp{{ number_format((float) $claim->claim_amount, 0, ',', '.') }}</td>
                                        <td><span class="dash-status {{ $claim->status_class }}">{{ $claim->claim_status ?: 'Tidak diketahui' }}</span></td>
                                        <td class="is-muted">{{ $claim->claim_date ?: '—' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="dash-muted">Belum ada data klaim.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        @endif
    </div>
</div>

@endsection
