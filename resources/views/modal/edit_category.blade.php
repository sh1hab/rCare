<div id="edit_category_modal" class="modal fade" style="">
  <div class="modal-dialog modal-dialog-vertical-center modal-md" role="document">
    <div class="modal-content bd-0 tx-14">

      <form class="form-horizontal" action="{{ URL::to('setup/add_category') }}" id="" role="form" method="post" data-parsley-validate>
        @csrf
        <div class="modal-body pd-25">
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10"> Edit Category </h6>
          <input type="hidden" value="" class="category_id"  name="category_id">
          <div class="form-layout form-layout-1">

            <div class="row">
              <div class="col-md-10">
                <div class="form-group">
                  <label class="form-control-label"> Category Name: <span class="tx-danger">*</span></label>
                  <input class="form-control category_name" type="text" name="category_name" placeholder="Enter Category">
                </div>
              </div><!-- col-4 -->
            </div><!-- row -->

            <div class="row">
              <div class="col-md-10">
                <div class="form-group">
                  <label class="form-control-label"> Category Code: <span class="tx-danger">*</span></label>
                  <input class="form-control edit_category_code" type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==2) return false;" name="category_code" placeholder="Category Code">

                  <div class="red edit_code_error" hidden>
                      Category code already exist!!!
                  </div>
                </div>
              </div><!-- col-4 -->
            </div><!-- row -->

            <div class="row">
              <div class="col-md-10">
                <div class="form-group">
                  <label class="form-control-label"> Category Details: </label>
                  <textarea rows="3" class="form-control category_details" name="category_details" placeholder="Enter Parts Details"></textarea>
                </div>
              </div><!-- col-4 -->
            </div><!-- row -->

            <div class="row">
              <div class="col-md-10">
                <div class="form-group">
                  <label class="form-control-label"> Serial: <span class="tx-danger">*</span></label>
                  <select class="form-control select2 select2-hidden-accessible category_serial" data-placeholder="Choose one" tabindex="-1" aria-hidden="true" name="serial">
                    <option value="Y"> Yes </option>
                    <option value="N"> No </option>
                  </select>
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
                        <input name="status" class="category_status" name="status" value="1" type="radio" checked="">
                        <span> Active </span>
                      </label>
                    </div><!-- col-3 -->
                    <div class="col-lg-4">
                      <label class="rdiobox">
                        <input name="status" class="category_status" name="status" value="0" type="radio">
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
          <button type="submit" class="btn btn-info tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium edit_category_submit"> Submit </button>
          <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">Close</button>
        </div>
      </form>

    </div>
  </div><!-- modal-dialog -->
</div>