@push('js')
<script>
    $('.datepicker').datepicker({
        rtl: {{ session('lang') == 'ar' ? 'true' : 'false' }},
        language: @json(session('lang')),
        format: 'yyyy-mm-dd',
        autoclose: false,
        todayBtn: true,
        clearBtn: true
    });

    $(document).on('change', '.status', function () {
        var status = $(this).val();

        if (status === 'refused') {
            $('.reason').removeClass('hidden');
        } else {
            $('.reason').addClass('hidden');
        }
    });
</script>
@endpush

<div id="product_setting" class="tab-pane fade">

    <h3>{{ trans('admin.product_setting') }}</h3>

    <div class="form-group col-md-3 col-lg-3 col-sm-3 col-xs-12">
        <label for="price">{{ trans('admin.price') }}</label>
        <input
            type="text"
            name="price"
            id="price"
            class="form-control"
            placeholder="{{ trans('admin.price') }}"
            value="{{ old('price', $product->price) }}"
        >
    </div>

    <div class="form-group col-md-3 col-lg-3 col-sm-3 col-xs-12">
        <label for="stock">{{ trans('admin.stock') }}</label>
        <input
            type="text"
            name="stock"
            id="stock"
            class="form-control"
            placeholder="{{ trans('admin.stock') }}"
            value="{{ old('stock', $product->stock) }}"
        >
    </div>

    <div class="form-group col-md-3 col-lg-3 col-sm-3 col-xs-12">
        <label for="start_at">{{ trans('admin.start_at') }}</label>
        <input
            type="text"
            name="start_at"
            id="start_at"
            class="form-control datepicker"
            autocomplete="off"
            placeholder="{{ trans('admin.start_at') }}"
            value="{{ old('start_at', $product->start_at) }}"
        >
    </div>

    <div class="form-group col-md-3 col-lg-3 col-sm-3 col-xs-12">
        <label for="end_at">{{ trans('admin.end_at') }}</label>
        <input
            type="text"
            name="end_at"
            id="end_at"
            class="form-control datepicker"
            autocomplete="off"
            placeholder="{{ trans('admin.end_at') }}"
            value="{{ old('end_at', $product->end_at) }}"
        >
    </div>

    <div class="clearfix"></div>
    <hr>

    <div class="form-group col-md-4 col-lg-4 col-sm-4 col-xs-12">
        <label for="price_offer">{{ trans('admin.price_offer') }}</label>
        <input
            type="text"
            name="price_offer"
            id="price_offer"
            class="form-control"
            placeholder="{{ trans('admin.price_offer') }}"
            value="{{ old('price_offer', $product->price_offer) }}"
        >
    </div>

    <div class="form-group col-md-4 col-lg-4 col-sm-4 col-xs-12">
        <label for="start_offer_at">{{ trans('admin.start_offer_at') }}</label>
        <input
            type="text"
            name="start_offer_at"
            id="start_offer_at"
            class="form-control datepicker"
            placeholder="{{ trans('admin.start_offer_at') }}"
            autocomplete="off"
            value="{{ old('start_offer_at', $product->start_offer_at) }}"
        >
    </div>

    <div class="form-group col-md-4 col-lg-4 col-sm-4 col-xs-12">
        <label for="end_offer_at">{{ trans('admin.end_offer_at') }}</label>
        <input
            type="text"
            name="end_offer_at"
            id="end_offer_at"
            class="form-control datepicker"
            placeholder="{{ trans('admin.end_offer_at') }}"
            autocomplete="off"
            value="{{ old('end_offer_at', $product->end_offer_at) }}"
        >
    </div>

    <div class="clearfix"></div>
    <hr>

    <div class="form-group">
        <label for="status">{{ trans('admin.status') }}</label>

        <select name="status" id="status" class="form-control status">
            <option value="">
                {{ trans('admin.status') }}
            </option>

            <option value="pending"
                {{ old('status', $product->status) == 'pending' ? 'selected' : '' }}>
                {{ trans('admin.pending') }}
            </option>

            <option value="refused"
                {{ old('status', $product->status) == 'refused' ? 'selected' : '' }}>
                {{ trans('admin.refused') }}
            </option>

            <option value="active"
                {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>
                {{ trans('admin.active') }}
            </option>
        </select>
    </div>

    <div class="form-group reason {{ old('status', $product->status) != 'refused' ? 'hidden' : '' }}">
        <label for="reason">{{ trans('admin.refused_reason') }}</label>

        <textarea
            name="reason"
            id="reason"
            class="form-control"
            placeholder="{{ trans('admin.refused_reason') }}"
        >{{ old('reason', $product->reason) }}</textarea>
    </div>

</div>
