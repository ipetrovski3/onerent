@extends('adminlte::page')

@section('title', 'Cars')

@section('content_header')
    <h1>Bookings</h1>
@stop

@section('content')
    @livewire('dashboard.bookings.index')
@stop
