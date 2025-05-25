<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\City;

class StudentController extends Controller
{
    // Rodyti visus studentus su miestais (puslapiavimas po 20)
    public function index()
    {
        $students = Student::with('city')->paginate(20);
        return view('students.index', compact('students'));
    }

    // Rodyti ištrintus studentus (soft deleted)
    public function trashed()
    {
        $students = Student::onlyTrashed()->with('city')->paginate(20);
        return view('students.trashed', compact('students'));
    }

    // Formos rodymas naujam studentui sukurti
    public function create()
    {
        $cities = City::all();
        return view('students.create', compact('cities'));
    }

    // Naujo studento įrašymas į DB
    public function store(Request $request)
    {
        $validated = $request->validate([
            'vardas' => 'required|string|max:255',
            'pavarde' => 'required|string|max:255',
            'adresas' => 'required|string|max:500',
            'telefonas' => 'required|string|max:20',
            'city_id' => 'required|exists:cities,id',
        ]);

        Student::create($validated);

        return redirect()->route('students.index')->with('success', 'Studentas pridėtas!');
    }

    // Formos rodymas studento redagavimui
    public function edit(Student $student)
    {
        $cities = City::all();
        return view('students.edit', compact('student', 'cities'));
    }

    // Studentų duomenų atnaujinimas
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'vardas' => 'required|string|max:255',
            'pavarde' => 'required|string|max:255',
            'adresas' => 'required|string|max:500',
            'telefonas' => 'required|string|max:20',
            'city_id' => 'required|exists:cities,id',
        ]);

        $student->update($validated);

        return redirect()->route('students.index')->with('success', 'Studentas atnaujintas!');
    }

    // Minkštas studento ištrynimas (soft delete)
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Studentas pažymėtas kaip ištrintas.');
    }

    // Ištrinto studento atstatymas
    public function restore($id)
    {
        $student = Student::withTrashed()->findOrFail($id);
        $student->restore();

        return redirect()->route('students.trashed')->with('success', 'Studentas atkurtas!');
    }

    // Visam laikui studento ištrynimas
    public function forceDelete($id)
    {
        $student = Student::withTrashed()->findOrFail($id);
        $student->forceDelete();

        return redirect()->route('students.trashed')->with('success', 'Studentas visam laikui pašalintas.');
    }
}