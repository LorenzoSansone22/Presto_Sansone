<x-layout>
    <div class="container-fluid p-5 bg-info text-center text-white shadow">
        <div class="row">
            <div class="col-12">
                <h1 class="display-2">Esplora la categoria: {{ $category->name }}</h1>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="row">
            @forelse ($announcements as $announcement)
                <div class="col-12 col-md-4 my-3">
                    <div class="card shadow" style="width: 18rem;">
                        <img src="https://picsum.photos/200" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $announcement->title }}</h5>
                            <p class="card-text">{{ $announcement->description }}</p>
                            <p class="card-text">{{ $announcement->price }}€</p>
                            <a href="{{ route('announcements.show', $announcement) }}" class="btn btn-primary shadow">Visualizza</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="h3">Non sono ancora stati pubblicati annunci per questa categoria.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>