@extends('layouts.app')
@section('title','Input Siswa')
@section('content')
          <div class="col-md-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Form Input <small>input siswa baru</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                    <form class="form-horizontal form-label-left input_mask" action="{{ url('/admin/SimSis') }}" method="post">
                        {{ csrf_field() }}

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input name="nsis" type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="nama siswa">
                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <select class="form-control" name="kls">
                            <option>Pilih Kelas</option>
                            @for($x = 1; $x <= 6; $x++)
                            <option>{{ $x }}</option>
                            @endfor
                          </select>
                        <span class="fa fa-group form-control-feedback right" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input name="almt" type="text" class="form-control has-feedback-left" id="inputSuccess4" placeholder="Alamat">
                        <span class="fa fa-home form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input name="hp" type="number" class="form-control" id="inputSuccess5" placeholder="Phone">
                        <span class="fa fa-mobile-phone form-control-feedback right" aria-hidden="true"></span>
                      </div>

                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input name="Na" type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Nama Ayah">
                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                     </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input name="Ni" type="text" class="form-control" id="inputSuccess5" placeholder="Nama Ibu">
                        <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input name="Pa" type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Pekerjaan Ayah">
                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                     </div>

                     <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input name="Pi" type="text" class="form-control" id="inputSuccess5" placeholder="Pekerjaan Ibu">
                        <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                      </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <button type="button" class="btn btn-primary">Cancel</button>
                          <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>
                    </form>
                     </div>
                </div>
              </div>
            </div>
@endsection