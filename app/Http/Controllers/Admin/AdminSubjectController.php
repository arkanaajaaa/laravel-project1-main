<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;

class AdminSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjectsList = Subject::all();
        return view('admin.subject.index', compact('subjectsList'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:subjects,name',
            'description' => 'required|string|max:1000',
        ], [
            'name.required' => 'Nama subject wajib diisi.',
            'name.unique' => 'Nama subject sudah digunakan.',
            'name.max' => 'Nama subject maksimal 255 karakter.',
            'description.required' => 'Deskripsi wajib diisi.',
            'description.max' => 'Deskripsi maksimal 1000 karakter.',
        ]);

        try {
            // Simpan data subject
            Subject::create([
                'name' => $validated['name'],
                'description' => $validated['description'],
            ]);

            return redirect()->route('admin.subject.index')
                ->with('success', 'Subject berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan subject: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:subjects,name,' . $id,
            'description' => 'required|string|max:1000',
        ], [
            'name.required' => 'Nama subject wajib diisi.',
            'name.unique' => 'Nama subject sudah digunakan.',
            'name.max' => 'Nama subject maksimal 255 karakter.',
            'description.required' => 'Deskripsi wajib diisi.',
            'description.max' => 'Deskripsi maksimal 1000 karakter.',
        ]);

        try {
            // Cari subject berdasarkan ID
            $subject = Subject::findOrFail($id);

            // Update data subject
            $subject->update([
                'name' => $validated['name'],
                'description' => $validated['description'],
            ]);

            return redirect()->route('admin.subject.index')
                ->with('success', 'Subject berhasil diupdate!');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('admin.subject.index')
                ->with('error', 'Subject tidak ditemukan.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal mengupdate subject: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}