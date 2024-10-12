@extends('layouts.app')

@section('content')
<div class="card uper">
  <div class="card-header">
    Add New Student
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

    <!-- Formulario actualizado -->
    <form method="post" action="{{ route('student.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <label for="picture" class="form-label">Avatar</label>
        <input class="form-control" type="file" name="picture">
      </div>
      <div class="form-group">
        <label for="first_name">First Name:</label>
        <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}">
      </div>
      <div class="form-group">
        <label for="last_name">Last Name:</label>
        <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">
      </div>
      <div class="form-group">
        <label for="description">Description:</label>
        <textarea class="form-control" name="description" rows="5" columns="5">{{ old('description') }}</textarea>
      </div>
      <button type="submit" class="btn btn-primary">Save</button>
      <a href="{{ route('student.index') }}" class="btn btn-primary">Return</a>
    </form>
    <!-- Fin del formulario -->
    
  </div>
</div>
@endsection