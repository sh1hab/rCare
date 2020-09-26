<div id="edit_location_modal" class="modal fade" style="">
    <div class="modal-dialog modal-dialog-vertical-center modal-md" role="document">
        <div class="modal-content bd-0 tx-14">

{{-- <div class="modal-header pd-y-20 pd-x-25">
<h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Message Preview</h6>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
</div> --}}
<form class="form-horizontal" action="{{ URL::to('setup/add_location') }}" id="" role="form" method="post" data-parsley-validate>
    @csrf
    <div class="modal-body pd-25">
        <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10"> Edit Location </h6>
        <input type="hidden" value="" class="location_id"  name="location_id">
        <div class="form-layout form-layout-1">
            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <label class="form-control-label"> Location Name: <span class="tx-danger">*</span></label>
                        <input class="form-control full" type="text" name="location_name" placeholder="Enter Location Name">
                    </div>
                </div><!-- col-4 -->
            </div><!-- row -->

            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <label class="form-control-label"> Location Short Name: <span class="tx-danger">*</span></label>
                        <input class="form-control short" type="text" name="location_short_name" placeholder="Enter Location Short Name">
                    </div>
                </div><!-- col-4 -->
            </div><!-- row -->

            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <label class="form-control-label"> Location Details: </label>
                        <textarea rows="3" class="form-control details" name="location_details" placeholder="Enter Location Details"></textarea>
                    </div>
                </div><!-- col-4 -->
            </div><!-- row -->

            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <label class="form-control-label"> Location Type: </label>
                        <select class="form-control select2 select2-hidden-accessible location_type" data-placeholder="Choose one" tabindex="-1" aria-hidden="true" name="location_type">
                            <option value="1">Regular</option>
                            <option value="2">Irregular</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <label class="form-control-label"> Opening Balance: </label>
                        <div class="input-group">
                            <span class="input-group-addon tx-size-sm lh-2">৳</span>
                            <input type="number" class="form-control opening" name="location_opening_balance">
                            <span class="input-group-addon tx-size-sm lh-2">.00</span>
                        </div>
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
                                    <input class="status" name="location_status" value="1" type="radio" checked="">
                                    <span> Active </span>
                                </label>
                            </div><!-- col-3 -->
                            <div class="col-lg-4">
                                <label class="rdiobox">
                                    <input class="status" name="location_status" value="0" type="radio">
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