@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Patient Details</h1>
        <p><strong>ID:</strong> {{ $patient->id }}</p>
        <p><strong>Name:</strong> {{ $patient->name }}</p>
        <p><strong>Email:</strong> {{ $patient->email }}</p>
        <!-- Додай інші поля за потребою -->
        <a href="{{ route('patients.index') }}" class="btn btn-secondary mt-3">Back</a>
    </div>
@endsection
