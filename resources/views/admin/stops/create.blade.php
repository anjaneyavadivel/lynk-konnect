@extends('admin.layouts.app')


@section('content')

@include('admin.include.header')


@include('admin.include.sidebar')  

<div class="page">
      <div class="page-header">
        <h1 class="page-title">Stops Management</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="">Stops Management</a></li>
          <li class="breadcrumb-item active">Create Stops</li>
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
              

              <div class="col-md-12">
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

                    <form method="POST" action="{{ url('add_stop') }}">
                      @csrf
                      
                      <div class="row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">Route name</label>
                            <select class="form-control" id="route_id" name="route_id">
                              <option value="">Select</option>
                              @foreach ($routeList as $rval)
                                <option value="{{ $rval->id }}">{{ $rval->route_name }}</option>
                              @endforeach
                            </select>
                        </div>
                      </div>
                      
                     
                      @for($k=1; $k<=12; $k++)

                      <div class="form-row">
                        <div class="form-group form-material col-md-4"><?php echo $k.' - '; ?>
                          <label class="form-control-label" for="inputBasicFirstName">From County</label>
                            <select class="form-control" id="stop_state_id{{$k}}" name="stop_state_id[]">
                              <option value="">Select</option>
                              @foreach ($stateList as $Sval)
                              <option value="{{ $Sval->id }}">{{ $Sval->state_name }}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="form-group form-material col-md-4">
                          <label class="form-control-label" for="inputBasicFirstName">From  Neighborhoods</label>
                          <select class="form-control" id="stop_city_id{{$k}}" name="stop_city_id[]">
                              <option value="">Select Neighborhoods</option>
                          </select>
                        </div>

                        <div class="form-group form-material col-md-4">
                          <label class="form-control-label" for="inputBasicFirstName">Position</label>
                          <select class="form-control" id="position{{$k}}" name="position[]">
                              <option value="">Select Position</option>
                              @for($i=1; $i<=12; $i++)
                              <option value="{{ $i }}">{{ $i }}</option>
                              @endfor
                          </select>
                        </div>

                      </div>
                      @endfor


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
       
       
        <?php for($j=1; $j<=10; $j++){?>
       
       $('#stop_state_id'+<?php echo $j; ?>).on('change',function(e) {
                 
                 //var stop_state_id = e.target.value;
                 var stop_state_id = $('#stop_state_id'+<?php echo $j;?>).val();
                //alert(i);
                //alert(stop_state_id);
                 $.ajax({
                       
                       url:"{{ route('state') }}",
                       type:"get",
                       data: {
                           state_id: stop_state_id
                        },
                      
                       success:function (data) {

                        var select = $('#stop_city_id'+<?php echo $j; ?>).select();
                        select.empty();

                        $('#stop_city_id'+<?php echo $j; ?>).prepend('<option value="">Select Neighborhoods</option>');
                        $.each(data,function(key, value) {
                            select.append('<option value=' + value.id + '>' + value.city_name + '</option>');
                        });

                       }
                   })
                });
 <?php } ?>

      });


  
     </script>
@endsection