
<div class="form-group">
    <label class="col-sm-2 control-label">Title(*)</label>
    <div class="col-sm-10">
        <input name="title" type="text" placeholder="Title" class="form-control" value="{{old('title', (isset($setting->title)) ? $setting->title : '')}}">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Meta Title(*)</label>
    <div class="col-sm-10">
        <input name="meta_title" type="text" placeholder="Site Title" class="form-control" value="{{old('meta_title', (isset($setting->meta_title)) ? $setting->meta_title : '')}}">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Meta Description(*)</label>
    <div class="col-sm-10">
        <textarea name="meta_description" placeholder="Meta Description" class="form-control">{{old('meta_description', (isset($setting->meta_description)) ? $setting->meta_description : '')}}</textarea>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Logo Image(*)</label>
    <div class="col-sm-10">
        
        
            <div class="fileinput  @if($setting->logo != NULL)) fileinput-exists @else fileinput-new @endif" data-provides="fileinput">
                <div class="fileinput-preview fileinput-exists thumbnail" style="width:200px;height:200px;">
                    @if($setting->logo != NULL)
                        <img src="{{route('admin.site-setting.storage',$setting->id)}}">
                    @endif
                </div>
                <div>
                    <span class="btn btn-primary btn-file">
                        <span class="fileinput-new">Select Logo Image</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="hidden" name="logo" value="{{$setting->logo}}">
                        <input id="logo" name="logo" type="file" class="form-control"/>
                    </span>
                    <a href="#" class="btn btn-danger fileinput-exists"
                        data-dismiss="fileinput">Remove</a>
                </div>
            </div>
       
    </div>
</div>


<div class="form-group">
    <div class="hr-line-dashed"></div>
    <label class="col-sm-2 control-label">Address 1</label>
    <div class="col-sm-10">
        <input name="address_1" type="text" placeholder="Address 1" class="form-control" value="{{old('address_1', (isset($setting->address_1)) ? $setting->address_1 : '')}}">
    </div>
</div>

<div class="form-group">
    <div class="hr-line-dashed"></div>
    <label class="col-sm-2 control-label">Address 2</label>
    <div class="col-sm-10">
        <input name="address_2" type="text" placeholder="Address 2" class="form-control" value="{{old('address_2', (isset($setting->address_2)) ? $setting->address_2 : '')}}">
    </div>
</div>


<div class="form-group">
    <div class="hr-line-dashed"></div>
    <label class="col-sm-2 control-label">Mobile</label>
    <div class="col-sm-10">
        <input name="mobile" type="text" placeholder="Mobile" class="form-control" value="{{old('mobile', (isset($setting->mobile)) ? $setting->mobile : '')}}">
    </div>
</div>


<div class="form-group">
    <div class="hr-line-dashed"></div>
    <label class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
        <input name="email" type="text" placeholder="Email" class="form-control" value="{{old('email', (isset($setting->email)) ? $setting->email : '')}}">
    </div>
</div>

<div class="form-group">
    <div class="hr-line-dashed"></div>
    <label class="col-sm-2 control-label">iframe code</label>
    <div class="col-sm-10">
        <textarea name="iframe" class="form-control" rows="10">
            {{old('iframe', (isset($setting->iframe)) ? $setting->iframe : '')}}
        </textarea>
     
    </div>
</div>

<div class="form-group">
    <div class="hr-line-dashed"></div>
    <label class="col-sm-2 control-label">Home Slider Title</label>
    <div class="col-sm-10">
        <input name="home_slider_title" type="text" placeholder="Home Slider TItle" class="form-control" value="{{old('home_slider_title', (isset($setting->home_slider_title)) ? $setting->home_slider_title : '')}}">
    </div>
</div>

<div class="form-group">
    <div class="hr-line-dashed"></div>
    <label class="col-sm-2 control-label">Home Offer Title</label>
    <div class="col-sm-10">
        <input name="home_slider_subtitle" type="text" placeholder="Home Slider Sub TItle" class="form-control" value="{{old('home_slider_subtitle', (isset($setting->home_slider_subtitle)) ? $setting->home_slider_subtitle : '')}}">
    </div>
</div>


<div class="form-group">
    <div class="hr-line-dashed"></div>
    <label class="col-sm-2 control-label">Keywords (*)</label>
    <div class="col-sm-10">
        <input name="keyword" type="text" placeholder="Keyword" class="form-control" value="{{old('keyword', (isset($setting->keyword)) ? $setting->keyword : '')}}">
    </div>
</div>
