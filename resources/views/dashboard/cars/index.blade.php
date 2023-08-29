@extends('adminlte::page')

@section('title', 'Cars')

@section('content_header')
    <h1>Cars</h1>
    <a href="{{ route('add.car') }}" class="btn badge-info">Add New Car</a>
@stop

@section('content')
    @livewire('dashboard.cars.index')
@stop
