@extends('layout.app')
@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href=" {{URL::to('/dashboard')}} "> Dashboard </a>
        <a class="breadcrumb-item" href=""> Setup </a>
        <span class="breadcrumb-item active"> Add Bank Account </span>
    </nav>
</div>
<div class="br-pagebody">

    <div class="row">
        <div class="col-md-5">

            <form class="form-horizontal" action="{{ URL::to('setup/add_bank_account') }}" id="" role="form" method="post" data-parsley-validate>
                @csrf

                <div class="br-section-wrapper">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10"> Add Bank Account </h6>
                    <div class="form-layout form-layout-1">

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-control-label"> Account Number: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="account_number" placeholder="Enter Account Number" required="">
                                </div>
                            </div><!-- col-4 -->
                        </div><!-- row -->

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-control-label"> Bank: <span class="tx-danger">*</span></label>
                                    <select class="form-control selectpicker" data-live-search="true" title="Select Bank Name" data-placeholder="-------- Select Bank ---------" tabindex="-1" aria-hidden="true" name="bank_id" required="">
                                        @foreach ($data['bank'] as $bank)
                                            <option value="{{ $bank->id }}"> {{ $bank->full_name }} </option>
                                        @endforeach
                                    </select> 
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label></label>
                                    <span class="input-group-btn mg-t-8">
                                        <button class="btn btn-info edit_bank" type="button">
                                            <i class="fa fa-plus"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-control-label"> Branch Name: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="branch_name" placeholder="Enter Branch Name">
                                </div>
                            </div><!-- col-4 -->
                        </div><!-- row -->

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-control-label"> Route Number: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="route_number" placeholder="Enter Route Number">
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
            <div class="br-section-wrapper">          
                <h6 class="tx-inverse tx-uppercase tx-bold tx-14 mg-b-10"> All Bank List </h6>

                <table class="table table-bordered table-colored table-info">
                    <thead>
                        <tr>
                            <th class="wd-5p"> SL </th>
                            <th class="wd-15p"> Account Number </th>
                            <th class="wd-15p"> Bank </th>
                            <th class="wd-15p"> Branch </th>
                            <th class="wd-15p"> Route </th>
                            <th class="wd-15p"> Opening Balance </th>
                            <th class="wd-20p"> Remarks </th>
                            <th class="wd-10p"> Status </th>
                            <th class="wd-10p"> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($data['bank_account']) > 0)

                        @php
                        $i =1;
                        @endphp

                        @foreach($data['bank_account'] as $bank_account)
                        <tr>
                            <td> {{ $i++ }} </td>
                            <td> {{ $bank_account->account_number }} </td>
                            <td> {{ $bank_account->bank->short_name }} </td>
                            <td> {{ $bank_account->branch_name }} </td>
                            <td> {{ $bank_account->route_number }} </td>
                            <td> {{ $bank_account->opening_balance }} <span>৳</span> </td>
                            <td> {{ $bank_account->remarks }} </td>
                            <td>
                                @if($bank_account->status == 1)
                                Active
                                @else
                                Inactive
                                @endif
                            </td>
                            <td>
                                <a href="javascript:void(0);" id="" data-id="{{ $bank_account->id }}" data-acccount-number="{{ $bank_account->account_number }}" data-bank-id="{{ $bank_account->bank_id }}" data-branch="{{ $bank_account->branch_name }}" data-route="{{ $bank_account->route_number }}" data-opening="{{ $bank_account->opening_balance }}" data-status="{{ $bank_account->status }}" data-remarks="{{ $bank_account->remarks }}" class="btn btn-info btn-icon edit_bank_ac_modal">
                                    <div><i class="fa fa-edit" title="Edit"></i></div>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="7" class="text-center">
                                There is no bank account created
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
@include('modal.edit_bank_account')

@endsection

@section('custom_js')
<script type="text/javascript">

    $(document).on('click', '.edit_bank_ac_modal', function(e){
        var bank_account_id = $(this).attr("data-id");
        var ac_number = $(this).attr("data-acccount-number");
        var bank_id = $(this).attr("data-bank-id");
        var branch = $(this).attr("data-branch");
        var route = $(this).attr("data-route");
        var opening = $(this).attr("data-opening");
        var remarks = $(this).attr("data-remarks");
        var status = $(this).attr("data-status");

        $('#edit_bank_ac_modal').modal('show');      
        $('.bank_account_id').val(bank_account_id);
        $('.ac_number').val(ac_number);
        $('.bank_id option[value='+bank_id+']').prop("selected",true);
        $('.branch').val(branch);
        $('.route').val(route);
        $('.opening').val(opening);
        $('.remarks').val(remarks);
        $('.status[value='+status+']').prop("checked",true);
    });

    $(document).on('click', '.edit_bank', function(e){
        $('#edit_bank_modal').modal('show'); 
    });

</script>
@endsection