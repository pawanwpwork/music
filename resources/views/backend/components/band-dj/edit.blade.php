@extends('layouts.app-backend')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Edit Book Band/DJ</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('admin.dashboard')}}">Dashboard</a>
            </li>
            <li>
                <a href="{{route('admin.banddjbook.list')}}">list</a>
            </li>
            <li class="active">
                <strong>Update Book Band/DJ</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            @include('layouts.message')

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Update Book Band Dj from the following form.</h5>
                </div>
                <div class="ibox-content">
                  <form method="POST" class="form-horizontal" action="{{route('admin.banddjbook.update',$book->id)}}">
                    
                        @csrf()
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Type(*)</label>
                            <div class="col-sm-10">
                               <select name="type" class="form-control">
                                   <option value="">Select Type</option>
                                   <option value="Band" {{old('type',$book->type) == 'Band' ? 'selected' : ''}}>Band</option>
                                   <option value="DJ" {{old('type',$book->type) == 'DJ' ? 'selected' : ''}}>DJ</option>
                               </select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Type of Event</label>
                            <div class="col-sm-10">
                                <label>
                                   
                                   @if(isset($types) && count($types))
                                       @foreach($types as $type)

                                          
                                        <input type="checkbox" name="event_type_id[]" value="{{$type->id}}"

                                          @if(isset($book->event_type) && count($book->event_type) > 0)
                                            @foreach($book->event_type as $key => $event_t)

                                              {{$event_t->pivot->event_type_id == $type->id ? 'checked' : ''}}

                                            @endforeach
                                          @endif
                                          
                                        > {{$type->name}}<br>
                                           
                                       @endforeach
                                   @endif 
            
                                </label>
                            </div>
                        </div>


                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Age of Band Members</label>
                            <div class="col-sm-10">
                                <label>
                                   
                                   @if(isset($ages) && count($ages))
                                       @foreach($ages as $age)

                                           
                                           <input type="checkbox" name="age_group_id[]"value="{{$age->id}}"

                                               @if(isset($book->age) && count($book->age) > 0)
                                                @foreach($book->age as $key => $olditn)

                                                  {{$olditn->pivot->age_group_id == $age->id ? 'checked' : ''}}

                                                @endforeach
                                              @endif

                                              > {{$age->name}} <br>
                                       @endforeach
                                   @endif 
            
                                </label>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Name(*)</label>
                            <div class="col-sm-10">
                               <input type="text" name="name" value="{{old('name',$book->name)}}" class="form-control">
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Contact Number</label>
                            <div class="col-sm-10">
                               <input type="text" name="contact_number" value="{{old('contact_number',$book->contact_number)}}" class="form-control">
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Event Date</label>
                            <div class="col-sm-10">
                               <input type="date" name="event_date" value="{{old('event_date',$book->event_date)}}" class="form-control">
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Address</label>
                            <div class="col-sm-10">
                               <input type="text" name="address" value="{{old('address',$book->address)}}" class="form-control">
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Budget</label>
                            <div class="col-sm-10">
                               <input type="number" name="budget" value="{{old('budget',$book->budget)}}" class="form-control">
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Music Type</label>
                            <div class="col-sm-10">
                               <input type="text" name="type_of_music" value="{{old('type_of_music',$book->type_of_music)}}" class="form-control">
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Order Status</label>
                            <div class="col-sm-10">
                               <select name="order_status" class="form-control">
                                   <option value="">Select Status</option>
                                   <option value="0" {{$book->order_status == 0 ? 'selected' : ''}}>Pending</option>
                                   <option value="1" {{$book->order_status == 1 ? 'selected' : ''}}>Success</option>
                                   <option value="2" {{$book->order_status == 2 ? 'selected' : ''}}>Cancel</option>
                               </select>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection