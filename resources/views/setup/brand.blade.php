@extends('layout.app')
@section('content')

<div class="br-pageheader pd-y-15 pd-l-20">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href=" {{URL::to('/dashboard')}} "> Dashboard </a>
        <a class="breadcrumb-item" href=""> Setup </a>
        <span class="breadcrumb-item active"> Brand </span>
    </nav>
</div>

<div class="br-pagebody">

    <div class="row">
        <div class="col-md-4">

            <form class="form-horizontal" action="{{ URL::to('setup/add_brand') }}" id="" role="form" method="post" data-parsley-validate>
                @csrf
                <div class="br-section-wrapper">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10"> Add Brand </h6>
                    <div class="form-layout form-layout-1">

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-control-label"> Brand Name: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="brand_name" placeholder="Enter Brand Name">
                                </div>
                            </div><!-- col-4 -->
                        </div><!-- row -->

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-control-label"> Brand Code: <span class="tx-danger">*</span></label>
                                    <input class="form-control brand_code" type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==2) return false;" name="brand_code" placeholder="Enter Brand Code">

                                    <div class="red code_error" hidden>
                                        Brand code already exist!!!
                                    </div>

                                </div>
                            </div><!-- col-4 -->
                        </div><!-- row -->

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-control-label"> Categories of This Brand: <span class="tx-danger">*</span></label>
                                    <select class="selectpicker" name="categories[]" multiple data-live-search="true" title="Select Categories Under This Brand" data-width="100%">
                                        @foreach ($data['categories'] as $category)
                                            <option value="{{$category->id}}"> {{ $category->category_name }} </option>                                            
                                        @endforeach
                                    </select>
                                </div>
                            </div><!-- col-4 -->
                        </div><!-- row -->

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-control-label"> Parts Details: </label>
                                    <textarea rows="3" class="form-control" name="brand_details" placeholder="Enter Brand Details"></textarea>
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
                            <button class="btn btn-info brand_submit">Submit</button>
                            <button class="btn btn-secondary">Cancel</button>
                        </div><!-- form-layout-footer -->

                    </div>
                </div><!-- form-layout -->
            </form>
        </div>

        <div class="col-md-8">
            <div class="br-section-wrapper">          
                <h6 class="tx-inverse tx-uppercase tx-bold tx-14 mg-b-10"> All Brand List </h6>

                <table class="table table-bordered table-colored table-info">
                    <thead>
                        <tr>
                            <th class="wd-5p"> SL </th>
                            <th class="wd-10p"> Name </th>
                            <th class="wd-10p"> Code </th>
                            <th class="wd-35p"> Category </th>
                            <th class="wd-20p"> Details </th>
                            <th class="wd-10p"> Status </th>
                            <th class="wd-10p"> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($data['brand']) > 0)

                        @php
                            $i =1;
                        @endphp

                        @foreach($data['brand'] as $brand)
                        <tr>
                            <td> {{ $i++ }} </td>
                            <td> {{ $brand->brand_name }} </td>
                            <td> {{ $brand->brand_code }} </td>
                            <td> 
                                @php
                                // echo "<pre>";
                                // print_r($brand->categories);
                                $categories = json_decode($brand->categories);

                                foreach ($data['categories'] as $category) {
                                    if(in_array($category->id, $categories )){
                                        echo $category->category_name.'<br>';
                                    }
                                }
                                @endphp
                            </td>
                            <td> {{ $brand->brand_details }} </td>

                            <td>
                                @if($brand->status == 1)
                                    Active
                                @else
                                    Inactive
                                @endif
                            </td>
                            <td>
                                <a href="javascript:void(0);" id="" data-id="{{ $brand->id }}" data-name="{{ $brand->brand_name }}" data-code="{{ $brand->brand_code }}" data-details="{{ $brand->brand_details }}" data-category="{{ $brand->categories }}" data-status="{{ $brand->status }}" class="btn btn-info btn-icon edit_brand_modal">
                                    <div><i class="fa fa-edit" title="Edit"></i></div>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="7" class="text-center">
                                There is no brand created
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

@include('modal.edit_brand')

@endsection

@section('custom_js')
<script type="text/javascript">

    $('.brand_code').keyup(function() {
        var code = this.value;

        if(code){
            var url_op = base_url+"/setup/check_brand_code";
            $.ajax({
                type: "POST",
                url: url_op,
                dataType: 'json',
                data: {code:code, _token:csrf_token},
                success : function(data){
                    if(data.status){
                        $(".brand_submit").attr("disabled", true);
                        $(".code_error").removeAttr('hidden');
                    }else{
                        $(".brand_submit").attr("disabled", false);
                        $(".code_error").attr("hidden",true);
                    }
                }
            });
        }
    });


    $('.edit_brand_code').keyup(function() {
        var code = this.value;

        if(code){
            var url_op = base_url+"/setup/check_brand_code";
            $.ajax({
                type: "POST",
                url: url_op,
                dataType: 'json',
                data: {code:code, _token:csrf_token},
                success : function(data){
                    if(data.status){
                        $(".edit_brand_submit").attr("disabled", true);
                        $(".edit_code_error").removeAttr('hidden');
                    }else{
                        $(".edit_brand_submit").attr("disabled", false);
                        $(".edit_code_error").attr("hidden",true);
                    }
                }
            });
        }
    });

    $(document).on('click', '.edit_brand_modal', function(e){
        var brand_id = $(this).attr("data-id");
        var brand_name = $(this).attr("data-name");
        var brand_code = $(this).attr("data-code");
        var brand_details = $(this).attr("data-details");
        var category = $(this).attr("data-category");
        var status = $(this).attr("data-status");

        var obj = jQuery.parseJSON(category);

        
        $('#edit_brand_modal').modal('show');      
        $('.brand_id').val(brand_id);
        $('.brand_name').val(brand_name);
        $('.edit_brand_code').val(brand_code);
        $('.brand_details').val(brand_details);
        $('.brand_status[value='+status+']').prop("checked", true);

        // $('.category :selected').each(function(){
        //  obj[$(this).val()]=$(this).text();
        // });

        //$(".category select[name=categories").val(obj);
        $('.selectpicker').selectpicker('val', obj);
    });

</script>
@endsection