@extends('layouts.admin')

@section('content')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<link rel="stylesheet" href="{{ asset('css/tables.css') }}">
@endpush

@php
    $scoreBadges = [
        1 => ['class' => 'risk-1', 'text' => 'Rendah (1)'],
        2 => ['class' => 'risk-2', 'text' => 'Sedang (2)'],
        3 => ['class' => 'risk-3', 'text' => 'Tinggi (3)'],
        4 => ['class' => 'risk-4', 'text' => 'Sangat tinggi (4)'],
        5 => ['class' => 'risk-5', 'text' => 'Kritis (5)'],
    ];

    $money = function ($value) {
        if ($value === null || $value === '') {
            return '—';
        }

        return is_numeric($value)
            ? 'Rp' . number_format((float) $value, 0, ',', '.')
            : $value;
    };
@endphp

<div class="content-wrapper dashboard-page tables-page">
    <div class="dash-shell">
        <header class="dash-header">
            <div class="dash-header-main">
                <p class="dash-eyebrow">Analisis Risiko</p>
                <h1 class="dash-title">Scoring Klaim</h1>
                <p class="dash-subtitle">Ringkasan konsentrasi klaim berdasarkan kota, nominal, dan diagnosis.</p>
            </div>
            <div class="dash-header-actions">
                <span class="dash-updated"><i class="fas fa-clock"></i>Dihitung dari seluruh data klaim</span>
                <a href="/data" class="dash-btn">Kelola Data</a>
                <a href="/scoring" class="dash-btn dash-btn-primary">
                    <i class="fas fa-rotate"></i> Hitung Ulang
                </a>
            </div>
        </header>

        @if(empty($hasData))
        <div class="dash-empty">
            <span class="dash-empty-icon"><i class="fas fa-chart-pie"></i></span>
            <h2>Belum ada data untuk dihitung</h2>
            <p>Import data klaim terlebih dahulu agar halaman scoring dapat menampilkan ringkasan risiko.</p>
            <a href="/data" class="dash-btn dash-btn-primary">
                <i class="fas fa-file-import"></i> Buka Data Klaim
            </a>
        </div>
        @else
        <div class="tbl-kpis-3">
            <div class="dash-kpi tbl-kpi">
                <div class="tbl-kpi-head">
                    <span class="tbl-kpi-icon tbl-kpi-icon-primary"><i class="fas fa-city"></i></span>
                    <p class="tbl-kpi-label">Kota dengan klaim terbanyak</p>
                </div>
                <p class="tbl-kpi-value">{{ $mostCity ?? '—' }}</p>
                <p class="tbl-kpi-meta">{{ $provinceMostClaim ?? '—' }}</p>
                <p class="tbl-kpi-meta">{{ $addressMostClaim ?? '—' }}</p>
                <p class="tbl-kpi-meta">No. Certificate: {{ $noCertificateCity ?? '—' }}</p>
                <div class="tbl-kpi-foot">
                    <span class="dash-score {{ $scoreBadges[$score]['class'] ?? 'risk-2' }}">{{ $scoreBadges[$score]['text'] ?? 'Sedang (' . $score . ')' }}</span>
                    <span class="tbl-kpi-pct">{{ number_format($percentage ?? 0, 1) }}% dari total klaim</span>
                </div>
            </div>

            <div class="dash-kpi tbl-kpi">
                <div class="tbl-kpi-head">
                    <span class="tbl-kpi-icon tbl-kpi-icon-teal"><i class="fas fa-money-bill-wave"></i></span>
                    <p class="tbl-kpi-label">Nominal klaim tertinggi</p>
                </div>
                <p class="tbl-kpi-value">{{ $money($claim_amountHighestClaim ?? null) }}</p>
                <p class="tbl-kpi-meta">{{ $cityHighestClaim ?? '—' }} &bull; {{ $provinceHighestClaim ?? '—' }}</p>
                <p class="tbl-kpi-meta">No. Certificate: {{ $noCertificateClaim ?? '—' }}</p>
                <div class="tbl-kpi-foot">
                    <span class="dash-score {{ $scoreBadges[$scoreClaim]['class'] ?? 'risk-2' }}">{{ $scoreBadges[$scoreClaim]['text'] ?? 'Sedang (' . $scoreClaim . ')' }}</span>
                    <span class="tbl-kpi-pct">{{ number_format($percentageClaimAmount ?? 0, 1) }}% dari total klaim</span>
                </div>
            </div>

            <div class="dash-kpi tbl-kpi">
                <div class="tbl-kpi-head">
                    <span class="tbl-kpi-icon tbl-kpi-icon-amber"><i class="fas fa-stethoscope"></i></span>
                    <p class="tbl-kpi-label">Diagnosis terbanyak</p>
                </div>
                <p class="tbl-kpi-value">{{ $highestMostDiagnosis ?? '—' }}</p>
                <p class="tbl-kpi-meta">{{ $highestMostDiagnosisDesc ?? '—' }}</p>
                <p class="tbl-kpi-meta">{{ $highestMostDiagnosis_2 ?? '—' }}</p>
                <div class="tbl-kpi-foot">
                    <span class="dash-score {{ $scoreBadges[$scoreDiagnosis]['class'] ?? 'risk-2' }}">{{ $scoreBadges[$scoreDiagnosis]['text'] ?? 'Sedang (' . $scoreDiagnosis . ')' }}</span>
                    <span class="tbl-kpi-pct">{{ number_format($percentageDiagnosis ?? 0, 1) }}% dari total diagnosis</span>
                </div>
            </div>
        </div>

        <div class="tbl-chart-grid">
            <div class="dash-card">
                <div class="dash-card-head">
                    <div>
                        <h2 class="dash-card-title">Kota dengan Klaim Terbanyak</h2>
                        <p class="dash-card-sub">Jumlah klaim per kota</p>
                    </div>
                </div>
                <div class="dash-card-body">
                    <div class="tbl-chart"><canvas id="grafik1"></canvas></div>
                </div>
            </div>

            <div class="dash-card">
                <div class="dash-card-head">
                    <div>
                        <h2 class="dash-card-title">Nominal Klaim Tertinggi</h2>
                        <p class="dash-card-sub">Nilai klaim maksimum per kota</p>
                    </div>
                </div>
                <div class="dash-card-body">
                    <div class="tbl-chart"><canvas id="grafik2"></canvas></div>
                </div>
            </div>

            <div class="dash-card">
                <div class="dash-card-head">
                    <div>
                        <h2 class="dash-card-title">Diagnosis Terbanyak</h2>
                        <p class="dash-card-sub">Jumlah klaim per diagnosis</p>
                    </div>
                </div>
                <div class="dash-card-body">
                    <div class="tbl-chart"><canvas id="grafik3"></canvas></div>
                </div>
            </div>
        </div>

        <div class="dash-card">
            <div class="dash-card-head">
                <div>
                    <h2 class="dash-card-title">Detail Kota dengan Klaim Terbanyak</h2>
                    <p class="dash-card-sub">{{ $mostCity ?? '—' }} &bull; {{ number_format($percentage ?? 0, 1) }}% dari total klaim</p>
                </div>
                <span class="dash-score {{ $scoreBadges[$score]['class'] ?? 'risk-2' }}">{{ $scoreBadges[$score]['text'] ?? 'Sedang (' . $score . ')' }}</span>
            </div>
            <div class="dash-card-body tbl-card-flush">
                <div class="tbl-table-scroll">
                    <table class="dash-table tbl-detail-table">
                        <thead>
                            <tr>
                                <th>No. Certificate</th>
                                <th>City</th>
                                <th>Province</th>
                                <th>Hospital Name</th>
                                <th>Diagnosis</th>
                                <th class="is-numeric">Claim Amount</th>
                                <th class="is-numeric">Percent Value</th>
                                <th>Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data->where('city', $mostCity) as $item)
                            <tr>
                                <td class="tbl-mono">{{ $item->no_certificate ?? '—' }}</td>
                                <td>{{ $item->city ?? '—' }}</td>
                                <td>{{ $item->province ?? '—' }}</td>
                                <td>{{ $item->hospital_name ?? '—' }}</td>
                                <td class="tbl-cell-wrap">{{ $item->diagnosis_1 ?? '—' }} | {{ $item->diagnosis_description ?? '—' }} | {{ $item->diagnosis_2 ?? '—' }}</td>
                                <td class="is-numeric tbl-amount">{{ $money($item->claim_amount) }}</td>
                                <td class="is-numeric">{{ number_format($percentage ?? 0, 1) }}%</td>
                                <td><span class="dash-score {{ $scoreBadges[$score]['class'] ?? 'risk-2' }}">{{ $scoreBadges[$score]['text'] ?? 'Sedang (' . $score . ')' }}</span></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="tbl-empty-cell">Tidak ada detail untuk kota ini.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="dash-card">
            <div class="dash-card-head">
                <div>
                    <h2 class="dash-card-title">Detail Nominal Klaim Tertinggi</h2>
                    <p class="dash-card-sub">{{ $cityHighestClaim ?? '—' }} &bull; {{ number_format($percentageClaimAmount ?? 0, 1) }}% dari total klaim</p>
                </div>
                <span class="dash-score {{ $scoreBadges[$scoreClaim]['class'] ?? 'risk-2' }}">{{ $scoreBadges[$scoreClaim]['text'] ?? 'Sedang (' . $scoreClaim . ')' }}</span>
            </div>
            <div class="dash-card-body tbl-card-flush">
                <div class="tbl-table-scroll">
                    <table class="dash-table tbl-detail-table">
                        <thead>
                            <tr>
                                <th>No. Certificate</th>
                                <th>City</th>
                                <th>Province</th>
                                <th>Hospital Name</th>
                                <th>Diagnosis</th>
                                <th class="is-numeric">Claim Amount</th>
                                <th class="is-numeric">Percent Value</th>
                                <th>Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="tbl-mono">{{ $noCertificateClaim ?? '—' }}</td>
                                <td>{{ $cityHighestClaim ?? '—' }}</td>
                                <td>{{ $provinceHighestClaim ?? '—' }}</td>
                                <td>{{ $hospital_HighestClaim ?? '—' }}</td>
                                <td class="tbl-cell-wrap">{{ $highestDiagnosisClaim ?? '—' }} | {{ $highestDiagnosisDescClaim ?? '—' }} | {{ $highestDiagnosis_2claim ?? '—' }}</td>
                                <td class="is-numeric tbl-amount">{{ $money($claim_amountHighestClaim ?? null) }}</td>
                                <td class="is-numeric">{{ number_format($percentageClaimAmount ?? 0, 1) }}%</td>
                                <td><span class="dash-score {{ $scoreBadges[$scoreClaim]['class'] ?? 'risk-2' }}">{{ $scoreBadges[$scoreClaim]['text'] ?? 'Sedang (' . $scoreClaim . ')' }}</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="dash-card">
            <div class="dash-card-head">
                <div>
                    <h2 class="dash-card-title">Detail Diagnosis Terbanyak</h2>
                    <p class="dash-card-sub">{{ $highestMostDiagnosis ?? '—' }} &bull; {{ number_format($percentageDiagnosis ?? 0, 1) }}% dari total diagnosis</p>
                </div>
                <span class="dash-score {{ $scoreBadges[$scoreDiagnosis]['class'] ?? 'risk-2' }}">{{ $scoreBadges[$scoreDiagnosis]['text'] ?? 'Sedang (' . $scoreDiagnosis . ')' }}</span>
            </div>
            <div class="dash-card-body tbl-card-flush">
                <div class="tbl-table-scroll">
                    <table class="dash-table tbl-detail-table">
                        <thead>
                            <tr>
                                <th>No. Certificate</th>
                                <th>City</th>
                                <th>Province</th>
                                <th>Hospital Name</th>
                                <th>Diagnosis</th>
                                <th class="is-numeric">Claim Amount</th>
                                <th class="is-numeric">Percent Value</th>
                                <th>Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data->where('diagnosis_1', $highestMostDiagnosis)->where('diagnosis_2', $highestMostDiagnosis_2)->where('diagnosis_description', $highestMostDiagnosisDesc) as $item)
                            <tr>
                                <td class="tbl-mono">{{ $item->no_certificate ?? '—' }}</td>
                                <td>{{ $item->city ?? '—' }}</td>
                                <td>{{ $item->province ?? '—' }}</td>
                                <td>{{ $item->hospital_name ?? '—' }}</td>
                                <td class="tbl-cell-wrap">{{ $item->diagnosis_1 ?? '—' }} | {{ $item->diagnosis_description ?? '—' }} | {{ $item->diagnosis_2 ?? '—' }}</td>
                                <td class="is-numeric tbl-amount">{{ $money($item->claim_amount) }}</td>
                                <td class="is-numeric">{{ number_format($percentageDiagnosis ?? 0, 1) }}%</td>
                                <td><span class="dash-score {{ $scoreBadges[$scoreDiagnosis]['class'] ?? 'risk-2' }}">{{ $scoreBadges[$scoreDiagnosis]['text'] ?? 'Sedang (' . $scoreDiagnosis . ')' }}</span></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="tbl-empty-cell">Tidak ada detail untuk diagnosis ini.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @push('scripts')
        <script>
            var citiesForGraph = @json($citiesForGraph);
            var total_city = @json($total_city);
            var citiesForGraphClaimAmount = @json($citiesForGraphClaimAmount);
            var total_claimAmount = @json($total_claimAmount);
            var DiagnosisForGraph = @json($DiagnosisForGraph);
            var total_highestDiagnosis = @json($total_highestDiagnosis);
            var diagnosisLabels = DiagnosisForGraph.map(function (label) {
                return label && label.length > 22 ? label.substring(0, 22) + '…' : label;
            });

            Chart.defaults.global.defaultFontFamily = "'Source Sans Pro', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif";
            Chart.defaults.global.defaultFontColor = '#667085';
            Chart.defaults.global.defaultFontSize = 11;

            var chartTooltip = {
                backgroundColor: '#101828',
                titleFontColor: '#ffffff',
                bodyFontColor: '#ffffff',
                displayColors: false,
                cornerRadius: 6,
                padding: 10
            };

            new Chart(document.getElementById('grafik1'), {
                type: 'bar',
                data: {
                    labels: citiesForGraph,
                    datasets: [{
                        data: total_city,
                        backgroundColor: 'rgba(29, 31, 190, 0.85)',
                        hoverBackgroundColor: '#1d1fbe',
                        borderWidth: 0,
                        maxBarThickness: 28
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: { display: false },
                    tooltips: Object.assign({}, chartTooltip, {
                        callbacks: {
                            label: function (item) {
                                return item.value + ' klaim';
                            }
                        }
                    }),
                    scales: {
                        xAxes: [{
                            gridLines: { display: false, drawBorder: false },
                            ticks: { fontColor: '#667085', maxRotation: 45, minRotation: 0 }
                        }],
                        yAxes: [{
                            ticks: { beginAtZero: true, precision: 0, fontColor: '#667085' },
                            gridLines: { color: '#eef0f3', drawBorder: false, zeroLineColor: '#e4e7ec' }
                        }]
                    }
                }
            });

            new Chart(document.getElementById('grafik2'), {
                type: 'line',
                data: {
                    labels: citiesForGraphClaimAmount,
                    datasets: [{
                        data: total_claimAmount,
                        borderColor: '#0e7490',
                        backgroundColor: 'rgba(14, 116, 144, 0.08)',
                        borderWidth: 2,
                        pointRadius: 3,
                        pointHoverRadius: 5,
                        pointBackgroundColor: '#0e7490',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        fill: true,
                        lineTension: 0.25
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: { display: false },
                    tooltips: Object.assign({}, chartTooltip, {
                        callbacks: {
                            label: function (item) {
                                return 'Rp' + Number(item.value).toLocaleString('id-ID');
                            }
                        }
                    }),
                    scales: {
                        xAxes: [{
                            gridLines: { display: false, drawBorder: false },
                            ticks: { fontColor: '#667085', maxRotation: 45, minRotation: 0 }
                        }],
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                fontColor: '#667085',
                                callback: function (value) {
                                    return 'Rp' + Number(value).toLocaleString('id-ID');
                                }
                            },
                            gridLines: { color: '#eef0f3', drawBorder: false, zeroLineColor: '#e4e7ec' }
                        }]
                    }
                }
            });

            new Chart(document.getElementById('grafik3'), {
                type: 'horizontalBar',
                data: {
                    labels: diagnosisLabels,
                    datasets: [{
                        data: total_highestDiagnosis,
                        backgroundColor: 'rgba(180, 83, 9, 0.85)',
                        hoverBackgroundColor: '#b45309',
                        borderWidth: 0,
                        maxBarThickness: 24
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: { display: false },
                    tooltips: Object.assign({}, chartTooltip, {
                        callbacks: {
                            label: function (item) {
                                return item.value + ' klaim';
                            }
                        }
                    }),
                    scales: {
                        xAxes: [{
                            ticks: { beginAtZero: true, precision: 0, fontColor: '#667085' },
                            gridLines: { color: '#eef0f3', drawBorder: false, zeroLineColor: '#e4e7ec' }
                        }],
                        yAxes: [{
                            gridLines: { display: false, drawBorder: false },
                            ticks: { fontColor: '#667085' }
                        }]
                    }
                }
            });
        </script>
        @endpush
        @endif
    </div>
</div>
@endsection
