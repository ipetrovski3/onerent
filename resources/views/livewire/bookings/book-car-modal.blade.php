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
            {{-- <form wire:submit="bookCar"> --}}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <label for="from" class="form-label">From Date</label>
                            <input disabled id="from" type="text" class="form-control" value="{{ $booking->from_date }}">
                        </div>
                        <div class="col-6">
                            <label for="to" class="form-label">To Date</label>
                            <input disabled id="to"type="text" class="form-control" value=" {{ $booking->to_date }}">
                        </div>
                    </div>
                    <hr>
                    @if (isset($selected_car))
                        <p class="font-weight-bold" style="margin-bottom: 3px">{{ $selected_car->brand()->name }} {{ $selected_car->model->name }}</p>
                        <p id="summary" class="font-weight-bold">Total Cost: {{ $total_price }}</p>
                    @endif
                </div>
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col">
                            <input wire:model.defer="first_name" type="text" class="form-control" name="first_name" placeholder="First name">
                        </div>
                        <div class="col">
                            <input wire:model.defer="last_name" type="text" class="form-control" placeholder="Last name" name="last_name">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <input wire:model.defer="email" type="email" name="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="col">
                            <input wire:model.defer="phone" type="number" name="phone" class="form-control" placeholder="Telephone Number">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <input wire:model.defer="personal_id" type="text" name="personal_id" class="form-control" placeholder="Passport Number">
                        </div>
                        <div class="col">
                            <input wire:model.defer="address" type="text" name="address" class="form-control" placeholder="Address">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <select wire:model.defer="country" class="form-control" name="country_id">
                                <option value="" selected disabled>Select your country...</option>
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
                        <button wire:click.prevent="bookCar({{ $booking->id }}, {{ $car->id }})" type="submit" id="confirm_reservation" class="submit_btn">Make Reservation</button>
                        <button type="button" class="btn booking_btn" data-dismiss="modal">Cancel</button>
                    </div>
            {{-- </form> --}}
        </div>
    </div>
</div>
