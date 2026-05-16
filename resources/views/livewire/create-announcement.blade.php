<div>
    @if (session()->has('message'))
        <div class="alert alert-success shadow mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="store" class="p-5 shadow rounded bg-light">
        @csrf
        
        <div class="mb-3">
            <label for="title" class="form-label">Titolo Annuncio</label>
            <input type="text" wire:model="title" class="form-control @error('title') is-invalid @enderror">
            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <textarea wire:model="description" class="form-control @error('description') is-invalid @enderror" rows="5"></textarea>
            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Prezzo</label>
            <input type="number" wire:model="price" class="form-control @error('price') is-invalid @enderror">
            @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Categoria</label>
            <select wire:model="category_id" id="category" class="form-control @error('category_id') is-invalid @enderror">
                <option value="">Scegli una categoria</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Immagini</label>
            <input type="file" wire:model="temporary_images" class="form-control @error('temporary_images.*') is-invalid @enderror @error('temporary_images') is-invalid @enderror" multiple>
            @error('temporary_images.*') <div class="invalid-feedback">{{ $message }}</div> @enderror
            @error('temporary_images') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        @if (!empty($images))
            <div class="row mb-3 border border-info rounded p-3">
                <div class="col-12">
                    <p class="fw-bold">Anteprima Immagini:</p>
                    <div class="row">
                        @foreach ($images as $key => $image)
                            <div class="col-4 col-md-2 my-2 text-center">
                                <div class="img-preview mx-auto shadow rounded" style="background-image: url({{ $image->temporaryUrl() }}); width: 100px; height: 100px; background-size: cover; background-position: center;"></div>
                                <button type="button" class="btn btn-danger btn-sm mt-2 shadow" wire:click="removeImage({{ $key }})">Elimina</button>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <button type="submit" class="btn btn-primary shadow px-4 py-2">Crea Annuncio</button>
    </form>
</div>