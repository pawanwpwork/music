@extends('layouts.app-backend')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6 col-md-6">
        <h2>Contact List</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('admin.dashboard')}}">Dashboard</a>
            </li>
            <li class="active">
                <strong>Contact List</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-6 col-md-6 padding20">
       <!--  <div class="pull-right">
            <a href="{{route('admin.category.create')}}" class="btn btn-primary" data-original-title="Add New"><i class="fa fa-plus"></i></a>
        </div> -->
        
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Contact List</h5>

                </div>
                <div class="ibox-content">

                    <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                        <thead>
                            <tr>
                                <th data-toggle="true">Full Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Message</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($contacts) && count($contacts)>0)
                                @foreach($contacts as $cat)
                                    <tr>
                                        <td>{{$cat->name}}</td>
                                        <td>{{$cat->email}}</td>
                                        <td>{{$cat->subject}}</td>
                                        <td>{{$cat->enquiry }}</td>
                                    </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <td colspan="3">No Contact Available!</td>
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
<div class="modal fade" id="delete_category" tabindex="-1" role="dialog" aria-labelledby="delete_category" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content"></div>
   </div>
</div>

@section('footer-scripts')
<script type="text/javascript">
$('#delete_category').on('show.bs.modal', function (e) {
    var button = $(e.relatedTarget);
    var modal = $(this);
    // or, load content from value of data-remote url
    modal.find('.modal-content').load(button.data("remote"));

});
</script>
@endsection