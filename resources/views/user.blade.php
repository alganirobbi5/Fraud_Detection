@extends('layouts.admin')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>

    <div class="content-body">
      
        <div class="container-fluid">
      
          <div class="card">
      
            <div class="card-header pt-4">
              <a href='/user_add' class="btn btn-primary float-right"><i class="fa fa-plus"></i> &nbsp ADD USER</a>
              <h4>Data User Sistem</h4>
      
            </div>
            <div class="card-body pt-0">
      
              <style>
								table, th, td {
								  border: 1px solid black;
								  border-collapse: collapse;
								  text-align: center;
								  font-size: 13px;
								}
								th, td {
								  padding: 5px;
								}
								tr:nth-child(even) {
								  background-color: #f2f2f2
								}
								tr:hover {
								  background-color: #ddd
								}
								th {
								  background-color: #4CAF50;
								  color: white;
								  text-align: center;
								  font-size: 15px;
								  font-weight: bold;
								  text-transform: uppercase
								}
							  </style>
              <div class="table-responsive">
      
                <table class="table table-bordered" id="table-datatable">
                  <thead>
                    <tr>
                      <th width="1%">NO</th>
                      <th>NAMA</th>
                      <th class="text-center">EMAIL</th>
                      <th class="text-center">LEVEL</th>
                      <th class="text-center" width="10%">OPSI</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                    $no = 1;
                    @endphp
                    @foreach($user as $u)
                    <tr>
                      <td class="text-center">{{ $no++ }}</td>
                      <td>
                        @if($u->foto == "")
                        <img src="{{ asset('gambar/sistem/user.png') }}" class="img-circle elevation-2" style="width: 30px" class="mr-2">
                        @else
                        <img src="{{ asset('gambar/user/'.$u->foto) }}" class="img-circle elevation-2" style="width: 30px" class="mr-2">
                        @endif
      
      
                        {{ $u->name }}
                        @if(Auth::id() == $u->id)
                        <span class="badge badge-primary">Saya</span>
                        @endif
                      </td>
                      <td class="text-center">{{ $u->email }}</td>
                      <td class="text-center">{{ $u->level }}</td>
                      <td>    
      
                        <div class="text-center">
                          <a href="/user_edit/{{ $u->id }}" class="btn btn-default btn-sm">
                            <i class="fa fa-cog"></i>
                          </a>
      
                        @if($u->id != 1)
                          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_user_{{ $u->id }}">
                            <i class="fa fa-trash"></i>
                          </button>
                        @endif
                        </div>
      
                        <!-- modal hapus -->
                        <form method="POST" action='/user_delete/{{$u->id}}'>
                          <div class="modal fade" id="hapus_user_{{$u->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Caution !</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
      
                                  <p>Are you sure you want to delete this User?</p>
      
                                  @csrf
                                  {{ method_field('DELETE') }}
      
      
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal"><i class="ti-close m-r-5 f-s-12"></i> Close</button>
                                  <button type="submit" class="btn btn-danger"><i class="fa-regular fa-trash-can"></i> Yes, Delete</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
      
      
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
      
          </div>
      
      
      
      
      
        </div>
        <!-- #/ container -->
      </div>
      
</div>


@endsection