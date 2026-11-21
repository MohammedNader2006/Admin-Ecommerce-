@extends('admin.index')

@section('content')

@push('js')
<script type="text/javascript">

$(document).ready(function(){

    $('#jstree').jstree({
        "core": {
            'data': {!! load_dep(old('parent_id')) !!},
            "themes": {
                "variant": "large"
            }
        },

        "checkbox": {
            "keep_selected_style": false
        },

        "plugins": ["wholerow"]
    });

});


$('#jstree').on('changed.jstree', function(e, data){

    var i, j, r = [];

    for(i = 0, j = data.selected.length; i < j; i++)
    {
        r.push(
            data.instance.get_node(data.selected[i]).id
        );
    }

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

    <!-- /.box-header -->

    <div class="box-body">

        <form
            action="{{ aurl('departments') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf


            <div class="form-group">

                <label for="dep_name_ar">
                    {{ trans('admin.dep_name_ar') }}
                </label>

                <input
                    type="text"
                    name="dep_name_ar"
                    id="dep_name_ar"
                    value="{{ old('dep_name_ar') }}"
                    class="form-control"
                >

            </div>


            <div class="form-group">

                <label for="dep_name_en">
                    {{ trans('admin.dep_name_en') }}
                </label>

                <input
                    type="text"
                    name="dep_name_en"
                    id="dep_name_en"
                    value="{{ old('dep_name_en') }}"
                    class="form-control"
                >

            </div>


            <div class="clearfix"></div>


            <div id="jstree"></div>


            <input
                type="hidden"
                name="parent_id"
                class="parent_id"
                value="{{ old('parent_id') }}"
            >


            <div class="clearfix"></div>


            <div class="form-group">

                <label for="description">
                    {{ trans('admin.description') }}
                </label>

                <textarea
                    name="description"
                    id="description"
                    class="form-control"
                    rows="4"
                >{{ old('description') }}</textarea>

            </div>


            <div class="form-group">

                <label for="keyword">
                    {{ trans('admin.keyword') }}
                </label>

                <textarea
                    name="keyword"
                    id="keyword"
                    class="form-control"
                    rows="4"
                >{{ old('keyword') }}</textarea>

            </div>


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

            </div>


            <button
                type="submit"
                class="btn btn-primary"
            >
                {{ trans('admin.add') }}
            </button>


        </form>

    </div>

    <!-- /.box-body -->

</div>

<!-- /.box -->

@endsection
