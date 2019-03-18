@extends('layouts.app')
@section('content')
    <form action="{{ route('updateKep') }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="put">
    <div class="col-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Edit Penilaian <small>Kepribadian</small></h2>
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
                    @foreach($nilaiKep as $sis)
                    <tr>
                        <th>{{ $no++ }}</th>
                        <td><input name="nis{{ $sis->nis }}" type="hidden" value="{{ $sis->nis }}">{{ $sis->nis }}</td>
                        <td><input name="nama{{ $sis->nis }}" type="hidden" value="{{ $sis->nis }}">{{ $sis->siswas->nama }}</td>
                        <td><input type="hidden" name="kelas" value="{{ $sis->kelas_id }}">{{ $sis->kelas->kelas }}</td>
                        <td><input type="text" name="kelakuan{{ $sis->nis }}" class="form-control" value="{{ $sis->kelakuan }}"></td>
                        <td><input type="text" name="kerajinan{{ $sis->nis }}" class="form-control" value="{{ $sis->kerajinan }}"></td>
                        <td><input type="text" name="kebersihan{{ $sis->nis }}" class="form-control" value="{{ $sis->kebersihan }}"></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
                <button type="submit" class="btn btn-success">Update</button>
        </div>
    </div>
    </div>
    </form>
@endsection