<x-app-layout>
    <div class="container">
        <h1 class="text-2xl font-semibold mb-4">Tambah Kategori Baru</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('categories.store') }}">
            @csrf
            <div class="mb-4">
                <label for="name" class="form-label">Nama Kategori</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" 
                        class="form-control" required>
            </div>

            <div class="mb-4">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea name="description" id="description" 
                            class="form-control">{{ old('description') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                Simpan
            </button>
        </form>
    </div>
</x-app-layout>