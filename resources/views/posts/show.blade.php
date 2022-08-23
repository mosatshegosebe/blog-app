@extends('layouts.app')

@section('content')
  <article class="blog-post px-3 py-5 p-md-5">
    <div class="container single-col-max-width">
      <header class="blog-post-header">
        <h2 class="title mb-2">{{$post->title}}</h2>
        <div class="meta mb-3">
          <span class="date">Published {{$post->updated_at->diffForHumans()}}</span>
          <span class="comment">Author {{$post->user->name}}</span>
        </div>
      </header>
      <div class="blog-post-body">
        <figure class="blog-banner">
          <img class="img-fluid" src="{{ Str::replace('public', 'storage', asset($post->file_location)) }}" alt="image">
        </figure>
        <p>{{$post->body}}</p>
      </div>
    </div>
  </article>
@endsection