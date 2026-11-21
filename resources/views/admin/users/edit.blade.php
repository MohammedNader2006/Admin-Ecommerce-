@extends('admin.index')

@section('content')

<div class="box">

    <div class="box-header">
        <h3 class="box-title">{{ $title }}</h3>
    </div>

    <div class="box-body">

        <form action="{{ aurl('users/' . $user->id) }}" method="POST">

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
                    value="{{ $user->name }}"
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
                    value="{{ $user->email }}"
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

            <div class="form-group">

    <label for="level">
        {{ trans('admin.level') }}
    </label>

    <select name="level" id="level" class="form-control">

        <option value="">.............</option>

        <option value="user" {{ old('level') == 'user' ? 'selected' : '' }}>
            {{ trans('admin.user') }}
        </option>

        <option value="vendor" {{ old('level') == 'vendor' ? 'selected' : '' }}>
            {{ trans('admin.vendor') }}
        </option>

        <option value="company" {{ old('level') == 'company' ? 'selected' : '' }}>
            {{ trans('admin.company') }}
        </option>

    </select>

</div>

            <button type="submit" class="btn btn-primary">
                {{ trans('admin.save') }}
            </button>

        </form>

    </div>

</div>

@endsection
