
<div class="form-group">
    <label class="col-sm-2 control-label">First Name(*)</label>
    <div class="col-sm-10">
        <input name="first_name" type="text" class="form-control" value="{{old('first_name', (isset($member->first_name)) ? $member->first_name : '')}}">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Last Name(*)</label>
    <div class="col-sm-10">
        <input name="last_name" type="text" class="form-control" value="{{old('last_name', (isset($member->last_name)) ? $member->last_name : '')}}">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Email(*)</label>
    <div class="col-sm-10">
        <input name="email" type="text" class="form-control" value="{{old('email', (isset($member->email)) ? $member->email : '')}}">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Password(*)</label>
    <div class="col-sm-10">
        <input name="password" type="password" class="form-control" value="{{old('password')}}">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Password Confirmation(*)</label>
    <div class="col-sm-10">
        <input name="password_confirmation" type="password" class="form-control" value="{{old('password_confirmation', (isset($member->password_confirmation)) ? $member->password_confirmation : '')}}">
    </div>
</div>

<div class="hr-line-dashed"></div>

<div class="form-group">
    <label class="col-sm-2 control-label">Phone(*)</label>
    <div class="col-sm-10">
        <input name="phone" type="text" class="form-control" value="{{old('phone', (isset($member->phone)) ? $member->phone : '')}}">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Fax </label>
    <div class="col-sm-10">
        <input name="fax" type="text" class="form-control" value="{{old('fax', (isset($member->fax)) ? $member->fax : '')}}">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">City</label>
    <div class="col-sm-10">
        <input name="city" type="text" class="form-control" value="{{old('city', (isset($member->city)) ? $member->city : '')}}">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Country</label>
    <div class="col-sm-10">
        <textarea name="country" class="form-control">{{old('country', (isset($member->country)) ? $member->country : '')}}</textarea>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">State</label>
    <div class="col-sm-10">
        <input name="state" type="text" class="form-control" value="{{old('state', (isset($member->state)) ? $member->state : '')}}">
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Zip Code</label>
    <div class="col-sm-10">
        <input name="zipcode" type="text" class="form-control" value="{{old('zipcode', (isset($member->zipcode)) ? $member->zipcode : '')}}">
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">IP</label>
    <div class="col-sm-10">
        <input name="ip" type="text" class="form-control" value="{{old('ip', (isset($member->ip)) ? $member->ip : '')}}">
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">DOB</label>
    <div class="col-sm-10">
        <input name="dob" type="date" class="form-control" value="{{old('dob', (isset($member->dob)) ? $member->dob : '')}}">
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Date Added</label>
    <div class="col-sm-10">
        <input name="date" type="date" class="form-control" value="{{old('date', (isset($member->date)) ? $member->date : '')}}">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Music Genre</label>
    <div class="col-sm-10">
        <select name="music_genre_id" class="form-control" placeholder="Select Genre">
            <option value="" selected disabled> Select Music Genre </option>
            @foreach($genres as $key => $genre)
                <option value="{{ $key }}" {{ (isset($member->music_genre_id)) ? (($member->music_genre_id == $key) ? 'selected' : '') : '' }}>{{$genre}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Membership Type</label>
    <div class="col-sm-10">
        <select name="membership_type_id" class="form-control">
            <option value="" selected disabled> Select Member Type </option>
            @foreach($memberships as $key => $mem)
                <option value="{{ $key }}" {{ (isset($member->membership_type_id)) ? (($member->membership_type_id == $key) ? 'selected' : '') : '' }}>{{$mem}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Category</label>
    <div class="col-sm-10">
        <select name="music_category_id" class="form-control">
            <option value="" selected disabled> Select Music Category </option>
            @foreach($categories as $key => $category)
                <option value="{{ $key }}" {{ (isset($member->music_category_id)) ? (($member->music_category_id == $key) ? 'selected' : '') : '' }}>{{$category}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Approved</label>
    <div class="col-sm-10">
        <select name="approved" class="form-control">
            <option value="Yes" {{ (isset($member->approved)) ? (($member->approved == 'Yes') ? 'selected' : '') : '' }}>Yes</option>
            <option value="No" {{ (isset($member->approved)) ? (($member->approved == 'No') ? 'selected' : '') : '' }}>No</option>
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Status</label>
    <div class="col-sm-10">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" id="status1" value="1" {{old('status') == 1 ? 'checked' : ''}} {{ (isset($member->status)) ? (($member->status == 1) ? 'checked' : '') : '' }}>
            <label class="form-check-label" for="status1">
            Enabled
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" id="status2" value="0" {{old('status') == 1 ? 'checked' : ''}} {{ (isset($member->status)) ? (($member->status == 0) ? 'checked' : '') : '' }}>
            <label class="form-check-label" for="status2">
            Disabled
            </label>
        </div>
    </div>
</div>
