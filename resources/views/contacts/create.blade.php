@extends('layouts.contact')

@section('content')
<div class="container mt-4">
    <h2>Pridėti kontaktą</h2>

    {{-- Validacijos klaidų atvaizdavimas --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('contacts.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Vardas</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Telefonas</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">El. paštas</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <button type="submit" class="btn btn-success">Išsaugoti</button>
        <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Atgal</a>
    </form>
</div>
@endsection