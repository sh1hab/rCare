<div id="edit_service_modal" class="modal fade" style="">
    <div class="modal-dialog modal-dialog-vertical-center modal-md" role="document">
        <div class="modal-content bd-0 tx-14">

{{-- <div class="modal-header pd-y-20 pd-x-25">
<h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Message Preview</h6>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
</div> --}}
<form class="form-horizontal" action="{{ URL::to('setup/add_service') }}" id="" role="form" method="post" data-parsley-validate>
    @csrf
    <div class="modal-body pd-25">
        <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10"> Edit Service </h6>
        <input type="hidden" value="" class="service_id"  name="service_id">
        <div class="form-layout form-layout-1">

            <div class="row">
                <div class="col-md-10">
                    <div class="form-group mg-b-0">
                        <label> Service : <span class="tx-danger">*</span></label>
                        <input type="text" name="service_name" class="form-control name" placeholder="Enter firstname" required>
                    </div>
                </div><!-- col-4 -->
            </div><!-- row -->

          <div class="row">
              <div class="col-md-10">
                  <div class="form-group">
                      <label class="form-control-label"> Service Details: <span class="tx-danger">*</span></label>
                      <textarea rows="3" class="form-control details" name="service_details" placeholder="Enter Service Details"></textarea>
                  </div>
              </div><!-- col-4 -->
          </div><!-- row -->

            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <label class="form-control-label"> Status: <span class="tx-danger">*</span></label>
                        <div class="row mg-t-10">
                            <div class="col-lg-4">
                                <label class="rdiobox">
                                    <input name="status" class="status" type="radio" value="1" checked="">
                                    <span> Active </span>
                                </label>
                            </div><!-- col-3 -->
                            <div class="col-lg-4">
                                <label class="rdiobox">
                                    <input name="status" class="status" value="0" type="radio">
                                    <span> Inactive </span>
                                </label>
                            </div><!-- col-3 -->
                        </div>
                    </div>
                </div><!-- col-4 -->
            </div><!-- row -->
        </div>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-info tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium"> Submit </button>
        <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">Close</button>
    </div>
</form>

</div>
</div><!-- modal-dialog -->
</div>