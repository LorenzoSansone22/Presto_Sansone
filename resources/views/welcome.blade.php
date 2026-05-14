<x-layout>
    <div class="container-fluid p-5 bg-info text-center text-white shadow">
        <div class="row">
            <div class="col-12">
                <h1 class="display-1">Presto.it</h1>
            </div>
        </div>
    </div>

    {{-- MESSAGGIO RIMOSSO DA QUI --}}

    <div class="container my-5">
        <div class="row">
            @foreach ($announcements as $announcement)
                <div class="col-12 col-md-4 my-3">
                    <div class="card shadow" style="width: 18rem;">
                        <img src="https://picsum.photos/200" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $announcement->title }}</h5>
                            <p class="card-text">{{ $announcement->description }}</p>
                            <p class="card-text">{{ $announcement->price }}€</p>
                            
                            @if($announcement->category)
                                <a href="{{ route('categoryShow', ['category' => $announcement->category->id]) }}" class="my-2 border-top pt-2 border-dark card-link shadow btn btn-success">
                                    Categoria: {{ $announcement->category->name }}
                                </a>
                            @endif
                            
                            <a href="{{ route('announcements.show', $announcement) }}" class="btn btn-primary shadow">Visualizza</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <footer class="container-fluid bg-dark text-white py-5 mt-5">
        <div class="row text-center">
            <div class="col-12">
                <p class="lead">Vuoi guadagnare con noi?</p>
                <p>Diventa un revisore di Presto.it!</p>
                <a href="{{ route('revisor.form') }}" class="btn btn-warning shadow">Lavora con noi</a>
            </div>
        </div>
    </footer>
</x-layout>