@extends('layouts.app-backend')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6 col-md-6">
        <h2>Site Setting List</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('admin.dashboard')}}">Dashboard</a>
            </li>
            <li class="active">
                <strong>Site Setting List</strong>
            </li>
        </ol>
    </div>
    @if(!$setting)
    <div class="col-lg-6 col-md-6 padding20">
        <div class="pull-right">
            <a href="{{route('admin.site-setting.create')}}" class="btn btn-primary" data-original-title="Add New"><i class="fa fa-plus"></i></a>
        </div>
    </div>
    @endif
</div>
<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            @include('layouts.message')
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Site Setting List</h5>
                </div>
                <div class="ibox-content">

                    <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                        <thead>
                            <tr>
                                <th data-toggle="true">Title</th>
                                <th data-toggle="true">Meta Title</th>
                                <th data-toggle="true">Meta Description</th>
                                <th data-toggle="true">Logo</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($settings) && count($settings)>0)
                                @foreach($settings as $cat)
                                    <tr>
                                        <td>{{$cat->title ?? ''}}</td>
                                        <td>{{$cat->meta_title ?? ''}}</td>
                                        <td>{{$cat->meta_description ?? ''}}</td>
                                        <td>
                                            <a href="{{route('admin.site-setting.storage',$cat->id)}}" target="_blank"> <img src="{{route('admin.site-setting.storage',$cat->id)}}" width="80px" height="80px" class="img-thumbnail"></a>
                                        </td>
                                        <td>
                                            <a href="{{route('admin.site-setting.edit',$cat->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                        </td>
                                       
                                    </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <td colspan="3">No Site Setting Available!</td>
                                    </tr>
                            @endif 
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5">
                                    <ul class="pagination pull-right"></ul>
                                </td>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection