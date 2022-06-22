@extends('layouts.app-backend')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6 col-md-6">
        <ol class="breadcrumb">
            <li>
                <a href="{{route('admin.dashboard')}}">Dashboard</a>
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
                  
                    <h5>Classified Service <span style="font-size: 19px;">{{$service->product->name}} </span></h5>

                    <div class="generate-invoice">
                         @if($service->status == 1)
                            <span class="badge badge-primary">Completed</span>
                        @else
                            <span class="badge badge-danger">On Progress</span>
                        @endif
                    </div>

                </div>
                <div class="ibox-content">
                    <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                    

                        <tr>
                           <th>Product Name</th>
                           <td>{{$service->product->name ?? ''}}</td>
                           <th>Member Name</th>
                           <td>{{$service->member->first_name ?? ''}} {{$service->member->last_name ?? ''}}</td>
                       </tr>

                       <tr>
                           <th>Name of owner</th>
                           <td>{{$service->name_of_owner ?? ''}}</td>
                           <th>DBA</th>
                           <td>{{$service->dba ?? ''}}</td>
                       </tr>

                        <tr>
                           <th>Address</th>
                           <td>{{$service->address ?? ''}}</td>
                           <th>City/State/Zip</th>
                           <td>{{$service->city ?? ''}} {{$service->state ?? ''}} {{$service->zip ?? ''}}</td>
                       </tr>

                       <tr>
                           <th>Phone no.</th>
                           <td>{{$service->phone_no ?? ''}}</td>
                           <th>Cell phone</th>
                           <td>{{$service->cell_phone ?? ''}}</td>
                       </tr>

                       <tr>
                           <th>Fax</th>
                           <td>{{$service->fax ?? ''}}</td>
                           <th>Website</th>
                           <td>{{$service->website ?? ''}}</td>
                       </tr>

                       <tr>
                           <th>Email</th>
                           <td>{{$service->email ?? ''}}</td>
                           <th>Comments</th>
                           <td>{{$service->comments ?? ''}}</td>
                       </tr>

                        <tr>
                            <td>
                                 @if($service->status == 1)
                            <a href="{{ route('admin.service.inquiry.status', $service->id) }}" class="btn btn-danger">Cancel</a>
                            @else
                            <a  href="{{ route('admin.service.inquiry.status', $service->id) }}" class="btn btn-primary">Approved</a>
                            @endif

                                
                            </td>
                           
                        </tr>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<div class="modal fade" id="delete_review" tabindex="-1" role="dialog" aria-labelledby="delete_review" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content"></div>
   </div>
</div>

@section('footer-scripts')
<script type="text/javascript">
// $('#delete_review').on('show.bs.modal', function (e) {
//     var button = $(e.relatedTarget);
//     var modal = $(this);
//     // or, load content from value of data-remote url
//     modal.find('.modal-content').load(button.data("remote"));

// });
</script>
@endsection