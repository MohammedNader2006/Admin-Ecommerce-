<div class="col-md-6">
    <div class="form-group">
        <label for="size_id" class="col-md-3">
            {{ trans('admin.size_id') }}
        </label>

        <div class="col-md-9">
            <select name="size_id" id="size_id" class="form-control">
                <option value="">
                    {{ trans('admin.size_id') }}
                </option>

                @foreach($sizes as $id => $name)
                    <option value="{{ $id }}"
                        {{ old('size_id', $product->size_id) == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="size" class="col-md-3">
            {{ trans('admin.size') }}
        </label>

        <div class="col-md-9">
            <input
                type="text"
                name="size"
                id="size"
                class="form-control"
                placeholder="{{ trans('admin.size') }}"
                value="{{ old('size', $product->size) }}"
            >
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="weight_id" class="col-md-3">
            {{ trans('admin.weight_id') }}
        </label>

        <div class="col-md-9">
            <select name="weight_id" id="weight_id" class="form-control">
                <option value="">
                    {{ trans('admin.weight_id') }}
                </option>

                @foreach($weights as $id => $name)
                    <option value="{{ $id }}"
                        {{ old('weight_id', $product->weight_id) == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="weight" class="col-md-3">
            {{ trans('admin.weight') }}
        </label>

        <div class="col-md-9">
            <input
                type="text"
                name="weight"
                id="weight"
                class="form-control"
                placeholder="{{ trans('admin.weight') }}"
                value="{{ old('weight', $product->weight) }}"
            >
        </div>
    </div>
</div>

<div class="clearfix"></div>
