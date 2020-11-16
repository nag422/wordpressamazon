<?php
function anxp_add_image_ajax_shortcode() {
?>
	
<div class="container">
	<div class="row">
		<div class="col-md-12">
		    <div class="card">
		        <div class="card-body">
		            <div class="row">
		                <div class="col-md-12">
		                    <h4>Add Image</h4>
		                    <hr>
		                </div>
		            </div>
		            <div class="row">
		                <div class="col-md-12">
							<div id="msg"></div>
		                    <form action="" method="post" enctype="multipart/form-data">
							  <div class="form-group row">
                                <label for="packagename" class="col-4 col-form-label">Package Name</label> 
                                <div class="col-8">
                                  <input id="packagename" name="packagename" placeholder="Package Name" class="form-control here" type="text">
                                </div>
                              </div>
							  <div class="form-group row">
                                <label for="packagephoto" class="col-4 col-form-label">Package Photo</label> 
                                <div class="col-8">
                                  <input id="packagephoto" name="packagephoto" class="form-control here" type="file">
                                </div>
                              </div>
							  <div class="form-group row">
                                <label for="packagephoto" class="col-4 col-form-label">Package Photo2</label> 
                                <div class="col-8">
                                  <input id="packagephoto2" name="packagephoto2" class="form-control here" type="file">
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="offset-4 col-8">
                                  <input id="addimage" name="addimage" class="btn btn-primary" value="Add Image">
                                </div>
                              </div>
                            </form>
		                </div>
		            </div>
		            
		        </div>
		    </div>
		</div>
	</div>
</div>
<?php
}
add_shortcode( 'add_image_ajax', 'anxp_add_image_ajax_shortcode');