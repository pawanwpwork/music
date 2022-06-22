
<div class="form-group">
    <label class="col-sm-2 control-label">member Type</label>
    <div class="col-sm-10">
        <select name="membership_type_id" class="form-control">
            <option value="" selected disabled>Select member Type </option>
            @foreach($memberships as $key => $membership)
                <option value="{{ $key }}" {{ ($memberSetting->membership_type_id == $key) ? 'selected' : '' }}>{{$membership}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Photo(*)</label>
    <div class="col-sm-10">
        <input name="photo" type="number" class="form-control" value="{{old('photo', (isset($memberSetting->photo)) ? $memberSetting->photo : '')}}">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Video(*)</label>
    <div class="col-sm-10">
        <input name="video" type="number" class="form-control" value="{{old('video', (isset($memberSetting->video)) ? $memberSetting->video : '')}}">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Song(*)</label>
    <div class="col-sm-10">
        <input name="song" type="number" class="form-control" value="{{old('song', (isset($memberSetting->song)) ? $memberSetting->song : '')}}">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Instrument(*)</label>
    <div class="col-sm-10">
        <input name="instrument" type="number" class="form-control" value="{{old('instrument', (isset($memberSetting->instrument)) ? $memberSetting->instrument : '')}}">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Full Access</label>
    <div class="col-sm-10">
        <input type="checkbox" name="full_access" value="1" {{ ($memberSetting->full_access == '1') ? 'checked' : '' }}>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Home Access</label>
    <div class="col-sm-10">
        <input type="checkbox" name="home_access" value="1" {{ ($memberSetting->home_access == '1') ? 'checked' : '' }}>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">About Us</label>
    <div class="col-sm-10">
        <input type="checkbox" name="about_us" value="1" {{ ($memberSetting->about_us == '1') ? 'checked' : '' }}>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">View Event</label>
    <div class="col-sm-10">
        <input type="checkbox" name="view_event" value="1" {{ ($memberSetting->view_event == '1') ? 'checked' : '' }}>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Post Event</label>
    <div class="col-sm-10">
        <input type="checkbox" name="post_event" value="1" {{ ($memberSetting->post_event == '1') ? 'checked' : '' }}>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Request to Book a band</label>
    <div class="col-sm-10">
    <input type="checkbox" name="request_to_book_band" value="1" {{ ($memberSetting->request_to_book_band == '1') ? 'checked' : '' }}>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Post Classified</label>
    <div class="col-sm-10">
        <input type="checkbox" name="post_classified" value="1" {{ ($memberSetting->post_classified == '1') ? 'checked' : '' }}>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">View Classified</label>
    <div class="col-sm-10">
        <input type="checkbox" name="view_classified" value="1" {{ ($memberSetting->view_classified == '1') ? 'checked' : '' }}>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Cd Store</label>
    <div class="col-sm-10">
        <input type="checkbox" name="cd_store" value="1" {{ ($memberSetting->cd_store == '1') ? 'checked' : '' }}>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Cd Sell</label>
    <div class="col-sm-10">
        <input type="checkbox" name="cd_sell" value="1" {{ ($memberSetting->cd_sell == '1') ? 'checked' : '' }}>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Musician Search</label>
    <div class="col-sm-10">
        <input type="checkbox" name="musian_search" value="1" {{ ($memberSetting->musian_search == '1') ? 'checked' : '' }}>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Radio Submit</label>
    <div class="col-sm-10">
        <input type="checkbox" name="radio_submit" value="1" {{ ($memberSetting->radio_submit == '1') ? 'checked' : '' }}>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Radio Listen</label>
    <div class="col-sm-10">
        <input type="checkbox" name="radio_listen" value="1" {{ ($memberSetting->radio_listen == '1') ? 'checked' : '' }}>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Contact Us</label>
    <div class="col-sm-10">
        <input type="checkbox" name="contact_us" value="1" {{ ($memberSetting->contact_us == '1') ? 'checked' : '' }}>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Sign Up Fee</label>
    <div class="col-sm-10">
        <input name="sign_up_fee" type="number" class="form-control" value="{{old('sign_up_fee', (isset($memberSetting->sign_up_fee)) ? $memberSetting->sign_up_fee : '')}}">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Sign Up Fee Duration</label>
    <div class="col-sm-10">
        <input name="sign_up_fee_duration" type="text" class="form-control" value="{{old('sign_up_fee_duration', (isset($memberSetting->sign_up_fee_duration)) ? $memberSetting->sign_up_fee_duration : '')}}">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Number of song upload</label>
    <div class="col-sm-10">
        <input name="number_of_song_upload" type="number" class="form-control" value="{{old('number_of_song_upload', (isset($memberSetting->number_of_song_upload)) ? $memberSetting->number_of_song_upload : '')}}">
    </div>
</div>


