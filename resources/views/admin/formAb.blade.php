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
        </div>
    </div>
    @if(isset($_GET['kelas']))
        <form action="{{ url('/admin/saveA') }}" method="POST">
            {{ csrf_field() }}
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
                            <td><div class="radio">
                                    <label><input value="1" type="radio" name="radio{{ $siswas->nis }}" checked="checked">Hadir</label>
                                    <label><input value="2" type="radio" name="radio{{ $siswas->nis }}">Sakit</label>
                                    <label><input value="3" type="radio" name="radio{{ $siswas->nis }}">Ijin</label>
                                    <label><input value="4" type="radio" name="radio{{ $siswas->nis }}">Alpa</label>
                                </div></td>
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

        </form>
    @endif
    <script>
       function kelas(val)
       {
           window.location.href = "{{ url('/admin/absen?kelas=') }}"+val;
       }
    </script>
@endsection