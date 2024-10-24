@extends('layouts.app')

@section('content')
    <div class="col-md-12 form-theme">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <h3>Default prices ({{ \App\Models\Opay::CURRENCY }})</h3>

        <form action="{{ route('prices.update') }}" method="POST">
            @csrf
            @foreach ($items as $i => $item)
                <div class="form-group">
                    <label for="item-{{ $i }}" class="control-label">{{ $item->name }}</label>
                    <input type="text" name="[{{ $i }}][description]" id="item-{{ $i }}" class="form-control" value="{{ old("[$i.description]", $item->description) }}">
                    <input type="text" name="[{{ $i }}][value]" class="form-control" value="{{ old("[$i.value]", $item->value) }}">
                    @error("[$i.value]")
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            @endforeach

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
