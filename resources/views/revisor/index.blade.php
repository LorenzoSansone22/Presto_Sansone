<x-layout>
    <div class="container-fluid p-5 bg-info text-center text-white shadow mb-5">
        <div class="row">
            <div class="col-12">
                <h1 class="display-2">
                    {{ $announcement_to_check ? 'Annuncio da revisionare' : 'Non ci sono annunci da revisionare' }}
                </h1>
            </div>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="container mt-3">
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        </div>
    @endif

    <div class="container my-5">
        <div class="row justify-content-center mb-4">
            <div class="col-12 col-md-8 d-flex justify-content-end">
                <form action="{{ route('revisor.undo') }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-warning shadow">Annulla ultima revisione</button>
                </form>
            </div>
        </div>

        @if ($announcement_to_check)
            <div class="row justify-content-center">
                <div class="col-12 col-md-8">
                    <div class="card shadow">
                        <img src="https://picsum.photos/400/200" class="card-img-top" alt="...">
                        <div class="card-body text-center">
                            <h5 class="card-title">Titolo: {{ $announcement_to_check->title }}</h5>
                            <p class="card-text">Descrizione: {{ $announcement_to_check->description }}</p>
                            <p class="card-text">Prezzo: {{ $announcement_to_check->price }}€</p>
                            <p class="card-text text-muted small">Pubblicato il: {{ $announcement_to_check->created_at->format('d/m/Y') }}</p>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <form action="{{ route('revisor.reject_announcement', $announcement_to_check) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-danger shadow">Rifiuta</button>
                            </form>
                            
                            <form action="{{ route('revisor.accept_announcement', $announcement_to_check) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success shadow">Accetta</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 text-center">
                    <p class="lead">Ottimo lavoro! La tua coda di revisione è vuota.</p>
                    <a href="{{ route('homepage') }}" class="btn btn-primary shadow">Torna alla Home</a>
                </div>
            </div>
        @endif
    </div>
</x-layout>