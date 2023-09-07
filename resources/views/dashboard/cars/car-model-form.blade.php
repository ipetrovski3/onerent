@extends('adminlte::page')

@section('title', 'Cars')

@section('content_header')
    <h1>Add New Car Model</h1>
@stop

@section('content')
    @livewire('dashboard.cars.car-model-form')
@stop
