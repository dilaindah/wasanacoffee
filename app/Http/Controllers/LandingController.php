<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    // Fungsi untuk menampilkan halaman utama / Landing Page Wasana Coffee
    public function index()
    {
        return view('welcome');
    }
}