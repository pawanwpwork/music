@extends('layouts.app-backend')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6 col-md-6">
        <h2>Product List</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('admin.dashboard')}}">Dashboard</a>
            </li>
            <li class="active">
                <strong>Product List</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-6 col-md-6 padding20">
        <div class="pull-right">
            <a href="{{route('admin.product.create')}}" class="btn btn-primary" data-original-title="Add New"><i class="fa fa-plus"></i></a>
        </div>
        
    </div>
</div>

@include('backend.components.product.includes._search_form')

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            @include('layouts.message')
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Product List</h5>

                </div>
                <div class="ibox-content">

                    <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                        <thead>
                            <tr>
                                <th data-toggle="true">Product Name</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Model</th>
                                <th>SKU</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <!-- <th>Sort Order</th> -->
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($products) && count($products) > 0)
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{$product->name ?? ''}}</td>
                                        <td>{{substr($product->description,0,50) ?? ''}}</td>
                                        <td>
                                            @foreach($product->category as $key => $category)
                                                <span class="badge badge-success">{{ $category->name }}</span>
                                                @if($key != count($product->category) - 1)
                                                    ,
                                                @endif 
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{route('admin.product.storage',$product->id)}}" target="_blank"><img src="{{route('admin.product.storage',$product->id)}}" width="80px" height="80px" class="img-thumbnail"></a>
                                        </td>
                                        <td>{{$product->model ?? ''}}</td>
                                        <td>{{$product->sku ?? ''}}</td>
                                        <td>{{$product->price ?? ''}}</td>
                                        <td>{{$product->quantity ?? ''}}</td>
                                        <!-- <td>{{$product->sort_order ?? ''}}</td> -->
                                        <td>
                                            <a href="#" data-url="{{route('admin.product.change.status',$product->id)}}" data-toggle="modal"  class="status_product">
                                            @if($product->status == 1)
                                                <span class="badge badge-primary">Published
                                                </span>
                                                @foreach($product->category as $key => $category)
                                                    @if(  in_array( $category->id, [6,7,8] ) && $product->date_end < date('Y-m-d') )
                                                        <span class="badge badge-warning"> Expired </span>
                                                    @endif
                                                @endforeach
                                            @else
                                                <span class="badge badge-danger"> Unpublished</span>
                                              @foreach($product->category as $key => $category)
                                                    @if(  in_array( $category->id, [6,7,8] ) && $product->date_end < date('Y-m-d') )
                                                        <span class="badge badge-warning"> Expired </span>
                                                    @endif
                                                @endforeach
                                            @endif
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{route('admin.product.edit',$product->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                            <a href="#delete_product" data-remote="{{route('admin.product.delete.confirm',$product->id)}}" data-toggle="modal"  class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                            <a href="{{route('admin.product.view',$product->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <td colspan="3">No product Available!</td>
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
<div class="modal fade" id="delete_product" tabindex="-1" role="dialog" aria-labelledby="delete_product" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content"></div>
   </div>
</div>

<div class="modal fade" id="status_product" tabindex="-1" role="dialog" aria-labelledby="status_product" aria-hidden="true">
   <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="user_delete_confirm_title">Change Status</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">×</span>
                 </button>
            </div>
            <div class="modal-body"> Are you sure you want to change status  of this Product?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                <a href="#" class="btn btn-danger">Yes</a>
            </div>
        </div>
   </div>
</div>

@section('footer-scripts')
<script type="text/javascript">
$('#delete_product').on('show.bs.modal', function (e) {
    var button = $(e.relatedTarget);
    var modal = $(this);
    // or, load content from value of data-remote url
    modal.find('.modal-content').load(button.data("remote"));

});

$('.status_product').on('click', function (e) {
   $('#status_product').modal('show');
   $('.modal-footer a').attr('href',$(this).data('url'));
});
</script>
@endsection