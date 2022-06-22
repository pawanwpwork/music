
<div class="form-group">
    <label class="col-sm-2 control-label">Name(*)</label>
    <div class="col-sm-10">
        <input name="name" type="text" placeholder="Name" class="form-control" value="{{old('name', (isset($genre->name)) ? $genre->name : '')}}">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Status</label>
    <div class="col-sm-10">
        <select name="status" id="" class="form-control">
            <option value="1" {{ (isset($genre->status)) ? (($genre->status == 1) ? 'selected' : '') : '' }}>Active</option>
            <option value="0"  {{ (isset($genre->status)) ? (($genre->status == 0) ? 'selected' : '') : '' }}>Inactive</option>
        </select>
    </div>
</div>
