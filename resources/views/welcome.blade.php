<x-layout>
    <div class="container-fluid p-5 bg-info text-center text-white shadow">
        <div class="row">
            <div class="col-12">
                <h1 class="display-1">Presto.it</h1>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="row">
            @foreach ($announcements as $announcement)
                <div class="col-12 col-md-4 my-3">
                    <x-card :announcement="$announcement" />
                </div>
            @endforeach
        </div>
    </div>

    <footer class="container-fluid bg-dark text-white py-5 mt-5">
        <div class="row text-center">
            <div class="col-12">
                <p class="lead">{{ __('ui.earnWithUs') }}</p>
                <p>{{ __('ui.becomeRevisor') }}</p>
                <a href="{{ route('revisor.form') }}" class="btn btn-warning shadow">{{ __('ui.workWithUs') }}</a>
            </div>
        </div>
    </footer>
</x-layout>