@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
      <div class="col-8">
        {!! Form::open(['method' => 'POST', 'route' => 'posts.store', 'files' => true]) !!}
        @include('posts._form', ['posts' => new \App\Models\Post])
        {!! Form::close() !!}
      </div>
    </div>
@endsection