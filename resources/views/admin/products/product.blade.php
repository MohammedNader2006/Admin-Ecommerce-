@extends('admin.index')

@section('content')

<link
    href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css"
    rel="stylesheet"
/>

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script>
    $(document).ready(function () {
        $('.js-example-basic-single').select2();

        // Copy Product
        $(document).on('click', '.copy_product', function (e) {
            e.preventDefault();

            $.ajax({
                url: '{{ aurl('products/copy/' . $product->id) }}',
                dataType: 'json',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },

                beforeSend: function () {
                    $('.loading_copy').removeClass('hidden');
                    $('.validate_message').html('');
                    $('.error_message').addClass('hidden');
                    $('.success_message').html('').addClass('hidden');
                },

                success: function (data) {
                    $('.loading_copy').addClass('hidden');

                    if (data.status == true) {
                        $('.success_message')
                            .html('<h1>' + data.message + '</h1>')
                            .removeClass('hidden');

                        setTimeout(function () {
                            window.location.href =
                                '{{ aurl('products') }}/' + data.id + '/edit';
                        }, 5000);
                    }
                },

                error: function (response) {
                    $('.loading_copy').addClass('hidden');

                    var error_li = '';

                    $.each(response.responseJSON.errors, function (index, value) {
                        error_li += '<li>' + value + '</li>';
                    });

                    $('.validate_message').html(error_li);
                    $('.error_message').removeClass('hidden');
                }
            });
        });

        // Save and Continue
        $(document).on('click', '.save_and_continue', function (e) {
            e.preventDefault();

            var form_data = $('#product_form').serialize();

            $.ajax({
                url: '{{ aurl('products/' . $product->id) }}',
                dataType: 'json',
                type: 'POST',
                data: form_data,

                beforeSend: function () {
                    $('.loading_save_c').removeClass('hidden');
                    $('.validate_message').html('');
                    $('.error_message').addClass('hidden');
                    $('.success_message').html('').addClass('hidden');
                },

                success: function (data) {
                    $('.loading_save_c').addClass('hidden');

                    if (data.status == true) {
                        $('.success_message')
                            .html('<h1>' + data.message + '</h1>')
                            .removeClass('hidden');
                    }
                },

                error: function (response) {
                    $('.loading_save_c').addClass('hidden');

                    var error_li = '';

                    $.each(response.responseJSON.errors, function (index, value) {
                        error_li += '<li>' + value + '</li>';
                    });

                    $('.validate_message').html(error_li);
                    $('.error_message').removeClass('hidden');
                }
            });
        });
    });
</script>
@endpush

<div class="box">

    <div class="box-header">
        <h3 class="box-title">{{ $title }}</h3>
    </div>

    <div class="box-body">

        <form
            action="{{ aurl('products/' . $product->id) }}"
            method="POST"
            enctype="multipart/form-data"
            id="product_form"
        >
            @csrf
            @method('PUT')

            <button type="submit" class="btn btn-primary save">
                {{ trans('admin.save') }}
                <i class="fa fa-floppy-o"></i>
            </button>

            <button type="button" class="btn btn-success save_and_continue">
                {{ trans('admin.save_and_continue') }}
                <i class="fa fa-floppy-o"></i>
                <i class="fa fa-spin fa-spinner loading_save_c hidden"></i>
            </button>

            <button type="button" class="btn btn-info copy_product">
                {{ trans('admin.copy_product') }}
                <i class="fa fa-spin fa-spinner loading_copy hidden"></i>
                <i class="fa fa-copy"></i>
            </button>

            <button
                type="button"
                class="btn btn-danger delete"
                data-toggle="modal"
                data-target="#del_admin{{ $product->id }}"
            >
                {{ trans('admin.delete') }}
                <i class="fa fa-trash"></i>
            </button>

            <hr>

            <div class="alert alert-danger error_message hidden">
                <ul class="validate_message"></ul>
            </div>

            <div class="alert alert-success success_message hidden"></div>

            <hr>

            <ul class="nav nav-tabs">
                <li class="active">
                    <a data-toggle="tab" href="#product_info">
                        {{ trans('admin.product_info') }}
                        <i class="fa fa-info"></i>
                    </a>
                </li>

                <li>
                    <a data-toggle="tab" href="#department">
                        {{ trans('admin.department') }}
                        <i class="fa fa-list"></i>
                    </a>  
                </li>

                <li>
                    <a data-toggle="tab" href="#product_setting">
                        {{ trans('admin.product_setting') }}
                        <i class="fa fa-cog"></i>
                    </a>
                </li>

                <li>
                    <a data-toggle="tab" href="#product_media">
                        {{ trans('admin.product_media') }}
                        <i class="fa fa-photo"></i>
                    </a>
                </li>

                <li>
                    <a data-toggle="tab" href="#product_size_weight">
                        {{ trans('admin.product_size_weight') }}
                        <i class="fa fa-info-circle"></i>
                    </a>
                </li>

                <li>
                    <a data-toggle="tab" href="#other_data">
                        {{ trans('admin.other_data') }}
                        <i class="fa fa-database"></i>
                    </a>
                </li>

                <li>
                    <a data-toggle="tab" href="#related_product">
                        {{ trans('admin.related_product') }}
                        <i class="fa fa-list"></i>
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                @include('admin.products.tabs.product_info')
                @include('admin.products.tabs.department')
                @include('admin.products.tabs.product_setting')
                @include('admin.products.tabs.product_media')
                @include('admin.products.tabs.product_size_weight')
                @include('admin.products.tabs.other_data')
                @include('admin.products.tabs.related_product')
            </div>

            <hr>

            <button type="submit" class="btn btn-primary save">
                {{ trans('admin.save') }}
                <i class="fa fa-floppy-o"></i>
            </button>

            <button type="button" class="btn btn-success save_and_continue">
                {{ trans('admin.save_and_continue') }}
                <i class="fa fa-floppy-o"></i>
            </button>

            <button type="button" class="btn btn-info copy_product">
                {{ trans('admin.copy_product') }}
                <i class="fa fa-spin fa-spinner loading_copy hidden"></i>
                <i class="fa fa-copy"></i>
            </button>

            <button
                type="button"
                class="btn btn-danger delete"
                data-toggle="modal"
                data-target="#del_admin{{ $product->id }}"
            >
                {{ trans('admin.delete') }}
                <i class="fa fa-trash"></i>
            </button>

        </form>

    </div>
</div>

<!-- Delete Product Modal -->
<div id="del_admin{{ $product->id }}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    &times;
                </button>

                <h4 class="modal-title">
                    {{ trans('admin.delete') }}
                </h4>
            </div>

            <form
                action="{{ route('products.destroy', $product->id) }}"
                method="POST"
            >
                @csrf
                @method('DELETE')

                <div class="modal-body">
                    <h4>
                        {{ trans('admin.delete_this', ['name' => $product->title]) }}
                    </h4>
                </div>

                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-info"
                        data-dismiss="modal"
                    >
                        {{ trans('admin.close') }}
                    </button>

                    <button type="submit" class="btn btn-danger">
                        {{ trans('admin.yes') }}
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection
