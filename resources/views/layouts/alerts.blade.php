<div id="alerts" class="px-5">
  @include('flash::message')

  @if(isset($errors) && $errors->any())
    @foreach ($errors->all() as $error)
      <div class="alert alert-danger">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">&times;</button>
        {!! $error !!}
      </div>
    @endforeach
  @endif
</div>