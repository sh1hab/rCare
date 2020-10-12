@extends('layout.app')
@section('custom_css')

<style type="text/css">    
    .br-pagebody{
        margin-top: 0px;
    }
    .br-section-wrapper {
        padding: 30px;
    }
    .DataTables_sort_icon { display:none;}

    .dataTable > thead > tr > th[class*=sort]:after{
        display:none;
    }

    .sorting, .sorting_asc, .sorting_desc {
        background : none;
    }

    table.dataTable thead .sorting:after
    {
        display: none;
    }
    table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child,table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child{position:relative;padding-left:30px;cursor:pointer}table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child:before,table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child:before{top:8px;right:4px;height:16px;width:16px;display:block;position:absolute;color:white;border:2px solid white;border-radius:1px;text-align:center;line-height:14px;box-shadow:0 0 3px #444;box-sizing:content-box;content:'+';background-color:#31b131}table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child.dataTables_empty:before,table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child.dataTables_empty:before{display:none}table.dataTable.dtr-inline.collapsed>tbody>tr.parent>td:first-child:before,table.dataTable.dtr-inline.collapsed>tbody>tr.parent>th:first-child:before{content:'-';background-color:#d33333}table.dataTable.dtr-inline.collapsed>tbody>tr.child td:before{display:none}table.dataTable.dtr-inline.collapsed.compact>tbody>tr>td:first-child,table.dataTable.dtr-inline.collapsed.compact>tbody>tr>th:first-child{padding-left:27px}table.dataTable.dtr-inline.collapsed.compact>tbody>tr>td:first-child:before,table.dataTable.dtr-inline.collapsed.compact>tbody>tr>th:first-child:before{top:5px;right:4px;height:14px;width:14px;border-radius:1px;line-height:12px}table.dataTable.dtr-column>tbody>tr>td.control,table.dataTable.dtr-column>tbody>tr>th.control{position:relative;cursor:pointer}table.dataTable.dtr-column>tbody>tr>td.control:before,table.dataTable.dtr-column>tbody>tr>th.control:before{top:50%;left:50%;height:16px;width:16px;margin-top:-10px;margin-left:-10px;display:block;position:absolute;color:white;border:2px solid white;border-radius:1px;text-align:center;line-height:14px;box-shadow:0 0 3px #444;box-sizing:content-box;content:'+';background-color:#31b131}table.dataTable.dtr-column>tbody>tr.parent td.control:before,table.dataTable.dtr-column>tbody>tr.parent th.control:before{content:'-';background-color:#d33333}table.dataTable>tbody>tr.child{padding:0.5em 1em}table.dataTable>tbody>tr.child:hover{background:transparent !important}table.dataTable>tbody>tr.child ul{display:inline-block;list-style-type:none;margin:0;padding:0}table.dataTable>tbody>tr.child ul li{border-bottom:1px solid #efefef;padding:0.5em 0}table.dataTable>tbody>tr.child ul li:first-child{padding-top:0}table.dataTable>tbody>tr.child ul li:last-child{border-bottom:none}table.dataTable>tbody>tr.child span.dtr-title{display:inline-block;min-width:75px;font-weight:bold}

</style>
@endsection
@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href=" {{URL::to('/dashboard')}} "> Dashboard </a>
        <a class="breadcrumb-item" href=""> Setup </a>
        <span class="breadcrumb-item active"> Add Parts/Accessories </span>
    </nav>
</div>
<div class="br-pagebody">

    

    <div class="row">
        <div class="col-md-12">
            <div class="br-section-wrapper" style="overflow-x:auto;">
                <div class="row">
                    <div class="col-md-4">
                        <h6 class="tx-inverse tx-uppercase tx-bold tx-14 mg-b-10"> All Parts/Accessories List </h6>
                    </div>
                    <div class="col-md-4 text-center">
                        <button type="btn" class="btn btn-primary add_new_parts"><i class="fa fa-plus"> </i> Add New Parts</button>
                    </div>
                    <div class="col-md-4">
                        
                    </div>
                </div>                

                <table class="table table-striped table-info display responsive nowrap" id="sample_1" width="100%" cellspacing="0"><!-- table2 -->
                    <thead>
                        <tr>
                            <th class="wd-3p"> No </th>
                            <th class="wd-10p"> Category </th>
                            <th class="wd-10p"> Compatible Brand </th>
                            <th class="wd-10p"> Code </th>
                            <th class="wd-20p"> Parts </th>                        
                            <th class="wd-20p"> Warranty </th>                        
                            <th class="wd-15p"> Details </th>
                            <th class="wd-10p"> Purchase Price </th>
                            <th class="wd-10p"> Margin </th>
                            <th class="wd-10p"> Sale Price </th>
                            <th class="wd-5p"> Status </th>
                            <th class="wd-5p"> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($data['parts']) > 0)

                            @php
                                $i =1;
                            @endphp

                            @foreach($data['parts'] as $part)
                                <tr>
                                    <td> {{ $i++ }} </td>
                                    <td> {{ $part->category->category_name }} </td>
                                    <td> {{ $part->brand->brand_name }} </td>
                                    <td> {{ $part->full_code }} </td>
                                    <td> {{ $part->parts_name }} </td>
                                    <td> {{ $part->warranty->warranty_period }} </td>
                                    <td> {{ $part->details }} </td>
                                    <td> {{ $part->avg_price }} </td>
                                    <td> {{ $part->margin }} </td>
                                    <td> {{ $part->sales_price }} </td>
                                    <td>
                                        @if($part->status == 1)
                                            Active
                                        @else
                                            Inactive
                                        @endif
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" id="" data-id="{{ $part->id }}" data-category="{{ $part->category_id }}" data-brand="{{ $part->compatible_brand_id }}" data-name="{{ $part->parts_name }}" data-avg-price="{{ $part->avg_price }}" data-margin="{{ $part->margin }}" data-margin="{{ $part->margin }}" data-sale-price="{{ $part->sales_price }}" data-stock-level="{{ $part->stock_level }}" data-warranty="{{ $part->warranty_id }}" data-details="{{ $part->details }}" data-status="{{ $part->status }}" class="btn btn-info btn-icon edit_parts_modal">
                                            <div><i class="fa fa-edit" title="Edit"></i></div>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else                            
                            <tr>
                                <td colspan="12" class="text-center"> There is no parts created </td>
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
                                <td style="display: none"></td>
                            </tr>
                        @endif
                    </tbody>
                </table>

            </div>
        </div>
    </div><!-- br-section-wrapper -->
    <br>

</div>


@include('modal.edit_parts')

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

    $('.parts_name').keyup(function() {
        var parts_name = this.value;

        if(parts_name){
            var url_op = base_url+"/setup/check_parts_name";
            $.ajax({
                type: "POST",
                url: url_op,
                dataType: 'json',
                data: {code:code, _token:csrf_token},
                success : function(data){
                    if(data.status){
                        $(".parts_submit").attr("disabled", true);
                        $(".code_error").removeAttr('hidden');
                    }else{
                        $(".parts_submit").attr("disabled", false);
                        $(".code_error").attr("hidden",true);
                    }
                }
            });
        }
    });

    $(document).on('click', '.add_new_parts', function(e){
        e.preventDefault();
        jQuery.noConflict();
        $('#edit_parts_modal').modal('show');
    });


    $(document).on('click', '.edit_parts_modal', function(e){
        e.preventDefault();
        jQuery.noConflict();
        var parts_id = $(this).attr("data-id");
        var category_id = $(this).attr("data-category");
        var brand_id = $(this).attr("data-brand");
        var parts_name = $(this).attr("data-name");
        var avg_price = $(this).attr("data-avg-price");
        var margin = $(this).attr("data-margin");
        var sales_price = $(this).attr("data-sale-price");
        var stock_level = $(this).attr("data-stock-level");
        var warranty_id = $(this).attr("data-warranty");
        var details = $(this).attr("data-details");
        var status = $(this).attr("data-status");

        $('#edit_parts_modal').modal('show');      
        $('.parts_id').val(parts_id);
        $('.parts_name').val(parts_name);
        $('.avg_price').val(avg_price);
        $('.margin').val(margin);
        $('.sales_price').val(sales_price);
        $('.stock_level').val(stock_level);
        $('.details').val(details);
        $('.status[value='+status+']').prop("checked",true);

        $('.category_id').selectpicker('val', category_id);
        $('.brand_id').selectpicker('val', brand_id);
        $('.warranty_id').selectpicker('val', warranty_id);
    });

</script>
@endsection