@extends('admin.index')
@section('content')


<div class="box">
  <div class="box-header">
    <h3 class="box-title">{{ $title }}</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
   <form action="{{ aurl('cities') }}" method="POST">

    @csrf

    <div class="form-group">
        <label for="city_name_ar">
            {{ trans('admin.city_name_ar') }}
        </label>

        <input
            type="text"
            name="city_name_ar"
            id="city_name_ar"
            value="{{ old('city_name_ar') }}"
            class="form-control"
        >
    </div>


    <div class="form-group">
        <label for="city_name_en">
            {{ trans('admin.city_name_en') }}
        </label>

        <input
            type="text"
            name="city_name_en"
            id="city_name_en"
            value="{{ old('city_name_en') }}"
            class="form-control"
        >
    </div>


    <div class="form-group">
        <label for="country_id">
            {{ trans('admin.country_id') }}
        </label>

        <select name="country_id" id="country_id" class="form-control">

            @foreach(
                App\Models\Country::pluck(
                    'country_name_' . session('lang'),
                    'id'
                ) as $id => $name
            )
                <option value="{{ $id }}"
                    {{ old('country_id') == $id ? 'selected' : '' }}>
                    {{ $name }}
                </option>
            @endforeach

        </select>
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
