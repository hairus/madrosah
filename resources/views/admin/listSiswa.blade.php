@extends('layouts.app')
@section('title','Absen Siswa')
@section('content')
  <div class="row">
      <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Kelas</label>
          <select class="form-control" onchange="kelas(this.value)">
              <option>Pilih Kelas</option>
              @foreach( $kelas as $kelass)
                  <option value="{{ $kelass->kelas }}"
                  <?php
                      if(isset($_GET['kelas']))
                      {
                          if($_GET['kelas'] == $kelass->kelas)
                          {
                              echo 'selected="selected"';
                          }
                      }
                      ?>
                  >{{ $kelass->kelas }}</option>
              @endforeach
          </select>
      </div>
      @if(isset($_GET['kelas']))
          <div class="col-xs-12">
              <div class="x_panel">
                  <div class="x_title">
                      <h2>Absen Siswa <small>Kelas </small><?php echo $_GET['kelas']?></h2>
                      <ul class="nav navbar-right panel_toolbox">
                          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                          </li>
                          <li class="dropdown">
                          </li>
                          <li><a class="close-link"><i class="fa fa-close"></i></a>
                          </li>
                      </ul>
                      <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                      <table class="table">
                          <thead>
                          <tr>
                              <th>No</th>
                              <th>Nis</th>
                              <th>Nama</th>
                              <th>Keterangan</th>
                          </tr>
                          </thead>
                          <tbody>
                          <?php $no = 1 ;?>
                          @foreach($siswa as $siswas)
                              <tr>
                                  <th>{{ $no++ }}</th>
                                  <td><input type="hidden" name="nis{{ $siswas->nis }}" value="{{ $siswas->nis }}">{{ $siswas->nis }}</td>
                                  <td>{{ $siswas->nama }}</td>
                                  <td><a href="{{ url('/admin/cetak/') }}/{{$siswas->id}}">
                                          <button class="btn btn-danger">cetak </button></a></td>
                              </tr>
                          @endforeach
                          <input type="hidden" name="created_at" value="<?php echo date('Y-m-d H:i:s');?>">
                          <input type="hidden" name="kelas_id" value="<?php echo $_GET['kelas'];?>">
                          </tbody>
                      </table>
                      <button class="btn btn-info">simpan</button>
                  </div>
              </div>
          </div>
      @endif
  </div>

    </div>

  <script>
      function kelas(val)
      {
          window.location.href = "{{ url('/admin/laporan?kelas=') }}"+val;
      }
  </script>
@endsection