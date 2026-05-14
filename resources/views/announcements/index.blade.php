<x-layout>
    <div class="container-fluid p-5 bg-info text-center text-white shadow mb-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-2">Tutti gli annunci</h1>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="row">
            @forelse ($announcements as $announcement)
                <div class="col-12 col-md-4 mb-4 d-flex justify-content-center">
                    <div class="card shadow" style="width: 18rem;">
                        <img src="https://picsum.photos/300/200" class="card-img-top" alt="Immagine segnaposto">
                        <div class="card-body">
                            <h5 class="card-title">{{ $announcement->title }}</h5>
                            <p class="card-text">Prezzo: {{ $announcement->price }}€</p>
                            
                            {{-- Controllo se la categoria esiste prima di creare il link --}}
                            <p class="card-text">
                                Categoria: 
                                @if($announcement->category)
                                    <a href="{{ route('categoryShow', $announcement->category) }}" class="text-decoration-none fw-bold text-info">
                                        {{ $announcement->category->name }}
                                    </a>
                                @else
                                    <span>Nessuna</span>
                                @endif
                            </p>

                            <p class="card-text text-muted small">Redattore: {{ $announcement->user->name ?? 'Sconosciuto' }}</p>
                            <a href="{{ route('announcements.show', $announcement) }}" class="btn btn-primary shadow">Visualizza</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="lead">Non ci sono ancora annunci.</p>
                    <a href="{{ route('announcements.create') }}" class="btn btn-info">Crea Annuncio</a>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>