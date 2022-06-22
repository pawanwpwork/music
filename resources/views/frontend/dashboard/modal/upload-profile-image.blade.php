<div class="modal fade bd-example-modal-lg" id="modalUploadImage" tabindex="-1" role="dialog"
    aria-labelledby="modalUploadImageLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalUploadImageLabel">Profile Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="upload-img">
                    <form id="upload-img-form">
                        @csrf()
                        <div class="upload-img-form">
                            <label for="uploadImg"><i class="fa fa-plus"></i> Profile Image</label>
                            <input type="file" name="image" id="uploadImg">
                        </div>
                    </form>
                    <div class="upload-img-old">
                        <div class="row" id="appendUploadImage">
                            

                            @if(isset($member->image))
                                @foreach($member->image as $mImage)
                                  
                                    <div class="col-md-4" id="uploadImageItem{{$mImage->id}}">
                                        <div class="upload-img-old-box square">
                                            <img src="{{route('frontend.member.old.profile.image',$mImage->id)}}" alt="" data-image="{{$mImage->image}}" class="{{$mImage->image == $member->profile_image ? 'active' : ''}}">
                                        </div>
                                        <button type="button" class="remove btn-danger" id="{{$mImage->id}}">Remove</button>
                                    </div>
                                    

                                @endforeach
                            @endif
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <form action="{{route('frontend.member.profile.image.update')}}" method="POST" id="updateProfileImage">
                        @csrf()
                        <input type="hidden" name="profile_image">
                        <button type="submit" class="btn btn-secondary" id="changeProfile" onclick="deleteItems()">Change Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>