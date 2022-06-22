
<div class="formfield col-12">
    <label for="frmItemType">Item Type:</label>
    <select name="category_id[]" id="frmItemType">
        @foreach($categories as $category)
            @if(!in_array($category->id, [1,2,3,4]))
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endif
        @endforeach
    </select>
</div>
<div class="formfield col-md-6 col-12">
    <label for="frmItemName">Item Name</label>
    <input type="text" name="name" id="frmItemName" value="{{ old('name') }}">
</div>
<div class="formfield col-md-6 col-12">
    <label for="frmModelNo">Model/ Serial No.</label>
    <input type="text" name="model" id="frmModelNo" value="{{ old('model') }}">
</div>
<div class="formfield col-md-3 col-12">
    <label for="frmAskPrice">Asking Price</label>
    <input type="number" name="price" class="shortInput" id="frmAskPrice" min="0" max="999" value="{{ old('price') }}">
</div>
<div class="formfield col-md-3 col-12">
    <label for="frmItemsNo">Number of Items</label>
    <input type="number" name="quantity" class="shortInput" id="frmItemsNo" min="1" max="999" value="1">
</div>
<div class="formfield formfield-upload col-12" id="uploadImg">
    <label for="frmUploadImg">Upload Image</label>
    <input type="file" name="image" id="frmUploadImg">
</div>
<div class="formfield col-12">
    <label for="frmEventDesc">Description</label>
    <textarea name="description" id="frmEventDesc">{{ old('description') }}</textarea>
</div>
<div class="col-12">
    <h2 class="heading">Ad Post Date and Price</h2>
</div>
<div class="formfield col-md-6 col-12">
    <label for="frmStartDate">Ad Post Date</label>
    <input type="text" name="date_available" class="dateCal" id="frmStartDate" value="{{ old('date_available') }}" autocomplete="off">
</div>
<div class="formfield col-md-6 col-12">
    <label for="frmEndDate">Ad End Date</label>
    <input type="text" name="date_end" class="dateCal" id="frmEndDate" value="{{ old('date_end') }}" autocomplete="off">
</div>
<div class="formfield col-12" id="eventTotalDays">
    <div class="eventcost__wrap">
        <div class="formfield eventcost-day">
            <label for="frmTotalDays"><i class="fas fa-calendar-day"></i> Total Days</label>
            <input type="text" name="total_days" id="frmTotalDays" readonly>
        </div>
        <div class="formfield eventcost-rate">
            <label><i class="fa fa-percentage"></i> Per Day Rate</label>
            <input type="text" name="per_day_rate" id="frmEventRate" value="{{ $rate->classified_per_day_rate ?? 6 }}" readonly>
        </div>
        <div class="formfield eventcost-total">
            <label for="frmSubTotal"><i class="fas fa-poll-h"></i> Sub Total</label>
            <input type="text" name="sub_total" id="frmSubTotal" value="0" readonly>
        </div>
    </div>
</div>
<div class="formfield formfield-submit col-12">
    <input type="submit" value="Pay and Publish your Classified">
</div>