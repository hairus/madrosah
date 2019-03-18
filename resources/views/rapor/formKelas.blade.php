@extends('layouts.app')
@section('title','Input SIA')
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Input SIA</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form id="demo-form2" action="{{url('/rapor/saveSIA')}}" method="POST" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Kelas</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="kelas">
                                    <option>----</option>
                                    @for($x = 1; $x <= 6; $x++)
                                    <option value="{{ $x }}">{{ $x }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Semester</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="smt">
                                    <option>----</option>
                                    @for($x = 1; $x <= 2; $x++)
                                        <option value="{{ $x }}">{{ $x }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button type="submit" class="btn btn-success">Pilih</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection