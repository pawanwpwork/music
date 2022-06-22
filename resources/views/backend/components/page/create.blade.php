@extends('layouts.app-backend')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Add Page</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('admin.dashboard')}}">Dashboard</a>
            </li>
            <li>
                <a href="{{route('admin.page.list')}}">list</a>
            </li>
            <li class="active">
                <strong>Add Page</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            @include('layouts.message')
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Add Page from the following form.</h5>
                </div>
                <div class="ibox-content">
                    <form method="POST" class="form-horizontal" action="{{route('admin.page.store')}}" enctype="multipart/form-data">
                        @csrf()

        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Title (*)</label>
                            <div class="col-sm-10">
                                <input name="title" type="text" class="form-control" value="{{old('title')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Content</label>
                            <div class="col-sm-10">
                               <textarea name="content" class="form-control textarea" rows="20">{!!old('content')!!}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Attachment</label>
                            <div class="col-sm-10">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width:400px;max-height:400px;"></div>
                                <div>
                                    <span class="btn btn-primary btn-file">
                                        <span class="fileinput-new">Select image</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input id="attachment" name="attachment" type="file" class="form-control"/>
                                    </span>
                                    <a href="#" class="btn btn-danger fileinput-exists"
                                        data-dismiss="fileinput">Remove</a>
                                </div>
                              
                            </div>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                         <div class="form-group">
                            <label class="col-sm-2 control-label">Status *</label>
                            <div class="col-sm-10">
                               <div class="form-check">
                                  <input class="form-check-input" type="radio" name="status" id="status1" value="1" {{old('status') == 1 ? 'checked' : ''}}>
                                  <label class="form-check-label" for="status1">
                                   Publish
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="status" id="status2" value="0" {{old('status') == 0 ? 'checked' : ''}}>
                                  <label class="form-check-label" for="status2">
                                    Unpublish
                                  </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('header-style')
<link href="{{ asset('assets/backend/jasny-bootstrap/css/jasny-bootstrap.css')}}" rel="stylesheet" />
@stop
@section('footer-scripts')
<script type="text/javascript" src="{{ asset('assets/backend/jasny-bootstrap/js/jasny-bootstrap.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/backend/tinymce/tinymce.min.js') }}"></script>
<script>
  tinymce.init({
    selector: ".textarea",
    menubar:true,
    plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu'
    ],
    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link'
});

</script>
@stop
