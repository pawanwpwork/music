@extends('layouts.app-backend')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Product Details</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('admin.dashboard')}}">Dashboard</a>
            </li>
            <li>
                <a href="{{route('admin.product.list')}}">list</a>
            </li>
            <li class="active">
                <strong>Product Details</strong>
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
                    <h5>{{$product->name ?? 'N/A'}}</h5>
                   
                     @if($product->status == 1)
                        <span class="badge badge-primary" style="margin-left: 10px;">Published</span>
                    @else
                        <span class="badge badge-danger" style="margin-left: 10px;"> Unpublished</span>
                    @endif
                    
                </div>
                <div class="ibox-content">
                    <table class="table">
                        <tr>
                            <th>Product Name</th>
                            <td>{{$product->name ?? 'N/A'}}</td>
                            <th>Product Added By</th>
                            <td>@if($product->add_user_type == 'member') {{$product->member->first_name}} {{$product->member->last_name}} @else Admin @endif</td>
                            <th>Category</th>
                            <td>
                            @if(isset($product->category) && count($product->category) > 0) 
                                @foreach($product->category as $cat)
                                    {{$cat->name}} @if(count($product->category) > 1), @endif
                                @endforeach
                            @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Model/Label Code</th>
                            <td>{{$product->model ?? 'N/A'}}</td>
                            <th>SKU/Product Code</th>
                            <td>{{$product->sku ?? 'N/A'}}</td>
                            <th>Locations</th>
                            <td>{{$product->locations ?? 'N/A'}}</td>
                        </tr>

                        <tr>
                            <th>Price</th>
                            <td>{{$product->price ?? 'N/A'}}</td>
                            <th>Quantity</th>
                            <td>{{$product->quantity ?? 'N/A'}}</td>
                            <th>Substract Stock</th>
                            <td>{{$product->subtract_stock ?? 'N/A'}}</td>
                        </tr>

                        <tr>
                            <th>Is Featured</th>
                            <td>{{$product->is_featured == 0 ? 'No' : 'Yes'}}</td>
                            <th>Out of Stock</th>
                            <td>{{$product->out_of_stock ?? 'N/A'}}</td>
                            <th>Date Available/Start</th>
                            <td>{{$product->date_available ?? 'N/A'}}</td>
                        </tr>

                         <tr>
                            <th>Date End</th>
                            <td>{{$product->date_end ?? 'N/A' }}</td>
                            <th>Dimensions (L x W x H)</th>
                            <td>{{$product->length ?? 'N/A'}} * {{$product->width ?? 'N/A'}} * {{$product->height ?? 'N/A'}}</td>
                            <th>Length class</th>
                            <td>{{$product->length_class ?? 'N/A'}}</td>
                        </tr>

                        <tr>
                            <th>Weight</th>
                            <td>{{$product->weight ?? 'N/A'}}</td>
                            <th>Weight Limit</th>
                            <td>{{$product->weight_unit ?? 'N/A'}}</td>
                            <th>Manufacturer</th>
                            <td>{{$product->manufacturer ?? 'N/A'}}</td>
                        </tr>

                        <tr>
                            @if($product->status == 0)
                            <td>
                             <a href="#" data-url="{{route('admin.product.change.status',$product->id)}}" data-toggle="modal"  class="btn btn-primary status_product">Published</a>
                            </td>
                            @endif
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<div class="modal fade" id="status_product" tabindex="-1" role="dialog" aria-labelledby="status_product" aria-hidden="true">
   <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="user_delete_confirm_title">Confirm Published</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">×</span>
                 </button>
            </div>
            <div class="modal-body"> Are you sure you want to published this Product?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                <a href="#" class="btn btn-danger">Yes</a>
            </div>
        </div>
   </div>
</div>

@section('footer-scripts')
<script type="text/javascript">
$('.status_product').on('click', function (e) {
   $('#status_product').modal('show');
   $('.modal-footer a').attr('href',$(this).data('url'));
});
</script>
@endsection