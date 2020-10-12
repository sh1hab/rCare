@extends('layout.app')
@section('custom_css')

<style type="text/css">
    .data-table{
        width: 100% !important;
    }
    div.dt-buttons {
        margin-left: 20px;
    }
    td.details-control {
        background: url('../resources/details_open.png') no-repeat center center;
        cursor: pointer;
    }
    tr.shown td.details-control {
        background: url('../resources/details_close.png') no-repeat center center;
    }
</style>

@endsection

@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href=" {{URL::to('/dashboard')}} "> Dashboard </a>
        <a class="breadcrumb-item" href=""> Purchase </a>
        <span class="breadcrumb-item active"> Approved List </span>
    </nav>
</div>
<div class="br-pagebody">
    <div class="row">        
        <div class="col-md-12">
            <div class="br-section-wrapper" style="overflow-x:auto;">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="tx-inverse tx-uppercase tx-bold tx-14 mg-b-10"> All Approved </h6>
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>
                <div class="row">
                    {{-- <div class="col-md-12">
                        <label>Column Filter:</label>
                        <select id="myCol">
                          <option value="0">All</option>
                          <option value="1">Diff1</option>
                          <option value="2">Diff2</option>
                          <option value="3">Diff3</option>
                        </select> 
                    </div> --}}
                    <div class="col-md-12">                       

                        <table class="table table-striped table-info no-footer data-table">
                            <thead>
                                <tr>
                                    {{-- <th>  </th> --}}
                                    <th> SL </th>
                                    <th> Parts </th>
                                    <th> Supplier </th>
                                    <th> Quantity </th>
                                    <th> Unit Price </th>
                                    <th> Total Price </th>
                                    <th> Note</th>
                                    <th> Request By </th>
                                    {{-- <th> Action </th>  --}}
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

    $(function () {

        var table = $('.data-table').DataTable({
            buttons: [
                'csv', 'excel', 'pdf', 'print'
              ],
            "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
            dom: 'lBfrtip',
            processing: true,
            serverSide: true,
            //"scrollY": "200px",
            "paging": true,
            search: {
                caseInsensitive: false,
              },             
            ajax: "{{ route('approve-data') }}",
            columns: [
                //  {
                //     "className": 'details-control',
                //     "orderable": false,
                //     "data":      null,
                //     "defaultContent": ''
                // },
                {data: 'no', name: 'SL'},
                {data: 'parts_name', name: 'Parts', bSortable:false},
                {data: 'supplier_name', name: 'Supplier', bSearchable:true, bSortable:true},
                {data: 'quantity', name: 'Quantity'},
                {data: 'unit_price', name: 'Unit Price'},
                {data: 'total_price', name: 'Total Price'},
                {data: 'Note', name: 'Note'},
                {data: 'username', name: 'Request By', bSearchable:false, bSortable:false},
                //{data: 'action', name: 'action', bSearchable:false, bSortable:false},
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







            /* Formatting function for row details - modify as you need */
            // function format ( d ) {
            //     // `d` is the original data object for the row
            //     return '<table cellpadding="10" cellspacing="0" border="0" style="">'+
            //         '<tr>'+
            //             '<td>Full name:</td>'+
            //             '<td>'+d.name+'</td>'+
            //         '</tr>'+
            //         '<tr>'+
            //             '<td>Extension number:</td>'+
            //             '<td>'+d.extn+'</td>'+
            //         '</tr>'+
            //         '<tr>'+
            //             '<td>Extra info:</td>'+
            //             '<td>And any further details here (images etc)...</td>'+
            //         '</tr>'+
            //     '</table>';
            // }
             
            // $(document).ready(function() {
                // var table = $('#example').DataTable( {
                //     "ajax": "../ajax/data/objects.txt",
                //     "columns": [
                //         {
                //             "className":      'details-control',
                //             "orderable":      false,
                //             "data":           null,
                //             "defaultContent": ''
                //         },
                //         { "data": "name" },
                //         { "data": "position" },
                //         { "data": "office" },
                //         { "data": "salary" }
                //     ],
                //     "order": [[1, 'asc']]
                // } );
                 
                // Add event listener for opening and closing details
                // $('.data-table tbody').on('click', 'td.details-control', function () {
                //     var tr = $(this).closest('tr');
                //     var row = table.row( tr );
             
                //     if ( row.child.isShown() ) {
                //         // This row is already open - close it
                //         row.child.hide();
                //         tr.removeClass('shown');
                //     }
                //     else {
                //         // Open this row
                //         row.child( format(row.data()) ).show();
                //         tr.addClass('shown');
                //     }
                // } );
            // } );








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