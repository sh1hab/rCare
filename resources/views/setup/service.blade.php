@extends('layout.app')
@section('custom_css')
  <style type="text/css">
    .table-info > tbody > tr > th, .table-info > tbody > tr > td{

    }
  </style>
@endsection
@section('content')

  <div class="br-pageheader pd-y-15 pd-l-20">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
      <a class="breadcrumb-item" href=" {{URL::to('/dashboard')}} "> Dashboard </a>
      <a class="breadcrumb-item" href=""> Setup </a>
      <span class="breadcrumb-item active"> Add Service Type </span>
    </nav>
  </div>
  <div class="br-pagebody">

        <div class="row">
          <div class="col-md-5">
            <form class="form-horizontal" action="{{ URL::to('setup/add_service') }}" id="" role="form" method="post" data-parsley-validate>
              @csrf
              <div class="br-section-wrapper">
                <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10"> Add Service </h6>
                <div class="form-layout form-layout-1">

                  <div class="row">
                    <div class="col-md-10">
                      <div class="form-group mg-b-0">
                        <label> Service: <span class="tx-danger">*</span></label>
                        <input type="text" name="service_name" class="form-control" placeholder="Enter Service Name" required="">
                      </div>
                    </div><!-- col-4 -->
                  </div><!-- row -->

                  <div class="row">
                      <div class="col-md-10">
                          <div class="form-group">
                              <label class="form-control-label"> Service Details:<span class="tx-danger">*</span> </label>
                              <textarea rows="3" class="form-control" name="service_details" placeholder="Enter Service Details" required=""></textarea>
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
              <h6 class="tx-inverse tx-uppercase tx-bold tx-14 mg-b-10"> All Employee Role List </h6>

              <table class="table table-bordered table-colored table-info data-table">
                <thead>
                  <tr>
                    <th class="wd-35p"> Name </th>
                    <th class="wd-35p"> Details </th>
                    <th class="wd-10p"> Status </th>
                    <th class="wd-10p"> Action </th>
                  </tr>
                </thead>
                <tbody> 
                  @if(count($data['service']) > 0)
                    @foreach($data['service'] as $service)
                      <tr>
                        {{-- <th scope="row">{{ $service->id }}</th> --}}
                        <td> {{ $service->service_name }} </td>
                        <td> {{ $service->service_details }} </td>
                        <td>
                          @if($service->status == 1)
                            Active
                          @else
                            Inactive
                          @endif
                        </td>
                        <td>
                          <a href="javascript:void(0);" id="" data-id="{{ $service->id }}" data-name="{{ $service->service_name }}" data-details="{{ $service->service_details }}" data-status="{{ $service->status }}" class="btn btn-info btn-icon edit_service_modal">
                            <div><i class="fa fa-edit" title="Edit"></i></div>
                          </a>
                        </td>
                      </tr>
                    @endforeach
                  @else
                    <tr>
                        <td colspan="7" class="text-center">
                            There is no service name created
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

  @include('modal.edit_service')

@endsection

@section('custom_js')
  <script type="text/javascript">
    // $(function () {
    
    //   var table = $('.data-table').DataTable({
    //       processing: true,
    //       serverSide: true,
    //       ajax: "{{ route('add-employee-role') }}",
    //       columns: [
    //          // {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: true, searchable: true},
    //           {data: 'role_name', name: 'Role Name', orderable: true, searchable: true},
    //           {data: 'Status', name: 'Status', orderable: true, searchable: true },
    //           {data: 'action', name: 'action', orderable: true, searchable: true},
    //       ]
    //   });
      
    // });

    $(document).on('click', '.edit_service_modal', function(e){
        var service_id = $(this).attr("data-id");
        var name = $(this).attr("data-name");
        var details = $(this).attr("data-details");
        var status = $(this).attr("data-status");
        
        $('#edit_service_modal').modal('show');      
        $('.service_id').val(service_id);
        $('.name').val(name);
        $('.details').val(details);
        $('.status[value='+status+']').prop("checked",true);
    });
    

  </script>
@endsection