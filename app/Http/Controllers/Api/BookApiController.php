<?php

namespace App\Http\Controllers\Api;

use App\Models\Buku;
use App\Models\Books;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;

class BookApiController extends Controller
{
    public function index() {
        $books = Books :: latest() ->paginate(5);
        return new BookResource(true, 'List Data Buku', $books);
    }
}
