@extends('admin.index')

@section('content')

@push('js')
<script>
    $(document).ready(function () {

        // لو رجعنا للصفحة بسبب Validation Error
        // وكان فيه Country مختارة قبل كده
        @if(old('country_id'))

            $.ajax({
                url: '{{ aurl('states/create') }}',
                type: 'GET',
                dataType: 'html',

                data: {
                    country_id: '{{ old('country_id') }}',
                    select: '{{ old('city_id') }}'
                },

                success: function (data) {
                    $('.city').html(data);
                }
            });

        @endif


        // عند تغيير الدولة
        $(document).on('change', '.country_id', function () {

            let countryId = $(this).val();

            if (countryId > 0) {

                $.ajax({
                    url: '{{ aurl('states/create') }}',
                    type: 'GET',
                    dataType: 'html',

                    data: {
                        country_id: countryId,
                        select: ''
                    },

                    success: function (data) {
                        $('.city').html(data);
                    },

                    error: function () {
                        $('.city').html(
                            '<p class="text-danger">حدث خطأ أثناء تحميل المدن</p>'
                        );
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

    <div class="box-body">

        <form action="{{ aurl('states') }}" method="POST">

            @csrf

            <div class="form-group">
                <label for="state_name_ar">
                    {{ trans('admin.state_name_ar') }}
                </label>

                <input
                    type="text"
                    name="state_name_ar"
                    id="state_name_ar"
                    value="{{ old('state_name_ar') }}"
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
                    value="{{ old('state_name_en') }}"
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

                    <option value="">.............</option>

                    @foreach(
                        App\Models\Country::pluck(
                            'country_name_' . session('lang'),
                            'id'
                        ) as $id => $name
                    )

                        <option
                            value="{{ $id }}"
                            {{ old('country_id') == $id ? 'selected' : '' }}
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


            <button type="submit" class="btn btn-primary">
                {{ trans('admin.add') }}
            </button>

        </form>

    </div>

</div>

@endsection
