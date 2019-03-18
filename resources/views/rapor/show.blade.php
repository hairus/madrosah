@extends('layouts.app')
@section('title','Cetak Rapor')
@section('content')
    <div class="col-md-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><small>Keterangan</small></h2>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th colspan="2" align="center">Cetak</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                      $no = 1;
                    ?>
                    @foreach($nilai as $data)
                    <tr>
                        <th>{{ $no++ }}</th>
                        <td>{{ $data->siswa->nama }}</td>
                        <td><a href="{{ url('/rapor/cover/') }}/{{$data->nis}}" target="_blank"><button class="btn btn-success">Cover Depan</button></a></td>
                        <td><a href="{{ url('/rapor/petunjuk') }}" target="_blank"><button class="btn btn-success">Petunjuk</button></a></td>
                        <td><a href="{{ url('/rapor/keterangan') }}/{{$data->nis}}" target="_blank"><button class="btn btn-success">Keterangan</button></a></td>
                        <td><a href="{{ url('/rapor/nilai') }}/{{$data->nis}}" target="_blank"><button class="btn btn-success">Cetak Nilai</button></a></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection