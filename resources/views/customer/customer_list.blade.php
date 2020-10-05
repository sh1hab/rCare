@extends('layout.app')
@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href=" {{URL::to('/dashboard')}} "> Dashboard </a>
        <a class="breadcrumb-item" href=""> Customer </a>
        <span class="breadcrumb-item active"> Customer List </span>
    </nav>
</div>
<div class="br-pagebody">

    <div class="row">        
        <div class="col-md-12">
            <div class="br-section-wrapper" style="overflow-x:auto;">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="tx-inverse tx-uppercase tx-bold tx-14 mg-b-10"> Customer List </h6>
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>


                <table class="table table-striped table-info" id="sample_1"><!-- table2 -->
                    <thead>
                        <tr>
                            <th class="wd-5p"> SL </th>
                            <th class="wd-5p"> Name </th>
                            <th class="wd-5p"> Mobile </th>
                            <th class="wd-5p"> Email </th>
                            <th class="wd-10p"> Address </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($data['customers']) > 0)

                        @php
                            $i =1;
                        @endphp

                        @foreach($data['customers'] as $customer)
                        <tr>
                            <td> {{ $i++ }} </td>
                            <td> {{$customer->customer_name}} </td>
                            <td> {{$customer->customer_mobile}} </td>
                            <td> {{$customer->customer_email}} </td>
                            <td> {{$customer->customer_address}} </td>
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

</script>
@endsection