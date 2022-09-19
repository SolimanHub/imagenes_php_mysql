<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PHP MySQL AJAX Image Upload - Mywebtuts.com</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
  <div class="row">
    <div class="col-md-12">
      <div class="card w-75 m-auto">
	<div class="card-header text-center bg-primary text-white">
	  <h4>PHP MySQL AJAX Image Upload - Mywebtuts.com</h4>
	</div>
	<div class="card-body">
	  <form action="upload.php" id="form" method="post" enctype="multipart/form-data">
	    <img id="preview-image" width="300px" class="mb-2">
	    <div class="form-group">
	      <label for="myImage"><strong>Select Image : </strong><span class="text-danger">*</span></label>
	      <input type="file" id="myImage" class="form-control">
	      <p id="errorMs" class="text-danger"></p>
	    </div>
	    <div class="d-flex justify-content-center">
	      <input type="submit" class="btn btn-success" id="submit" value="Upload">
	    </div>
	  </form>
	</div>
      </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){

$('#myImage').change(function(){    
  let reader = new FileReader();
  reader.onload = (e) => { 
    $('#preview-image').attr('src', e.target.result); 
  }   
  reader.readAsDataURL(this.files[0]); 
});

$("#submit").click(function(e){
  e.preventDefault();
  let form_data = new FormData();
  let img = $("#myImage")[0].files;
  if(img.length > 0){
    form_data.append('my_image', img[0]);
    $.ajax({
      url: 'upload.php',
      type: 'post',
      data: form_data,
      contentType: false,
      processData: false,
      success: function(res){
	const data = JSON.parse(res);
	if (data.error != 1) {
	  alert('Upload suceesfully.');
	}else {
	  $("#errorMs").text(data.em);
	}
      }
    });
  }else {
  $("#errorMs").text("Please select an image.");
  }
});
});
</script>
</body>
</html>

