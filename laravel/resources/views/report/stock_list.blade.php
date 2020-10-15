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
                            <th class="wd-10p"> Parts </th>
                            <th class="wd-5p"> Sales Price </th>
                            <th class="wd-5p"> Warranty </th>
                            <th class="wd-5p"> Stock Level </th>
                            <th class="wd-5p"> Stock Value </th>
                            <th class="wd-5p"> Quantity </th>
                            @php
                                $location_ids = array();
                            @endphp
                            @foreach ($data['locations'] as $location)
                               <th class="wd-5p"> {{ $location->location_short_name }} </th>
                               @php
                                   $location_ids[] = $location->id;
                               @endphp
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($data['location_data']) > 0)
                            @foreach($data['location_data'] as $stock)                                    
                                <tr>
                                    <td> {{ $stock['category'] }} </td>
                                    <td> {{ $stock['brand'] }} </td>
                                    <td> {{ $stock['full_code'] }} </td>
                                    <td> {{ $stock['parts_name'] }} </td>
                                    <td> {{ $stock['sales_price'] }} </td>
                                    <td> {{ $stock['warranty_period'] }} </td>
                                    <td> {{ $stock['stock_level'] }} </td>
                                    <td> {{ $stock['stock_value'] }} </td>
                                    <td> {{ $stock['quantity'] }} </td>

                                    @foreach ($data['locations'] as $location)
                                        <?php 
                                            if(in_array($location['id'], $stock['location_ids'])) { 
                                        ?>
                                             <td> {{ $stock['location_ids'][$location['id']] }} </td>
                                        <?php
                                            }else{
                                        ?>
                                            <td> 0 </td>
                                        <?php
                                            }
                                        ?>
                                      
                                    @endforeach

                                </tr> 
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