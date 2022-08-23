@extends('layouts.app')

@section('content')
  <div class="row justify-content-center mt-5">
    <div class="col-8">
      {!! Form::open(['method' => 'POST', 'route' => 'category.store', 'files' => true]) !!}
      {{ Form::label('Category Name', null, ['class' => 'form-label']) }}
      {!! Form::text('category_name', null, ['class' => 'form-control form-control'] )!!}
      @error('category_name')
      <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
      @enderror
      <button type="submit" class="btn btn-primary my-2">Submit</button>
      {!! Form::close() !!}
    </div>
    <div class="col-8">
      <table class="table table-striped my-5">
        <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Category Name</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
          <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$category->category_name}}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection