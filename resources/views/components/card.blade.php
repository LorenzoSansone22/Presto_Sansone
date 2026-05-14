<div class="card shadow h-100">
    <img src="https://picsum.photos/400/300" class="card-img-top" alt="Immagine annuncio">
    
    <div class="card-body d-flex flex-column">
        <h5 class="card-title">{{ $announcement->title }}</h5>
        <p class="card-text text-truncate">{{ $announcement->description }}</p>
        <p class="fw-bold mt-auto">{{ $announcement->price }}€</p>
        
        <hr>
        
        <p class="small text-muted m-0">Categoria: 
            <span class="badge bg-info text-dark">
                {{ $announcement->category->name ?? 'Nessuna' }}
            </span>
        </p>
        <p class="small text-muted">Autore: {{ $announcement->user->name ?? 'Sconosciuto' }}</p>
        
        <a href="#" class="btn btn-primary w-100 mt-2">Visualizza</a>
    </div>
</div>