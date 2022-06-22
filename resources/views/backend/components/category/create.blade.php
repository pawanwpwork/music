@extends('layouts.app-backend')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Add Category</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('admin.dashboard')}}">Dashboard</a>
            </li>
            <li>
                <a href="{{route('admin.category.list')}}">list</a>
            </li>
            <li class="active">
                <strong>Add Category</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            @include('layouts.message')
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Add Category from the following form.</h5>
                </div>
                <div class="ibox-content">
                    <form method="POST" class="form-horizontal" action="{{route('admin.category.store')}}" enctype="multipart/form-data">
                        @csrf()
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Name(*)</label>
                            <div class="col-sm-10">
                                <input name="name" type="text" class="form-control" value="{{old('name')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Parent</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="parent" >
                                  <option value="0">--Root--</option>
                                  @foreach($categories as $cat)
                                  <option value="{{$cat->id}}" {{old('parent') == $cat->id ? 'selected' : '' }}> {{$cat->name}}</option>
                                  @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10">
                                <textarea name="description" class="form-control">{{old('description')}}</textarea>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Featured Image(*)</label>
                            <div class="col-sm-10">
                                    

                                <div class="fileinput fileinput-new" data-provides="fileinput">
                       
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width:400px;max-height:400px;"></div>
                                <div>
                                    <span class="btn btn-primary btn-file">
                                        <span class="fileinput-new">Select image</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input id="image" name="image" type="file" class="form-control"/>
                                    </span>
                                    <a href="#" class="btn btn-danger fileinput-exists"
                                       data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>

                            </div>
                        </div>
                        
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Is service</label>
                            <div class="col-sm-10">
                               <div class="form-check">
                                  <input class="form-check-input" type="radio" name="is_service" id="is_service1" value="1" {{old('is_service') == 1 ? 'checked' : ''}}>
                                  <label class="form-check-label" for="is_service1">
                                   Yes
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="is_service" id="is_service2" value="0" {{old('is_service') == 0 ? 'checked' : ''}}>
                                  <label class="form-check-label" for="is_service2">
                                    No
                                  </label>
                                </div>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Meta Title</label>
                            <div class="col-sm-10">
                                <input name="meta_tag_title" type="text" class="form-control" value="{{old('meta_tag_title')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Meta Description</label>
                            <div class="col-sm-10">
                                <textarea name="meta_tag_description" class="form-control">{{old('meta_tag_description')}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Meta Keywords</label>
                            <div class="col-sm-10">
                               <input name="meta_tag_keyword" type="text" class="form-control" value="{{old('meta_tag_keyword')}}">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Sort Order(*)</label>
                            <div class="col-sm-10">
                               <input name="sort_order" type="number" class="form-control" value="{{old('sort_order')}}">
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-sm-2 control-label">Status</label>
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
                        <div class="hr-line-dashed"></div>
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
@stop