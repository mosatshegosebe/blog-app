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
              {{ link_to_route('posts.edit', 'Edit', [$post->id], ['class' => 'text-link btn btn-sm btn-primary']) }}
              {{ link_to_route('posts.destroy', 'Delete', [$post->id], ['class' => 'btn btn-sm btn-danger']) }}
              {{ link_to_route('posts.publish', $post->published == 0 ? 'Publish': 'Unpublish', [$post->id], ['class' => 'btn btn-sm btn-info']) }}
            </div><!--//col-->
          </div><!--//row-->
        </div><!--//item-->
      @endforeach
    </div>
  </section>
@endsection
