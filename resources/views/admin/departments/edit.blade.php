@extends('admin.index')

@section('content')

@push('js')

<script type="text/javascript">

$(document).ready(function () {

    $('#jstree').jstree({
        "core": {
            
            "data": {!! load_dep($department->parent_id, $department->id) !!},

            "themes": {
                "variant": "large"
            }
        },

        "checkbox": {
            "keep_selected_style": false
        },

        "plugins": [
            "wholerow"
        ]
    });

});


$('#jstree').on('changed.jstree', function (e, data) {

    var i, j, r = [];

    for (
        i = 0, j = data.selected.length;
        i < j;
        i++
    ) {

        r.push(
            data.instance
                .get_node(data.selected[i])
                .id
        );

    }

    /*
    حفظ ID القسم الأب في hidden input
    */
    $('.parent_id').val(r.join(', '));

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
            action="{{ aurl('departments/' . $department->id) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf

            @method('PUT')


            {{-- Department Arabic Name --}}
            <div class="form-group">

                <label for="dep_name_ar">
                    {{ trans('admin.dep_name_ar') }}
                </label>

                <input
                    type="text"
                    name="dep_name_ar"
                    id="dep_name_ar"
                    class="form-control"
                    value="{{ old('dep_name_ar', $department->dep_name_ar) }}"
                >

                @error('dep_name_ar')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror

            </div>


            {{-- Department English Name --}}
            <div class="form-group">

                <label for="dep_name_en">
                    {{ trans('admin.dep_name_en') }}
                </label>

                <input
                    type="text"
                    name="dep_name_en"
                    id="dep_name_en"
                    class="form-control"
                    value="{{ old('dep_name_en', $department->dep_name_en) }}"
                >

                @error('dep_name_en')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror

            </div>


            <div class="clearfix"></div>


            {{-- Departments Tree --}}
            <div id="jstree"></div>


            {{-- Parent Department --}}
            <input
                type="hidden"
                name="parent_id"
                class="parent_id"
                value="{{ old('parent_id', $department->parent_id) }}"
            >


            <div class="clearfix"></div>


            {{-- Description --}}
            <div class="form-group">

                <label for="description">
                    {{ trans('admin.description') }}
                </label>

                <textarea
                    name="description"
                    id="description"
                    class="form-control"
                    rows="4"
                >{{ old('description', $department->description) }}</textarea>

                @error('description')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror

            </div>


            {{-- Keyword --}}
            <div class="form-group">

                <label for="keyword">
                    {{ trans('admin.keyword') }}
                </label>

                <textarea
                    name="keyword"
                    id="keyword"
                    class="form-control"
                    rows="4"
                >{{ old('keyword', $department->keyword) }}</textarea>

                @error('keyword')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror

            </div>


            {{-- Icon --}}
            <div class="form-group">

                <label for="icon">
                    {{ trans('admin.icon') }}
                </label>

                <input
                    type="file"
                    name="icon"
                    id="icon"
                    class="form-control"
                >

                @error('icon')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror


                @if(
                    !empty($department->icon)
                    && Storage::disk('public')->exists($department->icon)
                )

                    <img
                        src="{{ Storage::disk('public')->url($department->icon) }}"
                        alt="{{ $department->dep_name_en }}"
                        style="width: 100px; height: 100px;"
                    >

                @endif

            </div>


            {{-- Submit --}}
            <button
                type="submit"
                class="btn btn-primary"
            >
                {{ trans('admin.save') }}
            </button>

        </form>

    </div>

</div>

@endsection
