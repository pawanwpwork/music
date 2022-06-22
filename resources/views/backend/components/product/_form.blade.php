
<div class="form-group">
    <label class="col-sm-2 control-label">Name(*)</label>
    <div class="col-sm-10">
        <input name="name" type="text" class="form-control" value="{{old('name', (isset($product->name)) ? $product->name : '')}}">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Description(*)</label>
    <div class="col-sm-10">
        <textarea name="description" class="form-control">{{old('description', (isset($product->description)) ? $product->description : '')}}</textarea>
    </div>
</div>

<div class="hr-line-dashed"></div>
<div class="form-group">
    <label class="col-sm-2 control-label">Featured Image/Front Cover(*)</label>
    <div class="col-sm-10">
        
        @if(request()->route()->getName() == 'admin.product.edit')
            <div class="fileinput  @if($product->image != NULL)) fileinput-exists @else fileinput-new @endif" data-provides="fileinput">
                <div class="fileinput-preview fileinput-exists thumbnail" style="width:200px;height:200px;">
                    @if($product->image != NULL)
                        <img src="{{route('admin.product.storage',$product->id)}}">
                    @endif
                </div>
                <div>
                    <span class="btn btn-primary btn-file">
                        <span class="fileinput-new">Select Featured/Back image</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="hidden" name="image" value="{{$product->image}}">
                        <input id="image" name="image" type="file" class="form-control"/>
                    </span>
                    <a href="#" class="btn btn-danger fileinput-exists"
                        data-dismiss="fileinput">Remove</a>
                </div>
            </div>
        @else
            <div class="fileinput fileinput-new" data-provides="fileinput">

            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width:400px;max-height:400px;"></div>
            <div>
                <span class="btn btn-primary btn-file">
                    <span class="fileinput-new">Select Featured/Back image</span>
                    <span class="fileinput-exists">Change</span>
                    <input id="image" name="image" type="file" class="form-control"/>
                </span>
                <a href="#" class="btn btn-danger fileinput-exists"
                    data-dismiss="fileinput">Remove</a>
            </div>
            </div>
        @endif

    
</div>
</div>


<div class="hr-line-dashed"></div>
<div class="form-group">
    <label class="col-sm-2 control-label">Featured Image/Back Cover</label>
    <div class="col-sm-10">
        
        @if(request()->route()->getName() == 'admin.product.edit')
            <div class="fileinput  @if($product->back_image != NULL)) fileinput-exists @else fileinput-new @endif" data-provides="fileinput">
                <div class="fileinput-preview fileinput-exists thumbnail" style="width:200px;height:200px;">
                    @if($product->back_image != NULL)
                        <img src="{{route('admin.product.back.storage',$product->id)}}">
                    @endif
                </div>
                <div>
                    <span class="btn btn-primary btn-file">
                        <span class="fileinput-new">Select Back image</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="hidden" name="back_image" value="{{$product->back_image}}">
                        <input id="back_image" name="back_image" type="file" class="form-control"/>
                    </span>
                    <a href="#" class="btn btn-danger fileinput-exists"
                        data-dismiss="fileinput">Remove</a>
                </div>
            </div>
        @else
            <div class="fileinput fileinput-new" data-provides="fileinput">

            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width:400px;max-height:400px;"></div>
            <div>
                <span class="btn btn-primary btn-file">
                    <span class="fileinput-new">Select Back image</span>
                    <span class="fileinput-exists">Change</span>
                    <input id="back_image" name="back_image" type="file" class="form-control"/>
                </span>
                <a href="#" class="btn btn-danger fileinput-exists"
                    data-dismiss="fileinput">Remove</a>
            </div>
            </div>
        @endif

    
</div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group">
    <label class="col-sm-2 control-label">Meta Tag Title (*)</label>
    <div class="col-sm-10">
        <input name="meta_tag_title" type="text" class="form-control" value="{{old('meta_tag_title', (isset($product->meta_tag_title)) ? $product->meta_tag_title : '')}}">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Meta Description</label>
    <div class="col-sm-10">
        <textarea name="meta_tag_description" class="form-control">{{old('meta_tag_description', (isset($product->meta_tag_description)) ? $product->meta_tag_description : '')}}</textarea>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Meta tag Keywords</label>
    <div class="col-sm-10">
        <input name="meta_tag_keyword" type="text" class="form-control" value="{{old('meta_tag_keyword', (isset($product->meta_tag_keyword)) ? $product->meta_tag_keyword : '')}}">
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Product tags</label>
    <div class="col-sm-10">
        <input name="product_tag" type="text" class="form-control" value="{{old('product_tag', (isset($product->product_tag)) ? $product->product_tag : '')}}">
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Model/Label Code(*)</label>
    <div class="col-sm-10">
        <input name="model" type="text" class="form-control" value="{{old('model', (isset($product->model)) ? $product->model : '')}}">
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">SKU/Product Code</label>
    <div class="col-sm-10">
        <input name="sku" type="text" class="form-control" value="{{old('sku', (isset($product->sku)) ? $product->sku : '')}}">
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Locations</label>
    <div class="col-sm-10">
        <input name="locations" type="text" class="form-control" value="{{old('locations', (isset($product->locations)) ? $product->locations : '')}}">
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Price</label>
    <div class="col-sm-10">
        <input name="price" type="text" class="form-control" value="{{old('price', (isset($product->price)) ? $product->price : '')}}">
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Quantity</label>
    <div class="col-sm-10">
        <input name="quantity" type="text" class="form-control" value="{{old('quantity', (isset($product->quantity)) ? $product->quantity : '')}}">
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Substract Stock</label>
    <div class="col-sm-10">
        <select name="subtract_stock" class="form-control">
            <option value="Yes" {{ (isset($product->subtract_stock)) ? (($product->subtract_stock == 'Yes') ? 'selected' : '') : '' }}>YES</option>
            <option value="No" {{ (isset($product->subtract_stock)) ? (($product->subtract_stock == 'No') ? 'selected' : '') : '' }}>No</option>
        </select>
    </div>
</div>


<div class="form-group">
    <label class="col-sm-2 control-label">Is Featured</label>
    <div class="col-sm-10">
        <select name="is_featured" class="form-control">
            <option value="1" {{ (isset($product->is_featured)) ? (($product->is_featured == 1 ) ? 'selected' : '') : '' }}>YES</option>
            <option value="0" {{ (isset($product->is_featured)) ? (($product->is_featured == 0) ? 'selected' : '') : '' }}>No</option>
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Out of Stock Status</label>
    <div class="col-sm-10">
        <select name="out_of_stock" class="form-control">
            <option value="2-3_days" {{ (isset($product->out_of_stock)) ? (($product->out_of_stock == '2-3_days') ? 'selected' : '') : '' }}>2-3 days</option>
            <option value="in_stock" {{ (isset($product->out_of_stock)) ? (($product->out_of_stock == 'in_stock') ? 'selected' : '') : '' }}>In stock</option>
            <option value="out_of_stock" {{ (isset($product->out_of_stock)) ? (($product->out_of_stock == 'out_of_stock') ? 'selected' : '') : '' }}>Out of stock</option>
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Date Available/Start</label>
    <div class="col-sm-10">
        @if( isset( $product->date_available ) )
        <input name="date_available" id="date_available" type="text" class="form-control" value="{{old('date_available',$product->date_available)}}" autocomplete="off">
        @else
        <input name="date_available" id="date_available" type="text" class="form-control" value="{{old('date_available')}}" autocomplete="off">
        @endif
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Date End</label>
    <div class="col-sm-10">
        @if( isset( $product->date_end ) )
        <input name="date_end" type="text" id="date_end" class="form-control" value="{{old('date_end',$product->date_end)}}" autocomplete="off">
        @else
        <input name="date_end" type="text" id="date_end" class="form-control" value="{{old('date_end')}}" autocomplete="off">
        @endif
        
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Dimensions (L x W x H)</label>
    <div class="col-sm-10">
        <div class="row">
            <div class="col-sm-4">
                <input name="length" type="number" class="form-control" value="{{old('length', (isset($product->length)) ? $product->length : '')}}" placeholder="Length">
            </div>
            <div class="col-sm-4">
                <input name="width" type="number" class="form-control" value="{{old('width', (isset($product->width)) ? $product->width : '')}}" placeholder="Width">
            </div>
            <div class="col-sm-4">
                <input name="height" type="number" class="form-control" value="{{old('height', (isset($product->height)) ? $product->height : '')}}" placeholder="Height">
            </div>
        </div>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Length Class</label>
    <div class="col-sm-10">
        <select name="length_class" class="form-control">
            <option value="centimeter" {{ (isset($product->length_class)) ? (($product->length_class == 'centimeter') ? 'selected' : '') : '' }}>Centimeter</option>
            <option value="milimeter" {{ (isset($product->length_class)) ? (($product->length_class == 'milimeter') ? 'selected' : '') : '' }}>Milimeter</option>
            <option value="inch" {{ (isset($product->length_class)) ? (($product->length_class == 'inch') ? 'selected' : '') : '' }}>Inch</option>
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Weight</label>
    <div class="col-sm-10">
        <input name="weight" type="number" class="form-control" value="{{old('weight', (isset($product->height)) ? $product->height : '')}}">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Weight Limit</label>
    <div class="col-sm-10">
        <select name="weight_limit" class="form-control">
            <option value="kilogram" {{ (isset($product->length_class)) ? (($product->length_class == 'kilogram') ? 'selected' : '') : '' }}>Kilogram</option>
            <option value="gram" {{ (isset($product->length_class)) ? (($product->length_class == 'gram') ? 'selected' : '') : '' }}>Gram</option>
            <option value="pound" {{ (isset($product->length_class)) ? (($product->length_class == 'pound') ? 'selected' : '') : '' }}>Pound</option>
            <option value="ounce" {{ (isset($product->length_class)) ? (($product->length_class == 'ounce') ? 'selected' : '') : '' }}>Ounce</option>
        </select>
    </div>
</div>

@if(request()->route()->getName() == 'admin.product.edit')
@php 
if(isset($product->category) && count($product->category) > 0){
    $checkCat = 1;
}
else{
    $checkCat = 0;   
}
@endphp
<div class="form-group">
    <label class="col-sm-2 control-label">Categories</label>
    <div class="col-sm-10">
        <select name="category_id[]" class="select2 form-control" multiple="multiple">
            @foreach($categories as $key => $category)
                <option value="{{ $category->id }}" @if($checkCat == 1)  @foreach($product->category as $pCat ) @if($pCat->id == $category->id)  selected @endif @endforeach @endif>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
</div>

@else
<div class="form-group">
    <label class="col-sm-2 control-label">Categories</label>
    <div class="col-sm-10">
        <select name="category_id[]" class="select2 form-control" multiple="multiple">
            @foreach($categories as $key => $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
</div>
@endif

<div class="form-group">
    <label class="col-sm-2 control-label">Manufacturer</label>
    <div class="col-sm-10">
        <input name="manufacturer" type="text" class="form-control" value="{{old('manufacturer', (isset($product->manufacturer)) ? $product->manufacturer : '')}}">
    </div>
</div>


<div class="hr-line-dashed"></div>
<div class="form-group">
    <label class="col-sm-2 control-label">Sort Order(*)</label>
    <div class="col-sm-10">
        <input name="sort_order" type="number" class="form-control" value="{{old('sort_order', (isset($product->sort_order)) ? $product->sort_order : '')}}">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Status</label>
    <div class="col-sm-10">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" id="status1" value="1" {{old('status') == 1 ? 'checked' : ''}} {{ (isset($product->status)) ? (($product->status == 1) ? 'checked' : '') : '' }}>
            <label class="form-check-label" for="status1">
            Publish
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" id="status2" value="0" {{old('status') == 1 ? 'checked' : ''}} {{ (isset($product->status)) ? (($product->status == 0) ? 'checked' : '') : '' }}>
            <label class="form-check-label" for="status2">
            Unpublish
            </label>
        </div>
    </div>
</div>
