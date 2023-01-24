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
            <th scope="col" title="Price Per Day"><button class="badge badge-info" id="update_price"> &euro; </button></th>
            <th scope="col">Disable Booking</th>
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
            <td> 
                <span type="disabled" class="form-control show-price">{{ number_format($car->ppd, 2, ',', '.') }}</span>
                <input type="text" hidden class="form-control price-input" value="{{ $car->ppd}}" data-car_id="{{ $car->id }}">
            </td>
            <td><input data-car_id="{{ $car->id }}" class="form-control booking-status" type="checkbox" {{ $car->always_booked ? 'checked' : '' }}></td>
        </tr>
        @endforeach
        </tbody>
    </table>
@stop

@section('css')
@stop

@section('js')
    <script>

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        })
        // Update price
        $(document).on('change', '.price-input', function () {
            let price = $(this).val()
            let car_id = $(this).data('car_id')
            console.log(price, car_id)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                data: {price, car_id},
                url: "{{ route('update_car_price') }}",
                success: function () {
                    Toast.fire({
                        title: 'Car Price Updated'
                    })
                }
            })
        })
        $(document).on('click', '.show-price', function() {
            $(this).hide()
            $(this).next().attr('hidden', false)

        })




    </script>
    <script>
        $(document).on('click', '.booking-status', function () {
            let status = $(this).is(":checked") ? '1' : '0'
            let car_id = $(this).data('car_id')
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{ route('car.status') }}",
                data: {status, car_id},
                success: function () {

                }
            })
        })
    </script>
@stop
