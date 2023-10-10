<div wire:ignore.self class="modal fade" id="book_car" tabindex="-1" role="dialog" aria-labelledby="book_car" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <label for="from" class="form-label ml-1">From Date</label>
                        <input
                            readonly
                            wire:model="from_date"
                            name="from_date"
                            id="from_date"
                            autocomplete="off"
                            x-data
                            x-init="flatpickr($refs.input, { 
                                enableTime: true, 
                                disableMobile: true, 
                                dateFormat: 'd.m.Y H:i', 
                                time_24hr: true,
                                minDate: 'today'
                            });"
                            class="text_div form-control datetimepicker-input input_2"
                            x-ref="input"
                            type="text"
                            placeholder="{{ \Carbon\Carbon::today()->addDay()->format('d.m.Y - H:i') }}"
                            style="cursor: pointer;"
                        />
                    </div>
                    <div class="col-6">
                        <label for="to" class="form-label ml-1">To Date</label>
                        <input
                            readonly
                            wire:model="to_date"
                            name="to_date"
                            id="to_date"
                            autocomplete="off"
                            x-data
                            x-init="flatpickr($refs.input, { 
                                enableTime: true, 
                                disableMobile: true, 
                                dateFormat: 'd.m.Y H:i', 
                                time_24hr: true,
                                minDate: 'today'
                            });"
                            class="text_div form-control datetimepicker-input input_2"
                            x-ref="input"
                            type="text"
                            placeholder="{{ \Carbon\Carbon::tomorrow()->addDay()->format('d.m.Y - H:i') }}"
                            style="cursor: pointer;"
                        />
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <label for="pick_up" class="form-label ml-1">Pick up location</label>
                        <select wire:model="pick_up" class="form-control" name="pick_up" id="pick_up">
                            <option selected value="" class="text-muted">Pick up Location</option>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="drop_off" class="form-label ml-1">Drop off location</label>
                        <select wire:model="drop_off" class="form-control" name="drop_off" id="drop_off">
                            <option selected value="">Drop off Location</option>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <hr>
                @if (isset($selected_car))
                    @php
                        $days = Carbon\Carbon::parse($from_date)->diffInDays($to_date);
                        $total_price = $days * $selected_car->ppd;
                    @endphp
                    <p class="font-weight-bold" style="margin-bottom: 3px">{{ $selected_car->brand()->name }} {{ $selected_car->model->name }}</p>
                    <p class="font-weight-bold">Total Cost: {{ $total_price }}</p>
                @endif
            </div>
            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col-6">
                        <label for="pick_up" class="form-label ml-1">First name</label>
                        <input wire:model.defer="first_name" type="text" class="form-control" name="first_name">
                    </div>
                    <div class="col-6">
                        <label for="pick_up" class="form-label ml-1">Last name</label>
                        <input wire:model.defer="last_name" type="text" class="form-control" name="last_name">
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-6">
                        <label for="pick_up" class="form-label ml-1">Email</label>
                        <input wire:model.defer="email" type="email" name="email" class="form-control">
                    </div>
                    <div class="col-6">
                        <label for="pick_up" class="form-label ml-1">Telephone number</label>
                        <input wire:model.defer="phone" type="number" name="phone" class="form-control">
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-6">
                        <label for="pick_up" class="form-label ml-1">Passport number</label>
                        <input wire:model.defer="personal_id" type="text" name="personal_id" class="form-control">
                    </div>
                    <div class="col-6">
                        <label for="pick_up" class="form-label ml-1">Address</label>
                        <input wire:model.defer="address" type="text" name="address" class="form-control">
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-6">
                        <label for="pick_up" class="form-label ml-1">Country</label>
                        <select wire:model.defer="country" class="form-control" name="country_id">
                            <option value="" selected>Select your country...</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>  
                <div class="row mb-4">
                    <div class="col">
                        <input wire:model="terms_and_conditions" id="terms" type="checkbox">
                        <label for="terms">By checking this you are agreeing to our terms and conditions</label>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button wire:click.prevent="bookCar" type="submit" id="confirm_reservation" class="submit_btn">Make Reservation</button>
                <button type="button" class="btn booking_btn" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
