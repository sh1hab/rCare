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

                <table class="table table-striped table-info" id="sample_1"><!-- table2 -->
                    <thead>
                        <tr>
                            <th class="wd-3p"> No </th>
                            <th class="wd-10p"> Category </th>
                            <th class="wd-10p"> Compatible Brand </th>
                            <th class="wd-10p"> Code </th>
                            <th class="wd-20p"> Parts </th>                        
                            <th class="wd-20p"> Warranty </th>                        
                            <th class="wd-15p"> Details </th>
                            <th class="wd-10p"> Avg. Price </th>
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
                                        <a href="javascript:void(0);" id="" data-id="{{ $part->id }}" data-category="{{ $part->category_id }}" data-brand="{{ $part->compatible_brand_id }}" data-name="{{ $part->parts_name }}" data-avg-price="{{ $part->avg_price }}" data-margin="{{ $part->margin }}" data-margin="{{ $part->margin }}" data-sale-price="{{ $part->sales_price }}" data-warranty="{{ $part->warranty_id }}" data-details="{{ $part->details }}" data-status="{{ $part->status }}" class="btn btn-info btn-icon edit_parts_modal">
                                            <div><i class="fa fa-edit" title="Edit"></i></div>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="11" class="text-center">
                                    There is no parts created
                                </td>
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
        $('#edit_parts_modal').modal('show');
    });


    $(document).on('click', '.edit_parts_modal', function(e){
        var parts_id = $(this).attr("data-id");
        var category_id = $(this).attr("data-category");
        var brand_id = $(this).attr("data-brand");
        var parts_name = $(this).attr("data-name");
        var avg_price = $(this).attr("data-avg-price");
        var margin = $(this).attr("data-margin");
        var sales_price = $(this).attr("data-sale-price");
        var warranty_id = $(this).attr("data-warranty");
        var details = $(this).attr("data-details");
        var status = $(this).attr("data-status");

        $('#edit_parts_modal').modal('show');      
        $('.parts_id').val(parts_id);
        $('.parts_name').val(parts_name);
        $('.avg_price').val(avg_price);
        $('.margin').val(margin);
        $('.sales_price').val(sales_price);
        $('.details').val(details);
        $('.status[value='+status+']').prop("checked",true);

        $('.category_id').selectpicker('val', category_id);
        $('.brand_id').selectpicker('val', brand_id);
        $('.warranty_id').selectpicker('val', warranty_id);
    });

</script>
@endsection