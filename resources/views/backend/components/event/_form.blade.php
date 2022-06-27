
<div class="form-group">
    <label class="col-sm-2 control-label">Name(*)</label>
    <div class="col-sm-10">
        <input name="name" type="text" placeholder="Name" class="form-control" value="{{old('name', (isset($event->name)) ? $event->name : '')}}">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Description(*)</label>
    <div class="col-sm-10">
        <textarea name="description" placeholder="Description" class="form-control">{{old('description', (isset($event->description)) ? $event->description : '')}}</textarea>
    </div>
</div>

<div class="hr-line-dashed"></div>
<div class="form-group">
    <label class="col-sm-2 control-label">Featured Image(*)</label>
    <div class="col-sm-10">
        
        @if(request()->route()->getName() == 'admin.event.edit')
            <div class="fileinput  @if($event->image != NULL)) fileinput-exists @else fileinput-new @endif" data-provides="fileinput">
                <div class="fileinput-preview fileinput-exists thumbnail" style="width:200px;height:200px;">
                    @if($event->image != NULL)
                        <img src="{{route('admin.event.storage',$event->id)}}">
                    @endif
                </div>
                <div>
                    <span class="btn btn-primary btn-file">
                        <span class="fileinput-new">Select image</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="hidden" name="image" value="{{$event->image}}">
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
                    <span class="fileinput-new">Select image</span>
                    <span class="fileinput-exists">Change</span>
                    <input id="image" name="image" type="file" class="form-control"/>
                </span>
                <a href="#" class="btn btn-danger fileinput-exists"
                    data-dismiss="fileinput">Remove</a>
            </div>
        @endif

    </div>
</div>

<div class="hr-line-dashed"></div>
<div class="form-group">
    <label class="col-sm-2 control-label">Location (*)</label>
    <div class="col-sm-10">
        <input name="location" type="text" placeholder="Location" class="form-control" value="{{old('location', (isset($event->location)) ? $event->location : '')}}">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Time</label>
    <div class="col-sm-10">
        <input type="time" name="time" class="form-control" placeholder="--:--" value="{{ old('time', (isset($event->time)) ? $event->time : '')}}">
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Pay per day</label>
    <div class="col-sm-10">
        <input name="pay_per_day" type="number" placeholder="Pay per day" class="form-control" value="{{old('pay_per_day', (isset($event->pay_per_day)) ? $event->pay_per_day : '')}}">
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Total days</label>
    <div class="col-sm-10">
        <input name="total_days" type="text" placeholder="Total Days" class="form-control" value="{{old('total_days', (isset($event->total_days)) ? $event->pay_per_day : '')}}">
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Sub Total</label>
    <div class="col-sm-10">
        <input name="sub_total" type="text" placeholder="Sub Total" class="form-control" value="{{old('sub_total', (isset($event->sub_total)) ? $event->sub_total : '')}}">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Event Start Date</label>
    <div class="col-sm-10">
        <input name="event_start_date" type="text" class="form-control" value="{{ old('event_start_date', (isset($event->event_start_date)) ? \Carbon\Carbon::parse($event->event_start_date)->format('Y-m-d') : '')}}" id="frmEventStartDate" autocomplete="off" readonly>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Event End Date</label>
    <div class="col-sm-10">
        <input name="event_end_date" type="text" class="form-control" value="{{ old('event_end_date', (isset($event->event_end_date)) ? \Carbon\Carbon::parse($event->event_end_date)->format('Y-m-d') : '')}}" id="frmEventEndDate" autocomplete="off" readonly>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Advertisement Start Date</label>
    <div class="col-sm-10">
        <input name="date_start" type="text" class="form-control" value="{{ old('date_start', (isset($event->date_start)) ? \Carbon\Carbon::parse($event->date_start)->format('Y-m-d') : '')}}" id="frmStartDate" autocomplete="off" readonly>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Advertisement End Date</label>
    <div class="col-sm-10">
        <input name="date_end" type="text" class="form-control" value="{{ old('date_end', (isset($event->date_end)) ? \Carbon\Carbon::parse($event->date_end)->format('Y-m-d') : '')}}" id="frmEndDate" autocomplete="off" readonly>
    </div>
</div>


<div class="form-group">
    <label class="col-sm-2 control-label">Status</label>
    <div class="col-sm-10">
        <select name="status" id="" class="form-control">
            <option value="pending" {{ (isset($event->status)) ? (($event->status == 'pending') ? 'selected' : '') : '' }}>Pending</option>
            <option value="approved" {{ (isset($event->status)) ? (($event->status == 'approved') ? 'selected' : '') : '' }}>Approved</option>
            <option value="cancel"  {{ (isset($event->status)) ? (($event->status == 'cancel') ? 'selected' : '') : '' }}>Cancel</option>
        </select>
    </div>
</div>
