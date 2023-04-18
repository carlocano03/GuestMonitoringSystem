<!-- Modal -->
<div class="modal fade" id="camera1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-camera-fill me-2"></i>Live Camera (Children 1)</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
            <div id="my_camera_1" class="pre_capture_frame_child mx-auto" ></div>
                <div class="form-group mb-2 camera_child_1" style="display:none;">
                    <div id="results_child_1">
                        
                    </div>
                </div>
		        <input type="hidden" name="captured_image_data_child_1" id="captured_image_data_child_1">
                <input type="hidden" id="child_1">
                <input type="hidden" id="child_id_1">
		        <br>
		        <input type="button" class="btn btn-success btn-lg w-100" value="CAPTURE" onClick="take_snapshot_1()">	
            </div>
            <hr>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="camera2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-camera-fill me-2"></i>Live Camera (Children 2)</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
            <div id="my_camera_2" class="pre_capture_frame_child mx-auto" ></div>
                <div class="form-group mb-2 camera_child_2" style="display:none;">
                    <div id="results_child_2">
                        
                    </div>
                </div>
		        <input type="hidden" name="captured_image_data_child_2" id="captured_image_data_child_2">
                <input type="hidden" id="child_2">
                <input type="hidden" id="child_id_2">
		        <br>
		        <input type="button" class="btn btn-success btn-lg w-100" value="CAPTURE" onClick="take_snapshot_2()">	
            </div>
            <hr>
        </div>
    </div>
</div>

<!-- Camera 3 -->
<div class="modal fade" id="camera3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-camera-fill me-2"></i>Live Camera (Children 3)</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
            <div id="my_camera_3" class="pre_capture_frame_child mx-auto" ></div>
                <div class="form-group mb-2 camera_child_3" style="display:none;">
                    <div id="results_child_3">
                        
                    </div>
                </div>
		        <input type="hidden" name="captured_image_data_child_3" id="captured_image_data_child_3">
                <input type="hidden" id="child_3">
                <input type="hidden" id="child_id_3">
		        <br>
		        <input type="button" class="btn btn-success btn-lg w-100" value="CAPTURE" onClick="take_snapshot_3()">	
            </div>
            <hr>
        </div>
    </div>
</div>

<script>
    //Camera 1
    Webcam.set({
	    width: 360,
	    height: 287,
	    image_format: 'jpeg',
	    jpeg_quality: 90
	});	 
	Webcam.attach('#my_camera_1');
	
	function take_snapshot_1() {
	 // take snapshot and get image data
        $('.camera_child_1').show(200);
        $('#my_camera_1').hide(200);
	    Webcam.snap( function(data_uri) {
	 // display results in page
            document.getElementById('results_child_1').innerHTML = 
            '<img class="after_capture_frame_child_1" src="'+data_uri+'"/>';
            $("#captured_image_data_child_1").val(data_uri);
	    });	 
        saveSnap1();
	}

    //Camera 2
    Webcam.set({
	    width: 360,
	    height: 287,
	    image_format: 'jpeg',
	    jpeg_quality: 90
	});	 
	Webcam.attach('#my_camera_2');
	
	function take_snapshot_2() {
	 // take snapshot and get image data
        $('.camera_child_2').show(200);
        $('#my_camera_2').hide(200);
	    Webcam.snap( function(data_uri) {
	 // display results in page
            document.getElementById('results_child_2').innerHTML = 
            '<img class="after_capture_frame_child_2" src="'+data_uri+'"/>';
            $("#captured_image_data_child_2").val(data_uri);
	    });	 
        saveSnap2();
	}

    //Camera 3
    Webcam.set({
	    width: 360,
	    height: 287,
	    image_format: 'jpeg',
	    jpeg_quality: 90
	});	 
	Webcam.attach('#my_camera_3');
	
	function take_snapshot_3() {
	 // take snapshot and get image data
        $('.camera_child_3').show(200);
        $('#my_camera_3').hide(200);
	    Webcam.snap( function(data_uri) {
	 // display results in page
            document.getElementById('results_child_3').innerHTML = 
            '<img class="after_capture_frame_child_3" src="'+data_uri+'"/>';
            $("#captured_image_data_child_3").val(data_uri);
	    });	 
        saveSnap3();
	}

    $(document).on('click', '#openCamera', function() {
        var childID = $(this).data('id');
        var guestID = $(this).data('child');
        console.log(childID);
        console.log(guestID);
        switch (childID) {
            case 1:
                $('#camera1').modal('show');
                $('#child_1').val(childID);
                $('#child_id_1').val(guestID);
                break;
        
            case 2:
                $('#camera2').modal('show');
                $('#child_2').val(childID);
                $('#child_id_2').val(guestID);
                break;

            case 3:
                $('#camera3').modal('show');
                $('#child_3').val(childID);
                $('#child_id_3').val(guestID);
                break;
        }
    }); 

    //Camera 1 Save
    function saveSnap1(){
	var base64data = $("#captured_image_data_child_1").val();
    var childID = $('#child_id_1').val();
	 $.ajax({
			type: "POST",
			dataType: "json",
			url: "<?= base_url('main/saveSnap')?>",
			data: {
                image: base64data,
                childID: childID
            },
			success: function(data) { 
				if (data.message == 'Success') {
                    setTimeout(() => {
                        $('#camera1').modal('hide');
                        $('.camera_child_1').hide(200);
                        $('#my_camera_1').show(200);
                    }, 1000);
                }
			}
		});
	}

    //Camera 2 Save
    function saveSnap2(){
	var base64data = $("#captured_image_data_child_2").val();
    var childID = $('#child_id_2').val();
	 $.ajax({
			type: "POST",
			dataType: "json",
			url: "<?= base_url('main/saveSnap')?>",
			data: {
                image: base64data,
                childID: childID
            },
			success: function(data) { 
				if (data.message == 'Success') {
                    setTimeout(() => {
                        $('#camera2').modal('hide');
                        $('.camera_child_2').hide(200);
                        $('#my_camera_2').show(200);
                    }, 1000);
                }
			}
		});
	}

    //Camera 3 Save
    function saveSnap3(){
	var base64data = $("#captured_image_data_child_3").val();
    var childID = $('#child_id_3').val();
	 $.ajax({
			type: "POST",
			dataType: "json",
			url: "<?= base_url('main/saveSnap')?>",
			data: {
                image: base64data,
                childID: childID
            },
			success: function(data) { 
				if (data.message == 'Success') {
                    setTimeout(() => {
                        $('#camera3').modal('hide');
                        $('.camera_child_3').hide(200);
                        $('#my_camera_3').show(200);
                    }, 1000);
                }
			}
		});
	}
</script>