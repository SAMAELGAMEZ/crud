@extends('layouts.app') 
@section('content') 
  <style> 
    .margin { 
      margin-top: 40px; 
    } 
  </style> 
  <div class="margin"> 
    @if (session()->get('success')) 
      <div class="alert alert-success"> 
        {{ session()->get('success') }} 
      </div><br /> 
    @endif 
    <div class="row"> 
      <a class="btn btn-primary" href="{{ route('student.create') }}">Add</a> 
    </div> 

    <table class="table table-striped"> 
      <thead> 
        <tr> 
          <th>No</th> 
          <th>First Name</th> 
          <th>Last Name</th> 
          <th width="80px"></th> 
          <th width="80px"></th> 
        </tr> 
      </thead> 
      <tbody> 
        @foreach ($students as $student) 
          <tr> 
            <td><a href="{{ route('student.show', $student->id) }}">{{ $student->id }}</a></td> 
            <td><a href="{{ route('student.show', $student->id) }}">{{ $student->first_name }}</a></td> 
            <td><a href="{{ route('student.show', $student->id) }}">{{ $student->last_name }}</a></td> 
            <td><a href="{{ route('student.edit', $student->id) }}" class="btn btn-primary">Edit</a></td> 
            <td> 
              <form action="{{ route('student.destroy', $student->id) }}" method="post"> 
                @csrf 
                @method('DELETE') 
                <button class="btn btn-danger" type="submit">Delete</button> 
              </form> 
            </td> 
          </tr> 
        @endforeach 
      </tbody> 
    </table> 
  <div> 
@endsection 