@extends('admin.layouts.app')


@section('content')

@include('admin.include.header')


@include('admin.include.sidebar')  

<div class="page">
      <div class="page-header">
        <h1 class="page-title">Trip Management</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="">Trip Management</a></li>
          <li class="breadcrumb-item active">Create Trip</li>
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

                    <form method="POST" action="{{ url('add_trip') }}">
                      @csrf
                      <div class="row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">Operator</label>
                          <!-- <input type="text" class="form-control" id="inputBasicFirstName" name="company_name"
                            placeholder="" autocomplete="off" /> -->
                           <select class="form-control" id="select" name="trip_owner_company_id">
                              <option value="">Select</option>
                              @foreach ($companyList as $Cval)
                              <option value="{{ $Cval->id }}" <?php if($list->trip_owner_company_id == $Cval->id){ echo 'selected';}?>>{{ $Cval->company_name }}</option>
                              @endforeach
                            </select>
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">From Address</label>
                            <textarea class="form-control" id="inputBasicFirstName" name="from_address" placeholder="" autocomplete="off"><?php echo $list->from_address; ?></textarea>
                        </div>
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">From County</label>
                          <select class="form-control" id="select" name="from_state_id">
                              <option value="">Select</option>
                              @foreach ($stateList as $Sval)
                              <option value="{{ $Sval->id }}" <?php if($list->from_state_id == $Sval->id){ echo 'selected';}?>>{{ $Sval->state_name }}</option>
                              @endforeach
                          </select>  
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">From Neighborhoods</label>
                          <select class="form-control" id="select" name="from_city_id">
                              <option value="">Select</option>
                              @foreach ($companyList as $Cval)
                              <option value="{{ $Cval->id }}" <?php if($list->from_state_id == $Sval->id){ echo 'selected';}?>>{{ $Cval->company_name }}</option>
                              @endforeach
                          </select>  
                        </div>
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicLastName">From Postcode</label>
                          <input type="text" class="form-control" id="select" name="from_postcode" value="<?php  echo $list->from_postcode; ?>">
                              
                        </div>
                      </div>


                      <div class="form-row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">To Address</label>
                            <textarea class="form-control" id="inputBasicFirstName" name="to_address" placeholder="" autocomplete="off"><?php  echo $list->to_address; ?></textarea>
                        </div>
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">To County</label>
                          <select class="form-control" id="select" name="to_state_id">
                              <option value="">Select</option>
                              @foreach ($stateList as $STval)
                              <option value="{{ $STval->id }}" <?php if($list->to_state_id == $STval->id){ echo 'selected';}?>>{{ $STval->state_name }}</option>
                              @endforeach
                          </select>  
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">To Neighborhoods</label>
                          <select class="form-control" id="select" name="to_city_id">
                              <option value="">Select</option>
                              @foreach ($companyList as $Cval)
                              <option value="{{ $Cval->id }}" <?php if($list->to_state_id == $STval->id){ echo 'selected';}?>>{{ $Cval->company_name }}</option>
                              @endforeach
                          </select>  
                        </div>
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicLastName">To Postcode</label>
                          <input type="text" class="form-control" id="select" name="to_postcode" value="<?php echo $list->to_postcode; ?>">
                              
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
              <div class="col-md-6">
                
                <div class="example-wrap">
                 <!--  <h4 class="example-title">Basic Form (Form row)</h4> -->
                  <div class="example">

                  <div class="panel-body">
            <div class="form-group form-material col-md-6">
              <label class="form-control-label" for="inputBasicFirstName">Trip Date/Time</label>
            </div>
            <div class="example">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="icon md-calendar" aria-hidden="true"></i>
                      </span>
                      <input data-date-format="dd-mm-yyyy" type="text" class="form-control trip_date_time" value="{{ $list->trip_date }}" data-plugin="datepicker" name="trip_date" id="trip_date">
                    </div>
                  </div>
                  
                  <div class="example">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="icon md-time" aria-hidden="true"></i>
                      </span>
                      <input type="text" class="form-control" data-plugin="timepicker" name="trip_time" id="trip_time"  value="{{ $list->trip_time }}"/>
                    </div>
                  </div>
                  <span class="error" id="trip_date_time" style="display:none">Trip Date/Time is required</span> 
                </div>
          </div>
                    
                      <div class="row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">Trip Description</label>
                          <textarea class="form-control" id="inputBasicFirstName" name="description_trip" placeholder="" autocomplete="off"><?php echo $list->description_trip; ?></textarea>
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">No of persons </label>
                          <input type="text" class="form-control" id="inputBasicFirstName" name="no_of_passengers"
                             autocomplete="off" value="<?php echo $list->no_of_passengers; ?>" />
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">Trip Amount</label>
                          <input type="text" class="form-control" id="inputBasicFirstName" name="no_of_passengers"
                             autocomplete="off" value="<?php echo $list->trip_amount; ?>" />
                        </div>
                      </div>  
                      <input type="hidden" class="form-control" name="trip_date" id="trip_date" value="<?php echo $list->trip_date; ?>">
                      <input type="hidden" class="form-control" name="trip_time" id="trip_time" value="<?php echo $list->trip_time; ?>">
                      <button id="confirm_trip" class="btn btn-primary animation-scale-up waves-effect waves-classic">Click here to confirm the trip</button>

                  </div>
                </div>
               
              </div> <!-- End Example Basic Form (Form row) -->
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
        
        $( "#confirm_trip").change(function() { 
                alert('sdsd');
              });
        //-- indi-validation --
            $( "#country_id").change(function() { 
                if($( "#country_id" ).val()==''){$("#country_idError").show();}else{$( "#country_idError" ).hide();} 
              });
            
            $( "#parish_name").keyup(function() { 
                if($( "#parish_name" ).val()==''){$("#parish_nameError").show();}else{$( "#parish_nameError" ).hide();} 
              });

      });
     </script>
@endsection