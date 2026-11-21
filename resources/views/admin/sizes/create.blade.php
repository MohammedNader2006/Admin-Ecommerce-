@extends('admin.index')

@section('content')

@push('js')

<script type="text/javascript">

$(document).ready(function () {

    $('#jstree').jstree({

        "core": {

            'data': {!! load_dep(old('department_id')) !!},

            "themes": {
                "variant": "large"
            }

        },

        "checkbox": {
            "keep_selected_style": true
        },

        "plugins": ["wholerow"]

    });

});


$('#jstree').on('changed.jstree', function (e, data) {

    var i, j, r = [];
    var name = [];

    for (i = 0, j = data.selected.length; i < j; i++) {

        r.push(
            data.instance
                .get_node(data.selected[i])
                .id
        );

    }

    if (r.join(', ') != '') {

        $('.department_id').val(r.join(', '));

    }

});

</script>

@endpush


<div class="box">

    <div class="box-header">

        <h3 class="box-title">
            {{ $title }}
        </h3>

    </div>

    <div class="box-body">

        <form
            action="{{ aurl('sizes') }}"
            method="POST"
        >

            @csrf


            {{-- Arabic Name --}}
            <div class="form-group">

                <label for="name_ar">
                    {{ trans('admin.name_ar') }}
                </label>

                <input
                    type="text"
                    name="name_ar"
                    id="name_ar"
                    class="form-control"
                    value="{{ old('name_ar') }}"
                >

                @error('name_ar')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror

            </div>


            {{-- English Name --}}
            <div class="form-group">

                <label for="name_en">
                    {{ trans('admin.name_en') }}
                </label>

                <input
                    type="text"
                    name="name_en"
                    id="name_en"
                    class="form-control"
                    value="{{ old('name_en') }}"
                >

                @error('name_en')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror

            </div>


            {{-- Department --}}
            <input
                type="hidden"
                name="department_id"
                class="department_id"
                value="{{ old('department_id') }}"
            >

            <div id="jstree"></div>


            {{-- Is Public --}}
            <div class="form-group">

                <label for="is_public">
                    {{ trans('admin.is_public') }}
                </label>

                <select
                    name="is_public"
                    id="is_public"
                    class="form-control"
                >

                    <option
                        value="yes"
                        {{ old('is_public') == 'yes' ? 'selected' : '' }}
                    >
                        {{ trans('admin.yes') }}
                    </option>

                    <option
                        value="no"
                        {{ old('is_public') == 'no' ? 'selected' : '' }}
                    >
                        {{ trans('admin.no') }}
                    </option>

                </select>

                @error('is_public')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror

            </div>


            {{-- Submit --}}
            <button
                type="submit"
                class="btn btn-primary"
            >
                {{ trans('admin.add') }}
            </button>


        </form>

    </div>

</div>

@endsection
