@extends('components.layout')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2>Edit Book</h2>
            </div>
            <div class="card-body">
                <!-- Form Edit Buku -->
                <form action="{{ route('update', $books->id) }}" method="POST" enctype="multipart/form-data">
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
                    
                                        
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga:</label>
                        <input type="number" name="harga" id="harga" class="form-control" value="{{ old('harga', $books->harga) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="discount" class="form-label">Diskon (%):</label>
                        <input type="number" name="discount" id="discount" class="form-control" value="{{ old('discount', $books->discount) }}" step="0.01">
                    </div>


                
                    <!-- Input untuk Tanggal Terbit -->
                    <div class="mb-3">
                        <label for="tanggal_terbit" class="form-label">Tanggal Terbit:</label>
                        <input type="date" name="tanggal_terbit" id="tanggal_terbit" class="form-control" value="{{ old('tanggal_terbit', $books->tanggal_terbit) }}" required>
                    </div>

                    <!-- Image -->
                   <div class="mb-3">
                       <label for="image" class="form-label">Image</label>
                       <input type="file" name="image" id="image" class="form-control" required>
                   </div>
                    
                    <!-- Existing gallery images -->
                    <h4>Gambar Galeri:</h4>
                    <div class="gallery mb-3">
                        @foreach($books->galleries as $gallery)
                            <div class="mb-3">
                                <img src="{{ asset('storage/galleries/' . $gallery->image) }}" class="rounded w-25" alt="Gallery Image">
                                <!-- Input untuk keterangan gambar -->
                                <div class="mt-2">
                                    <label for="gallery_caption_{{ $gallery->id }}" class="form-label">Keterangan:</label>
                                    <input type="text" name="gallery_caption[{{ $gallery->id }}]" id="gallery_caption_{{ $gallery->id }}" class="form-control" value="{{ old('gallery_caption.' . $gallery->id, $gallery->caption) }}">
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Input untuk gambar galeri baru -->
                    <div class="form-group">
                        <label for="gallery_images">Tambah Gambar Galeri:</label>
                        <input type="file" name="gallery_images[]" class="form-control" multiple>
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
