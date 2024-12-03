@extends('components.layout')
@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3>Detail Buku</h3>
        </div>
        <div class="card-body">
            <!-- Menampilkan Info Buku -->
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ asset('storage/img/'.$book->image) }}" class="img-fluid rounded" alt="Book Image">
                </div>
                <div class="col-md-8">
                    <h4>{{ $book->title }}</h4>
                    <p><strong>Penulis:</strong> {{ $book->author }}</p>
                    <p><strong>Harga:</strong> Rp{{ number_format($book->harga, 2, ',', '.') }}</p>
                    <p><strong>Tanggal Terbit:</strong> {{ \Carbon\Carbon::parse($book->tanggal_terbit)->format('d F Y') }}</p>
                </div>
            </div>

            <hr>

             <!-- Menampilkan Galeri Gambar -->
             <h5 class="mb-3">Galeri Gambar Buku</h5>
             <div class="row g-3">
                 @foreach($book->galleries as $gallery)
                 <div class="col-md-3 col-sm-4 text-center">
                     <img src="{{ asset('storage/galleries/'.$gallery->image) }}" 
                          class="img-fluid rounded shadow-sm mb-2" 
                          style="max-height: 150px; object-fit: cover;" 
                          alt="Gallery Image">
                     <p class="text-muted small">{{ $gallery->caption ?? 'Tidak ada keterangan' }}</p>
                 </div>
                 @endforeach
             </div>

            <a href="{{ route('buku') }}" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    </div>
</div>
@endsection
