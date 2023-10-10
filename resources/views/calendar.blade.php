@extends('adminlte::page')

@extends('layouts.tailwind')

@section('title', 'Calendar')

@section('content_header')
    <h1>Calendar</h1>
@stop

@section('content')
    @livewire('dashboard.bookings.car-availability')
@stop

@push('styles')
    <style>
        .slash-line {
            position: absolute;
            top: 0;
            right: 0;
            height: 100%;
            width: 1px;
            background-color: #ccc;
        }

        .date-cell {
            width: 46px;
            height: 46px;
            text-align: center;
            padding: 5px;
        }

        .bg-diagonal-line-from {
            position: relative;
            background: linear-gradient(135deg, #34d399 50%, #f87171 50%);
        }

        .bg-diagonal-line-to {
            position: relative;
            background: linear-gradient(-45deg, #34d399 50%, #f87171 50%);
        }

        .bg-diagonal-line-change {
            position: relative;
            background: linear-gradient(135deg, #f87171 50%, #f87171 50%);
        }

        .client-name {
            position: absolute;
            top: 50%;
            left: 60%;
            transform: translate(-50%, -50%) rotate(-45deg); /* Rotate text by 45 degrees */
            font-size: 12px;
            font-weight: 600;
            color: black;          
        }
    </style>
@endpush
