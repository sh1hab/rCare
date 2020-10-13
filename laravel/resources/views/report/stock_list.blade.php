@extends('layout.app')
@section('custom_css')
<style type="text/css">

</style>
@endsection
@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href=" {{URL::to('/dashboard')}} "> Dashboard </a>
        <a class="breadcrumb-item" href=""> Reports </a>
        <span class="breadcrumb-item active"> Stock Parts List </span>
    </nav>
</div>
<div class="br-pagebody">

    <div class="row">        
        <div class="col-md-12">
            <div class="br-section-wrapper" style="overflow-x:auto;">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="tx-inverse tx-uppercase tx-bold tx-14 mg-b-10"> All Parts </h6>
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>


                <table class="table table-striped table-info" id="sample_1"><!-- table2 -->
                    <thead>
                        <tr>
                            {{-- <th class="wd-5p"> SL </th> --}}
                            <th class="wd-5p"> Category </th>
                            <th class="wd-5p"> Brand </th>
                            <th class="wd-5p"> Code </th>
                            <th class="wd-5p"> Parts </th>
                            <th class="wd-5p"> Sales Price </th>
                            <th class="wd-5p"> Warranty </th>
                            <th class="wd-5p"> Stock Level </th>
                            <th class="wd-5p"> Stock Value </th>
                            <th class="wd-5p"> Quantity </th>
                            @php
                            $locs = '';
                            $qtys_inner = array();

                            for($i=0; $i<$data['location_count']; $i++){
                                if($locs!='') $locs .= ',';
                                //$locs .= $qtys_inner[$i];
                            @endphp
                               
                                {{-- <td style="cursor: pointer;" onclick=""></td> --}}
                                @php
                            }
                                
                            @endphp

                        </tr>
                    </thead>
                    <tbody>
                        @if(count($data['stock_list']) > 0)
                            @php
                                $i =1;
                                $parts_row_total = 0;
                                $total_qty = $total_stock_value = 0;
                                $parts_ids = array();
                            @endphp

                            @foreach($data['stock_list'] as $stock)

                                @php
                                    // $loc = $stock['location_id'];
                                    // $key = array_search($loc, $data['location_ids']);
                                    // if($key || $key===0) {
                                    //     $qtys_inner[$key] =  $stock->quantity;
                                    // }
                                    
                                    //$total_qty +=  $stock->quantity;

                                    // echo "<pre>";
                                    // print_r($parts_row_total.' -- '.$stock->parts_id);

                                    if(in_array($stock->parts_id, $parts_ids))
                                        $parts_row_total += $stock->quantity;
                                    else
                                        $parts_row_total = 0;

                                    
                                @endphp

                                @if(in_array($stock->parts_id, $parts_ids) == false)                               
                                    
                                <tr>
                                    <td> {{$stock->category_name}} </td>
                                    <td> {{$stock->brand_name}} </td>
                                    <td> {{$stock->full_code}} </td>
                                    <td> {{$stock->parts_name}} --- {{$stock->parts_id}}</td>
                                    <td> {{$stock->sales_price}} </td>
                                    <td> {{$stock->warranty_period}} </td>
                                    <td> {{$stock->stock_level}} </td>
                                    <td> {{$stock->stock_level}} </td>
                                    <td> {{$parts_row_total}} </td>
                                </tr>

                                @php
                                   //$parts_row_total = 0;
                                @endphp

                                    
                                    
                                @endif

                                @php
                                    // if(in_array($stock->parts_id, $parts_ids))
                                    //     $parts_row_total += $stock->quantity;
                                    // else
                                    //      $parts_row_total = 0;

                                    $parts_ids[] = $stock->parts_id; 
                                @endphp

                            @endforeach                            
                        @else
                            <tr>
                                <td colspan="1" class="text-center"> There is no user created </td>
                            </tr>
                        @endif

                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <br>

    <div class="row">

    </div>

</div>

@endsection

@section('custom_js')
<script type="text/javascript">
    $('#sample_1').DataTable({
        "scrollX": true,
        "iDisplayLength": 10,
        "aLengthMenu": [
        [10, 25, 50, -1],
        [10, 25, 50, "all"]
        ]
    });
</script>
@endsection