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
                        
                        @if ($announcement_to_check->images->count() > 0)
                            <div id="revisorCarousel" class="carousel slide" data-bs-interval="false">
                                <div class="carousel-inner">
                                    @foreach ($announcement_to_check->images as $key => $image)
                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                            <div class="row p-3 align-items-center">
                                                <div class="col-12 col-md-6 text-center">
                                                    <img src="{{ $image->getUrl(300, 300) }}" class="img-fluid rounded shadow" alt="Immagine annuncio">
                                                </div>
                                                <div class="col-12 col-md-6 mt-3 mt-md-0">
                                                    <h5 class="custom-card-title text-center mb-3">Revisione Immagine {{ $key + 1 }}</h5>
                                                    <div class="card-body pt-0 ps-3">
                                                        <p class="mb-1"><strong>Adulti:</strong> <span class="{{ $image->adult }}"></span></p>
                                                        <p class="mb-1"><strong>Satira:</strong> <span class="{{ $image->spoof }}"></span></p>
                                                        <p class="mb-1"><strong>Medicina:</strong> <span class="{{ $image->medical }}"></span></p>
                                                        <p class="mb-1"><strong>Violenza:</strong> <span class="{{ $image->violence }}"></span></p>
                                                        <p class="mb-1"><strong>Ammiccante:</strong> <span class="{{ $image->racy }}"></span></p>
                                                    </div>
                                                    <div class="p-3 border-top mt-2">
                                                        <h6 class="mb-2">Tag rilevati:</h6>
                                                        @if ($image->labels)
                                                            @foreach ($image->labels as $label)
                                                                <span class="badge bg-secondary me-1 mb-1">{{ $label }}</span>
                                                            @endforeach
                                                        @else
                                                            <p class="text-muted small mb-0">Nessun tag calcolato</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @if ($announcement_to_check->images->count() > 1)
                                    <button class="carousel-control-prev bg-dark bg-opacity-25 rounded-start" type="button" data-bs-target="#revisorCarousel" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next bg-dark bg-opacity-25 rounded-end" type="button" data-bs-target="#revisorCarousel" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                @endif
                            </div>
                        @else
                            <img src="https://picsum.photos/400/200" class="card-img-top" alt="Immagine di default">
                        @endif

                        <div class="card-body text-center border-top">
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