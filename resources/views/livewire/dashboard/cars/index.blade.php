<div>
    <table class="table">
        <thead>
            <tr class="text-center">
                <th scope="col"></th>
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
                <tr class="text-center">
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $car->brand()->name }}</td>
                    <td>{{ $car->model->name }}</td>
                    <td>{{ $car->plate }}</td>
                    <td>{{ $transmissions[$car->transmission_type] }}</td>
                    <td>{{ $engines[$car->engine_type] }}</td>
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
                    <td><input wire:click="disableBooking({{ $car->id }})" class="form-control booking-status" type="checkbox" {{ $car->always_booked ? 'checked' : '' }}></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
