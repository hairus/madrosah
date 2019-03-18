@extends('layouts.app')
@section('title','List User')
@section('content')
    <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_panel">
            <div class="x_title">
                <h2>Semua User</h2>
            </div>
            <div class="x_content">
                <table class="table">
                <thead>
                    <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    ?>
                    @foreach ($user as $data)
                    <tr>
                            <th scope="row">1</th>
                            <td>{{$data->name}}</td>
                            <td>{{$data->email}}</td>
                            <td>delete</td>
                        </tr>    
                    @endforeach
                </tbody>
                </table>
            </div>
            </div>
        </div>
@endsection