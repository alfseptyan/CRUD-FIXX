<?php

namespace App\Http\Controllers;
use App\Models\Books;

use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index(){
        $books = Books::all();
        $totalBooks = Books::count();
        $totalHarga = Books::sum('harga');
        return view('index', compact('books',  'totalBooks', 'totalHarga'));
    }

    public function create(){
        return view('create');
    }
    public function store(Request $request){

        $request->validate([
            'title' => 'required|string',
            'author' => 'required|string|max:30',
            'harga' => 'required|numeric',
            'tanggal_terbit' => 'required|date'
        ]);
        $books = new books;
        $books->title = $request->title;
        $books->author = $request->author;
        $books->harga = $request->harga;
        $books->tanggal_terbit = $request->tanggal_terbit;
        $books->save();

        return redirect('/buku')->with('status', 'Data Buku Berhasil Ditambahkan');
    }
    public function search(Request $request){
        $batas = 5;
        $search = $request->search;
        $books = Books::where('title', 'like', "%" . $search . "%")->orwhere('author','like','%'.
        $search.'%')->paginate($batas);
        $totalBooks = $books->count();
        $totalHarga = Books::sum('harga');
        $no = $batas * ($books->currentPage() - 1);
        return view('search', compact('books', 'no', 'search', 'totalBooks', 'totalHarga'));
    }

    public function destroy($id){
        $books = Books::find($id);
        $books->delete();
        return redirect('/buku')->with('status', 'Data Buku Berhasil Dihapus');
    }   

    public function edit($id){
        $books = Books::find($id);
        return view('edit', compact('books'));
    }
    public function update(Request $request, $id){
    $books = Books::find($id);
    $books->title = $request->input('title');
    $books->author = $request->input('author');
    $books->harga = $request->input('harga');
    $books->tanggal_terbit = $request->input('tanggal_terbit');
    $books->save();

    return redirect('/buku')->with('status', 'Data Buku Berhasil Diubah');
}

}
