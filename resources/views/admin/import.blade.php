@extends('layouts.app')
@section('content')
    <form action="{{route('import')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        Select image to upload:
        <input type="file" name="file" id="fileToUpload">
        <input type="submit" value="file" name="submit">
    </form>
@endsection