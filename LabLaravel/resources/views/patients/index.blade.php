@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Patients</h1>

        <form method="get" class="mb-4">
            <input type="text" name="name" placeholder="Search by name" value="{{ request('name') }}">
            <input type="number" name="itemsPerPage" placeholder="Items per page" value="{{ request('itemsPerPage', 10) }}">
            <button type="submit">Filter</button>
        </form>

        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($patients as $patient)
                <tr>
                    <td>{{ $patient->id }}</td>
                    <td>{{ $patient->name }}</td>
                    <td>{{ $patient->email }}</td>
                    <td>
                        <a href="{{ route('patients.show', $patient) }}">Show</a>
                        <a href="{{ route('patients.edit', $patient) }}">Edit</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No records found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="pagination">
            {{ $patients->withQueryString()->links() }}
        </div>
    </div>
@endsection
