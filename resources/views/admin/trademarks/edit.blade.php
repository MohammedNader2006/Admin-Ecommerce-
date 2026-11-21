@extends('admin.index')
@section('content')


<div class="box">
  <div class="box-header">
    <h3 class="box-title">{{ $title }}</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
  <form
    action="{{ aurl('countries/' . $trademark->id) }}"
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
            value="{{ $trademark->name_ar }}"
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
            value="{{ $trademark->name_en }}"
            class="form-control"
        >
    </div>

    <div class="form-group">
        <label for="logo">
            {{ trans('admin.trade_icon') }}
        </label>

        <input
            type="file"
            name="logo"
            id="logo"
            class="form-control"
        >

        @if (!empty($trademark->logo))
            <img
                src="{{ Storage::url($trademark->logo) }}"
                style="width: 50px; height: 50px;"
            >
        @endif
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
