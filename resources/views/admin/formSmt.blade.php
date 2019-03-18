@extends('layouts.app')
@section('title','Aktif Semester')
@section('content')
    <form action="{{ route('aktifsmt') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">
        <div class="col-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Semester Aktif</h2>
                    <div class="clearfix"></div>
                    <div class="x_content">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Pilih Semester</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="select2_single form-control" tabindex="-1" name="smt">
                                    <option></option>
                                    @foreach($smt as $data)
                                        <option value="{{ $data->id }}">{{ $data->id }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Aktifkan</button>
                </div>
            </div>
        </div>
    </form>
@endsection