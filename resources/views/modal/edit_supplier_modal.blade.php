<div id="edit_supplier_modal" class="modal fade" style="">
    <div class="modal-dialog modal-dialog-vertical-center modal-md" role="document">
        <div class="modal-content bd-0 tx-14">

            <form class="form-horizontal" action="{{ URL::to('setup/add_supplier') }}" id="" role="form" method="post" data-parsley-validate>
                @csrf
                <div class="modal-body pd-25">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10"> Edit Supplier </h6>
                    <input type="hidden" value="" class="supplier_id"  name="supplier_id">
                    <div class="form-layout form-layout-1">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-control-label"> Supplier Name: <span class="tx-danger">*</span></label>
                                    <input class="form-control supplier_name" type="text" name="supplier_name" placeholder="Enter Supplier Name">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-control-label"> Supplier Contact: <span class="tx-danger">*</span></label>
                                    <input class="form-control supplier_contact" type="text" name="supplier_contact" placeholder="Enter Supplier Contact Number">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-control-label"> Supplier Address: </label>
                                    <textarea rows="3" class="form-control supplier_address" name="supplier_address" placeholder="Enter Address Details"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-control-label"> Opening Balance: </label>
                                    <div class="input-group">
                                        <input class="form-control opening_amount" type="number" pattern="/^-?\d+\.?\d*$/" name="opening_amount" placeholder="Enter Opening Amount">
                                    </div>
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
                                                <input class="status" name="status" value="1" type="radio" checked="">
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