<section class="find_car_area">
    <div class="container">
        <div class="find_car_inner">
            <h2 class="wow animated fadeInUp" data-wow-delay="0.2s">Let’s find your ideal car</h2>
            <p class="wow animated fadeIn" data-wow-delay="0.3s">No. 1 online Rental Service in Macedonia</p>
            <form wire:submit="availableCars">
                <div class="search_car_box wow animated fadeInUp" data-wow-delay="0.4s">
                    <div class="search_car_item">
                        <select wire:model="pick_up_id" class="text-body form-control" name="pick_up_id" id="pick_up_id">
                            <option disabled selected value="" class="text-muted">Pick up Location</option>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="search_car_item">
                        <select wire:model="drop_off_id" class="text-body form-control" name="drop_off_id" id="drop_off_id">
                            <option disabled selected value="">Drop Off Location</option>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="search_car_item">
                        <div class="form-group">
                            <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                                <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                                    <div class="input-group-text client_2"><i class="icon-calendar_2"></i></div>
                                </div>
                                <input wire:model="from_date" name="from_date" id="from_date" autocomplete="off" x-data
                                    x-init="flatpickr($refs.input, {enableTime: true, disableMobile: true, dateFormat: 'd.m.Y    H:i'});"
                                    class="text_div form-control datetimepicker-input input_2"
                                    x-ref="input" type="text" placeholder="{{ \Carbon\Carbon::tomorrow()->format('d.m.Y    H:i') }}" />
                            </div>
                        </div>
                    </div>
                    <div class="search_car_item">
                        <div class="form-group">
                            <div class="input-group time" id="datetimepicker4" data-target-input="nearest">
                                <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                                    <div class="input-group-text client_2"><i class="icon-calendar_2"></i></div>
                                </div>
                                <input wire:model="to_date" name="to_date" id="to_date" autocomplete="off" x-data
                                    x-init="flatpickr($refs.input, {enableTime: true, disableMobile: true, dateFormat: 'd.m.Y    H:i'});"
                                    class="text_div form-control datetimepicker-input input_2"
                                    x-ref="input" type="text" placeholder="{{ \Carbon\Carbon::tomorrow()->addDay()->format('d.m.Y    H:i') }}" />
                            </div>
                        </div>
                    </div>
                    <button class="submit_btn" type="submit">Search Car</button>
                </div>
            </form>
        </div>
    </div>
</section>
