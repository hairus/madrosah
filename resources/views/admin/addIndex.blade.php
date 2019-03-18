@extends('layouts.app')
@section('title','Add User')
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif
@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
<div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Tambah User</h2>
          </div>
          <div class="x_content">
            <br>
          <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" action="{{ url('/admin/add')}}" method="post">
                {{ csrf_field() }}
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama User <span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" name="nama">
                </div>
              </div>
              <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email<span class="required"></span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="email" id="first-name" required="required" class="form-control col-md-7 col-xs-12" name="email">
                    </div>
                  </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Password<span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="password" id="last-name" name="password" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" class="btn btn-success">Simpan</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
@endsection