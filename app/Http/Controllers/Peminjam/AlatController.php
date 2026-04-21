<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    public function index() {
    $alats = \App\Models\Alat::all();
    return view('peminjam.alats.index', compact('alats')); // Arahkan ke view peminjam
}
}
