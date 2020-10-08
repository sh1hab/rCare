<div id="product_note_modal" class="modal fade" style="">
    <div class="modal-dialog modal-dialog-vertical-center modal-md" role="document">
        <div class="modal-content bd-0 tx-14">

<div class="modal-header pd-y-20 pd-x-25">
<h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold"> Product Note </h6>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
</div>
<form class="form-horizontal" action="{{ URL::to('purchase/add_note') }}" id="" role="form" method="post" data-parsley-validate>
    @csrf

    <input type="hidden" value="" class="purchase_id"  name="purchase_id">
    <div class="modal-body pd-25">
        <div class="row">
            <div class="col-md-10">
                <div class="form-group">
                    <textarea rows="3" class="form-control note_1" name="parts_note_1" placeholder="Write Note"></textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-footer" style="justify-content: flex-start;">
        <button type="submit" class="btn btn-info tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium"> Save </button>
        <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">Close</button>
    </div>
</form>

</div>
</div><!-- modal-dialog -->
</div>