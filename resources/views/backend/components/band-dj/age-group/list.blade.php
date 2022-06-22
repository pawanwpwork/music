@extends('layouts.app-backend')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6 col-md-6">
        <h2>Band/Dj Age Group List</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('admin.dashboard')}}">Dashboard</a>
            </li>
            <li class="active">
                <strong>Band/Dj Age Group List</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-6 col-md-6 padding20">
         <div class="pull-right">
            <a href="{{route('admin.banddjagegroup.create')}}" class="btn btn-primary" data-original-title="Add New"><i class="fa fa-plus"></i></a>
        </div>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            @include('layouts.message')
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Band/Dj Age Group List</h5>

                </div>
                <div class="ibox-content">

                    <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                        <thead>
                            <tr>
                                <th>Age Group</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($ages) && count($ages)>0)
                                @foreach($ages as $age)
                                    <tr>
                                        <td>{{$age->name}}</td>
                                        
                                        <td>

                                            <a href="{{route('admin.banddjagegroup.edit',$age->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>

                                            <a href="#delete_banddjagegroup" data-remote="{{route('admin.banddjagegroup.delete.confirm',$age->id)}}" data-toggle="modal"  class="btn btn-danger"><i class="fa fa-trash"></i></a>

                                        </td>
                                       
                                    </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <td colspan="3">No Band/Dj Age Group Available!</td>
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
<div class="modal fade" id="delete_banddjagegroup" tabindex="-1" role="dialog" aria-labelledby="delete_banddjagegroup" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content"></div>
   </div>
</div>

@section('footer-scripts')
<script type="text/javascript">
$('#delete_banddjagegroup').on('show.bs.modal', function (e) {
    var button = $(e.relatedTarget);
    var modal = $(this);
    // or, load content from value of data-remote url
    modal.find('.modal-content').load(button.data("remote"));

});
</script>
@endsection