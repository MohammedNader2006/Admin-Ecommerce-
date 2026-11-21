@extends('admin.index')

@section('content')

@push('js')
<script type="text/javascript">
$(document).ready(function(){

  @if($state->country_id)

  $.ajax({
      url: '{{ aurl('states/create') }}',
      type: 'get',
      dataType: 'html',

      data: {
          country_id: '{{ $state->country_id }}',
          select: '{{ $state->city_id }}'
      },

      success: function(data)
      {
        $('.city').html(data);
      }
  });

  @endif

  $(document).on('change', '.country_id', function(){

    var country = $('.country_id option:selected').val();

    if(country > 0)
    {
      $.ajax({
        url: '{{ aurl('states/create') }}',
        type: 'get',
        dataType: 'html',

        data: {
            country_id: country,
            select: ''
        },

        success: function(data)
        {
          $('.city').html(data);
        }
      });

    } else {
      $('.city').html('');
    }

  });

});
</script>
@endpush


<div class="box">

  <div class="box-header">
    <h3 class="box-title">{{ $title }}</h3>
  </div>

  <!-- /.box-header -->

  <div class="box-body">

    <form
        action="{{ aurl('states/' . $state->id) }}"
        method="POST"
    >

        @csrf
        @method('PUT')


        <div class="form-group">

            <label for="state_name_ar">
                {{ trans('admin.state_name_ar') }}
            </label>

            <input
                type="text"
                name="state_name_ar"
                id="state_name_ar"
                value="{{ $state->state_name_ar }}"
                class="form-control"
            >

        </div>


        <div class="form-group">

            <label for="state_name_en">
                {{ trans('admin.state_name_en') }}
            </label>

            <input
                type="text"
                name="state_name_en"
                id="state_name_en"
                value="{{ $state->state_name_en }}"
                class="form-control"
            >

        </div>


        <div class="form-group">

            <label for="country_id">
                {{ trans('admin.country_id') }}
            </label>

            <select
                name="country_id"
                id="country_id"
                class="form-control country_id"
            >

                <option value="">
                    .............
                </option>

                @foreach(
                    App\Models\Country::pluck(
                        'country_name_' . session('lang'),
                        'id'
                    ) as $id => $name
                )

                    <option
                        value="{{ $id }}"
                        {{ $state->country_id == $id ? 'selected' : '' }}
                    >
                        {{ $name }}
                    </option>

                @endforeach

            </select>

        </div>


        <div class="form-group">

            <label for="city_id">
                {{ trans('admin.city_id') }}
            </label>

            <span class="city"></span>

        </div>


        <button
            type="submit"
            class="btn btn-primary"
        >
            {{ trans('admin.save') }}
        </button>


    </form>

  </div>

  <!-- /.box-body -->

</div>

<!-- /.box -->

@endsection
