@extends('layouts.app')
@section('content')
    <form action="{{ route('simpanSIA') }}" method="post">
        {{ csrf_field() }}
    <div class="col-12">
        <div class="x_panel">
            <div class="x_title">
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
                        <th>Sakit</th>
                        <th>Ijin</th>
                        <th>Alpha</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        ?>
                   @foreach ($kelas as $data)
                   <tr>
                       <th>{{ $no++ }}</th>
                       <td>{{ $data->nis }}</td>
                       <td>{{ $data->nama }}</td>
                       <td>{{ $data->kls }}</td>
                       <td><input type="number" class="form-control" name="sakit{{ $data->nis }}" value="0"></td>
                       <td><input type="number" class="form-control" name="ijin{{ $data->nis }}" value="0"></td>
                       <td><input type="number" class="form-control" name="alpha{{ $data->nis }}" value="0"></td>
                       <input type="hidden" name="nis" value="{{ $data->nis }}">
                       <input type="hidden" name="smt" value="{{ $smt->id }}">
                       <input type="hidden" name="kelas" value="{{ $data->kelas }}">
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