@extends('layouts.admin')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Of Matrix Scoring</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Detail Of Matrix Scoring</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-3">
                <div class="card summary-card">
                    <div class="card-body">
                        <div class="summary-card-icon summary-card-icon-primary">
                            <i class="fas fa-map-marked-alt"></i>
                        </div>
                        <div class="summary-card-content">
                            <p class="summary-card-label">Total Provinsi</p>
                            <h3 class="summary-card-value">2</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-3">
                <div class="card summary-card">
                    <div class="card-body">
                        <div class="summary-card-icon summary-card-icon-success">
                            <i class="fas fa-layer-group"></i>
                        </div>
                        <div class="summary-card-content">
                            <p class="summary-card-label">Total Area</p>
                            <h3 class="summary-card-value">34</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-3">
                <div class="card summary-card">
                    <div class="card-body">
                        <div class="summary-card-icon summary-card-icon-warning">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <div class="summary-card-content">
                            <p class="summary-card-label">Distribusi Skor</p>
                            <div class="summary-score-list">
                                <span class="badge score-badge score-low">Low 2</span>
                                <span class="badge score-badge score-medium">Medium 3</span>
                                <span class="badge score-badge score-high">High 21</span>
                                <span class="badge score-badge score-very-high">Very High 4</span>
                                <span class="badge score-badge score-critical">Critical 4</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Scoring Area</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Provinsi</th>
                    <th>Area</th>
                    <th style="width: 130px">Scoring</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td rowspan="5">1</td>
                    <td>DKI Jakarta</td>
                    <td>Jakarta Selatan</td>
                    <td><span class="badge score-badge score-low">Low (1)</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Jakarta Barat</td>
                    <td><span class="badge score-badge score-medium">Medium (2)</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Jakarta Utara</td>
                    <td><span class="badge score-badge score-medium">Medium (2)</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Jakarta Timur</td>
                    <td><span class="badge score-badge score-low">Low (1)</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Jakarta Pusat</td>
                    <td><span class="badge score-badge score-medium">Medium (2)</span></td>
                </tr>
                <tr>
                    <td rowspan="29">2</td>
                    <td>Sumatra Utara</td>
                    <td>Batubara</td>
                    <td><span class="badge score-badge score-high">High (3)</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Binjai</td>
                    <td><span class="badge score-badge score-high">High (3)</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Dairi</td>
                    <td><span class="badge score-badge score-high">High (3)</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Deli Serdang</td>
                    <td><span class="badge score-badge score-high">High (3)</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Gunung Sitoli</td>
                    <td><span class="badge score-badge score-critical">Critical (5)</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Humbang Hasundutan</td>
                    <td><span class="badge score-badge score-high">High (3)</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Karo</td>
                    <td><span class="badge score-badge score-high">High (3)</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Labuhan Batu</td>
                    <td><span class="badge score-badge score-very-high">Very High (4)</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Labuhan Batu Selatan</td>
                    <td><span class="badge score-badge score-very-high">Very High (4)</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Labuhan Batu Utara</td>
                    <td><span class="badge score-badge score-very-high">Very High (4)</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Langkat</td>
                    <td><span class="badge score-badge score-very-high">Very High (4)</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Medan</td>
                    <td><span class="badge score-badge score-high">High (3)</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Nias</td>
                    <td><span class="badge score-badge score-critical">Critical (5)</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Nias Barat</td>
                    <td><span class="badge score-badge score-critical">Critical (5)</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Nias Selatan</td>
                    <td><span class="badge score-badge score-critical">Critical (5)</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Padang Lawas Utara</td>
                    <td><span class="badge score-badge score-high">High (3)</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Padangsidimpuan</td>
                    <td><span class="badge score-badge score-high">High (3)</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Pematang Siantar</td>
                    <td><span class="badge score-badge score-high">High (3)</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Samosir</td>
                    <td><span class="badge score-badge score-high">High (3)</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Serdang Bedagai</td>
                    <td><span class="badge score-badge score-high">High (3)</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Simalungun</td>
                    <td><span class="badge score-badge score-high">High (3)</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Sukabumi</td>
                    <td><span class="badge score-badge score-high">High (3)</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Tanjung Balai</td>
                    <td><span class="badge score-badge score-high">High (3)</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Tapanuli Selatan</td>
                    <td><span class="badge score-badge score-high">High (3)</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Tapanuli Tengah</td>
                    <td><span class="badge score-badge score-high">High (3)</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Tapanuli Tengah</td>
                    <td><span class="badge score-badge score-high">High (3)</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Tapanuli Utara</td>
                    <td><span class="badge score-badge score-high">High (3)</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Tebing Tinggi</td>
                    <td><span class="badge score-badge score-high">High (3)</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Toba Samosir</td>
                    <td><span class="badge score-badge score-high">High (3)</span></td>
                </tr>
            </tbody>
        </table>
                </div>
    </div>
</div>
</div>
</div>
</div>
</div>



@endsection