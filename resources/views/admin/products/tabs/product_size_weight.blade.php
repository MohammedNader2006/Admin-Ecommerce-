@push('js')
<script>
    $(document).ready(function () {
        var dataSelect = [
            @foreach(\App\Models\Country::with('malls')->get() as $country)
                {
                    "text": @json($country->{'country_name_' . session('lang')}),
                    "children": [
                        @foreach($country->malls as $mall)
                            {
                                "id": {{ $mall->id }},
                                "text": @json($mall->{'name_' . session('lang')}),
                                "selected": {{ check_mall($mall->id, $product->id) ? 'true' : 'false' }}
                            },
                        @endforeach
                    ]
                },
            @endforeach
        ];

        $('.mall_select2').select2({
            data: dataSelect,
            width: '100%'
        });
    });
</script>
@endpush

<div id="product_size_weight" class="tab-pane fade">

    <h3>{{ trans('admin.product_size_weight') }}</h3>

    <div class="size_weight">
        <center>
            <h1>برجاء قم باختيار قسم</h1>
        </center>
    </div>

    <div class="info_data hidden">

        <div class="form-group col-md-4 col-lg-4 col-sm-4 col-xs-12">
            <label for="color_id">
                {{ trans('admin.color_id') }}
            </label>

            <select name="color_id" id="color_id" class="form-control">
                <option value="">
                    {{ trans('admin.color_id') }}
                </option>

                @foreach(\App\Models\Color::pluck('name_' . session('lang'), 'id') as $id => $name)
                    <option value="{{ $id }}"
                        {{ old('color_id', $product->color_id) == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-md-4 col-lg-4 col-sm-4 col-xs-12">
            <label for="trade_id">
                {{ trans('admin.trade_id') }}
            </label>

            <select name="trade_id" id="trade_id" class="form-control">
                <option value="">
                    {{ trans('admin.trade_id') }}
                </option>

                @foreach(\App\Models\TradeMark::pluck('name_' . session('lang'), 'id') as $id => $name)
                    <option value="{{ $id }}"
                        {{ old('trade_id', $product->trade_id) == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-md-4 col-lg-4 col-sm-4 col-xs-12">
            <label for="manu_id">
                {{ trans('admin.manu_id') }}
            </label>

            <select name="manu_id" id="manu_id" class="form-control">
                <option value="">
                    {{ trans('admin.manu_id') }}
                </option>

                @foreach(\App\Models\Manufacturer::pluck('name_' . session('lang'), 'id') as $id => $name)
                    <option value="{{ $id }}"
                        {{ old('manu_id', $product->manu_id) == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-12 col-lg-12 col-sm-12">
            <label for="mall_select">
                {{ trans('admin.malls') }}
            </label>

            <select
                name="mall[]"
                id="mall_select"
                class="form-control mall_select2"
                multiple="multiple"
                style="width: 100%"
            ></select>
        </div>

        <div class="clearfix"></div>

    </div>
</div>
