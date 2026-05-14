<x-layout>
    <div class="container-fluid p-5 bg-info text-center text-white shadow mb-4">
        <div class="row">
            <div class="col-12">
                <h1 class="display-1">Presto.it</h1>
                <p class="lead">Il miglior portale di annunci in Italia</p>
            </div>
        </div>
    </div>

    @if (session('message'))
        <div class="alert alert-success shadow">
            {{ session('message') }}
        </div>
    @endif

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 text-center mb-5">
                <h2 class="display-4">Gli ultimi annunci</h2>
            </div>
        </div>
        
        <div class="row">
            @forelse($announcements as $announcement)
                <div class="col-12 col-md-4 mb-4">
                    <x-card :announcement="$announcement" />
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="h3">Non sono ancora stati inseriti annunci.</p>
                    <a href="{{ route('announcements.create') }}" class="btn btn-primary">Pubblica il primo!</a>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>