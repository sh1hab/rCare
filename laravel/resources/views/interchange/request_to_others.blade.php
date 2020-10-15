@extends('layout.app')

@section('custom_css')
    <style type="text/css">
        .table th{
            text-align: center;
        }
    </style>
@endsection

@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href=" {{URL::to('/dashboard')}} "> Dashboard </a>
        <a class="breadcrumb-item" href=""> Reports </a>
        <span class="breadcrumb-item active"> Request List </span>
    </nav>
</div>
<div class="br-pagebody">

    <div class="row">        
        <div class="col-md-12">
            <div class="br-section-wrapper" style="overflow-x:auto;">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="tx-inverse tx-uppercase tx-bold tx-14 mg-b-10"> All Request To Others </h6>
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>

                <table class="table table-striped table-info text-center" id="sample_1"><!-- table2 -->
                    <thead>
                        <tr>
                            <th width="1%"> SL </th>
                            <th width="5%"> Date </th>
                            <th width="5%"> Req. From </th>
                            <th width="5%"> Req. To </th>
                            <th width="5%"> User </th>
                            <th width="5%"> Code </th>
                            <th width="10%"> Parts/Accessories </th>
                            <th width="5%"> Quantity </th>
                            <th width="8%"> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                         @if(count($data['interchange_details']) > 0)
                            @php
                                $i =1;
                            @endphp
                            @foreach($data['interchange_details'] as $interchange)
                                <tr>
                                    <td> {{ $i++ }} </td>
                                    <td> {{ date('d-m-Y', strtotime($interchange->request_date)) }} </td>
                                    <td> {{ $interchange->from_loc }} </td>
                                    <td> {{ $interchange->to_loc }} </td>
                                    <td> {{ $interchange->request_user }} </td>
                                    <td> {{ $interchange->full_code }} </td>
                                    <td> {{ $interchange->parts_name }} </td>
                                    <td> {{ $interchange->quantity }} </td>
                                    <td class="text-center">
                                        <button class="btn btn-oblong btn-sm btn-warning" disabled=""> Pending </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="1" class="text-center"> There is no reqeust </td>
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