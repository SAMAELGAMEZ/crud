@extends('layouts.app')

@section('content')
  <style>
    .uper {
      margin-top: 40px;
    }
  </style>

  <div class="card uper">
    <div class="card-header">
      View Student
    </div>

    <div class="card-body">
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div><br />
      @endif

      <!-- Añadiendo los detalles del estudiante -->
      <h1>Student Details</h1>
      <p>ID: {{ $student->id }}</p>
      <p>First Name: {{ $student->first_name }}</p>
      <p>Last Name: {{ $student->last_name }}</p>

      <!-- Bloque de código agregado -->
      <div class="row"> 
        <div class="col-9"> 
          <div class="form-group"> 
            <label for="first_name">First Name:</label> 
            <input type="text" class="form-control" name="first_name" value="{{ $student->first_name }}" disabled /> 
          </div> 
          <div class="form-group"> 
            <label for="last_name">Last Name:</label> 
            <input type="text" class="form-control" name="last_name" value="{{ $student->last_name }}" disabled /> 
          </div> 
          <div class="form-group"> 
            <label for="symptoms">Description :</label> 
            <textarea rows="5" columns="5" class="form-control" name="description" disabled>{{ $student->description }}</textarea> 
          </div> 
        </div> 
        <div class="col-3"> 
          {{-- New property picture --}} 
          <div class="form-group"> 
            <label for="">Avatar :</label> 
            <img src="{{ asset('storage') }}/{{ $student->picture }}" class="img-fluid" width="100px"> 
          </div> 
          {{-- end of new property picture --}} 
        </div> 
      </div>
      <!-- Fin del bloque de código agregado -->

      <a href="{{ route('student.edit', $student->id) }}" class="btn btn-primary">Edit</a>
      <a href="{{ route('student.index') }}" class="btn btn-primary">Index</a>
    </div>
  </div>
@endsection