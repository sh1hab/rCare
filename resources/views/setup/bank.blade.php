@extends('layout.app')
@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href=" {{URL::to('/dashboard')}} "> Dashboard </a>
        <a class="breadcrumb-item" href=""> Setup </a>
        <span class="breadcrumb-item active"> Add Bank </span>
    </nav>
</div>
<div class="br-pagebody">

    <div class="row">
        <div class="col-md-5">

            <form class="form-horizontal" action="{{ URL::to('setup/add_bank') }}" id="" role="form" method="post" data-parsley-validate>
                @csrf

                <div class="br-section-wrapper">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10"> Add Bank </h6>
                    <div class="form-layout form-layout-1">

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-control-label"> Bank Short Name: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="short_name" placeholder="Enter Bank Short Name" required="">
                                </div>
                            </div><!-- col-4 -->
                        </div><!-- row -->

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-control-label"> Bank Full Name: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="full_name" placeholder="Enter Bank Full Name" required="">
                                </div>
                            </div><!-- col-4 -->
                        </div><!-- row -->

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-control-label"> Opening Balance: </label>
                                    <div class="input-group">
                                        <span class="input-group-addon tx-size-sm lh-2">৳</span>
                                        <input type="number" class="form-control" name="opening_balance">
                                        <span class="input-group-addon tx-size-sm lh-2">.00</span>
                                    </div>
                                </div>
                            </div><!-- col-4 -->
                        </div><!-- row -->

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-control-label"> Remarks: </label>
                                    <textarea rows="3" class="form-control" name="remarks" placeholder="Remarks"></textarea>
                                </div>
                            </div><!-- col-4 -->
                        </div><!-- row -->

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-control-label"> Status: <span class="tx-danger">*</span></label>
                                    <div class="row mg-t-10">
                                        <div class="col-lg-4">
                                            <label class="rdiobox">
                                                <input name="status" value="1" type="radio" checked="">
                                                <span> Active </span>
                                            </label>
                                        </div><!-- col-3 -->
                                        <div class="col-lg-4">
                                            <label class="rdiobox">
                                                <input name="status" value="0" type="radio">
                                                <span> Inactive </span>
                                            </label>
                                        </div><!-- col-3 -->
                                    </div>
                                </div>
                            </div><!-- col-4 -->
                        </div><!-- row -->



                        <div class="form-layout-footer">
                            <button type="submit" class="btn btn-info">Submit</button>
                            <button type="reset" class="btn btn-secondary">Cancel</button>
                        </div><!-- form-layout-footer -->

                    </div>
                </div><!-- form-layout -->
            </form>

        </div>

        <div class="col-md-7">
            <div class="br-section-wrapper" style="overflow-x:auto;">          
                <h6 class="tx-inverse tx-uppercase tx-bold tx-14 mg-b-10"> All Bank List </h6>

                <table class="table table-bordered table-colored table-info">
                    <thead>
                        <tr>
                            <th class="wd-5p"> SL </th>
                            <th class="wd-15p"> Name </th>
                            <th class="wd-30p"> Full Name </th>
                            <th class="wd-20p"> Balance </th>
                            <th class="wd-35p"> Remarks </th>
                            <th class="wd-10p"> Status </th>
                            <th class="wd-20p"> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($data['bank']) > 0)

                        @php
                        $i =1;
                        @endphp

                        @foreach($data['bank'] as $bank)
                        <tr>
                            <td> {{ $i++ }} </td>
                            <td> {{ $bank->short_name }} </td>
                            <td> {{ $bank->full_name }} </td>
                            <td> {{ $bank->opening_balance }} <span>৳</span> </td>
                            <td> {{ $bank->remarks }} </td>
                            <td>
                                @if($bank->status == 1)
                                Active
                                @else
                                Inactive
                                @endif
                            </td>
                            <td>
                                <a href="javascript:void(0);" id="" data-id="{{ $bank->id }}" data-short="{{ $bank->short_name }}" data-full="{{ $bank->full_name }}" data-opening="{{ $bank->opening_balance }}" data-status="{{ $bank->status }}" data-remarks="{{ $bank->remarks }}" class="btn btn-info btn-icon edit_bank_modal">
                                    <div><i class="fa fa-edit" title="Edit"></i></div>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="7" class="text-center">
                                There is no bank created
                            </td>
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


@include('modal.edit_bank')

@endsection

@section('custom_js')
<script type="text/javascript">

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

</script>
@endsection