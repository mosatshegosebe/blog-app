@extends('layouts.app')

@section('content')
  <section class="blog-list px-3 py-5 p-md-5">
  <div class="container single-col-max-width">
    @foreach($posts as $post)
      <div class="item mb-5">
        <div class="row g-3 g-xl-0">
          <div class="col-2 col-xl-3">
            <img class="img-fluid post-thumb " src="{{ Str::replace('public', 'storage', asset($post->file_location)) }}" alt="image">
          </div>
          <div class="col">
            <h3 class="title mb-1"><a class="text-link" href="{{ route('posts.show', $post) }}">{{$post->title}}</a></h3>
            <div class="meta mb-1">
              <span class="date">Published {{$post->updated_at->diffForHumans()}}</span>
              <span class="comment">Author {{$post->user->name}}</span>
            </div>
            <div class="intro">{{$post->body}}</div>
            <a class="text-link" href="{{ route('posts.show', $post) }}">Read more &rarr;</a>
          </div><!--//col-->
        </div><!--//row-->
      </div><!--//item-->
    @endforeach
  </div>
</section>

@endsection