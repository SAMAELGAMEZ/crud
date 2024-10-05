<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the students.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $students = Student::all();
        return view('student.index', compact('students'));
    }

    /**
     * Display a form for creating a new student.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created student in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar los campos del formulario
        $validatedData = $request->validate([
            'first_name' => 'required|max:75',
            'last_name' => 'required|max:75',
            'description' => 'required',
        ]);

        // Crear el estudiante con los datos validados
        Student::create($validatedData);

        // Redirigir a la página de índice con un mensaje de éxito
        return redirect('/student')->with('success', 'Student is successfully saved');
    }

    /**
     * Display the specified student.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::findOrFail($id);
        // Retorna la vista 'student.show' y pasa el objeto $student
        return view('student.show', compact('student'));
    }

    /**
     * Show the form for editing the specified student.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Buscar el estudiante por ID
        $student = Student::findOrFail($id);

        // Retornar la vista de edición con los datos del estudiante
        return view('student.edit', compact('student'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Mostrar toda la información del request
        dd($request->all());

        // Validar los campos del formulario
        $validatedData = $request->validate([
            'first_name' => 'required|max:75',
            'last_name' => 'required|max:75',
            'description' => 'required',
        ]);

        // Buscar el estudiante por ID
        $student = Student::findOrFail($id);

        // Actualizar el estudiante con los datos validados
        $student->update($validatedData);

        // Redirigir a la página de índice con un mensaje de éxito
        return redirect('/student')->with('success', 'Student is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Buscar el estudiante por ID
        $student = Student::findOrFail($id);

        // Eliminar el estudiante
        $student->delete();

        // Redirigir a la página de índice con un mensaje de éxito
        return redirect('/student')->with('success', 'Student data is successfully deleted');
    }
}
