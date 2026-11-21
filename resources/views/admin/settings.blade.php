@extends('admin.index')

@section('content')

<div class="box">

    <div class="box-header">
        <h3 class="box-title">{{ $title }}</h3>
    </div>

    <div class="box-body">

        <form action="{{ aurl('settings') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="form-group">
                <label for="sitename_ar">
                    {{ trans('admin.sitename_ar') }}
                </label>

                <input
                    type="text"
                    name="sitename_ar"
                    id="sitename_ar"
                    value="{{ setting()->sitename_ar }}"
                    class="form-control"
                >
            </div>


            <div class="form-group">
                <label for="sitename_en">
                    {{ trans('admin.sitename_en') }}
                </label>

                <input
                    type="text"
                    name="sitename_en"
                    id="sitename_en"
                    value="{{ setting()->sitename_en }}"
                    class="form-control"
                >
            </div>


            <div class="form-group">
                <label for="email">
                    {{ trans('admin.email') }}
                </label>

                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ setting()->email }}"
                    class="form-control"
                >
            </div>


            <div class="form-group">
                <label for="logo">
                    {{ trans('admin.logo') }}
                </label>

                <input
                    type="file"
                    name="logo"
                    id="logo"
                    class="form-control"
                >
                @if (!empty(setting()->logo))
                <img src="{{ Storage::url(setting()->logo) }}" style="width: 50px"/>
                @endif
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
                @if (!empty(setting()->logo))
                <img src="{{ Storage::url(setting()->icon) }}" style="width: 50px"/>
                @endif
            </div>


            <div class="form-group">
                <label for="description">
                    {{ trans('admin.description') }}
                </label>

                <textarea
                    name="description"
                    id="description"
                    class="form-control"
                >{{ setting()->description }}</textarea>
            </div>


            <div class="form-group">
                <label for="keywords">
                    {{ trans('admin.keywords') }}
                </label>

                <textarea
                    name="keywords"
                    id="keywords"
                    class="form-control"
                >{{ setting()->keywords }}</textarea>
            </div>


            <div class="form-group">
                <label for="main_lang">
                    {{ trans('admin.main_lang') }}
                </label>

                <select name="main_lang" id="main_lang" class="form-control">

                    <option value="ar" {{ setting()->main_lang == 'ar' ? 'selected' : '' }}>
                        {{ trans('admin.ar') }}
                    </option>

                    <option value="en" {{ setting()->main_lang == 'en' ? 'selected' : '' }}>
                        {{ trans('admin.en') }}
                    </option>

                </select>
            </div>


            <div class="form-group">
                <label for="status">
                    {{ trans('admin.status') }}
                </label>

                <select name="status" id="status" class="form-control">

                    <option value="open" {{ setting()->status == 'open' ? 'selected' : '' }}>
                        {{ trans('admin.open') }}
                    </option>

                    <option value="close" {{ setting()->status == 'close' ? 'selected' : '' }}>
                        {{ trans('admin.close') }}
                    </option>

                </select>
            </div>


            <div class="form-group">
                <label for="message_maintenance">
                    {{ trans('admin.message_maintenance') }}
                </label>

                <textarea
                    name="message_maintenance"
                    id="message_maintenance"
                    class="form-control"
                >{{ setting()->message_maintenance }}</textarea>
            </div>


            <button type="submit" class="btn btn-primary">
                {{ trans('admin.save') }}
            </button>

        </form>

    </div>

</div>

@endsection
