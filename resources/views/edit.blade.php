@extends('layout.components')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2>Edit Book</h2>
            </div>
            <div class="card-body">
                <!-- Form Edit Buku -->
                <form action="{{ route('update', $books->id) }}" method="POST">
                    @csrf
                    @method('PUT')
            
                    <!-- Input untuk Judul -->
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul:</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $books->title) }}" required>
                    </div>

                    <!-- Input untuk Penulis -->
                    <div class="mb-3">
                        <label for="author" class="form-label">Penulis:</label>
                        <input type="text" name="author" id="author" class="form-control" value="{{ old('author', $books->author) }}" required>
                    </div>

                    <!-- Input untuk Harga -->
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga:</label>
                        <input type="number" name="harga" id="harga" class="form-control" value="{{ old('harga', $books->harga) }}" required>
                    </div>

                    <!-- Input untuk Tanggal Terbit -->
                    <div class="mb-3">
                        <label for="tanggal_terbit" class="form-label">Tanggal Terbit:</label>
                        <input type="date" name="tanggal_terbit" id="tanggal_terbit" class="form-control" value="{{ old('tanggal_terbit', $books->tanggal_terbit) }}" required>
                    </div>

                    <!-- Tombol Update -->
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Update</button>

                        <!-- Tombol Back -->
                        <a href="{{ route('buku') }}" class="btn btn-secondary">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
