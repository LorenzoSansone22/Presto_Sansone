<x-layout>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <h1 class="text-center display-4 mb-4">Accedi</h1>

                <form action="/login" method="POST" class="p-5 shadow rounded bg-light">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" name="remember" class="form-check-input" id="remember">
                        <label class="form-check-label" for="remember">Ricordami</label>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Accedi</button>
                        <a href="{{ route('register') }}" class="mt-3 text-center text-muted">Non sei ancora registrato? Clicca qui</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>