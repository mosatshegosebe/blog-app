@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
      <div class="col-8">
        {!! Form::model($post, ['method'=> 'PUT', 'route' => ['posts.update', $post->id], 'files' => true]) !!}
        @include('posts._form')
        {!! Form::close() !!}
      </div>
    </div>
@endsection