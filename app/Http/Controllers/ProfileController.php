<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index ()
    {
        $data = [
            'nama' => 'Banyu Bening Tegar Pangestu',
            'kelas' => '11 RPL 2',
            'sekolah' => 'SMK Raden Umar Said'
        ];
        return view('profile', $data, ['title' => "Profile"]);
    }
}
