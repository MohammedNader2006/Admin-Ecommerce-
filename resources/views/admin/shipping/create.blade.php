@extends('admin.index')

@section('content')

@push('js')

<script
    type="text/javascript"
    src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyB-mb0VKOIEyBQg2yihyIid-utKd0Bq_rs"
></script>

<script
    type="text/javascript"
    src="{{ asset('design/adminlte/dist/js/locationpicker.jquery.js') }}"
></script>

@php
    $lat = old('lat', '30.034024628931657');
    $lng = old('lng', '31.24238681793213');
@endphp

<script>
$(document).ready(function () {

    $('#us1').locationpicker({

        location: {
            latitude: {{ $lat }},
            longitude: {{ $lng }}
        },

        radius: 300,

        markerIcon: '{{ asset('design/adminlte/dist/img/map-marker-2-xl.png') }}',

        inputBinding: {
            latitudeInput: $('#lat'),
            longitudeInput: $('#lng')
        }

    });

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
            action="{{ aurl('shipping') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf


            {{-- Latitude --}}
        <input
    type="hidden"
    value="{{ old('lat', '30.034024628931657') }}"
    id="lat"
    name="lat"
>
<input
    type="hidden"
    value="{{ old('lng', '31.24238681793213') }}"
    id="lng"
    name="lng"
>


            {{-- Arabic Name --}}
            <div class="form-group">

                <label for="name_ar">
                    {{ trans('admin.name_ar') }}
                </label>

                <input
                    type="text"
                    name="name_ar"
                    id="name_ar"
                    value="{{ old('name_ar') }}"
                    class="form-control"
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
                    value="{{ old('name_en') }}"
                    class="form-control"
                >

                @error('name_en')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror

            </div>


            {{-- Owner --}}
            <div class="form-group">

                <label for="user_id">
                    {{ trans('admin.owner_id') }}
                </label>

                <select
                    name="user_id"
                    id="user_id"
                    class="form-control"
                >

                    <option value="">
                        {{ trans('admin.choose') }}
                    </option>

                    @foreach(
                        App\Models\User::where('level', 'company')
                            ->pluck('name', 'id')
                        as $id => $name
                    )

                        <option
                            value="{{ $id }}"
                            {{ old('user_id') == $id ? 'selected' : '' }}
                        >
                            {{ $name }}
                        </option>

                    @endforeach

                </select>

                @error('user_id')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror

            </div>


            {{-- Map --}}
            <div class="form-group">

                <div
                    id="us1"
                    style="width: 100%; height: 400px;"
                ></div>

            </div>


            {{-- Shipping Icon --}}
            <div class="form-group">

                <label for="icon">
                    {{ trans('admin.ship_icon') }}
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
