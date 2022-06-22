<div class="wrapper wrapper-content search-form">
    <div class="row">
        <div class="col-lg-12">
            <form action="{{\Request::url()}}">
                <div class="ibox-content">

                    <div class="row">
                        <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label" for="input-name">Member First Name</label>
                            <input type="text" name="first_name" value="{{$_GET['first_name'] ?? ''}}" placeholder="Member Name" id="input-name" class="form-control" autocomplete="off"><ul class="dropdown-menu"></ul>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="input-name">Member Last Name</label>
                            <input type="text" name="last_name" value="{{$_GET['last_name'] ?? ''}}" placeholder="Member Name" id="input-name" class="form-control" autocomplete="off"><ul class="dropdown-menu"></ul>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="input-model">Email</label>
                            <input type="text" name="email" value="{{$_GET['email'] ?? ''}}" placeholder="Email" id="input-model" class="form-control" autocomplete="off"><ul class="dropdown-menu"></ul>
                        </div>
                        </div>
                        <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label" for="input-price">Member Group</label>
                            <select name="membership_type_id" class="form-control">
                                <option value="" selected>Select a Group</option>
                                @foreach($memberships as $key => $member)
                                    <option value="{{ $key }}" {{  isset( $_GET['membership_type_id'] ) && $_GET['membership_type_id'] == $key ? 'selected' : ''  }}>{{$member}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="input-quantity">IP</label>
                            <input type="text" name="ip" value="{{$_GET['ip'] ?? ''}}" placeholder="Ip" id="input-quantity" class="form-control">
                        </div>
                        </div>
                        <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label" for="input-model">Date Added</label>
                            <input type="date" class="form-control" name="date" value="{{$_GET['date'] ?? ''}}">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="input-status">Status</label>
                            <select name="status" id="input-status" class="form-control" placeholder="status">
                                <option value=""></option>
                                <option value="1" {{  isset( $_GET['status'] ) && $_GET['status'] == 1 ? 'selected' : ''  }}>Enabled</option>
                                <option value="0" {{  isset( $_GET['status'] ) && $_GET['status'] == 0 ? 'selected' : ''  }}>Disabled</option>
                            </select>
                        </div>
                        <!-- <div class="form-group">
                            <label class="control-label" for="input-image">Image</label>
                            <select name="image" id="input-image" class="form-control">
                            <option value="*"></option>
                                <option value="1">Enabled</option>
                                <option value="0">Disabled</option>
                            </select>
                        </div> -->
                        <button type="submit" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-filter"></i> Filter</button>
                        </div>
                    </div>

                </div>
            </form>
           
        </div>
    </div>
</div>