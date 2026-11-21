@extends('admin.index')

@section('content')

<div class="box">

    <div class="box-header">
        <h3 class="box-title">{{ $title }}</h3>
    </div>

    <div class="box-body">

        <form action="{{ aurl('admin/' . $admin->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">
                    {{ trans('admin.name') }}
                </label>

                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ $admin->name }}"
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
                    value="{{ $admin->email }}"
                    class="form-control"
                >
            </div>

            <div class="form-group">
                <label for="password">
                    {{ trans('admin.password') }}
                </label>

                <input
                    type="password"
                    name="password"
                    id="password"
                    class="form-control"
                >
            </div>

            <button type="submit" class="btn btn-primary">
                {{ trans('admin.save') }}
            </button>

        </form>

    </div>

</div>

@endsection
