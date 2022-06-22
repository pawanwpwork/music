@if (count($errors) > 0)
<div class="alert alert-danger alert-dismissible show"
             role="alert">
  <button aria-label="Close"
       class="close"
       data-dismiss="alert"
       type="button"><span aria-hidden="true">&times;</span></button>
  <ul>
    @foreach ($errors->all() as $error)
    <li>{!!$error !!}</li>@endforeach
  </ul>
</div>
@endif

@if (session('message'))
<div class="alert alert-success">
    <a aria-label="close" class="close" data-dismiss="alert" href="#">×</a> {!! session('message') !!}
</div>
@endif