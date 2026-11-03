@extends('layouts.admin')

@section('content')

@php
    $scoreBadges = [
        1 => ['class' => 'score-low', 'text' => 'Low (1)'],
        2 => ['class' => 'score-medium', 'text' => 'Medium (2)'],
        3 => ['class' => 'score-high', 'text' => 'High (3)'],
        4 => ['class' => 'score-very-high', 'text' => 'Very High (4)'],
        5 => ['class' => 'score-critical', 'text' => 'Critical (5)'],
    ];
@endphp

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Scoring Table</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Scoring Table</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-4 col-md-6 mb-3">
                    <div class="card summary-card h-100">
                        <div class="card-body">
                            <div class="summary-card-icon summary-card-icon-primary">
                                <i class="fas fa-city"></i>
                            </div>
                            <div class="summary-card-content">
                                <p class="summary-card-label">City With Most Claim</p>
                                <h3 class="summary-card-value summary-card-value-text">{{ $mostCity }}</h3>
                                <p class="summary-card-meta">{{ $provinceMostClaim }}</p>
                                <p class="summary-card-meta">{{ $addressMostClaim }}</p>
                                <p class="summary-card-meta mb-0">No Certificate: {{ $noCertificateCity }}</p>
                                <div class="mt-2">
                                    <span class="badge score-badge {{ $scoreBadges[$score]['class'] ?? 'score-medium' }}">{{ $scoreBadges[$score]['text'] ?? 'Medium ('.$score.')' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 mb-3">
                    <div class="card summary-card h-100">
                        <div class="card-body">
                            <div class="summary-card-icon summary-card-icon-success">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                            <div class="summary-card-content">
                                <p class="summary-card-label">Highest Claim Amount</p>
                                <h3 class="summary-card-value summary-card-value-text">Rp{{ number_format($claim_amountHighestClaim, 0, ',', '.') }}</h3>
                                <p class="summary-card-meta">{{ $cityHighestClaim }} | {{ $provinceHighestClaim }}</p>
                                <p class="summary-card-meta mb-0">{{ number_format($percentageClaimAmount, 1) }}% dari total klaim</p>
                                <div class="mt-2">
                                    <span class="badge score-badge {{ $scoreBadges[$scoreClaim]['class'] ?? 'score-medium' }}">{{ $scoreBadges[$scoreClaim]['text'] ?? 'Medium ('.$scoreClaim.')' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 mb-3">
                    <div class="card summary-card h-100">
                        <div class="card-body">
                            <div class="summary-card-icon summary-card-icon-warning">
                                <i class="fas fa-stethoscope"></i>
                            </div>
                            <div class="summary-card-content">
                                <p class="summary-card-label">Highest Diagnosis</p>
                                <h3 class="summary-card-value summary-card-value-text">{{ $highestMostDiagnosis }}</h3>
                                <p class="summary-card-meta">{{ $highestMostDiagnosisDesc }}</p>
                                <p class="summary-card-meta">{{ $highestMostDiagnosis_2 }}</p>
                                <p class="summary-card-meta mb-0">{{ number_format($percentageDiagnosis, 1) }}% dari total diagnosis</p>
                                <div class="mt-2">
                                    <span class="badge score-badge {{ $scoreBadges[$scoreDiagnosis]['class'] ?? 'score-medium' }}">{{ $scoreBadges[$scoreDiagnosis]['text'] ?? 'Medium ('.$scoreDiagnosis.')' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Grafik Scoring Data</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <h6 class="text-uppercase text-muted font-weight-bold mb-3">City With Most Claim</h6>
                                    <div id="grafik1" style="width: 100%; height: 300px;"></div>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <h6 class="text-uppercase text-muted font-weight-bold mb-3">Highest Claim Amount</h6>
                                    <div id="grafik2" style="width: 100%; height: 300px;"></div>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <h6 class="text-uppercase text-muted font-weight-bold mb-3">Highest Diagnosis</h6>
                                    <div id="grafik3" style="width: 100%; height: 300px;"></div>
                                </div>
                            </div>
                        <script src="https://code.highcharts.com/highcharts.js"></script>
                        <script type="text/javascript">
                          var citiesForGraph = <?php echo json_encode($citiesForGraph) ?>;
                          var total_city = <?php echo json_encode($total_city) ?>;
                          var citiesForGraphClaimAmount = <?php echo json_encode($citiesForGraphClaimAmount) ?>;
                          var total_claimAmount = <?php echo json_encode($total_claimAmount) ?>;
                          var DiagnosisForGraph = <?php echo json_encode($DiagnosisForGraph) ?>;
                          var total_highestDiagnosis = <?php echo json_encode($total_highestDiagnosis) ?>;
                          Highcharts.chart('grafik1', {
                                chart: {
                                    type: 'column'
                                },
                                title: {
                                    text: 'Grafik City With Most Claim'
                                    
                                },
                                xAxis: {
                                    categories: citiesForGraph,
                                    labels: {
                                    style: {
                                        color: 'black',
                                        fontSize:'12px'
                                        }
                                     }
                                },
                                yAxis: {
                                    min: 0,
                                    title: {
                                        text: 'JUMLAH CLAIM'
                                    }
                                  },
                                plotOptions: {
                                  series: {
                                    allPointsSelect: true
                                  }
                                },
                                series: [{
                                  name: 'TOTAL CLAIM',
                                  data: total_city,
                                }]
                            });
          
                            Highcharts.chart('grafik2', {
                                chart: {
                                    type: 'line'
                                },
                                title: {
                                    text: 'Grafik Highest Claim Amount'
                                },
                                xAxis: {
                                    categories: citiesForGraphClaimAmount,
                                    labels: {
                                    style: {
                                        color: 'black',
                                        fontSize:'12px'
                                        }
                                     }
                                },
                                yAxis: {
                                    min: 0,
                                    title: {
                                        text: 'NOMINAL CLAIM'
                                    }
                                  },
                                plotOptions: {
                                  series: {
                                    allPointsSelect: true
                                  }
                                },
                                series: [{
                                  name: 'NOMINAL CLAIM',
                                  data: total_claimAmount,
                                }]
                            });
          
          
                            Highcharts.chart('grafik3', {
                                chart: {
                                    type: 'bar'
                                },
                                title: {
                                    text: 'Grafik Highest Diagnosis'
                                },
                                xAxis: {
                                    categories: DiagnosisForGraph,
                                    labels: {
                                    style: {
                                        color: 'black',
                                        fontSize:'12px'
                                        }
                                     }
                                },
                                yAxis: {
                                    min: 0,
                                    title: {
                                        text: 'JUMLAH DIAGNOSIS'
                                    }
                                  },
                                plotOptions: {
                                  series: {
                                    allPointsSelect: true
                                  }
                                },
                                series: [{
                                  name: 'TOTAL DIAGNOSIS',
                                  data: total_highestDiagnosis,
                                }]
                            });
                        </script>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Detail City With Most Claim</h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive table-sticky">
                                <table class="table table-bordered table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>No Certificate</th>
                                            <th>City</th>
                                            <th>Province</th>
                                            <th>Hospital Name</th>
                                            <th>Diagnosis</th>
                                            <th>Claim Amount</th>
                                            <th>Percent Value</th>
                                            <th style="width: 130px">Score</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                        @if ($item->city == $mostCity)
                                        <tr>
                                            <td>{{ $item->no_certificate }}</td>
                                            <td>{{ $item->city }}</td>
                                            <td>{{ $item->province }}</td>
                                            <td>{{ $item->hospital_name }}</td>
                                            <td>{{ $item->diagnosis_1 }} | {{ $item->diagnosis_description }} | {{ $item->diagnosis_2 }}</td>
                                            <td>Rp{{ number_format($item->claim_amount, 0, ',', '.') }}</td>
                                            <td>{{ number_format($percentage, 1) }}%</td>
                                            <td>
                                                <span class="badge score-badge {{ $scoreBadges[$score]['class'] ?? 'score-medium' }}">{{ $scoreBadges[$score]['text'] ?? 'Medium ('.$score.')' }}</span>
                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Detail Highest Claim Amount</h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive table-sticky">
                                <table class="table table-bordered table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>No Certificate</th>
                                            <th>City</th>
                                            <th>Province</th>
                                            <th>Hospital Name</th>
                                            <th>Diagnosis</th>
                                            <th>Claim Amount</th>
                                            <th>Percent Value</th>
                                            <th style="width: 130px">Score</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $noCertificateClaim }}</td>
                                            <td>{{ $cityHighestClaim }}</td>
                                            <td>{{ $provinceHighestClaim }}</td>
                                            <td>{{ $hospital_HighestClaim }}</td>
                                            <td>{{ $highestDiagnosisClaim }} | {{ $highestDiagnosisDescClaim }} | {{ $highestDiagnosis_2claim }}</td>
                                            <td>Rp{{ number_format($claim_amountHighestClaim, 0, ',', '.') }}</td>
                                            <td>{{ number_format($percentageClaimAmount, 1) }}%</td>
                                            <td>
                                                <span class="badge score-badge {{ $scoreBadges[$scoreClaim]['class'] ?? 'score-medium' }}">{{ $scoreBadges[$scoreClaim]['text'] ?? 'Medium ('.$scoreClaim.')' }}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Detail Highest Diagnosis</h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive table-sticky">
                                <table class="table table-bordered table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>No Certificate</th>
                                            <th>City</th>
                                            <th>Province</th>
                                            <th>Hospital Name</th>
                                            <th>Diagnosis</th>
                                            <th>Claim Amount</th>
                                            <th>Percent Value</th>
                                            <th style="width: 130px">Score</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                        @if ($item->diagnosis_1 == $highestMostDiagnosis && $item->diagnosis_2 == $highestMostDiagnosis_2 && $item->diagnosis_description == $highestMostDiagnosisDesc)
                                        <tr>
                                            <td>{{ $item->no_certificate }}</td>
                                            <td>{{ $item->city }}</td>
                                            <td>{{ $item->province }}</td>
                                            <td>{{ $item->hospital_name }}</td>
                                            <td>{{ $item->diagnosis_1 }} | {{ $item->diagnosis_description }} | {{ $item->diagnosis_2 }}</td>
                                            <td>Rp{{ number_format($item->claim_amount, 0, ',', '.') }}</td>
                                            <td>{{ number_format($percentageDiagnosis, 1) }}%</td>
                                            <td>
                                                <span class="badge score-badge {{ $scoreBadges[$scoreDiagnosis]['class'] ?? 'score-medium' }}">{{ $scoreBadges[$scoreDiagnosis]['text'] ?? 'Medium ('.$scoreDiagnosis.')' }}</span>
                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
