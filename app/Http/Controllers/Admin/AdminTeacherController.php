<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Subject;

class AdminTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachersList = Teacher::with('subject')->get();
        $subjectsList = Subject::all();

        return view('admin.teacher.index', compact('teachersList', 'subjectsList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'nullable|email',
            'phone'      => 'nullable|string|max:20',
            'address'    => 'nullable|string',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        Teacher::create($request->all());

        return redirect()->back()->with('success', 'Guru berhasil ditambahkan!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $teacher = Teacher::findOrFail($id);

        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'nullable|email',
            'phone'      => 'nullable|string|max:20',
            'address'    => 'nullable|string',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        $teacher->update($request->all());

        return redirect()->back()->with('success', 'Data guru berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();

        return redirect()->back()->with('success', 'Guru berhasil dihapus!');
    }
}
