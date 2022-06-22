@extends('layouts.app-backend')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6 col-md-6">
        <h2>Member List</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('admin.dashboard')}}">Dashboard</a>
            </li>
            <li class="active">
                <strong>Member List</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-6 col-md-6 padding20">
        <div class="pull-right">
            <a href="{{route('admin.member.create')}}" class="btn btn-primary" data-original-title="Add New"><i class="fa fa-plus"></i></a>
        </div>
    </div>
</div>

@include('backend.components.member.includes._search_form')

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            @include('layouts.message')
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Member List</h5>
                </div>
                <div class="ibox-content">

                    <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                        <thead>
                            <tr>
                                <th data-toggle="true">Member Name</th>
                                <th>Email</th>
                                <th>Ip</th>
                                <th>Date Added</th>
                                <th>Membership</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($members) && count($members) > 0)
                                @foreach($members as $member)
                                    <tr>
                                        <td>{{$member->first_name ?? ''}} {{$member->last_name ?? ''}}</td>
                                        <td>{{$member->email ?? ''}}</td>
                                        <td>
                                            {{ $member->ip ?? '' }}
                                        </td>
                                        <td>{{date('F j, Y', strtotime($member->created_at)) ?? ''}}</td>
                                        <td>{{$member->getMembershipType->name ?? ''}}</td>
                                        <td>
                                            @if($member->status == 1)
                                                <span class="badge badge-primary">Enabled</span>
                                            @else
                                                <span class="badge badge-danger"> Disabled</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('admin.member.edit',$member->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                            <a href="#delete_member" data-remote="{{route('admin.member.delete.confirm',$member->id)}}" data-toggle="modal"  class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                       
                                    </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <td colspan="3">No member Available!</td>
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
<div class="modal fade" id="delete_member" tabindex="-1" role="dialog" aria-labelledby="delete_member" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content"></div>
   </div>
</div>

@section('footer-scripts')
<script type="text/javascript">
$('#delete_member').on('show.bs.modal', function (e) {
    var button = $(e.relatedTarget);
    var modal = $(this);
    // or, load content from value of data-remote url
    modal.find('.modal-content').load(button.data("remote"));

});
</script>
@endsection