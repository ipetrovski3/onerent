@extends('adminlte::page')

@section('title', 'Cars')

@section('content_header')
    <h1>Cars</h1>
    <a href="{{ route('cars.new') }}" class="btn badge-info">Add New Car</a>
@stop

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Brand</th>
            <th scope="col">Model</th>
            <th scope="col">Plate</th>
            <th scope="col" title="Transmission"><i class="fa fa-cog"></i></th>
            <th scope="col" title="Fuel"><i class="fa fa-gas-pump"></i></th>
            <th scope="col" title="Air Conditioner"><i class="fa fa-snowflake"></i></th>
            <th scope="col" title="Navigation"><i class="fa fa-map-marked"></i></th>
            <th scope="col" title="Max Passengers"><i class="fa fa-users"></i></th>
            <th scope="col" title="Price Per Day"> &euro; </th>
        </tr>
        </thead>
        <tbody>
        @foreach($cars as $car)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $car->brand->name }}</td>
            <td>{{ $car->model->name }}</td>
            <td>{{ $car->plate }}</td>
            <td>{{ $car->transmissions[$car->transmission_type] }}</td>
            <td>{{ $car->engines[$car->engine_type] }}</td>
            @if($car->ac)
                <td><i class="fa fa-check text-success"></i></td>
            @else
                <td><i class="fa fa-times text-danger"></i></td>
            @endif
            @if($car->navigation)
                <td><i class="fa fa-check text-success"></i></td>
            @else
                <td><i class="fa fa-times text-danger"></i></td>
            @endif
            <td>{{ $car->max_passengers }}</td>
            <td>{{ number_format($car->ppd, 2, ',', '.') }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
