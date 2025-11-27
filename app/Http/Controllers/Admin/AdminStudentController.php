<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Classroom;

class AdminStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studentsList = Student::with('classroom')->paginate(10);
        $classroomsList = Classroom::all();

        return view('admin.student.index', compact('studentsList', 'classroomsList'));
    }

    /**
     * Store a newly created student.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'classroom_id' => 'required|exists:classrooms,id',
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
            'gender' => 'required|string',
            'date_of_birth' => 'required|date',
        ]);

        Student::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'classroom_id' => $request->classroom_id,
            'address' => $request->address,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
        ]);

        return redirect()->back()->with('success', 'Data siswa berhasil ditambahkan!');
    }

    /**
     * Update the specified student.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'classroom_id' => 'required|exists:classrooms,id',
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
            'gender' => 'required|string',
            'date_of_birth' => 'required|date',
        ]);

        $student = Student::findOrFail($id);

        $student->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'classroom_id' => $request->classroom_id,
            'address' => $request->address,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
        ]);

        return redirect()->back()->with('success', 'Data siswa berhasil diperbarui!');
    }

    /**
     * Remove the specified student.
     */
    public function destroy(string $id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->back()->with('success', 'Data siswa berhasil dihapus!');
    }
}
