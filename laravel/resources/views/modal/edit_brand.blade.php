<div id="edit_brand_modal" class="modal fade" style="">
    <div class="modal-dialog modal-dialog-vertical-center modal-md" role="document">
        <div class="modal-content bd-0 tx-14">

            <form class="form-horizontal" action="{{ URL::to('setup/add_brand') }}" id="" role="form" method="post" data-parsley-validate>
                @csrf
                <div class="br-section-wrapper">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10"> Edit Brand </h6>
                    <input type="hidden" value="" class="brand_id"  name="brand_id">
                    <div class="form-layout form-layout-1">

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-control-label"> Brand Name: <span class="tx-danger">*</span></label>
                                    <input class="form-control brand_name" type="text" name="brand_name" placeholder="Enter Brand Name" required="">
                                </div>
                            </div><!-- col-4 -->
                        </div><!-- row -->

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-control-label"> Brand Code: <span class="tx-danger">*</span></label>
                                    <input class="form-control edit_brand_code" type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==2) return false;" name="brand_code" placeholder="Enter Brand Code" required="">

                                    <div class="red edit_code_error" hidden>
                                        Brand code already exist!!!
                                    </div>

                                </div>
                            </div><!-- col-4 -->
                        </div><!-- row -->

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-control-label"> Categories of This Brand: <span class="tx-danger">*</span></label>
                                    <select class="selectpicker category" name="categories[]" multiple data-live-search="true" title="Select Categories Under This Brand" data-width="100%" required="">
                                        @foreach ($data['categories'] as $category)
                                            <option value="{{$category->id}}"> {{ $category->category_name }} </option>                                            
                                        @endforeach
                                    </select>
                                </div>
                            </div><!-- col-4 -->
                        </div><!-- row -->

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-control-label"> Parts Details: </label>
                                    <textarea rows="3" class="form-control brand_details" name="brand_details" placeholder="Enter Brand Details"></textarea>
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
                                                <input class="brand_status" name="status" value="1" type="radio" checked="">
                                                <span> Active </span>
                                            </label>
                                        </div><!-- col-3 -->
                                        <div class="col-lg-4">
                                            <label class="rdiobox">
                                                <input class="brand_status" name="status" value="0" type="radio">
                                                <span> Inactive </span>
                                            </label>
                                        </div><!-- col-3 -->
                                    </div>
                                </div>
                            </div><!-- col-4 -->
                        </div><!-- row -->



                        <div class="modal-footer  text-center">
                            <button type="submit" class="btn btn-info tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium"> Submit </button>
                            <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div><!-- form-layout -->
            </form>

        </div>
    </div><!-- modal-dialog -->
</div>