<label class="form-label" for="car_model_id">Model</label>
<select class="form-control" name="car_model_id" id="car_model_id">
    @foreach($car_models as $model)
        <option value="{{ $model->id }}">{{ $model->name }}</option>
    @endforeach
</select>
