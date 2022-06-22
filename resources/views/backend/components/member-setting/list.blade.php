@extends('layouts.app-backend')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6 col-md-6">
        <h2>Member Setting List</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('admin.dashboard')}}">Dashboard</a>
            </li>
            <li class="active">
                <strong>Member Setting List</strong>
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
                    <h5>Member Setting List</h5>
                </div>
                <div class="ibox-content">

                    <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                        <thead>
                            <tr>
                                <th data-toggle="true">Member Type</th>
                                <th>Sign Up Fee</th>
                                <th>Sign Up Fee Duration</th>
                                <th>No of song upload</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($memberSettings) && count($memberSettings) > 0)
                                @foreach($memberSettings as $member)
                                    <tr>
                                        <td>{{$member->membershipType->name ?? ''}}</td>
                                        <td>{{$member->sign_up_fee ?? ''}}</td>
                                        <td>{{$member->sign_up_fee_duration ?? ''}}</td>
                                        <td>{{$member->number_of_song_upload ?? ''}}</td>
                                        <td>
                                            <a href="{{route('admin.member-setting.edit',$member->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
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