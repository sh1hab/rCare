@extends('layout.app')
@section('custom_css')

<style type="text/css">
    .data-table{
        width: 100% !important;
    }
    div.dt-buttons {
        margin-left: 20px;
    }
    .btn, .sp-container button {
        padding: 5px 8px;
    }
    .status_btn{
        padding: 1px 2px;
        font-size: 12px;
    }
</style>

@endsection

@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href=" {{URL::to('/dashboard')}} "> Dashboard </a>
        <a class="breadcrumb-item" href=""> Customer </a>
        <span class="breadcrumb-item active"> Claim List </span>
    </nav>
</div>
<div class="br-pagebody">
    <div class="row">        
        <div class="col-md-12">
            <div class="br-section-wrapper" style="overflow-x:auto;">
                <div class="row">
                    <div class="col-md-6">

                        {{-- <div class="form-group">
                            <label class="form-control-label"> Location: <span class="tx-danger">*</span></label>
                            <select class="form-control selectpicker" data-live-search="true" title="Select Role" data-placeholder="" tabindex="-1" aria-hidden="true" name="location_id" required="">
                                <option value=""> test </option>
                                <option value=""> test </option>
                                <option value=""> test </option>
                                <option value=""> test </option>
                            </select> 
                        </div>

                        <div class="form-group">
                            <label class="form-control-label"> Location: <span class="tx-danger">*</span></label>
                            <select class="form-control selectpicker" data-live-search="true" title="Select Role" data-placeholder="" tabindex="-1" aria-hidden="true" name="location_id" required="">
                                <option value=""> test </option>
                                <option value=""> test </option>
                                <option value=""> test </option>
                                <option value=""> test </option>
                            </select> 
                        </div>

                        <div class="form-group">
                            <label class="form-control-label"> Location: <span class="tx-danger">*</span></label>
                            <select class="form-control selectpicker" data-live-search="true" title="Select Role" data-placeholder="" tabindex="-1" aria-hidden="true" name="location_id" required="">
                                <option value=""> test </option>
                                <option value=""> test </option>
                                <option value=""> test </option>
                                <option value=""> test </option>
                            </select> 
                        </div> --}}

                    </div>
                    <div class="col-md-6">
                        
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-12">                       
                         <h6 class="tx-inverse tx-uppercase tx-bold tx-14 mg-b-10"> All Claimed </h6>
                        <table class="table table-striped table-info no-footer data-table">
                            <thead>
                                <tr>
                                    <th> SL </th>
                                    <th> RCV No </th>
                                    <th> Claim Date </th>
                                    <th> Customer </th>
                                    <th> Approx Days </th>
                                    <th> Engineer </th>
                                    <th> Item </th>
                                    <th> Received By </th>
                                    <th> Remarks</th>
                                    <th> Receive Note </th>
                                    <th> Problem </th>
                                    <th> Status </th>
                                    <th> Action </th> 
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</div>



@endsection

@section('custom_js')
<script type="text/javascript">

    
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });

    $(function () {        

        var table = $('.data-table').DataTable({
            buttons: [
                'csv', 'excel', 'pdf', 'print'
              ],
          "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
            dom: 'lBfrtip',
            processing: true,
            //serverSide: true,
            //"scrollY": "200px",
            // "paging": true,
            // search: {
            //     caseInsensitive: false,
            //   },
            "aoColumnDefs": [
              { 'bSortable': false, 'aTargets': [ 5, 11 ] }
            ],
            initComplete: function () {
                this.api().columns([5, 11]).every( function () {
                    var column = this;
                    var select = $('<select class="js-example-basic-single filter_select"><option value="">Show all</option></select>')
                        .appendTo( $(column.header()) )
                        .on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
     
                            column
                                .search( val ? '^'+val+'$' : '', true, false )
                                .draw();
                        } );
     
                    column.data().unique().sort().each( function ( d, j ) {

                        // if($(d).attr("value") == null){
                        //     var d = d;
                        // }
                        // else{
                        //     var d = $(d).attr("value");
                        // }

                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                } );
            },
            ajax: "{{ route('claim-data') }}",
            columns: [
                {data: 'no', name: 'SL', bSortable:false, bSearchable:false},
                {data: 'rcv_no', name: 'RCV No',  bSearchable:true, bSortable:true},
                {data: 'claim_date', name: 'Claim Date'},
                {data: 'customer_name', name: 'Customer',bSearchable:true, bSortable:false},
                {data: 'approx_date', name: 'Approx Days',bSearchable:true, bSortable:true},
                {data: 'engineer_name', name: 'Engineer', bSearchable:true},
                {data: 'item_name', name: 'Item', bSearchable:true},
                {data: 'username', name: 'Received By'},
                {data: 'claim_remarks', name: 'Remarks'},
                {data: 'product_details', name: 'Receive Note'},
                {data: 'problem_details', name: 'Problem'},
                {data: 'status', name: 'Status'},
                {data: 'action', name: 'Action'},
                ]

                });



            table.on('order.dt search.dt', function () {
                table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            }).draw();

            table.on( 'draw.dt', function () {
            var PageInfo = $('.data-table').DataTable().page.info();
                 table.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                    cell.innerHTML = i + 1 + PageInfo.start;
                } );
            });


            // $(document).on("change","#myCol",function(event){
            //     var selCol = $(this).val();

            //     console.log(selCol);

            //    if(selCol == 1){

            //        table.columns( [1, 2, 3, 4 ] ).visible( true);
            //        table.columns( [5,6,7] ).visible( false);

            //     } else if(selCol == 2){

            //        table.column([1, 5, 6, 7]).visible(true);
            //        table.columns( [2,3,4] ).visible( false);

            //     } else if(selCol == 3){

            //        table.column([1]).visible(true);
            //        table.columns( [2,3,4,5,6,7] ).visible( false);

            //     } else if(selCol == 4){

            //        table.column([1]).visible(true);
            //        table.columns( [2,3,4,5,6,7] ).visible( false);

            //     } else {

            //     console.log(selCol);
            //        table.column([1,2,3,4,5,6,7]).visible(true);

            //     }

            //     table.columns.adjust().draw( true );
            // });

    });

    

</script>
@endsection