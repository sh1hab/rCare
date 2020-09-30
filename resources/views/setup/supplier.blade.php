@extends('layout.app')
@section('content')

<div class="br-pageheader pd-y-15 pd-l-20">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href=" {{URL::to('/dashboard')}} "> Dashboard </a>
        <a class="breadcrumb-item" href=""> Setup </a>
        <span class="breadcrumb-item active"> Supplier </span>
    </nav>
</div>

<div class="br-pagebody">

    <div class="row">
        <div class="col-md-4">

            <form class="form-horizontal" action="{{ URL::to('setup/add_supplier') }}" role="form" method="post" data-parsley-validate>
                @csrf
                <div class="br-section-wrapper">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10"> Add Supplier </h6>
                    <div class="form-layout form-layout-1">

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-control-label"> Supplier Name: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="supplier_name" placeholder="Enter Supplier Name" required="">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-control-label"> Supplier Contact: <span class="tx-danger">*</span></label>
                                    <input class="form-control supplier_contact" type="text" name="supplier_contact" placeholder="Enter Supplier Contact Number" required="">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-control-label"> Supplier Address: </label>
                                    <textarea rows="3" class="form-control" name="supplier_address" placeholder="Enter Supplier Address"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-control-label"> Opening Amount: </label>
                                    <input class="form-control opening_amount" type="number" pattern="/^-?\d+\.?\d*$/" name="opening_amount" placeholder="Enter Opening Amount">
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
                                                <input name="status" value="1" type="radio" checked="">
                                                <span> Active </span>
                                            </label>
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="rdiobox">
                                                <input name="status" value="0" type="radio">
                                                <span> Inactive </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="form-layout-footer">
                            <button class="btn btn-info brand_submit">Submit</button>
                            <button class="btn btn-secondary">Cancel</button>
                        </div><!-- form-layout-footer -->

                    </div>
                </div><!-- form-layout -->
            </form>
        </div>

        <div class="col-md-8">
            <div class="br-section-wrapper" style="overflow-x:auto;">          
                <h6 class="tx-inverse tx-uppercase tx-bold tx-14 mg-b-10"> All Supplier List </h6>

                <table class="table table-striped table-info" id="sample_1"><!-- table2 -->
                    <thead>
                        <tr>
                            <th class="wd-5p"> SL </th>
                            <th class="wd-10p"> Name </th>
                            <th class="wd-10p"> Contact </th>
                            <th class="wd-35p"> Address </th>
                            <th class="wd-20p"> Opening Amount </th>
                            <th class="wd-10p"> Status </th>
                            <th class="wd-10p"> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($data['supplier']) > 0)

                        @php
                            $i =1;
                        @endphp

                        @foreach($data['supplier'] as $supplier)
                        <tr>
                            <td> {{ $i++ }} </td>
                            <td> {{ $supplier->supplier_name }} </td>
                            <td> {{ $supplier->supplier_contact }} </td>
                            <td> {{ $supplier->supplier_address }} </td>
                            <td> {{ $supplier->opening_amount }} </td>
                            <td>
                                @if($supplier->status == 1)
                                    Active
                                @else
                                    Inactive
                                @endif
                            </td>
                            <td>
                                <a href="javascript:void(0);" data-id="{{ $supplier->id }}" data-name="{{ $supplier->supplier_name }}" data-contact="{{ $supplier->supplier_contact }}" data-address="{{ $supplier->supplier_address }}" data-opening="{{ $supplier->opening_amount }}" data-status="{{ $supplier->status }}" class="btn btn-info btn-icon edit_supplier">
                                    <div><i class="fa fa-edit" title="Edit"></i></div>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center"> There is no supplier created </td>
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

@include('modal.edit_supplier_modal')

@endsection

@section('custom_js')
<script type="text/javascript">

    $('#sample_1').DataTable({
        "iDisplayLength": 10,
        "aLengthMenu": [
        [10, 25, 50, -1],
        [10, 25, 50, "all"]
        ]
    });
    
    $(document).on('click', '.edit_supplier', function(e){
        e.preventDefault();
        jQuery.noConflict();
        var supplier_id = $(this).attr("data-id");
        var supplier_name = $(this).attr("data-name");
        var supplier_contact = $(this).attr("data-contact");
        var supplier_address = $(this).attr("data-address");
        var opening_amount = $(this).attr("data-opening");
        var status = $(this).attr("data-status");
        
        $('#edit_supplier_modal').modal('show');      
        $('.supplier_id').val(supplier_id);
        $('.supplier_name').val(supplier_name);
        $('.supplier_contact').val(supplier_contact);
        $('.supplier_address').val(supplier_address);
        $('.opening_amount').val(opening_amount);
        $('.brand_status[value='+status+']').prop("checked", true);

    });

</script>
@endsection