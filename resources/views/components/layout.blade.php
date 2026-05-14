<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Presto.it</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <x-navbar />

    <div class="min-vh-100">
        @if (session()->has('message'))
            <div class="container mt-3">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8">
                        <div class="alert alert-success shadow text-center">
                            {{ session('message') }}
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="container mt-3">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8">
                        <div class="alert alert-danger shadow">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{ $slot }}
    </div>

    </body>
</html>