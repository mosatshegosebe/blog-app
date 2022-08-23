<div class="card">
  <div class="card-body">
    <div class="mb-3">
      {{ Form::label('Title', null, ['class' => 'form-label']) }}
      {!! Form::text('title', null, ['class' => 'form-control form-control'] )!!}
      @error('title')
      <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
      @enderror
    </div>
    <div class="mb-3">
      {{ Form::label('Body', null, ['class' => 'form-label']) }}
      {!! Form::textarea('body', null, ['class' => 'form-control form-control'] )!!}
      @error('body')
      <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
      @enderror
    </div>
    <div class="mb-3">
      {!! Form::select('category', $categories, $post->category_id ?? null, ['class' => 'form-control form-control form-select']) !!}
      @error('category')
      <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
      @enderror
    </div>
    @unless(isset($post))
      <div class="mb-3 form-check">
        {!! Form::file('image', null, ['class' => 'form-control form-control']) !!}
      </div>
    @endunless

    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</div>