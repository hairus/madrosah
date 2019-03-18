@extends('layouts.app')
@section('content')
    <form action="{{ route('updateNilai') }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">
        <div class="col-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>EDIT NILAI</h2>
                    <div class="clearfix"></div>
                    <div class="x_content">
                        <?php
                        $no = 1;
                        ?>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Mapel</th>
                                <th>Kelas</th>
                                <th>Nilai</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($datas as $data)
                                <tr>
                                    <th>{{ $no++ }}</th>
                                    <td><input name="nis{{ $data->nis }}" type="hidden" value="{{ $data->nis }}">{{ $data->siswa->nama }}</td>
                                    <td>{{ $data->mapel->mapel }}</td>
                                    <td><input type="hidden" name="kelas" value="{{ $data->kelas_id }}">{{ $data->kelas_id }}</td>
                                    <td><input type="number" name="nilai{{ $data->nis }}" class="form-control" value="{{$data->nilai}}"></td>
                                    <input type="hidden" name="mapel" value="{{ $data->mapel_id }}">
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