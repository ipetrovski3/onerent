@extends('adminlte::page')

@section('Car Model', 'Dashboard')

@section('content_header')
    <h1>New Car Model</h1>
@stop

@section('content')
    <form action="{{ route('models.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <select class="form-control" name="car_brand_id" id="">
            @foreach($brands as $brand)
                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
            @endforeach
        </select>
        <div class="form-group">
            <label for="">Name</label>
            <input class="form-control" type="text" name="name">
        </div>
        <div class="form-group">
            <label for="">Image</label>
            <input class="form-control" type="file" name="image">
        </div>
        <button type="submit" class="btn btn-success">Save Car Model</button>
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
