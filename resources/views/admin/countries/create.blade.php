@extends('admin.index')
@section('content')


<div class="box">
  <div class="box-header">
    <h3 class="box-title">{{ $title }}</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <form action="{{ aurl('countries') }}" method="POST" enctype="multipart/form-data">

    @csrf

    <div class="form-group">
        <label for="country_name_ar">
            {{ trans('admin.country_name_ar') }}
        </label>

        <input
            type="text"
            name="country_name_ar"
            id="country_name_ar"
            value="{{ old('country_name_ar') }}"
            class="form-control"
        >
    </div>


    <div class="form-group">
        <label for="country_name_en">
            {{ trans('admin.country_name_en') }}
        </label>

        <input
            type="text"
            name="country_name_en"
            id="country_name_en"
            value="{{ old('country_name_en') }}"
            class="form-control"
        >
    </div>


    <div class="form-group">
        <label for="code">
            {{ trans('admin.code') }}
        </label>

        <input
            type="text"
            name="code"
            id="code"
            value="{{ old('code') }}"
            class="form-control"
        >
    </div>


    <div class="form-group">
        <label for="mob">
            {{ trans('admin.mob') }}
        </label>

        <input
            type="text"
            name="mob"
            id="mob"
            value="{{ old('mob') }}"
            class="form-control"
        >
    </div>
    <div class="form-group">
        <label for="currency">
            {{ trans('admin.currency') }}
        </label>

        <input
            type="text"
            name="currency"
            id="currency"
            value="{{ old('currency') }}"
            class="form-control"
        >
    </div>


    <div class="form-group">
        <label for="logo">
            {{ trans('admin.country_flag') }}
        </label>
        <input
            type="file"
            name="logo"
            id="logo"
            class="form-control"
        >
    </div>


    <button type="submit" class="btn btn-primary">
        {{ trans('admin.add') }}
    </button>

</form>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->



@endsection
