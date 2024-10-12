<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;

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
            'picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
        ]);

        // Manejo de la imagen
        $file = $request->file('picture');
        if ($file) {
            $path = Storage::disk('public')->put('Avatars', $file);
        } else {
            $path = 'https://picsum.photos/200/300';  // Imagen por defecto si no se sube ninguna
        }

        // Crear el estudiante con los datos validados
        Student::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'picture' => $path,
            'description' => $validatedData['description'],
            'created_at' => now(),
        ]);

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
        // Validar los campos del formulario, incluyendo la imagen
        $validatedData = $request->validate([
            'first_name' => 'required|max:75',
            'last_name' => 'required|max:75',
            'picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
        ]);

        // Buscar el estudiante por ID
        $student = Student::findOrFail($id);

        // Si se ha subido una nueva imagen, manejar la subida
        if ($request->file('picture')) {
            $path = Storage::disk('public')->put('Avatars', $request->file('picture'));

            // Actualizar el estudiante con la nueva imagen
            $student->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'picture' => $path,
                'description' => $request->description,
                'updated_at' => now(),
            ]);
        } else {
            // Actualizar el estudiante sin cambiar la imagen
            $student->update($validatedData);
        }

        // Redirigir a la página de índice con un mensaje de éxito
        return redirect('/student')->with('success', 'Student data is successfully updated');
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

        // Eliminar la imagen del almacenamiento público si existe
        if ($student->picture) {
            Storage::disk('public')->delete($student->picture);
        }

        // Eliminar el estudiante de la base de datos
        $student->delete();

        // Redirigir a la página de índice con un mensaje de éxito
        return redirect('/student')->with('success', 'Student data is successfully deleted');
    }

}
