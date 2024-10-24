@extends('layouts.app')

@section('content')
    <h1>Price in {{ \App\Models\Opay::CURRENCY }}</h1>

    <div class="table-responsive">
        <table id="price-grid" class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dataProvider as $data)
                    <tr>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->value }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
