@extends('layouts.admin')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">New User</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">New User</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>

    <div class="container-fluid">

        <div class="card">
    
          <div class="card-header pt-4">
            <a href='/user' class="btn btn-primary float-right"><i class="fa fa-arrow-left"></i> &nbsp BACK</a>
            <h4>Add User</h4>
    
          </div>
          <div class="card-body pt-0">
    
            <div class="row">
    
              <div class="col-lg-5">
    
                <form method="POST" action='/user_aksi' enctype="multipart/form-data">
                  @csrf
    
                  <div class="form-group">
                    <div class="form-group has-feedback">
                      <label class="text-dark">Name</label>
                      <input id="name" type="text" placeholder="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="off">
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
    
                  <div class="form-group">
                    <div class="form-group has-feedback">
                      <label class="text-dark">Email</label>
                      <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="off">
    
                      @error('email')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
    
                  <div class="form-group">
                    <div class="form-group has-feedback">
                      <label class="text-dark">Level</label>
                      <select class="form-control @error('level') is-invalid @enderror" name="level">
                        <option <?php if(old("level") == "admin"){echo "selected='selected'";} ?> value="admin">Admin</option>
                        <option <?php if(old("level") == "member"){echo "selected='selected'";} ?> value="member">Member</option>
                      </select>
                      
                      @error('level')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
    
    
                  <div class="form-group">
                    <div class="form-group has-feedback">
                      <label class="text-dark">Password</label>
                      <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">
    
                      @error('password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  <input type="checkbox" onclick="myFunction()"> Show Password
    
                  <br><br>
                  <div class="form-group">
                    <div class="form-group has-feedback">
                      <label class="text-dark">Foto Profil</label>
                      <br>
                      <input id="foto" type="file" placeholder="foto" class="@error('foto') is-invalid @enderror" name="foto" value="{{ old('foto') }}" autocomplete="off">
                      <br>
                      <small class="text-muted"><i>Can be left blank</i></small>
                      @error('foto')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
    
                  
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                  </div>
                </form>
              </div>
    
    
            </div>
    
          </div>
    
        </div>
    
      </div>


</div>

@endsection