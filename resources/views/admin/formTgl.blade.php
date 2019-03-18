@extends('layouts.app')
@section('title','Absen Siswa')
@section('content')
<div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Edit Siswa<small>Pengeditan siswa Berdasarkan Tanggal</small></h2>
          </div>
          <div class="x_content">
            <br>
            <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" action="{{url('/admin/editTgl')}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="nis" value="{{$idSiswa}}">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Pilih Tanggal</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="tgl">
                            <option>--- Pilih ---</option>
                            @for($x=1; $x<=$tanggal; $x++)
                            @if(strlen($x)== 1)
                            <option value="0{{ $x }}">0{{ $x }}</option>
                            @else
                            <option value="{{ $x }}">{{ $x }}</option>
                            @endif
                            @endfor
                        </select>
                    </div>
                </div>
                        <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Pilih Bulan</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="bln">
                                    <option>--- Pilih ---</option>
                                    @for($x=1; $x<=12; $x++)
                                    @if(strlen($x)== 1)
                                    <option value="0{{ $x }}">0{{ $x }}</option>
                                    @else
                                    <option value="{{ $x }}">{{ $x }}</option>
                                    @endif    
                                    @endfor
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