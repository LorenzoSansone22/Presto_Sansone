<x-layout>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <h1 class="text-center display-4 mb-4">Registrati</h1>

                <form action="/register" method="POST" class="p-5 shadow rounded bg-light">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nome Utente</label>
                        <input type="text" name="name" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Conferma Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Registrati</button>
                        <a href="{{ route('login') }}" class="mt-3 text-center text-muted">Già registrato? Accedi qui</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>