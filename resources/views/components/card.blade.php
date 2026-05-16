<div class="card shadow h-100">
    <img src="{{ $announcement->images->isNotEmpty() ? $announcement->images->first()->getUrl(300, 300) : 'https://picsum.photos/400/300' }}" class="card-img-top" alt="Immagine annuncio">
    
    <div class="card-body d-flex flex-column">
        <h5 class="card-title">{{ $announcement->title }}</h5>
        <p class="card-text text-truncate">{{ $announcement->description }}</p>
        <p class="fw-bold mt-auto">{{ $announcement->price }}€</p>
        
        <hr>
        
        @if($announcement->category)
            <p class="small text-muted m-0">
                <a href="{{ route('categoryShow', ['category' => $announcement->category->id]) }}" class="text-decoration-none">
                    <span class="badge bg-success text-white shadow-sm py-1 px-2">
                        {{ __('ui.category') }}: {{ __("ui.{$announcement->category->name}") }}
                    </span>
                </a>
            </p>
        @else
            <p class="small text-muted m-0">Categoria: <span class="badge bg-info text-dark">Nessuna</span></p>
        @endif
        
        <p class="small text-muted mt-1 mb-0">Autore: {{ $announcement->user->name ?? 'Sconosciuto' }}</p>
        
        <a href="{{ route('announcements.show', $announcement) }}" class="btn btn-primary w-100 mt-3 shadow">{{ __('ui.view') }}</a>
    </div>
</div>