<div class="wrapper wrapper-content search-form">
    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('admin.product.list') }}">
                <div class="ibox-content">

                    <div class="row">
                        <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label" for="input-name">Product Name</label>
                            <input type="text" name="name" value="" placeholder="Product Name" id="input-name" class="form-control" autocomplete="off"><ul class="dropdown-menu"></ul>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="input-model">Model</label>
                            <input type="text" name="model" value="" placeholder="Model" id="input-model" class="form-control" autocomplete="off"><ul class="dropdown-menu"></ul>
                        </div>
                        </div>
                        <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label" for="input-price">Price</label>
                            <input type="text" name="price" value="" placeholder="Price" id="input-price" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="input-quantity">Quantity</label>
                            <input type="text" name="quantity" value="" placeholder="Quantity" id="input-quantity" class="form-control">
                        </div>
                        </div>
                        <div class="col-sm-4">
                       <!--  <div class="form-group">
                            <label class="control-label" for="input-model">SKU</label>
                            <input type="text" name="sku" value="" placeholder="SKU" id="input-model" class="form-control" autocomplete="off"><ul class="dropdown-menu"></ul>
                        </div> -->
                        <div class="form-group">
                            <label class="control-label" for="input-status">Status</label>
                            <select name="status" id="input-status" class="form-control" placeholder="status">
                                <option value=""></option>
                                <option value="1" selected>Published</option>
                                <option value="0">Unpublished</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="input-categories">Categories</label>
                            <select name="category_id" id="input-categories" class="form-control">
                                <option value="">Select Category</option>
                                  @foreach($categories as $key => $category)
                                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                 @endforeach
                            </select>
                        </div>
                        <button type="submit" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-filter"></i> Filter</button>
                        </div>
                    </div>

                </div>
            </form>
           
        </div>
    </div>
</div>