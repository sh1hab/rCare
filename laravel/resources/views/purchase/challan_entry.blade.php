@extends('layout.app')
@section('custom_css')
  <style type="text/css">        
    .form-layout-1 .form-group {
        margin-bottom: 20px;
    }
  </style>
@endsection
@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href=" {{URL::to('/dashboard')}} "> Dashboard </a>
        <a class="breadcrumb-item" href=""> Purchase </a>
        <span class="breadcrumb-item active"> Challan </span>
    </nav>
</div>
<div class="br-pagebody">

    <div class="row">
        <div class="col-md-6 offset-md-3">

            <form class="form-horizontal" action="{{ URL::to('purchase/add_challan_entry') }}" id="" role="form" method="post" data-parsley-validate>
                @csrf

                <div class="br-section-wrapper">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10"> Challan Entry </h6>
                    <div class="form-layout form-layout-1">

                        <input type="hidden" name="purchase_details_id" value="{{$data['purchase_details']->purchase_id}}">
                        <input type="hidden" name="parts_id" value="{{$data['purchase_details']->parts_id}}">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> Parts: </label>
                                    <input class="form-control" type="text" name="short_name" placeholder="" required="" value="{{$data['purchase_details']->parts_name}}" readonly="">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> Supplier: </label>
                                    <input class="form-control" type="text" name="supplier" placeholder="" value="{{$data['purchase_details']->supplier_name}}" readonly="">
                                </div>
                            </div>
                        </div>

                        <div class="row">                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> Unit Price: </label>
                                    <input class="form-control" type="text" name="unit_price" placeholder="" required="" value="{{$data['purchase_details']->unit_price}}" readonly="">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> Quantity: </label>
                                    <input class="form-control" type="text" name="quantity" placeholder="" required="" value="{{$data['purchase_details']->quantity}}" readonly="">
                                </div>
                            </div>
                        </div>

                        <div class="row">                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> Receive Location: <span class="tx-danger">*</span></label>
                                    <select class="form-control selectpicker" data-live-search="true" title="Select Location Name" data-placeholder="" tabindex="-1" aria-hidden="true" name="location_id" required="">
                                        @foreach ($data['locations'] as $location)
                                            <option value="{{ $location->id }}"> {{ $location->location_name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> Receive By: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="receive_by" placeholder="Select Receive By" required="" value="{{Auth::user()->username}}" readonly="">
                                </div>
                            </div>
                        </div>



                        <div class="row">                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> Receive Quantity: <span class="tx-danger">*</span></label>                                   
                                    <input class="form-control" type="text" name="rcv_quantity" placeholder="Enter Receive Quantity" required="" value="">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> Challan No: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="challan_no" placeholder="Enter Challan Number" required="" value="">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> Return Quantity: </label>                                   
                                    <input class="form-control" type="text" name="return_quantity" placeholder="Enter Return Quantity" value="">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> Receive Note: </label>
                                    <textarea rows="3" class="form-control" name="receive_note" placeholder="Remarks"></textarea>
                                </div>
                            </div>                            
                        </div>

                        <div class="row">
                            @for ($i = 1; $i <= $data['purchase_details']->quantity; $i++)
                                <div class="col-md-6 text-center">
                                    <label class="form-control-label"> Parts - {{$i}} </label>
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" name="serial[]" placeholder="Enter Serial Number" required="" value="" autocomplete="off">
                                </div>
                            @endfor
                        </div>


                        <br><br>

                        <div class="form-layout-footer text-center">
                            <button type="submit" class="btn btn-info">Save</button>
                            <button type="reset" class="btn btn-secondary">Cancel</button>
                        </div><!-- form-layout-footer -->

                    </div>
                </div><!-- form-layout -->
            </form>
        </div>        
    </div>   

</div>


@include('modal.edit_bank')

@endsection

@section('custom_js')
<script type="text/javascript">
    

</script>
@endsection