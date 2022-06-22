<div class="formfield">
    <label for="frmBandDj">Band / DJ</label>
    <select name="type" id="frmBandDj" class="max-width--100">
        <option value="Band">Band</option>
        <option value="DJ">DJ</option>
    </select>
</div>
<div class="formfield">
    <h3 class="heading-min">Type of Event</h3>
    <div class="row margin-auto">
        <!-- // class customcheckbox is removed need to check later -->
        @foreach($types as $key => $type)
            <div class="form-check customcheckbox col-md-3 col-sm-6">
                <input type="checkbox" name="event_type_id[]" id="frmEvent{{$key}}" value="{{ $type->id }}">
                <label for="frmEvent{{$key}}">{{ $type->name }}</label>
            </div>
        @endforeach
    </div>
</div>
<div class="formfield">
    <input type="text" name="event_category_other" id="event_category_other" class="max-width--300"
        placeholder="Name of other party">
</div>
<div class="formfield">
    <h3 class="heading-min">Age of Band Members</h3>
    <div class="row margin-auto">
        <!-- // class customcheckbox is removed need to check later -->
        @foreach($ages as $key => $age)
            <div class="form-check customcheckbox col-12">
                <input type="checkbox" name="age_group_id[]" id="frmAge{{$key}}" value="{{ $age->id }}">
                <label for="frmAge{{$key}}">{{$age->name}}</label>
            </div>
        @endforeach
    </div>
</div>
<h3 class="heading-min">Registration Form</h3>
<div class="row">
    <div class="formfield col-12">
        <label for="frmName">Name</label>
        <input type="text" name="name" id="frmName">
    </div>
    <div class="formfield col-md-6">
        <label for="frmPhone">Contact Number</label>
        <input type="tel" name="contact_number" id="frmPhone">
    </div>
    <div class="formfield col-md-6">
        <label for="frmDate">Event Date</label>
        <input type="text" name="event_date" id="frmDate" autocomplete="off">
    </div>
    <div class="formfield col-12">
        <label for="frmAddress">Address</label>
        <input type="text" name="address" id="frmAddress">
    </div>
    <div class="formfield col-12">
        <label for="frmBudget">Budget</label>
        <input type="number" name="budget" id="frmBudget" class="max-width--100" min="1"
            max="99999">
    </div>
    <div class="formfield col-md-6">
        <label for="frmTypeMusic">Type of Music</label>
        <input type="text" name="type_of_music" id="frmTypeMusic">
    </div>
</div>
<small class="message">Submission Fee is ${{ $rate->book_band_dj_submission_rate}}.</small>
<div class="formfield formfield-submit">
    <input type="submit" value="Submit">
</div>