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
                    <label for="car_brand_id">Car Brand</label>
                    <select wire:model="car_brand_id" id="car_brand_id" class="form-control">
                        <option value="">Select car brand</option>
                        @foreach ($car_brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="name">Name</label>
                    <input wire:model="name" id="name" type="text" name="name" class="form-control" placeholder="ex. A4, 325i, C220, 308">
                </div>
                <div class="form-group">
                    <label for="">Image</label>
                    <input wire:model="image" class="form-control" type="file" name="image">
                </div>
                <button type="submit" class="btn btn-success">Save Car Model</button>
            </form>
        </div>
    </div>
</div>
