<x-layout>
    <div class="container-fluid p-5 bg-info text-center text-white shadow mb-5">
        <div class="row">
            <div class="col-12">
                <h1 class="display-2">Lavora con noi</h1>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                @if(Auth::user()->is_revisor)
                    <div class="alert alert-info text-center shadow">
                        <h3>Sei già un revisore!</h3>
                        <p>Non hai bisogno di inviare un'altra richiesta.</p>
                        <a href="{{ route('homepage') }}" class="btn btn-primary shadow mt-3">Torna alla Home</a>
                    </div>
                @else
                    <div class="card shadow p-4">
                        <h3 class="text-center mb-4">Invia la tua candidatura</h3>
                        <form action="{{ route('become.revisor') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Perché vuoi diventare revisore?</label>
                                <textarea name="description" class="form-control" rows="5" placeholder="Scrivici qualcosa su di te..." required></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-warning shadow">Invia richiesta</button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layout>