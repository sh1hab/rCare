@extends('layout.app')
@section('content')
@section('custom_css')

<style type="text/css">
    .bigdrop {
        width: 500px !important;
    }
    .table th, .table td {
        padding: 5px;
    }
</style>

@endsection
<div class="br-pageheader pd-y-15 pd-l-20">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href=" {{URL::to('/dashboard')}} "> Dashboard </a>
        <a class="breadcrumb-item" href=""> Interchange </a>
        <span class="breadcrumb-item active"> Request </span>
    </nav>
</div>
<div class="br-pagebody">

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">

            <form class="form-horizontal" action="{{ URL::to('post-interchange') }}" id="" role="form" method="post" data-parsley-validate enctype="multipart/form-data">
                @csrf

                <div class="br-section-wrapper">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10"> Interchange Request </h6>
                    <div class="form-layout form-layout-1">


                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label"> From: <span class="tx-danger">*</span></label>
                                    <select class="form-control selectpicker" data-live-search="true" title="Select From Location Name" data-placeholder="" tabindex="-1" aria-hidden="true" name="from_location_id" required="">
                                        @foreach ($data['locations'] as $location)
                                            <option value="{{ $location->id }}"> {{ $location->location_name }} </option>
                                        @endforeach
                                    </select> 
                                </div>
                            </div>

                            <div class=" col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label"> To: <span class="tx-danger">*</span></label>
                                    <select class="form-control selectpicker" data-live-search="true" title="Select To Location Name" data-placeholder="" tabindex="-1" aria-hidden="true" name="to_location_id" required="">
                                        @foreach ($data['locations'] as $location)
                                            <option value="{{ $location->id }}"> {{ $location->location_name }} </option>
                                        @endforeach
                                    </select> 
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label"> Remarks: </label>
                                    <textarea rows="3" class="form-control" name="remarks" placeholder="Remarks"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <table class="table responsive table mg-b-0" id="interchangeParts">
                                    <thead>
                                        <tr>
                                            <th class="wd-40p"> Parts </th>
                                            <th class="wd-40p"> Quantity </th>
                                            <th class="wd-15p"></th>
                                            <th class="wd-10p"></th>
                                        </tr>
                                    </thead>
                                    @php
                                        $serial_no = 1; $Subtotal = 0; $j = 0; $existsData = 0;
                                    @endphp
                                    <tbody>
                                        <?php $existsData = 1; ?>
                                        <tr class="rowcount_{{ $serial_no }}">
                                            <td>
                                                <select class="form-control selectpicker parts_id" data-live-search="true" placeholder="Select Parts"  name="parts_id_1" required="">
                                                    <option value=""> Select Any Parts/Item </option>
                                                    @foreach ($data['parts'] as $part)
                                                    <option data-tokens="{{$part->full_code}}" data-subtext="" value="{{ $part->id }}"> {{ $part->full_code }} -- {{ $part->parts_name }} </option>
                                                    @endforeach
                                                </select> 
                                            </td>
                                            <td>
                                                <input class="form-control quantity" type="text" name="quantity_1" placeholder="Parts Quantity" required="">
                                                
                                            </td>
                                            <td>
                                                <label class="mg-t-10">
                                                    <input type="checkbox" name="instant_1" value="1">
                                                    <span>&nbsp;Instant</span>
                                                </label>
                                            </td>
                                            <td>                                            
                                                
                                            </td>
                                            <?php $j++; $serial_no++; ?>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-2">
                                
                            </div>                            
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-layout-footer">
                                    <button type="submit" class="btn btn-info">Submit</button>
                                    <button type="reset" class="btn btn-secondary" onClick="window.location.reload();">Cancel</button>
                                </div>
                            </div>
                            <div class="col-md-6 text-right">
                                <input type="hidden" name="partsrowcount" id="partsrowcount" value="{{ $j }}"> 
                                <a href="javascript:;" class="btn btn-sm btn-success" id="add_more_parts"> <i class="fa fa-plus-square"></i> Add another </a>
                            </div>
                        </div>
                        


                    </div>
                </div>
            </form>

        </div>
        <div class="col-md-1"></div>
    </div>
</div>

<br>


@endsection

@section('custom_js')
<script type="text/javascript">    

    $('#add_more_parts').on('click', function(e){
        var CurrRowCount = $('#interchangeParts tbody tr').length+1;

        var anotherRow = "<tr class='rowcount_"+CurrRowCount+"'>"+
        "<td>"+getParts(CurrRowCount)+"</td>"+
        "<td><input type='text' placeholder='Parts Quantity' name='quantity_"+CurrRowCount+"' class='quantity form-control' required></td>"+
        "<td><label class='mg-t-10'><input type='checkbox' name='instant_"+CurrRowCount+"' value='1'><span>&nbsp;Instant</span></label></td>"+
        "<td><button type='button' class='btn btn-xs btn-danger deleteParts' data-serailNo='"+CurrRowCount+"'>X</button></td>"+
        "</tr>";

        $('#interchangeParts tbody').append(anotherRow);
        $('#partsrowcount').val(CurrRowCount);
        selectRefresh();

    });

    function getParts(count){
        
        var salesdropdownhtml = '<select name="parts_id_'+count+'" class="form-control select select2 js-example-basic-single" data-live-search="true" required>'
        +'<option value=""> Select Any Parts/Item </option>';
        <?php 
        foreach ($data['parts'] as $part) {
            echo 'salesdropdownhtml += \'<option value="'.$part->id.'" data-subtext="'.$part->full_code.'" >'.$part->full_code.' -- '.$part->parts_name.'</option>\'; ';
        }
        ?>

        salesdropdownhtml += '</select>';
        return salesdropdownhtml;
    }

    $('#interchangeParts tbody').on("click", '.deleteParts', function(){
        if($('#interchangeParts tbody tr').length == 1){
            if(confirm('Are you sure to delete the last item?')){
                $(this).parent('td').parent('tr').remove();
            };
        }else{
            $(this).parent('td').parent('tr').remove();
        }

        $('#interchangeParts tbody tr').each(function(key, value){
            $(value).attr('class', 'rowcount_'+(key+1))
            $(value).children('td').children('.parts_id').attr('name', 'parts_id_'+(key+1));
            $(value).children('td').children('.quantity').attr('name', 'quantity_'+(key+1));
            $('#partsrowcount').val($('#interchangeParts tbody tr').length);
        });

    });

    function selectRefresh() {
      $('.select2').select2({
        //tags: true,
        placeholder: "Select Any Parts/Item",
        //allowClear: true,
        //width: '100%',
        dropdownCssClass : 'bigdrop'
        });
    }

</script>
@endsection