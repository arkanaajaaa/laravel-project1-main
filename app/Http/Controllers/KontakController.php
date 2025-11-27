<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        $data = [
        'email' => 'test@gmail.com',
        'no_hp' => '08263538365',
        'alamat' => 'Bogor',
    ];
    return view('kontak', $data, ['title' => "Contact"]);
    }
}
