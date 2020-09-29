@extends('layout.app')
@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href=" {{URL::to('/dashboard')}} "> Dashboard </a>
        <a class="breadcrumb-item" href=""> Purchase </a>
        <span class="breadcrumb-item active"> Request </span>
    </nav>
</div>
<div class="br-pagebody">

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">

            <form class="form-horizontal" action="{{ URL::to('purchase/post_request') }}" id="" role="form" method="post" data-parsley-validate enctype="multipart/form-data">
                @csrf

                <div class="br-section-wrapper">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10"> Purchase Request </h6>
                    <div class="form-layout form-layout-1">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label"> Supplier: <span class="tx-danger">*</span></label>
                                    <select class="form-control selectpicker" data-live-search="true" title="Select Supplier Name" data-placeholder="-------- Select Bank ---------" tabindex="-1" aria-hidden="true" name="supplier_id" required="">
                                        @foreach ($data['suppliers'] as $supplier)
                                            <option value="{{ $supplier->id }}"> {{ $supplier->supplier_name }} </option>
                                        @endforeach
                                    </select> 
                                </div>
                            </div>

                            <div class="col-md-offset-1 col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label"> Location: <span class="tx-danger">*</span></label>
                                    <select class="form-control selectpicker" data-live-search="true" title="Select Location Name" data-placeholder="" tabindex="-1" aria-hidden="true" name="location_id" required="">
                                        @foreach ($data['locations'] as $location)
                                            <option value="{{ $location->id }}"> {{ $location->location_name }} </option>
                                        @endforeach
                                    </select> 
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <table class="table mg-b-0" id="purchaseProduct">
                                <thead>
                                    <tr>
                                        <th class="wd-20p">Product</th>
                                        <th class="wd-20p">Quantity</th>
                                        <th class="wd-20p">Unit Price</th>
                                        <th class="wd-20p">Note</th>
                                        <th class="wd-5p"></th>
                                    </tr>
                                </thead>

                                @php
                                $serial_no = 1; $Subtotal = 0; $j = 0; $existsData = 0;
                                @endphp

                                <tbody>
                                    <?php $existsData = 1; ?>
                                    <tr class="rowcount_{{ $serial_no }}">
                                        <td>
                                            <select class="form-control js-example-basic-single parts_id" placeholder="Select Parts"  name="parts_id_1" required="">
                                                <option value="0">Select Any Parts</option>
                                                @foreach ($data['parts'] as $part)
                                                <option data-tokens="{{$part->full_code}}" data-subtext="{{$part->full_code}}" value="{{ $part->id }}"> {{ $part->parts_name }} </option>
                                                @endforeach
                                            </select> 
                                        </td>
                                        {{-- <td>
                                            <select class="form-control js-example-basic-single supplier_id" name="supplier_id_1" required="">
                                                <option value="0">Select Any Supplier</option>
                                                @foreach ($data['suppliers'] as $supplier)
                                                <option data-subtext="{{$supplier->supplier_contact}}" value="{{ $supplier->id }}"> {{ $supplier->supplier_name }} </option>
                                                @endforeach
                                            </select> 
                                        </td> --}}
                                        <td>
                                            <input class="form-control quantity" type="text" name="quantity_1" placeholder="Product Quantity" required="">
                                        </td>
                                        <td>
                                            <input class="form-control price" type="text" name="price_1" placeholder="Product Price" required="">
                                        </td>
                                        <td>
                                            <input class="form-control note" type="text" name="note_1" placeholder="Product Note" required="">
                                        </td>
                                        <td>                                            
                                            <input type="hidden" class="qty_1" name="qty_1" value="">
                                            <input type="hidden" class="price_1" name="price_1" value="">
                                            <input type="hidden" class="subtotal total_1" name="total_1" value="">
                                        </td>

                                        <?php $j++; $serial_no++; ?>

                                    </tr>

                                </tbody>
                            </table>
                        </div>

                        <div class="row">
                            <table class="table mg-b-0">
                                <thead>
                                    <tr>
                                        <th class="wd-20p"></th>
                                        <th class="wd-20p"></th>
                                        <th class="wd-20p"></th>
                                        <th class="wd-20p"></th>
                                        <th class="wd-5p"></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr >
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <input class="form-control discount" type="text" name="discount" placeholder="Discount" value="" required="">
                                        </td>
                                        <td>
                                            <input class="form-control grandTotal" type="text" name="total" placeholder="Grand Total" required="" value="">
                                        </td>
                                        <td>

                                        </td>

                                    </tr>

                                </tbody>
                            </table>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-layout-footer">
                                    <button type="submit" class="btn btn-info">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Cancel</button>
                                </div>
                            </div>
                            <div class="col-md-6 text-right">
                                <input type="hidden" name="productsrowcount" id="productsrowcount" value="{{ $j }}"> 
                                <a href="javascript:;" class="btn btn-sm btn-success" id="add_more_product"> <i class="fa fa-plus-square"></i> Add another </a>
                            </div>
                        </div>




                    </div>
                </div><!-- form-layout -->
            </form>

        </div>
        <div class="col-md-1"></div>
    </div>
</div>

<br>


@endsection

@section('custom_js')
<script type="text/javascript">

    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });

    $('#add_more_product').on('click', function(e){
        var CurrRowCount = $('#purchaseProduct tbody tr').length+1;

        var anotherRow = "<tr class='rowcount_"+CurrRowCount+"'>"+
        "<td>"+getParts(CurrRowCount)+"</td>"+
        // "<td>"+getSupplier(CurrRowCount)+"</td>"+
        "<td><input type='text' placeholder='Product Quantity' name='quantity_"+CurrRowCount+"' class='quantity form-control'></td>"+
        "<td><input type='text' placeholder='Product Price' name='price_"+CurrRowCount+"' class='price form-control'></td>"+
        "<td><input type='text' placeholder='Product Note' name='note_"+CurrRowCount+"' class='note form-control'></td>"+
        "<td>"+
        "<input type='hidden' class='qty_"+CurrRowCount+"' name='qty_"+CurrRowCount+"' value=''>"+
        "<input type='hidden' class='price_"+CurrRowCount+"' name='price_"+CurrRowCount+"' value=''>"+
        "<input type='hidden' class='subtotal total_"+CurrRowCount+"' name='total_"+CurrRowCount+"' value=''>"+
        "<button type='button' class='btn btn-xs btn-danger deletePurchaseProduct' data-serailNo='"+CurrRowCount+"'>X</button>"+
        "</td>"+
        "</tr>";

        $('#purchaseProduct tbody').append(anotherRow);
        $('#productsrowcount').val(CurrRowCount);

    });

    function getParts(count){
        var salesdropdownhtml = '<select name="parts_id_'+count+'" class="form-control js-example-basic-single" required>'
        +'<option value=""> ---- Select --- </option>';
        <?php 
        foreach ($data['parts'] as $part) {
            echo 'salesdropdownhtml += \'<option value="'.$part->id.'">'.$part->parts_name.'</option>\'; ';
        }
        ?>

        salesdropdownhtml += '</select>';
        return salesdropdownhtml;
    }

    function getSupplier(count){
        var PurchaseProducthtml = '<select name="supplier_id_'+count+'" class="form-control select select2 js-example-basic-single" required>'
        +'<option value=""> ---- Select --- </option>';

        <?php 
        foreach ($data['suppliers'] as $supplier) {
            echo 'PurchaseProducthtml += \'<option value="'.$supplier->id.'">'.$supplier->supplier_name.'</option>\'; ';
        }
        ?>

        PurchaseProducthtml += '</select>';
        return PurchaseProducthtml;
    }


    $('#purchaseProduct tbody').on("click", '.deletePurchaseProduct', function(){
        if($('#purchaseProduct tbody tr').length == 1){
            if(confirm('Are you sure to delete the last item?')){
                $(this).parent('td').parent('tr').remove();
            };
        }else{

            var serial_no = $(this).attr('data-serailNo');
            var deletedTotal = $('.total_'+serial_no).val();
            var grandTotal = $('.grandTotal').val();
            var sum = grandTotal - deletedTotal;
            $('.grandTotal').val(sum);

            $(this).parent('td').parent('tr').remove();
        }

        $('#purchaseProduct tbody tr').each(function(key, value){
            $(value).attr('class', 'rowcount_'+(key+1))
            $(value).children('td').children('.parts_id').attr('name', 'parts_id_'+(key+1));
            // $(value).children('td').children('.supplier_id').attr('name', 'supplier_id_'+(key+1));
            $(value).children('td').children('.quantity').attr('name', 'quantity_'+(key+1));
            $(value).children('td').children('.price').attr('name', 'price_'+(key+1));
            $(value).children('td').children('.note').attr('name', 'note_'+(key+1));
            $('#productsrowcount').val($('#purchaseProduct tbody tr').length);
        });

    });

    

    $(document).on('keyup', '.quantity', function(e){
        var ids = $(this).attr("name").split('_');
        var qty = $(this).val();
        var field_no = ids[1];

        var price = parseFloat($('input[name=price_'+field_no+']').val());

        if(!isNaN(price)) {
            var amount = qty*price;
        }
        else {
            var amount = qty*0;
        }        

        $('input[name=total_'+field_no+']').val(amount);
        calculateAmount();
    });

    $(document).on('keyup', '.price', function(e){
        var ids = $(this).attr("name").split('_');
        var price = $(this).val();
        var field_no = ids[1];

        var qty = parseFloat($('input[name=quantity_'+field_no+']').val());

        if(!isNaN(qty)) {
            var amount = qty*price;
        }
        else {
            var amount = qty*0;
        }


        $('input[name=total_'+field_no+']').val(amount);
        calculateAmount();
    });

    $(document).on('keyup', '.discount', function(e){
        calculateAmount();
    });

    function calculateAmount(){
        if($(".grandTotal").val()=='' || $(".grandTotal").val() == 'NaN') 
            $(".grandTotal").val('0');

        var sum = 0;
        var discount = 0;

        $(".subtotal").each(function() {
            if($(this).val()=='') $(this).val('0');
                sum += parseInt($(this).val(), 10);
        });

        var discount = parseFloat($('.discount').val());

        if($(".discount").val()=='') 
            $(".discount").val('0');

        sum -=  parseInt($(".discount").val(), 10);

        $('.grandTotal').val(sum);

    }

</script>
@endsection