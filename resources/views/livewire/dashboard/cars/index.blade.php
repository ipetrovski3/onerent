@push('styles')   
    <style>
        .modal-dialog {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
    </style>
@endpush

<div x-data="{ showModal: false }" x-cloak>
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
                <th scope="col" title="Actions">Actions</i></th>
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
                        <div x-data="{ ppd: {{ $car->ppd }} }">
                            <input
                                x-model="ppd"
                                x-on:input="ppd = $event.target.value"
                                x-on:blur="$wire.changePrice({{ $car->id }}, ppd)"
                                type="text"
                                class="form-control price-input text-center"
                                value="{{ $car->ppd }}"
                            >
                        </div>
                    </td>
                    <td>
                        <button wire:click="getCarId({{ $car->id }})" @click="showModal = true" class="btn btn-sm btn-danger">Delete</button>
                    </td>
                    <td><input wire:click="disableBooking({{ $car->id }})" class="form-control booking-status" type="checkbox" {{ $car->always_booked ? 'checked' : '' }}></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div x-show="showModal" class="fixed inset-0 z-10 overflow-y-auto">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteBookingModalLabel">Delete Car</h5>
                    <button type="button" class="close" @click="showModal = false" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-lg font-bold mb-4">Are you sure you want to delete this car?</p>
                </div>
                <div class="modal-footer">
                    <button wire:click="deleteCar" @click="showModal = false" class="btn btn-danger">Yes, delete</button>
                    <button @click="showModal = false" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
