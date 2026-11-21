@extends('admin.index')
@section('content')
@push('js')

<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-mb0VKOIEyBQg2yihyIid-utKd0Bq_rs&libraries=places">
</script>

<script src="{{ asset('design/adminlte/dist/js/locationpicker.jquery.js') }}"></script>

<script>
$(document).ready(function () {

    var lat = {{ old('lat', '30.034024628931657') }};
    var lng = {{ old('lng', '31.24238681793213') }};

    $('#us1').locationpicker({

        location: {
            latitude: lat,
            longitude:lng
        },

        radius: 300,

        zoom: 15,

        enableAutocomplete: true,

        enableReverseGeocode: true,

        markerIcon: '{{ asset('design/adminlte/dist/img/map-marker-2-xl.png') }}',

        inputBinding: {
            latitudeInput: $('#lat'),
            longitudeInput: $('#lng'),
            locationNameInput: $('#address')
        },

        onchanged: function (currentLocation, radius, isMarkerDropped) {

            console.log('Latitude:', currentLocation.latitude);
            console.log('Longitude:', currentLocation.longitude);

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
    action="{{ aurl('manufacturers/' . $manufacturer->id) }}"
    method="POST"
    enctype="multipart/form-data"
>

    @csrf
    @method('PUT')
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
    <div class="form-group">
        <label for="name_ar">
            {{ trans('admin.name_ar') }}
        </label>

        <input
            type="text"
            name="name_ar"
            id="name_ar"
            value="{{ $manufacturer->name_ar }}"
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
            value="{{ $manufacturer->name_en }}"
            class="form-control"
        >
    </div>
    <div class="form-group">
        <label for="contact_name">
            {{ trans('admin.contact_name') }}
        </label>

        <input
            type="text"
            name="contact_name"
            id="contact_name"
            value="{{ $manufacturer->contact_name }}"
            class="form-control"
        >
    </div>
    <div class="form-group">
        <label for="mobile">
            {{ trans('admin.mobile') }}
        </label>

        <input
            type="number"
            name="mobile"
            id="mobile"
            value="{{ $manufacturer->mobile }}"
            class="form-control"
        >
    </div>

    <div class="form-group">
    <label for="address">
        {{ trans('admin.address') }}
    </label>

    <input
    type="text"
    name="address"
    id="address"
    value="{{ $manufacturer->address }}"
    class="form-control address"
    >
    </div>
         <div class="form-group">
       <div id="us1" style="width: 100%; height: 400px;"></div>
     </div>

    <div class="form-group">
        <label for="email">
            {{ trans('admin.email') }}
        </label>

        <input
            type="email"
            name="email"
            id="email"
            value="{{ $manufacturer->email }}"
            class="form-control"
        >
    </div>
    <div class="form-group">
        <label for="facebook">
            {{ trans('admin.facebook') }}
        </label>

        <input
            type="text"
            name="facebook"
            id="facebook"
            value="{{ $manufacturer->facebook }}"
            class="form-control"
        >
    </div>
    <div class="form-group">
        <label for="twitter">
            {{ trans('admin.twitter') }}
        </label>

        <input
            type="text"
            name="twitter"
            id="twitter"
            value="{{ $manufacturer->twitter }}"
            class="form-control"
        >
    </div>

    <div class="form-group">
        <label for="logo">
            {{ trans('admin.manufacturers_icon') }}
        </label>

        <input
            type="file"
            name="logo"
            id="logo"
            class="form-control"
        >

        @if (!empty($manufacturer->logo))
            <img
                src="{{ Storage::url($manufacturer->logo) }}"
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
