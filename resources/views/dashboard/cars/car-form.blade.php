@extends('adminlte::page')

@section('title', 'Cars')

@section('content_header')
    <h1>Add New Car</h1>
@stop

@section('content')
    @livewire('dashboard.cars.car-form')
@stop
