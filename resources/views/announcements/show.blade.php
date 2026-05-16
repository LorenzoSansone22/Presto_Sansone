<x-layout>
    <div class="container-fluid p-5 bg-info text-center text-white shadow mb-5">
        <div class="row">
            <div class="col-12">
                <h1 class="display-1 text-capitalize">Annuncio: {{ $announcement->title }}</h1>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 shadow rounded p-5 bg-light">
                <div class="row">
                    <div class="col-12 col-md-6">
                        @if ($announcement->images->count() > 0)
                            <div id="showCarousel" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($announcement->images as $key => $image)
                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                            <img src="{{ $image->getUrl(300, 300) }}" class="img-fluid rounded shadow w-100" alt="Immagine annuncio" style="max-height: 400px; object-fit: cover;">
                                        </div>
                                    @endforeach
                                </div>
                                @if ($announcement->images->count() > 1)
                                    <button class="carousel-control-prev" type="button" data-bs-target="#showCarousel" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#showCarousel" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                @endif
                            </div>
                        @else
                            <img src="https://picsum.photos/600/400" class="img-fluid rounded shadow" alt="Immagine di default">
                        @endif
                    </div>

                    <div class="col-12 col-md-6">
                        <h2 class="display-5">{{ $announcement->title }}</h2>
                        <h4 class="text-muted mt-3">Prezzo: {{ $announcement->price }}€</h4>
                        <div class="mt-4">
                            <h5>Descrizione:</h5>
                            <p>{{ $announcement->description }}</p>
                        </div>
                        <hr>
                        <p><strong>Categoria:</strong> {{ $announcement->category->name ?? 'Nessuna' }}</p>
                        <p><strong>Pubblicato da:</strong> {{ $announcement->user->name ?? 'Sconosciuto' }}</p>
                        <p><strong>Data di pubblicazione:</strong> {{ $announcement->created_at->format('d/m/Y') }}</p>
                        
                        <a href="{{ route('announcements.index') }}" class="btn btn-outline-info mt-3">Torna a tutti gli annunci</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>