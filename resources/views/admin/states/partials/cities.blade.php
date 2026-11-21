<select name="city_id" id="city_id" class="form-control">

    <option value="">.............</option>

    @foreach($cities as $id => $name)

        <option
            value="{{ $id }}"
            {{ $select == $id ? 'selected' : '' }}
        >
            {{ $name }}
        </option>

    @endforeach

</select>
