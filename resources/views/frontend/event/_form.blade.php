<div class="formfield col-12">
    <label for="frmEventName">Event Title</label>
    <input type="text" name="name" id="frmEventName" value="{{ old('name') }}">
</div>
<div class="formfield col-lg-6 col-12">
    <label for="frmEventLocation">Event Location</label>
    <input type="text" name="location" id="frmEventLocation" value="{{ old('location') }}">
</div>
<div class="formfield col-lg-6 col-12">
    <label for="frmEventTime">Event Time</label>
    <input type="time" name="time" id="frmEventTime" value="{{ old('time') }}">
</div>
<div class="formfield formfield-upload col-12" id="uploadImg">
    <label for="frmUploadImg">Upload Event Image</label>
    <input type="file" name="image" id="frmUploadImg" class="form-control">

</div>
<div class="formfield col-12">
    <label for="frmEventDesc">Description</label>
    <textarea name="description" id="description">{{ old('description') }}</textarea>
</div>

<div class="formfield col-lg-6 col-12">
    <label for="frmStartDate">Event Start Date</label>
    <input type="text" name="event_start_date" id="frmEventStartDate" value="{{ old('event_start_date') }}" autocomplete="off">
</div>
<div class="formfield col-lg-6 col-12">
    <label for="frmEndDate">Event End Date</label>
    <input type="text" name="event_end_date"  id="frmEventEndDate" value="{{ old('event_end_date') }}" autocomplete="off">
</div>

<div class="formfield col-lg-6 col-12">
    <label for="frmStartDate">Advertise Start Date</label>
    <input type="text" name="date_start" class="dateCal" id="frmStartDate" value="{{ old('date_start') }}" autocomplete="off">
</div>
<div class="formfield col-lg-6 col-12">
    <label for="frmEndDate">Advertise End Date</label>
    <input type="text" name="date_end" class="dateCal" id="frmEndDate" value="{{ old('date_end') }}" autocomplete="off">
</div>
<div class="formfield col-12" id="eventTotalDays">
    <div class="eventcost__wrap">
        <div class="formfield eventcost-day">
            <label for="frmTotalDays"><i class="fas fa-calendar-day"></i> Total Days</label>
            <input type="text" name="total_days" id="frmTotalDays" value="0">
        </div>
        <div class="formfield eventcost-rate">
            <label><i class="fa fa-percentage"></i> Per Day Rate</label>
            <input type="text" name="pay_per_day" id="frmEventRate" value="{{ $rate->event_per_day_rate }}" readonly>
        </div>
        <div class="formfield eventcost-total">
            <label for="frmSubTotal"><i class="fas fa-poll-h"></i> Sub Total</label>
            <input type="text" name="sub_total" id="frmSubTotal" value="0" readonly>
        </div>
    </div>
</div>
<div class="formfield formfield-submit col-12">
    <input type="submit" value="Add To Cart">
</div>