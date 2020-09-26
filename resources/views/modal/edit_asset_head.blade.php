<div id="edit_asset_head_modal" class="modal fade" style="">
    <div class="modal-dialog modal-dialog-vertical-center modal-md" role="document">
        <div class="modal-content bd-0 tx-14">

{{-- <div class="modal-header pd-y-20 pd-x-25">
<h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Message Preview</h6>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
</div> --}}
<form class="form-horizontal" action="{{ URL::to('setup/asset_head') }}" id="" role="form" method="post" data-parsley-validate>
    @csrf
    <div class="modal-body pd-25">
        <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10"> Edit Asset Head </h6>
        <input type="hidden" value="" class="asset_head_id"  name="asset_head_id">
        <div class="form-layout form-layout-1">

            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <label class="form-control-label"> Asset Type: </label>
                        <select class="form-control select2 select2-hidden-accessible asset_type" title="Select Asset Type" data-placeholder="Choose one" tabindex="-1" aria-hidden="true" name="asset_type">
                            @foreach ($data['asset_type'] as $asset_type)
                                <option value="{{ $asset_type->id }}">{{$asset_type->asset_type}}</option>
                            @endforeach
                        </select>                          
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <label class="form-control-label"> Asset Head: <span class="tx-danger">*</span></label>
                        <input class="form-control head" type="text" name="asset_head" placeholder="Enter Asset Head Name">
                    </div>
                </div><!-- col-4 -->
            </div><!-- row -->

            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <label class="form-control-label"> Status: <span class="tx-danger">*</span></label>
                        <div class="row">
                            <div class="col-lg-4">
                                <label class="rdiobox">
                                    <input name="status" class="status" value="1" type="radio" checked="">
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
        <button type="submit" class="btn btn-info tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">Submit</button>
        <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">Close</button>
    </div>
</form>

</div>
</div><!-- modal-dialog -->
</div>