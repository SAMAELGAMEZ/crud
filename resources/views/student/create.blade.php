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

    <form method="post" action="{{ route('student.store') }}">
      @csrf
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
        <textarea class="form-control" name="description">{{ old('description') }}</textarea>
      </div>
      <button type="submit" class="btn btn-primary">Save Student</button>
    </form>
  </div>
</div>
@endsection