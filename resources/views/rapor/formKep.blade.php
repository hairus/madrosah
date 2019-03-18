@extends('layouts.app')
@section('content')
    <form action="{{ route('simKep') }}" method="post">
        {{ csrf_field() }}
    <div class="col-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Tabel Penilaian <small>Kepribadian</small></h2>
                <div class="clearfix"></div>
            <div class="x_content">
                <?php
                    $no = 1;
                ?>
                <table class="table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nis</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Kelakuan</th>
                        <th>Kerajian</th>
                        <th>Kebersihan</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($siswa as $sis)
                    <tr>
                        <th>{{ $no++ }}</th>
                        <td><input name="nis{{ $sis->nis }}" type="hidden" value="{{ $sis->nis }}">{{ $sis->nis }}</td>
                        <td><input name="nama{{ $sis->nis }}" type="hidden" value="{{ $sis->nis }}">{{ $sis->nama }}</td>
                        <td><input type="hidden" name="kelas" value="{{ $sis->kls }}">{{ $sis->kls }}</td>
                        <td><input type="text" name="kelakuan{{ $sis->nis }}" class="form-control"></td>
                        <td><input type="text" name="kerajinan{{ $sis->nis }}" class="form-control"></td>
                        <td><input type="text" name="kebersihan{{ $sis->nis }}" class="form-control"></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
                <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </div>
    </div>
    </form>
@endsection