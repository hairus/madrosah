@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Form Update Nilai </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" method="post" action="/madrasah/admin/update">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama <span class="required"></span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="{{ $trx_nilai->siswa->nama }}" disabled>
                                <input type="hidden" name="nis" value="{{ $trx_nilai->nis }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Mapel<span class="required"></span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="last-name" name="last-name" required="required" class="form-control col-md-7 col-xs-12" value="{{ $trx_nilai->mapel->mapel }}" disabled>
                                <input type="hidden" name="mapel_id" value="{{ $trx_nilai->mapel_id }}">
                                <input type="hidden" name="id" value="{{ $trx_nilai->id }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Nilai</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="middle-name" class="form-control col-md-7 col-xs-12" type="text" name="nilai" value="{{ $trx_nilai->nilai }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="reset">Batal</button>
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection