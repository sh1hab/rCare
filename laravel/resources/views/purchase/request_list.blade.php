@extends('layout.app')

@section('custom_css')
<style type="text/css">
    .btn, .sp-container button {
        padding: 5px 8px;
    }
    .request_search{
        padding: 10px;
    }
    .request_search .form-group{
        margin-bottom: 10px;
    }
    .request_search .btn, .request_search button {
        padding: 8px 10px;
    }
</style>
@endsection
@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href=" {{URL::to('/dashboard')}} "> Dashboard </a>
        <a class="breadcrumb-item" href=""> Purchase </a>
        <span class="breadcrumb-item active"> Purchase List </span>
    </nav>
</div>
<div class="br-pagebody">

    <div class="row">
        <div class="col-md-4 offset-md-4">
            <form class="form-horizontal" action="{{ URL::to('purchase/request_list') }}" id="" role="form" method="post">
                @csrf
                <div class="br-section-wrapper" style="padding: 10px">
                    <div class="form-layout form-layout-1 request_search">

                        <div class="row">
                            <div class="col-md-8 offset-md-2">
                                <div class="form-group">
                                    <label class="form-control-label"> Supplier </label>
                                    <select class="form-control js-example-basic-single" style="width: 100%" data-live-search="true" title="Select Supplier Name" data-placeholder="" tabindex="-1" aria-hidden="true" name="supplier_id">
                                        <option value="0"> ALL Supplier </option>
                                        @foreach ($data['suppliers'] as $supplier)
                                            <option value="{{ $supplier->id }}" <?php if( $supplier->id == Request::input('supplier_id') ) { echo "selected"; } ?>> {{ $supplier->supplier_name }} </option>
                                        @endforeach
                                    </select> 
                                </div>
                            </div><!-- col-4 -->
                        </div><!-- row -->

                        <div class="row">
                            <div class="col-md-8 offset-md-2">
                                <div class="form-group">
                                    <label class="form-control-label"> Request Date Range </label>
                                    <input class="form-control date_range" type="text" name="request_dates" placeholder="Date Range" autocomplete="off">
                                </div>
                            </div><!-- col-4 -->
                        </div><!-- row -->

                        <div class="form-layout-footer offset-md-4">
                            <button type="submit" class="btn btn-info">Search</button>
                            <button type="submit" class="btn btn-primary">Show All</button>
                        </div><!-- form-layout-footer -->

                    </div>
                </div><!-- form-layout -->
            </form>
        </div>        
    </div>

    <br>


    <div class="row">        
        <div class="col-md-12">
            <div class="br-section-wrapper" style="overflow-x:auto;">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="tx-inverse tx-uppercase tx-bold tx-14 mg-b-10"> All Purchase Request List </h6>
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>


                <table class="table table-striped table-info" id="sample_1"><!-- table2 -->
                    <thead>
                        <tr>
                            <th class="wd-5p"> SL </th>
                            <th class="wd-10p"> Parts </th>
                            <th class="wd-5p"> Supplier </th>
                            <th class="wd-5p"> Quantity </th>
                            <th class="wd-5p"> Unit Price </th>
                            <th class="wd-5p"> Total Price </th>
                            <th class="wd-10p"> Note</th>
                            <th class="wd-5p"> Request By </th>
                            <th class="wd-5p"> Location </th>
                            <th class="wd-5p"> Status </th>
                            <th class="wd-5p"> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($data['purchase_details']) > 0)

                        @php
                        $i =1;
                        @endphp

                        @foreach($data['purchase_details'] as $purchase)

                        @php
                            //dmd($purchase->purchase);
                        @endphp
                        <tr>
                            <td> {{ $i++ }} </td>
                            <td> {{$purchase->parts_name}} </td>
                            <td> {{$purchase->supplier_name}} </td>
                            <td> {{$purchase->quantity}} </td>
                            <td> {{$purchase->unit_price}} </td>
                            <td> {{$purchase->total_price}} </td>
                            <td>
                                @php
                                echo $purchase->parts_note;
                                if($purchase->parts_note_1){
                                    echo "<br>".$purchase->parts_note_1;
                                }
                                @endphp
                            </td>
                            <td> {{$purchase->user->name}} </td>
                            <td> {{$purchase->location_name}} </td>
                            <td>
                                @if($purchase->purchase_status == 1)
                                <a class="btn btn-warning tx-8 btn btn-warning tx-uppercase" style="cursor: default;" href="">Pending</a>
                                @elseif($purchase->purchase_status == 2)
                                <a class="btn btn-success tx-8 btn btn-warning tx-uppercase" style="cursor: default;" href="">Approved</a>
                                @else
                                <a class="btn btn-danger tx-8 btn btn-warning tx-uppercase" style="cursor: default;" href="">Canceled</a>
                                @endif


                            </td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-primary" href="" role="button" id="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-angle-down"></i>
                                    </a>    
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item product_note" data-id="{{ $purchase->purchase_id }}" data-note-1="{{ $purchase->parts_note_1 }}" href="{{ URL::to('purchase/request_status/'.$purchase->purchase_id.'') }}">Add Note</a>
                                        @if($purchase->purchase_status != 2)
                                        <a class="dropdown-item" href="{{ URL::to('purchase/request_status/'.$purchase->purchase_id.'/2') }}">Approve</a>
                                        @endif
                                        <a class="dropdown-item" href="{{ URL::to('purchase/request_status/'.$purchase->purchase_id.'/3') }}">Cancel</a>
                                        <a class="dropdown-item product_preview" href="{{ URL::to('purchase/request_status/'.$purchase->purchase_id) }}">Details</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="11" class="text-center"> There is no purchase request </td>
                            <td style="display: none"></td>
                            <td style="display: none"></td>
                            <td style="display: none"></td>
                            <td style="display: none"></td>
                            <td style="display: none"></td>
                            <td style="display: none"></td>
                            <td style="display: none"></td>
                            <td style="display: none"></td>
                            <td style="display: none"></td>
                            <td style="display: none"></td>
                        </tr>
                        @endif

                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <br>

    <div class="row">

    </div><!-- br-section-wrapper -->

</div>


@include('modal.product_note')
@include('modal.product_preview')

@endsection

@section('custom_js')
<script type="text/javascript">

    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });

    $( document ).ready(function() {        
        $('.date_range').daterangepicker({
            autoUpdateInput: false
        });

        $('.date_range').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        });

        $('.date_range').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    });


    $(document).on('click', '.product_note', function(e){
        e.preventDefault();
        jQuery.noConflict();

        var purchase_id = $(this).attr("data-id");
        var note_1 = $(this).attr("data-note-1");

        $('#product_note_modal').modal('show');

        $('.purchase_id').val(purchase_id);
        $('.note_1').val(note_1);
    });

    $(document).on('click', '.product_preview', function(e){
        e.preventDefault();
        jQuery.noConflict();

        $('#product_preview_modal').modal('show'); 
    });

    $('#sample_1').DataTable({
        "iDisplayLength": 10,
        "aLengthMenu": [
        [10, 25, 50, -1],
        [10, 25, 50, "all"]
        ]
    });

    $(document).on('click', '.edit_role', function(e){            
        e.preventDefault();
        jQuery.noConflict();
        $('#edit_role_modal').modal('show'); 
    });

    $(document).on('click', '.edit_location', function(e){            
        e.preventDefault();
        jQuery.noConflict();
        $('#edit_location_modal').modal('show'); 
    });

    $(document).on('click', '.edit_bank_modal', function(e){
        var bank_id = $(this).attr("data-id");
        var short = $(this).attr("data-short");
        var full = $(this).attr("data-full");
        var opening = $(this).attr("data-opening");
        var remarks = $(this).attr("data-remarks");
        var status = $(this).attr("data-status");

        $('#edit_bank_modal').modal('show');
        $('.bank_id').val(bank_id);
        $('.short').val(short);
        $('.full').val(full);
        $('.opening').val(opening);
        $('.remarks').val(remarks);
        $('.status[value='+status+']').prop("checked",true);
    });

</script>
@endsection