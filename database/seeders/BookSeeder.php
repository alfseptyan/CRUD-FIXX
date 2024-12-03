<?php

namespace Database\Seeders;
use App\Models\Books;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        // Tambahkan data secara manual
        Books::create([
            'title' => 'Koala Kumal',
            'author' => 'Raditya Dika',
            'harga' => 85000,
            'tanggal_terbit' => '2015-08-01',
            'image' => 'images/Koala Kumal.png', // Pastikan file ini ada di public/images
        ]);
    }
}