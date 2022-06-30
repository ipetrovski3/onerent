@extends('adminlte::page')

@section('title', 'Cars')

@section('content_header')
    <h1>Create new Car</h1>
    {{--    <a href="{{ route('cars.new') }}"></a>--}}
@stop

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <div class="col-6 mb-5">
            <form action="{{ route('cars.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="car_brands">Car Brand</label>
                    <select class="form-control" name="brand" id="car_brands">
                        @foreach($car_brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" id="car_model_list">

                </div>
                <div class="form-group">
                    <label class="form-label" for="plate">Licence Plate</label>
                    <input class="form-control" id="plate" type="text" name="plate">
                </div>
                <div class="form-group">
                    <label class="form-label" for="transmission">Transmission</label>
                    <select class="form-control" name="transmission_type" id="transmission">
                        @foreach($car->transmissions as $key => $transmission)
                            <option value="{{ $key }}">{{ $transmission }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="engine_type">Fuel</label>
                    <select class="form-control" name="engine_type" id="engine_type">
                        @foreach($car->engines as $key => $type)
                            <option value="{{ $key }}">{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
                <p>
                    <input data-val="true" value="1" id="ac" type="checkbox" name="ac" checked>
                    <label class="form-label" for="ac">Air Conditioner</label>
                </p>
                <p>
                    <input data-val="true" value="1" id="navigation" type="checkbox" name="navigation" checked>
                    <label class="form-label" for="navigation">Navigation</label>
                </p>
                <div class="form-group">
                    <label class="form-label" for="max_passengers">Max Passengers</label>
                    <input class="form-control" type="number" name="max_passengers">
                </div>
                <div class="form-group">
                    <label class="form-label" for="max_passengers">Price per day</label>
                    <input class="form-control" type="number" name="ppd">
                </div>
                <button type="submit" class="btn btn-success">Save Car</button>
            </form>
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $(document).on('change', '#car_brands', function () {
            let brand_id = $(this).val()
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{ route('select.brand') }}",
                data: {brand_id},
                success: function (view) {
                    $('#car_model_list').empty()
                    $('#car_model_list').html(view)
                }
            })
        })
    </script>
@stop
