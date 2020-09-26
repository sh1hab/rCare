<div id="edit_parts_modal" class="modal fade" style="">
    <div class="modal-dialog modal-dialog-vertical-center modal-lg" role="document">
        <div class="modal-content bd-0 tx-14">

{{-- <div class="modal-header pd-y-20 pd-x-25">
<h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Message Preview</h6>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
</div> --}}
<form class="form-horizontal" action="{{ URL::to('setup/add_parts_accessoris') }}" id="" role="form" method="post" data-parsley-validate>
@csrf
    <div class="br-section-wrapper">
        <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10"> Add Parts/Accessories </h6>
        <div class="form-layout form-layout-1">
            <input type="hidden" class="parts_id" name="parts_id" value="">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label"> Category: <span class="tx-danger">*</span></label>
                        <select class="form-control selectpicker category_id" data-live-search="true" title="Select Parts Category" data-placeholder="Select Category" tabindex="-1" aria-hidden="true" name="category_id">
                            @foreach ($data['category'] as $category)
                            <option data-subtext="{{$category->category_code}}" value="{{ $category->id }}">{{$category->category_name}}</option>
                            @endforeach
                        </select>                          
                    </div>
                </div>
            {{-- </div>

            <div class="row"> --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label"> Compatible Brand: <span class="tx-danger">*</span></label>
                        <select class="form-control selectpicker brand_id" data-live-search="true" title="Select Compatible Brand" data-placeholder="Select Category" tabindex="-1" aria-hidden="true" name="compatible_brand_id">
                            @foreach ($data['brand'] as $brand)
                            <option data-subtext="{{$brand->brand_code}}" value="{{ $brand->id }}">{{$brand->brand_name}}</option>
                            @endforeach
                        </select>                          
                    </div>
                </div>
            {{-- </div>


            <div class="row"> --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label"> Parts/Accessories Name: <span class="tx-danger">*</span></label>
                        <input class="form-control parts_name" type="text" name="parts_name" placeholder="Enter Parts/Accessories Name">
                    </div>
                </div>
            {{-- </div>

            <div class="row"> --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label"> Average Price: <span class="tx-danger">*</span></label>
                        <input class="form-control avg_price" type="text" name="avg_price" placeholder="Enter Parts/Accessories Avg. Price">
                    </div>
                </div>
            {{-- </div>

            <div class="row"> --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label"> Margin: <span class="tx-danger">*</span></label>
                        <input class="form-control margin" type="text" name="margin" placeholder="Enter Margin Price">
                    </div>
                </div>
            {{-- </div>

            <div class="row"> --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label"> Sale Price: <span class="tx-danger">*</span></label>
                        <input class="form-control sales_price" type="text" name="sales_price" placeholder="Enter Parts/Accessories Sale Price">
                    </div>
                </div>
            {{-- </div>

            <div class="row"> --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label"> Warranty Status: <span class="tx-danger">*</span></label>
                        <select class="form-control selectpicker warranty_id" data-live-search="true" title="Select Warranty Status" data-placeholder="Select Category" tabindex="-1" aria-hidden="true" name="warranty_id">
                            @foreach ($data['warranties'] as $warranty)
                            <option value="{{ $warranty->id }}">{{$warranty->warranty_period}}</option>
                            @endforeach
                        </select>                          
                    </div>
                </div>
            {{-- </div>


            <div class="row"> --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label"> Details: </label>
                        <textarea rows="3" class="form-control details" name="details" placeholder="Details of Product"></textarea>
                    </div>
                </div>
            {{-- </div>

            <div class="row"> --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label"> Status: <span class="tx-danger">*</span></label>
                        <div class="row mg-t-10">
                            <div class="col-lg-4">
                                <label class="rdiobox">
                                    <input class="status" name="status" value="1" type="radio" checked="">
                                    <span> Active </span>
                                </label>
                            </div><!-- col-3 -->
                            <div class="col-lg-4">
                                <label class="rdiobox">
                                    <input class="status" name="status" value="0" type="radio">
                                    <span> Inactive </span>
                                </label>
                            </div><!-- col-3 -->
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal-footer">
                <button type="submit" class="btn btn-info tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">Submit</button>
                <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div><!-- form-layout -->
</form>

</div>
</div><!-- modal-dialog -->
</div>