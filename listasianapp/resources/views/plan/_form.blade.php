@extends('layouts.app')

@section('content')
<div class="form">
    <form action="{{ route('plans.store') }}" method="POST">
        @csrf
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $model->name) }}">
        </div>

        @if ($model->isNewRecord)
            {{-- Select untuk package --}}
            <div class="form-group">
                <label for="package">Package</label>
                <select name="package" id="package" class="form-control">
                    @foreach (\App\Models\Price::getList() as $key => $value)
                        <option value="{{ $key }}" {{ old('package', $model->package) == $key ? 'selected' : '' }}>{{ $value }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="interval">Interval</label>
                <select name="interval" id="interval" class="form-control">
                    @foreach ($model->intervalList as $key => $value)
                        <option value="{{ $key }}" {{ old('interval', $model->interval) == $key ? 'selected' : '' }}>{{ $value }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="text" name="amount" id="amount" class="form-control" value="{{ old('amount', $model->amount) }}">
            </div>

            <div class="form-group">
                <label for="currency">Currency</label>
                <input type="text" name="currency" id="currency" class="form-control" value="{{ old('currency', $model->currency) }}">
            </div>
        @endif

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div><!-- form -->
@endsection
