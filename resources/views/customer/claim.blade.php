@extends('layout.app')
@section('custom_css')

<style type="text/css">
    

</style>

@endsection
@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href=" {{URL::to('/dashboard')}} "> Dashboard </a>
        <a class="breadcrumb-item" href=""> Customer </a>
        <span class="breadcrumb-item active"> Claim </span>
    </nav>
</div>
<div class="br-pagebody">

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">

            <form class="form-horizontal" action="{{ URL::to('customer/add_claim') }}" id="" role="form" method="post" data-parsley-validate enctype="multipart/form-data">
                @csrf

                <div class="br-section-wrapper">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10"> Add Claim </h6>
                    <div class="form-layout form-layout-1">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> Location: <span class="tx-danger">*</span></label>
                                    <select class="form-control selectpicker" data-live-search="true" title="Select Role" data-placeholder="" tabindex="-1" aria-hidden="true" name="location_id" required="">
                                        @foreach ($data['location'] as $location)
                                        <option value="{{ $location->id }}"> {{ $location->location_name }} </option>
                                        @endforeach
                                    </select> 
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label"></label>
                                    <label class="ckbox mg-t-40">
                                        <input type="checkbox" checked="" value="1">
                                        <span>RCOM Product</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> Service Type: <span class="tx-danger">*</span></label>
                                    <select class="form-control selectpicker" data-live-search="true" title="Select Service Type" data-placeholder="" tabindex="-1" aria-hidden="true" name="service_type_id" required="">
                                        @foreach ($data['services'] as $service)
                                        <option value="{{ $service->id }}"> {{ $service->service_name }} </option>
                                        @endforeach
                                    </select> 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> Process Type: <span class="tx-danger">*</span></label>
                                    <div class="row mg-t-10">
                                        <div class="col-lg-4">
                                            <label class="rdiobox">
                                                <input name="process_type" value="1" type="radio" checked="">
                                                <span> Regular </span>
                                            </label>
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="rdiobox">
                                                <input name="process_type" value="0" type="radio">
                                                <span> Fast </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> Invoice Number##: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="invoice_no" placeholder="Enter RCOM Invoice Number" required="">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> Invoice Date: <span class="tx-danger">*</span></label>
                                    <div class="input-group">
                                          <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                                          <input type="text" class="form-control fc-datepicker" placeholder="MM/DD/YYYY" name="invoice_date" autocomplete="off">
                                        </div>
                                </div>
                            </div>

                            <div class="col-md-12 mg-b-15">
                                <h6 class="text-center">Customer Info</h6>
                                <div class="form-layout form-layout-1 pd-10">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label"> Name: <span class="tx-danger">*</span></label>
                                                <input class="form-control" type="text" name="customer_name" placeholder="Customer Name" required="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label"> Mobile: <span class="tx-danger">*</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="customer_info tx-danger" hidden></span></label>
                                                <input class="form-control customer_mobile" type="text" name="customer_mobile" pattern="[0][0-9]{10}" onKeyPress="if(this.value.length == 11) return false;" placeholder="Customer Mobile Ex. (017xxxxxxxx) " required="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label"> Email: <span class="tx-danger">*</span></label>
                                                <input class="form-control" type="email" name="customer_email" placeholder="Customer Email Address">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label"> Address: <span class="tx-danger">*</span></label>
                                                <textarea rows="3" class="form-control" name="customer_address" placeholder="Customer Full Address"></textarea>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> Enginner: <span class="tx-danger">*</span></label>
                                    <select class="form-control selectpicker" data-live-search="true" title="Select Enginner" data-placeholder="" tabindex="-1" aria-hidden="true" name="engineer_id" required="">
                                        @foreach ($data['users'] as $user)
                                            <option value="{{ $user->id }}"> {{ $user->name }} </option>
                                        @endforeach
                                    </select> 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> Product (Old): <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="product_old" placeholder="Product Old Name" required="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> Serial (Old): <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="serial_old" placeholder="Enter Old Serial Number" required="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> Product Details: <span class="tx-danger">*</span></label>
                                    <textarea rows="3" class="form-control" name="product_details" placeholder="Write Product Details"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> Mention Problem: <span class="tx-danger">*</span></label>
                                    <textarea rows="3" class="form-control" name="problem_details" placeholder="Write Product Problem" ></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> Claim Date: <span class="tx-danger">*</span></label>
                                    <div class="input-group">
                                          <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                                          <input type="text" class="form-control fc-datepicker claim_date" placeholder="MM/DD/YYYY" name="claim_date" required="">
                                        </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> Approximate Date: <span class="tx-danger">*</span></label>
                                    <div class="input-group">
                                          <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                                          <input type="text" class="form-control fc-datepicker approx_date" name="approx_date" placeholder="MM/DD/YYYY" required="" autocomplete="off">
                                          <span class="input-group-addon tx-size-sm lh-2 calculate_days">0 days</span>
                                        </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> Remarks: </label>
                                    <textarea rows="3" class="form-control" name="remarks" placeholder="Remarks"></textarea>
                                </div>
                            </div>

                        </div>



                        <div class="form-layout-footer">
                            <button type="submit" class="btn btn-info">Submit</button>
                            <button type="reset" class="btn btn-secondary">Cancel</button>
                        </div><!-- form-layout-footer -->

                    </div>
                </div><!-- form-layout -->
            </form>

        </div>
        <div class="col-md-2"></div>
    </div>
</div>

<br>


@endsection

@section('custom_js')
<script type="text/javascript">

    var highlight_dates = ['1-1-2018','11-1-2018','18-1-2018','28-1-2018'];

    $('.fc-datepicker').datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        dateFormat: 'mm/dd/yy',
    });


    $(document).ready(function() {
        var date = new Date();

        var day = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear();

        if (month < 10) month = "0" + month;
        if (day < 10) day = "0" + day;

        var today = month+ "/"+day+"/"+year;       
        $(".claim_date").attr("value", today);        
    });


    $('.approx_date').change(function(){
        var start = $('.claim_date').val();
        var end = $('.approx_date').val();

        var startDay = new Date(start);
        var endDay = new Date(end);
        var millisecondsPerDay = 1000 * 60 * 60 * 24;

        var millisBetween = endDay.getTime() - startDay.getTime();
        var days = millisBetween / millisecondsPerDay;

        $('.calculate_days').text(days+' days');
    });

    $('.customer_mobile').keyup(function() {
        var mobile = this.value;
        if(this.value.length == 11){
            var url_op = base_url+"/customer/check_customer";
            $.ajax({
                type: "POST",
                url: url_op,
                dataType: 'json',
                data: {mobile:mobile, _token:csrf_token},
                success : function(data){
                    if(data.status){
                        $(".customer_info").attr("hidden", false).text(data.msg);
                    }else{
                        $(".customer_info").attr("hidden", false).text(data.msg);
                    }
                }
            });
        }else{
             $(".customer_info").attr("hidden", true);
        }
    });


</script>
@endsection