@extends('layout.app')
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
                                    <label class="form-control-label"> Sale Date: <span class="tx-danger">*</span></label>
                                    <div class="input-group">
                                          <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                                          <input type="text" class="form-control fc-datepicker" placeholder="MM/DD/YYYY" name="sale_date">
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
                                                <label class="form-control-label"> Mobile: <span class="tx-danger">*</span></label>
                                                <input class="form-control" type="text" name="customer_mobile" placeholder="Customer Mobile Number" required="">
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
                                          <input type="text" class="form-control fc-datepicker" name="dalivery_date" placeholder="MM/DD/YYYY" required="">
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
     $('.fc-datepicker').datepicker({
          showOtherMonths: true,
          selectOtherMonths: true,
          dateFormat: 'dd/mm/yy'
        });


     $(document).ready(function() {
        var date = new Date();

        var day = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear();

        if (month < 10) month = "0" + month;
        if (day < 10) day = "0" + day;

        var today = day+ "/"+month+"/"+year;       
        $(".claim_date").attr("value", today);

        // date difference ----


        // var start = $('#start_date').val();
        // var end = $('#end_date').val();
        // var diff = new Date(end - start);
        // var days = diff/1000/60/60/24;

        // $(".claim_date").val(days);
    });

</script>
@endsection