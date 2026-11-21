@push('js')
<script>
    var x = 0;
    var max_input = 9;

    $(document).on('click', '.add_input', function (e) {
        e.preventDefault();

        if (x < max_input) {
            $('.div_inputs').append(`
                <div class="other-data-item">
                    <div class="col-md-6">
                        <label for="input_key">${@json(trans('admin.input_key'))}</label>
                        <input
                            type="text"
                            name="input_key[]"
                            class="form-control"
                        >
                    </div>

                    <div class="col-md-6">
                        <label for="input_value">${@json(trans('admin.input_value'))}</label>
                        <input
                            type="text"
                            name="input_value[]"
                            class="form-control"
                        >
                    </div>

                    <div class="clearfix"></div>
                    <br>

                    <a href="#" class="remove_input btn btn-danger">
                        <i class="fa fa-trash"></i>
                    </a>
                </div>
            `);

            x++;
        }
    });

    $(document).on('click', '.remove_input', function (e) {
        e.preventDefault();

        $(this).closest('.other-data-item').remove();
        x--;
    });
</script>
@endpush

<div id="other_data" class="tab-pane fade">
    <h3>{{ trans('admin.other_data') }}</h3>

    <div class="div_inputs col-md-12 col-lg-12 col-sm-12">

        @foreach($product->other_data()->get() as $other)
            <div class="other-data-item">
                <div class="col-md-6">
                    <label>
                        {{ trans('admin.input_key') }}
                    </label>

                    <input
                        type="text"
                        name="input_key[]"
                        class="form-control"
                        value="{{ $other->data_key }}"
                    >
                </div>

                <div class="col-md-6">
                    <label>
                        {{ trans('admin.input_value') }}
                    </label>

                    <input
                        type="text"
                        name="input_value[]"
                        class="form-control"
                        value="{{ $other->data_value }}"
                    >
                </div>

                <div class="clearfix"></div>
                <br>

                <a href="#" class="remove_input btn btn-danger">
                    <i class="fa fa-trash"></i>
                </a>
            </div>
        @endforeach

    </div>

    <div class="clearfix"></div>
    <br>

    <a href="#" class="add_input btn btn-info">
        <i class="fa fa-plus"></i>
    </a>

    <div class="clearfix"></div>
    <br>
</div>
