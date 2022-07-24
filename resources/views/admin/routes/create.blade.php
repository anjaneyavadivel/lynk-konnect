@extends('admin.layouts.app')


@section('content')

@include('admin.include.header')


@include('admin.include.sidebar')  

<div class="page">
      <div class="page-header">
        <h1 class="page-title">Routes Management</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="">Routes Management</a></li>
          <li class="breadcrumb-item active">Create Routes</li>
        </ol>
        <!-- <div class="page-header-actions">
          <a class="btn btn-sm btn-primary btn-round" href="{{ url('add_user') }}">
        <i class="icon md-plus" aria-hidden="true"></i>
        <span class="hidden-sm-down">Add Users</span>
      </a>
        </div> -->
      </div>

      <div class="page-content">
        
        <!-- Panel Table Tools -->
        <div class="panel">
          <div class="panel-body container-fluid">
            <div class="row row-lg">
              

              <div class="col-md-6">
                <!-- Example Basic Form (Form grid) -->
                <div class="example-wrap">
                 <!--  <h4 class="example-title">Basic Form (Form grid)</h4> -->
                  <div class="example">
@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif

                    <form method="POST" action="{{ url('add_route') }}">
                      @csrf
                      <input type="hidden" name="country_id" value="1">
                      
                      <div class="row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">Route name</label>
                            <input class="form-control" type="text" id="route_name" name="route_name" value="">
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">From County</label>
                            <select class="form-control" id="from_route_state_id" name="from_route_state_id">
                              <option value="">Select</option>
                              @foreach ($stateList as $Sval)
                              <option value="{{ $Sval->id }}">{{ $Sval->state_name }}</option>
                              @endforeach
                            </select>

                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">From  Neighborhoods</label>
                          <select class="form-control" id="from_route_city_id" name="from_route_city_id">
                              <option value="">Select Neighborhoods</option>
                          </select>
                        </div>
                      </div>


                      <div class="row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">To County</label>
                            <select class="form-control" id="to_route_state_id" name="to_route_state_id">
                              <option value="">Select</option>
                              @foreach ($stateList as $Sval)
                              <option value="{{ $Sval->id }}">{{ $Sval->state_name }}</option>
                              @endforeach
                            </select>

                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">To  Neighborhoods</label>
                          <select class="form-control" id="to_route_city_id" name="to_route_city_id">
                              <option value="">Select Neighborhoods</option>
                          </select>
                        </div>
                      </div>



                      <div class="row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">Description</label>
                            <textarea class="form-control" id="description" name="description" placeholder="" autocomplete="off"></textarea>
                        </div>
                      </div>

                      
                      
                      <div class="form-group form-material">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    
                  </div>
                </div>
                <!-- End Example Basic Form -->
              </div>
<!-- Example Basic Form (Form row) -->
             
</form>
              
            </div>
          </div>
        </div>
        <!-- End Panel Table Tools -->
        
      </div>
    </div>

@include('admin.include.footer')
<script type="text/javascript">
        $(function() {
       
       $('#from_route_state_id').on('change',function(e) {
                 
                 var from_route_state_id = e.target.value;
                 //alert(from_state_id);
                 $.ajax({
                       
                       url:"{{ route('state') }}",
                       type:"get",
                       data: {
                           state_id: from_route_state_id
                        },
                      
                       success:function (data) {

                        var select = $('#from_route_city_id').select();
                        select.empty();

                        $('#from_route_city_id').prepend('<option value="">Select Neighborhoods</option>');
                        $.each(data,function(key, value) {
                            select.append('<option value=' + value.id + '>' + value.city_name + '</option>');
                        });

                       }
                   })
                });

       $('#to_route_state_id').on('change',function(e) {
                 
                 var to_route_state_id = e.target.value;
                 //alert(from_state_id);
                 $.ajax({
                       
                       url:"{{ route('state') }}",
                       type:"get",
                       data: {
                           state_id: to_route_state_id
                        },
                      
                       success:function (data) {

                        var select = $('#to_route_city_id').select();
                        select.empty();

                        $('#to_route_city_id').prepend('<option value="">Select Neighborhoods</option>');
                        $.each(data,function(key, value) {
                            select.append('<option value=' + value.id + '>' + value.city_name + '</option>');
                        });

                       }
                   })
                });


      });
     </script>
@endsection