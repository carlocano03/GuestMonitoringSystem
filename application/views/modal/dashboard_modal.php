    <!-- Modal -->
    <div class="modal fade" id="cameraModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-camera-fill me-2"></i>Live Camera</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div id="my_camera" class="pre_capture_frame mx-auto" ></div>
		            <!-- <input type="hidden" name="captured_image_data" id="captured_image_data"> -->
		            <br>
		            <input type="button" class="btn btn-success btn-lg w-100" value="CAPTURE" onClick="take_snapshot()">	
                </div>
                <hr>
            </div>
        </div>
    </div>

    <!-- Modal Discount -->
    <div class="modal fade" id="discountModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header text-white" style="background: #8F3F96;">
                <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-list-columns-reverse me-2"></i>Add Discount</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-2">
                    <label class="text-muted fw-bold">Discount</label>
                    <input type="number" class="form-control" id="total_discount">
                </div>
                <div class="form-group">
                    <label class="text-muted fw-bold">Remarks</label>
                    <textarea id="remarks" class="form-control"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary w-100" id="save_discount">ADD DISCOUNT<i class="bi bi-arrow-right-square-fill ms-2"></i></button>
            </div>
        </div>
    </div>

    <script>
        $(document).on('click', '.btn-close', function() {
            $('#add_discount').prop('checked', false);
            $('#discount_checked').val(0);
        });

        $(document).on('click', '#save_discount', function() {
            var discount = $('#total_discount').val();
            var total_discount = parseFloat($('#total_discount').val());
            var remarks = $('#remarks').val();
            var totalSum = 0;
            var total = 0;

            if (discount == '') {
                Swal.fire('Warning!', 'Please input valid discount.', 'warning');
            } else {
                $('#discount').text(total_discount.toFixed(2));
                $('#discount_remarks').text(remarks);
                $('#remarks_discount').val(remarks);
                $('.discount_added').show(200);

                $('#table_inventory tbody tr.row2').each(function() {
                    var sumCell = $(this).find('td:eq(5)');
                    var sumValue = parseFloat(sumCell.text());
                    totalSum += sumValue;
                    total = totalSum - total_discount;
                });
                $('#amount').text(total.toLocaleString('en-US', {maximumFractionDigits: 2}))
                $('#amt_total').val(discount);
                $('#discountModal').modal('hide');
                
            }
        });
    </script>

