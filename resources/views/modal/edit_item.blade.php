<div id="edit_item_modal" class="modal fade" style="">
    <div class="modal-dialog modal-dialog-vertical-center modal-md" role="document">
        <div class="modal-content bd-0 tx-14">

            <form class="form-horizontal" action="{{ URL::to('setup/add_item') }}" id="" role="form" method="post" data-parsley-validate>
                @csrf
                <div class="modal-body pd-25">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10"> Edit Item </h6>
                    <input type="hidden" value="" class="item_id"  name="item_id">
                    <div class="form-layout form-layout-1">

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group mg-b-0">
                                    <label> Item Name : <span class="tx-danger">*</span></label>
                                    <input type="text" name="item_name" class="form-control item_name" placeholder="Enter Item Name" required="">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-control-label"> Item Description: </label>
                                    <textarea rows="3" class="form-control item_description" name="item_description" placeholder="Enter Item Description"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-control-label"> Status: <span class="tx-danger">*</span></label>
                                    <div class="row mg-t-10">
                                        <div class="col-lg-4">
                                            <label class="rdiobox">
                                                <input class="status" name="status" value="1" type="radio">
                                                <span> Active </span>
                                            </label>
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="rdiobox">
                                                <input class="status" name="status" value="0" type="radio">
                                                <span> Inactive </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

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