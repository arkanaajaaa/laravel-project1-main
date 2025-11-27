<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Guardian;

class AdminGuardianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guardiansList = Guardian::paginate(10);
        return view('admin.guardian.index', compact('guardiansList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'job' => 'required|string|max:255',
            'email' => 'required|email',
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
            'gender' => 'required|string',
        ]);

        Guardian::create([
            'nama' => $request->nama,
            'job' => $request->job,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'gender' => $request->gender,
        ]);

        return redirect()->back()->with('success', 'Guardian berhasil ditambahkan!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'job' => 'required|string|max:255',
            'email' => 'required|email',
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
            'gender' => 'required|string',
        ]);

        $guardian = Guardian::findOrFail($id);

        $guardian->update([
            'nama' => $request->nama,
            'job' => $request->job,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'gender' => $request->gender,
        ]);

        return redirect()->back()->with('success', 'Guardian berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $guardian = Guardian::findOrFail($id);
        $guardian->delete();

        return redirect()->back()->with('success', 'Guardian berhasil dihapus!');
    }
}
