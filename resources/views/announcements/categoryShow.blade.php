<x-layout>
    <div class="container-fluid p-5 bg-info text-center text-white shadow mb-5">
        <h1>Esplora la categoria: {{ $category->name }}</h1>
    </div>

    <div class="container">
        <div class="row">
            @forelse ($category->announcements()->latest()->get() as $announcement)
                <div class="col-12 col-md-4 mb-4">
                    <div class="card shadow">
                        <img src="https://picsum.photos/300/200" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $announcement->title }}</h5>
                            <p class="card-text">Prezzo: {{ $announcement->price }}€</p>
                            <a href="{{ route('announcements.show', $announcement) }}" class="btn btn-primary">Visualizza</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="lead">Non ci sono ancora annunci per questa categoria.</p>
                    <a href="{{ route('announcements.create') }}" class="btn btn-info">Pubblicane uno tu!</a>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>