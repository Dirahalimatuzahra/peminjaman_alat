<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Buku;

class BukuController extends Controller
{
    public function index() 
    {
        $bukus = Buku::all();
        return view('peminjam.bukus.index', compact('bukus'));
    }
}