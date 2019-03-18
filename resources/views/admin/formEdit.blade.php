@extends('layouts.app')
@section('title','Absen Siswa')
@section('content')
<div class="row">
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
            <h2>Edit Siswa<small>Pengeditan siswa Hari ini</small></h2>
          </div>
          <div class="x_content">
            <br>
            <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" action="{{url('/admin/editNow')}}" method="post">
                {{ csrf_field() }}
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama Siswa <span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="{{ $now->siswa->nama }}" disabled>
                <input type="hidden" name="nis" value="{{ $now->nis }}">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Kelas<span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="last-name" name="last-name" required="required" class="form-control col-md-7 col-xs-12" value="{{ $now->kelas->kelas }}" disabled>
                </div>
              </div>
              <div class="form-group">
                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Catatan Hari Ini </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="middle-name" class="form-control col-md-7 col-xs-12" type="text" name="middle-name" value="{{ $now->keterangan->ket }}" disabled>
                </div>
              </div>
              <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Edit Keterangan</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <select class="form-control" name="ket">
                        <option>--- Pilih ---</option>
                        @foreach ($ket as $data)
                        <option value="{{ $data->ketA }}">{{ $data->ket }}</option>    
                        @endforeach
                      </select>
                    </div>
                  </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
@endsection