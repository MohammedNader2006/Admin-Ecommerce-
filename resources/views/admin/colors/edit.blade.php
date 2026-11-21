@extends('admin.index')
@section('content')

<div class="box">
  <div class="box-header">
    <h3 class="box-title">{{ $title }}</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
  <form
    action="{{ aurl('colors/' . $color->id) }}"
    method="POST"
    enctype="multipart/form-data"
>

    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name_ar">
            {{ trans('admin.name_ar') }}
        </label>

        <input
            type="text"
            name="name_ar"
            id="name_ar"
            value="{{ $color->name_ar }}"
            class="form-control"
        >
    </div>


    <div class="form-group">
        <label for="name_en">
            {{ trans('admin.name_en') }}
        </label>

        <input
            type="text"
            name="name_en"
            id="name_en"
            value="{{ $color->name_en }}"
            class="form-control"
        >
    </div>
    <div class="form-group">
        <label for="color">
            {{ trans('admin.color') }}
        </label>

        <input
            type="color"
            name="color"
            id="color"
            value="{{ $color->color }}"

        >
    </div>

    <button type="submit" class="btn btn-primary">
        {{ trans('admin.save') }}
    </button>

</form>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->



@endsection
