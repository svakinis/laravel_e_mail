@extends('layouts.layout')

@section('content')
<div class="container mt-4">
    <h2>Pridėti naują studentą</h2>
    
    <form action="{{ route('students.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Vardas</label>
            <input type="text" name="vardas" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Pavardė</label>
            <input type="text" name="pavarde" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Adresas</label>
            <input type="text" name="adresas" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Telefonas</label>
            <input type="text" name="telefonas" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Miestas</label>
            <select name="city_id" class="form-control" required>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Išsaugoti</button>
    </form>
</div>
@endsection