<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Медична інформаційна система</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('patients.index') }}">Медична інформаційна система</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <!-- Пацієнти -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('patients.index') }}">Пацієнти</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('patients.create') }}">Додати пацієнта</a>
                </li>

                <!-- Лікарі -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('doctors.index') }}">Лікарі</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('doctors.create') }}">Додати лікаря</a>
                </li>

                <!-- Прийоми -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('appointments.index') }}">Прийоми</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('appointments.create') }}">Додати прийом</a>
                </li>

                <!-- Діагнози -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('diagnoses.index') }}">Діагнози</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('diagnoses.create') }}">Додати діагноз</a>
                </li>

                <!-- Лікування -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('treatments.index') }}">Лікування</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('treatments.create') }}">Додати лікування</a>
                </li>
            </ul>
        </div>
    </nav>

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
