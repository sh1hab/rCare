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

            <form class="form-horizontal" action="{{ URL::to('setup/add_user') }}" id="" role="form" method="post" data-parsley-validate enctype="multipart/form-data">
                @csrf

                <div class="br-section-wrapper">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10"> Purchase Request </h6>
                    <div class="form-layout form-layout-1">

                        <div class="row">
                           <table class="table mg-b-0" id="purchaseProduct">
                              <thead>
                                <tr>
                                  <th class="wd-20p">Product</th>
                                  <th class="wd-20p">Supplier</th>
                                  <th class="wd-20p">Quantity</th>
                                  <th class="wd-20p">Price</th>
                                  <th class="wd-20p">Note</th>
                                </tr>
                              </thead>

                                @php
                                   $serial_no = 1; $Subtotal = 0; $j = 0; $existsData = 0;
                                @endphp

                              <tbody>
                                <?php $existsData = 1; ?>
                                <tr class="rowcount_{{ $serial_no }}">
                                  <td>
                                    <select class="form-control selectpicker parts_id" data-live-search="true" title="Products" data-placeholder="" tabindex="-1" aria-hidden="true" name="parts_id_1" required="">
                                        @foreach ($data['parts'] as $part)
                                            <option data-tokens="{{$part->full_code}}" data-subtext="{{$part->full_code}}" value="{{ $part->id }}"> {{ $part->parts_name }} </option>
                                        @endforeach
                                    </select> 
                                    </td>
                                  <td>
                                      <select class="form-control selectpicker supplier_id" data-live-search="true" title="Suppliers" data-placeholder="" tabindex="-1" aria-hidden="true" name="location_id_1" required="">
                                        @foreach ($data['suppliers'] as $supplier)
                                            <option data-subtext="{{$supplier->supplier_contact}}" value="{{ $supplier->id }}"> {{ $supplier->supplier_name }} </option>
                                        @endforeach
                                    </select> 
                                  </td>
                                  <td>
                                    <input class="form-control quantity" type="text" name="quantity_1" placeholder="Product Quantity" required="">
                                  </td>
                                  <td>
                                    <input class="form-control price" type="text" name="price_1" placeholder="Product Price" required="">
                                  </td>
                                  <td>
                                     {{--  <input class="form-control note" type="text" name="note_1" placeholder="Product Note" required=""> --}}
                                     <select class="js-example-basic-single" name="state">
                                          <option value="AL">Alabama</option>
                                            ...
                                          <option value="WY">Wyoming</option>
                                        </select>
                                  </td>

                                  <?php $j++; $serial_no++; ?>

                                </tr>
                                
                              </tbody>
                            </table>
                        </div>

                        <br>

                            <input type="hidden" name="productsrowcount" id="productsrowcount" value="{{ $j }}"> 
                            <a href="javascript:;" class="btn btn-sm btn-success" id="add_more_product"> <i class="fa fa-plus-square"></i> Add another </a>

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

            console.log(CurrRowCount);

            var anotherRow = "<tr class='rowcount_"+CurrRowCount+"'>"+
                            "<td>"+getParts(CurrRowCount)+"</td>"+
                            "<td>"+getSupplier(CurrRowCount)+"</td>"+
                            "<td><input type='text' name='wide_"+CurrRowCount+"' class='wide form-control'></td>"+
                            "<td><input type='text' name='qty_"+CurrRowCount+"' class='qty form-control'></td>"+
                            "<td><input type='text' name='price_"+CurrRowCount+"' class='price form-control'></td>"+
                            "<td><button type='button' class='btn btn-xs btn-danger deletePurchaseProduct' data-serailNo='"+CurrRowCount+"'>X</button></td>"+
                         "</tr>";

            $('#purchaseProduct tbody').append(anotherRow);
            $('#productsrowcount').val(CurrRowCount);

            console.log(anotherRow);
        });

        function getParts(count){
            var salesdropdownhtml = '<select name="parts_id_'+count+'" class="dropdown bootstrap-select form-control parts_id" required>'
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
            var PurchaseProducthtml = '<div class="dropdown bootstrap-select form-control"> <select name="supplier_id_'+count+'" class="form-control selectpicker supplier_id" required>'
                            +'<option value=""> ---- Select --- </option>';
                            
            <?php 
                foreach ($data['suppliers'] as $supplier) {
                    echo 'PurchaseProducthtml += \'<option value="'.$supplier->id.'">'.$supplier->supplier_name.'</option>\'; ';
                }
            ?>

            PurchaseProducthtml += '</select></div>';
            return PurchaseProducthtml;
        }


        $('#purchaseProduct tbody').on("click", '.deletePurchaseProduct', function(){
            if($('#purchaseProduct tbody tr').length == 1){
                if(confirm('Are you sure to delete the last item?')){
                    $(this).parent('td').parent('tr').remove();
                };
            }else{
                $(this).parent('td').parent('tr').remove();
            }

            $('#purchaseProduct tbody tr').each(function(key, value){
                $(value).attr('class', 'rowcount_'+(key+1))
                $(value).children('td').children('.parts_id').attr('name', 'parts_id_'+(key+1));
                $(value).children('td').children('.supplier_id').attr('name', 'supplier_id_'+(key+1));
                $(value).children('td').children('.quantity').attr('name', 'quantity_'+(key+1));
                $(value).children('td').children('.price').attr('name', 'price_'+(key+1));
                $(value).children('td').children('.note').attr('name', 'note_'+(key+1));
            $('#productsrowcount').val($('#purchaseProduct tbody tr').length);
            });

        });

</script>
@endsection