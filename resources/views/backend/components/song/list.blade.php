@extends('layouts.app-backend')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6 col-md-6">
        <h2>Song List</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('admin.dashboard')}}">Dashboard</a>
            </li>
            <li class="active">
                <strong>Song List</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            @include('layouts.message')
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Song List</h5>
                </div>
                <div class="ibox-content">
                    <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                        <thead>
                            <tr>
                                <th data-toggle="true">Song Name</th>
                                <th>Submited By</th>
                                <th>Label</th>
                                <th>Artist</th>
                                <th>Song</th>
                                <th>Lyrics</th>
                                <!-- <th>Status</th> -->
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($songs) && count($songs) > 0)
                                @foreach($songs as $song)
                                    <tr>
                                        <td>{{$song->member->first_name ?? ''}} {{$song->member->last_name ?? ''}}</td>
                                        <td>{{$song->title ?? ''}}</td>
                                        <td>{{$song->label ?? ''}}</td>
                                        <td>{{ $song->artist ?? '' }}</td>
                                        <td><a href="{{asset('song/'.$song->song)}}" target="_blank">Song File</a></td>
                                        <td><a href="{{asset('lyrics/'.$song->lyrics)}}" target="_blank">Lyrics File</a></td>
                                      {{-- <td>
                                            @if($song->status == 1)
                                                <span class="badge badge-primary">Published</span>
                                            @else
                                                <span class="badge badge-danger"> Unpublished</span>
                                            @endif
                                        </td> --}}
                                        <td>
                                            <a href="#delete_song" data-remote="{{route('admin.song.delete.confirm',$song->id)}}" data-toggle="modal"  class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                       
                                    </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <td colspan="8">No song Available!</td>
                                    </tr>
                            @endif 
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5">
                                    <ul class="pagination pull-right"></ul>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<div class="modal fade" id="delete_song" tabindex="-1" role="dialog" aria-labelledby="delete_song" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content"></div>
   </div>
</div>

@section('footer-scripts')
<script type="text/javascript">
$('#delete_song').on('show.bs.modal', function (e) {
    var button = $(e.relatedTarget);
    var modal = $(this);
    // or, load content from value of data-remote url
    modal.find('.modal-content').load(button.data("remote"));

});
</script>
@endsection