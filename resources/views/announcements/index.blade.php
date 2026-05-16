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
                    <x-card :announcement="$announcement" />
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