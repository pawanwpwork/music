<script type="text/javascript">
    

  $("#appendUploadImage img").on('click',function(){

      $("#appendUploadImage img").removeClass('active');

      $(this).addClass('active');

      $("#updateProfileImage input[name=profile_image]").val($(this).data('image'));

  });

  $("#uploadImg").on('change',function(e){

      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('#upload-img-form input[name="_token"]').val()
        }
      });

      e.preventDefault();

      var form = document.forms.namedItem("upload-img-form"); // high importance!, here you need change "yourformname" with the name of your form

      var formData = new FormData(form); // high importance!

      
      $.ajax({
        type: 'POST',
        url: "{{route('frontend.member.upload.profile.image')}}",
        dataType: "json", // or html if you want...
        contentType: false, // high importance!
        data: formData, // high importance!
        processData: false, // high importance!
        success: function (data) {
           var htmlData = '<div class="col-md-4">'+
                              '<div class="upload-img-old-box square">'+
                              '<img src="'+data.imageUrl+'" alt="" data-image="'+data.fileName+'">'+
                          '</div>';
           $("#appendUploadImage").append(htmlData);

           $("#appendUploadImage img").on('click',function(){
              $("#appendUploadImage img").removeClass('active');
              $(this).addClass('active');
              $("#updateProfileImage input[name=profile_image]").val($(this).data('image'));
          });
        },
        error: function (data) {
            console.log('Error:', data);
        }
      });
  });


  function deleteItems() {
    location.reload(true);
  }

  $('#appendUploadImage .remove').on('click',function(){

    if (confirm('Are you sure to remove this image?')) {

      var removeId = $(this).attr('id');

      $.ajax({
        type: 'GET',
        url: "{{route('frontend.member.upload.profile.image.remove')}}",
        data: {id:removeId}, // high importance!
        success: function (data) {
          $("#uploadImageItem"+data.response).remove();
        },
        error: function (data) {
            console.log('Error:', data);
        }
      });
    }

  });

</script>