<!DOCTYPE html>
<html>
<head>
    <title>Geo Form</title>
</head>
<body>
    <h1>Submit Geo Form</h1>

    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('geo.form.submit') }}" method="POST">
        @csrf
        <label for="country_id">Country</label>
        <input type="text" name="country_id" id="country_id" value="{{ old('country_id') }}">

        <label for="region_id">Region</label>
        <input type="text" name="region_id" id="region_id" value="{{ old('region_id') }}">

        <label for="sub_region_id">Sub Region</label>
        <input type="text" name="sub_region_id" id="sub_region_id" value="{{ old('sub_region_id') }}">

        <button type="submit">Submit</button>
    </form>
</body>
</html>
