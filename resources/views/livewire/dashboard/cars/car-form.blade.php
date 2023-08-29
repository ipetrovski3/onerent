<div>
    <div class="container">
        <div class="col-5 mb-5">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form wire:submit.prevent="store">
                <div class="form-group">
                    <label for="brand">Car Brand</label>
                    <select wire:model="brand" id="brand" class="form-control">
                        <option value="">Select car brand</option>
                        @foreach ($car_brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="brand">Model</label>
                    <select wire:model="model" id="model" class="form-control">
                        <option value="">Select model</option>
                        @foreach ($car_models as $model)
                            <option value="{{ $model->id }}">{{ $model->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="plate">License Plate</label>
                    <input wire:model="plate" id="plate" type="text" name="plate" class="form-control" placeholder="SK-1111-AB">
                </div>
                <div class="form-group">
                    <label for="transmission_type">Transmission</label>
                    <select wire:model="transmission_type" id="transmission_type" class="form-control">
                        <option value="">Select transmission type</option>
                        @foreach ($transmissions as $key => $transmission_type)
                            <option value="{{ $key }}">{{ $transmission_type }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="engine_type">Engine</label>
                    <select wire:model="engine_type" id="engine_type" class="form-control">
                        <option value="">Select engine type</option>
                        @foreach ($engines as $key => $engine_type)
                            <option value="{{ $key }}">{{ $engine_type }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="max_passengers">Max Passengers</label>
                    <input wire:model="max_passengers" id="max_passengers" type="number" name="max_passengers" class="col-2 form-control text-right">
                </div>
                <div class="form-group">
                    <label class="form-label" for="ppd">Price per day</label>
                    <input wire:model="ppd" id="ppd" type="number" name="ppd" class="col-2 form-control text-right" placeholder="€">
                </div>
                <div class="form-check">
                    <input wire:model="ac" id="ac" type="checkbox" class="form-check-input">
                    <label class="form-check-label" for="ac">Air Conditioner</label>
                </div>
                <div class="form-check">
                    <input wire:model="navigation" id="navigation" type="checkbox" class="form-check-input">
                    <label class="form-check-label" for="navigation">Navigation</label>
                </div>
                <button type="submit" class="btn btn-success mt-3">Save Car</button>
            </form>
        </div>
    </div>
</div>
