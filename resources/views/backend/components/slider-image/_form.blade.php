<div class="form-group">
    <label class="col-sm-2 control-label">Background Image(*)</label>
    <div class="col-sm-10">
        @if(request()->route()->getName() == 'admin.slider-image.edit')
            <div class="fileinput  @if($setting->image != NULL)) fileinput-exists @else fileinput-new @endif" data-provides="fileinput">
                <div class="fileinput-preview fileinput-exists thumbnail" style="width:200px;height:200px;">
                    @if($setting->image != NULL)
                        <img src="{{route('admin.slider-image.storage',$setting->id)}}">
                    @endif
                </div>
                <div>
                    <span class="btn btn-primary btn-file">
                        <span class="fileinput-new">Select Background Image</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="hidden" name="image" value="{{$setting->image}}">
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
                    <span class="fileinput-new">Select Background Image</span>
                    <span class="fileinput-exists">Change</span>
                    <input id="image" name="image" type="file" class="form-control"/>
                </span>
                <a href="#" class="btn btn-danger fileinput-exists"
                    data-dismiss="fileinput">Remove</a>
            </div>
        @endif
    </div>
</div>