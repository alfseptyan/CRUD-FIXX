<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BooksController extends Controller
{
    // Menampilkan daftar buku
    public function index()
    {
        $books = Books::all();

        $editorialPicks = Books::where('is_editorial_pick', true)
            ->take(5)
            ->get();

        $totalBooks = Books::count();
        $totalHarga = Books::sum('harga');
        return view('index', compact('books', 'editorialPicks', 'totalBooks', 'totalHarga'));
    }

    // Menampilkan form create
    public function create()
    {
        return view('create');
    }

    // Menampilkan detail buku
    public function show($id)
    {
        $book = Books::with('galleries')->findOrFail($id);
        return view('detailBuku', compact('book'));
    }

    // Menyimpan buku baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'tanggal_terbit' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_caption.*' => 'nullable|string|max:255',
            
        ]);
    
        // Menyimpan gambar utama
        $imagePath = $request->file('image')->store('public/img');
        
        // Membuat buku baru
        $book = new Books();
        $book->title = $request->title;
        $book->author = $request->author;
        $book->harga = $request->harga;
        $book->discount = $request->discount;
        $book->tanggal_terbit = $request->tanggal_terbit;
    
        // Menghitung harga setelah diskon
        if ($request->discount) {
            $discountAmount = $book->harga * ($request->discount / 100);
            $book->discounted_price = $book->harga - $discountAmount;
        } else {
            $book->discounted_price = $book->harga; // Jika tidak ada diskon
        }
    
        // Menyimpan gambar utama
        $book->image = basename($imagePath);
        $book->save();  // Simpan buku terlebih dahulu agar ada ID untuk galeri
    
        // Menyimpan gambar galeri jika ada
if ($request->hasFile('gallery_images')) {
    foreach ($request->file('gallery_images') as $index => $image) {
        // Menyimpan gambar galeri
        $galleryPath = $image->store('public/galleries');
        
        // Membuat entri galeri terkait dengan buku
        $gallery = $book->galleries()->create([
            'image' => basename($galleryPath),
            'caption' => $request->gallery_caption[$index] ?? null, // Menyimpan keterangan jika ada, atau null jika tidak ada
        ]);
    }
}

    
        return redirect('/buku')->with('status', 'Data Buku Berhasil Ditambahkan');
    }
    

    // Mengubah status editorial pick
    public function toggleEditorialPick($id)
    {
        $book = Books::findOrFail($id);
        $book->is_editorial_pick = !$book->is_editorial_pick;
        $book->save();

        return redirect()->route('buku')->with('success', 'Status editorial pick berhasil diubah.');
    }

    // Menghapus buku
    public function destroy($id)
    {
        $book = Books::find($id);
        
        // Menghapus gambar buku jika ada
        if ($book->image) {
            Storage::delete('public/img/' . $book->image);
        }

        // Menghapus gambar galeri
        foreach ($book->galleries as $gallery) {
            Storage::delete('public/galleries/' . $gallery->image);
        }

        // Menghapus data buku
        $book->delete();

        return redirect('/buku')->with('status', 'Data Buku Berhasil Dihapus');
    }

    // Menampilkan form edit buku
    public function edit($id)
    {
        $books = Books::find($id);
        return view('edit', compact('books'));
    }

    // Mengupdate data buku
    public function update(Request $request, $id)
    {
        $book = Books::findOrFail($id);
    
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'tanggal_terbit' => 'required|date',
            'image' => 'nullable|image|max:10240',
            'gallery_images.*' => 'nullable|image|max:10240',
            'gallery_caption.*' => 'nullable|string|max:255',
            'discount' => 'nullable|numeric|min:0|max:100',
        ]);
    
        // Update data buku
        $data = [
            'title' => $request->title,
            'author' => $request->author,
            'harga' => $request->harga,
            'tanggal_terbit' => $request->tanggal_terbit,
            'discount' =>$request->discount
        ];
    
        if ($request->discount) {
            $discountAmount = $book->harga * ($request->discount / 100);
            $book->discounted_price = $book->harga - $discountAmount;
        } else {
            $book->discounted_price = null;
        }

        // Menangani perubahan gambar jika ada gambar baru
        if ($request->hasFile('image')) {
            if ($book->image) {
                Storage::delete('public/img/' . $book->image);
            }
    
            $imagePath = $request->file('image')->store('public/img');
            $data['image'] = basename($imagePath);
        }

        // Menangani update gambar galeri
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $galleryPath = $image->store('public/galleries');
                $book->galleries()->create([
                    'image' => basename($galleryPath),
                    'book_id' => $book->id,
                ]);
            }
        }

        $book->update($data);
        
        // Mengupdate keterangan gambar galeri
        if ($request->has('gallery_caption')) {
            foreach ($request->gallery_caption as $galleryId => $caption) {
                $gallery = Gallery::findOrFail($galleryId);
                $gallery->caption = $caption;
                $gallery->save();
            }
        }

        return redirect('/buku')->with('status', 'Data Buku Berhasil Diubah');
    }
}
