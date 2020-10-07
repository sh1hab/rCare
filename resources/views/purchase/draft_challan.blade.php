@extends('layout.app')

@section('custom_css')
<style type="text/css">
    .btn, .sp-container button {
        padding: 5px 8px;
    }
    .btn, .sp-container button {
        padding: 0px 5px;
    }
    .select2-container {
        width: 100% !important;
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
        <div class="col-md-12">
            <div class="br-section-wrapper" style="overflow-x:auto;">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="tx-inverse tx-uppercase tx-bold tx-14 mg-b-10"> All Purchase Request List </h6>
                    </div>
                    <div class="col-md-6" id="table_filtering">
                        
                    </div>
                </div>
                

                <table class="table table-striped table-info" id="sample_1"><!-- table2 -->
                    {{-- <tfoot>
                        <tr>                           
                        </tr>
                    </tfoot> --}}
                    <thead>
                        <tr>
                            <th class="wd-5p"> SL </th>
                            <th class="wd-10p"> Parts </th>
                            <th class="wd-10p"> Supplier </th>
                            <th class="wd-5p"> Quantity </th>
                            <th class="wd-5p"> Unit Price </th>
                            <th class="wd-10p"> Total Price </th>
                            <th class="wd-5p"> Note</th>
                            <th class="wd-5p"> Request By </th>
                            <th class="wd-5p"> Serial </th>
                            <th class="wd-5p"> Challan </th>
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
                            <td>
                                <input type="text" name="">
                            </td>
                            <td>
                                <input type="text" name="">
                            </td>
                            <td align="center">
                                <a href="javascript:;" class="btn-sm btn btn-success">Pick</a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="11" class="text-center"> There is no user created </td>
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


    @include('modal.edit_role')
    @include('modal.edit_location')
    @include('modal.edit_user')

    @endsection

    @section('custom_js')
    <script type="text/javascript">

        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });

        $('#sample_1').DataTable({
            "iDisplayLength": 10,
            "aLengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "all"]
            ],
            initComplete: function () {
                this.api().columns([2, 7]).every( function () {
                    var column = this;
                    var select = $('<select class="js-example-basic-single filter_select"><option value="">Show all</option></select>')
                        // .appendTo( $(column.header()).empty() )
                        .appendTo( $(column.header()) )
                        // .appendTo( '#table_filtering' )
                        .on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
     
                            column
                                .search( val ? '^'+val+'$' : '', true, false )
                                .draw();
                        } );
     
                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                } );
            }
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

        // $(document).ready(function() {
        //     $('#sample_1').DataTable( {
                
        //     } );
        // } );

    </script>
    @endsection