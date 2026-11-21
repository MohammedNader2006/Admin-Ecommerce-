@extends('admin.index')

@section('content')

@push('js')

<!-- Delete Modal -->
<div id="delete_bootstrap_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">
                <button type="button"
                        class="close"
                        data-dismiss="modal">
                    &times;
                </button>

                <h4 class="modal-title">
                    {{ trans('admin.delete') }}
                </h4>
            </div>

            <form action=""
                  method="POST"
                  id="form_Delete_department">

                @csrf
                @method('DELETE')

                <div class="modal-body">
                    <h4>
                        {{ trans('admin.ask_delete_dep') }}

                        <span id="dep_name"></span>
                    </h4>
                </div>

                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-info"
                            data-dismiss="modal">
                        {{ trans('admin.close') }}
                    </button>

                    <button type="submit"
                            class="btn btn-danger">
                        {{ trans('admin.yes') }}
                    </button>

                </div>

            </form>

        </div>

    </div>
</div>


<script type="text/javascript">

$(document).ready(function () {

    $('#jstree').jstree({
        "core": {
            "data": {!! load_dep() !!},

            "themes": {
                "variant": "large"
            }
        },

        "checkbox": {
            "keep_selected_style": true
        },

        "plugins": [
            "wholerow"
        ]
    });

});


$('#jstree').on('changed.jstree', function (e, data) {

    var i, j, r = [];
    var name = [];

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

        name.push(
            data.instance
                .get_node(data.selected[i])
                .text
        );

    }

    /*
    Update delete form action
    */
    $('#form_Delete_department').attr(
        'action',
        '{{ aurl('departments') }}/' + r.join(', ')
    );

    /*
    Show selected department name
    */
    $('#dep_name').text(
        name.join(', ')
    );


    if (r.join(', ') != '') {

        $('.showbtn_control').removeClass('hidden');

        /*
        Update edit button URL
        */
        $('.edit_dep').attr(
            'href',
            '{{ aurl('departments') }}/' +
            r.join(', ') +
            '/edit'
        );

    } else {

        $('.showbtn_control').addClass('hidden');

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

        <!-- Edit Button -->
        <a href=""
           class="btn btn-info edit_dep showbtn_control hidden">

            <i class="fa fa-edit"></i>

            {{ trans('admin.edit') }}

        </a>


        <!-- Delete Button -->
        <a href=""
           class="btn btn-danger delete_dep showbtn_control hidden"
           data-toggle="modal"
           data-target="#delete_bootstrap_modal">

            <i class="fa fa-trash"></i>

            {{ trans('admin.delete') }}

        </a>


        <!-- Departments Tree -->
        <div id="jstree"></div>

    </div>

</div>

@endsection
