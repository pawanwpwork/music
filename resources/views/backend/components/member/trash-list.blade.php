@extends('layouts.app-backend')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6 col-md-6">
        <h2>Trashed Member List</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('admin.dashboard')}}">Dashboard</a>
            </li>
            <li class="active">
                <strong>Trashed Member List</strong>
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
                    <h5>Trashed Member List</h5>
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
                                            <a href="{{route('admin.member.restore.item',$member->id)}}" class="btn btn-success restore-item" title="Restore Member">Restore</a>
                                             <a href="{{route('admin.member.permanently.remove.item',$member->id)}}" class="btn btn-danger restore-item" title="Permanently Delete">Permanently Delete</a>
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
                                <td colspan="7">
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

<div class="modal fade" id="restore_member" tabindex="-1" role="dialog" aria-labelledby="restore_member" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="user_delete_confirm_title">Restore Member</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                Are you sure to restore this member?
            </div>
            
            <div class="modal-footer">
                <a href="" type="button" class="btn btn-primary" id="restore-confirm-btn">Confirm</a> 
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
      </div>
   </div>
</div>

<div class="modal fade" id="permanently_member" tabindex="-1" role="dialog" aria-labelledby="permanently_member" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="user_delete_confirm_title">Permanently Remove Member</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                Are you sure to remove permanently this member?
            </div>
            
            <div class="modal-footer">
                <a href="" type="button" class="btn btn-primary" id="permanently-confirm-btn">Confirm</a> 
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
      </div>
   </div>
</div>

@endsection


@section('footer-scripts')
<script type="text/javascript">

var restoreItem     = document.querySelectorAll('.restore-item');

var permanentlyItem = document.querySelectorAll('.parmently-remove');

restoreItem.forEach((element) => {
    element.addEventListener('click',(e) => {
        e.preventDefault();
        var restoreUrl      = e.target.getAttribute('href');
        document.getElementById('restore-confirm-btn').setAttribute('href',restoreUrl);
        $("#restore_member").modal('show');
    });
});

permanentlyItem.forEach((element) => {
    element.addEventListener('click',(e) => {
        e.preventDefault();
        var permanentlyUrl      = e.target.getAttribute('href');
        document.getElementById('permanently-confirm-btn').setAttribute('href',permanentlyUrl);
        $("#permanently_member").modal('show');
    });
});

</script>
@endsection