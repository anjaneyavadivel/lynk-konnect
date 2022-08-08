@extends('admin.layouts.app')


@section('content')

@include('admin.include.header')


@include('admin.include.sidebar')  
<style>
  .error{
    color:red;
  }
  </style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<div class="page">
      <div class="page-header">
        <h1 class="page-title">Trip Management</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="">Trip Management</a></li>
          <li class="breadcrumb-item active">Edit Trip</li>
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

                    <form method="POST" action="{{ url('edit_trip') }}" id="add_form">
                      @csrf
                      <input type="hidden" name="id" value="<?php if(isset($editview->id)){ echo $editview->id;} ?>">
                      <?php if(Auth::user()->id == 2){ ?>
                      <div class="row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">Operator <span class="error">*</span></label>
                           <select class="form-control operator" id="select" name="trip_owner_company_id">
                              @foreach ($companyList as $Cval)
                              <option value="{{ $Cval->id }}"  <?php if($editview->trip_owner_company_id==$Cval->id){echo "selected";} ?>>{{ $Cval->company_name }}</option>
                              @endforeach
                            </select>
                            <span class="error" id="operator" style="display:none">Operator is required</span>
                        </div>
                      </div>
                    <?php } ?>

                      <div class="form-row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">From Address <span class="error">*</span></label>
                            <textarea class="form-control address" id="inputBasicFirstName" value="{{ $editview->from_address }}" name="from_address" placeholder="" autocomplete="off" >{{ $editview->from_address }}</textarea>
                            <span class="error" id="address" style="display:none">Address is required</span>
                        </div>
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">From County <span class="error">*</span></label>
                          <select class="form-control county" id="from_state_id" name="from_state_id" >
                              <option value="">Select County</option>
                              @foreach ($stateList as $Sval)
                              <option value="{{ $Sval->id }}" <?php if($editview->from_state_id==$Sval->id){echo "selected";} ?>>{{ $Sval->state_name }}</option>
                              @endforeach
                          </select>  
                          <span class="error" id="county" style="display:none">County is required</span>
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">From  Neighborhoods <span class="error">*</span></label>
                          <select class="form-control neighborhoods" id="from_city_id" name="from_city_id">
                              <option value="">Select Neighborhoods</option>
                              @foreach ($citylist as $Sval)
                              <option value="{{ $Sval->id }}" <?php if($editview->from_city_id==$Sval->id){echo "selected";} ?>>{{ $Sval->city_name }}</option>
                              @endforeach
                          </select>  
                          <span class="error" id="neighborhoods" style="display:none">Neighborhoods is required</span>
                        </div>
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicLastName">From Postcode <span class="error">*</span></label>
                          <input type="text" class="form-control postcode" id="select" name="from_postcode" value="{{ $editview->from_postcode }}" required> 
                          <span class="error" id="postcode" style="display:none">Postcode is required</span> 
                        </div>
                      </div>


                      <div class="form-row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">To Address <span class="error">*</span></label>
                            <textarea class="form-control address1" id="inputBasicFirstName" name="to_address" placeholder="" autocomplete="off"> {{ $editview->to_address }}</textarea>
                            <span class="error" id="address1" style="display:none">Address is required</span> 
                        </div>
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">To County <span class="error">*</span></label>
                          <select class="form-control county1" id="to_state_id" name="to_state_id" required>
                              <option value="">Select County</option>
                              @foreach ($stateList as $Sval)
                              <option value="{{ $Sval->id }}"  <?php if($editview->to_state_id==$Sval->id){echo "selected";} ?>>{{ $Sval->state_name }}</option>
                              @endforeach
                          </select>  
                          <span class="error" id="county1" style="display:none">County is required</span> 
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">To Neighborhoods <span class="error">*</span></label>
                          <select class="form-control neighborhoods1" id="to_city_id" name="to_city_id">
                              <option value="">Select Neighborhoods</option>
                              @foreach ($citylist as $Sval)
                              <option value="{{ $Sval->id }}" <?php if($editview->to_city_id==$Sval->id){echo "selected";} ?>>{{ $Sval->city_name }}</option>
                              @endforeach
                          </select> 
                          <span class="error" id="neighborhoods1" style="display:none">Neighborhoods is required</span>  
                        </div>
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicLastName">To Postcode <span class="error">*</span></label>
                          <input type="number" class="form-control postcode1" id="select" name="to_postcode"  value="{{ $editview->to_postcode }}" required>
                          <span class="error" id="postcode1" style="display:none">Postcode is required</span>  
                        </div>
                      </div>
                      
                      <div class="form-group form-material">
                        <button type="button" class="btn btn-primary submit-form">Submit</button>
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
              <label class="form-control-label" for="inputBasicFirstName">Trip Date/Time <span class="error">*</span></label>
            </div>
            <div class="example">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="icon md-calendar" aria-hidden="true"></i>
                      </span>
                      <input data-date-format="dd-mm-yyyy" type="text" readonly class="form-control trip_date_time" value="{{ $editview->trip_date }}" data-plugin="datepicker" name="trip_date" id="trip_date">
                    </div>
                  </div>
                  
                  <div class="example">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="icon md-time" aria-hidden="true"></i>
                      </span>
                      <input type="text" class="form-control" disabled data-plugin="timepicker" name="trip_time" id="trip_time"  value="{{ $editview->trip_time }}"/>
                    </div>
                  </div>
                  <span class="error" id="trip_date_time" style="display:none">Trip Date/Time is required</span> 
                </div>
          </div>
                     

                      <div class="row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">Trip Description</label>
                          <textarea class="form-control" id="inputBasicFirstName" name="description_trip"  placeholder="" autocomplete="off">{{ $editview->description_trip }}</textarea>
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">No of persons  <span class="error">*</span></label>
                          <input type="number" class="form-control no_of_passengers" id="inputBasicFirstName" name="no_of_passengers" value="{{ $editview->no_of_passengers }}"
                             autocomplete="off" />
                             <span class="error" id="no_of_passengers" style="display:none">No of persons is required</span> 
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">Trip amount <span class="error">*</span></label>
                          <input type="number" class="form-control trip_amount" id="inputBasicFirstName" name="trip_amount"  value="{{ $editview->trip_amount }}"
                             autocomplete="off" />
                             <span class="error" id="trip_amount" style="display:none">Trip amount is required</span> 
                        </div>
                      </div>

                      

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
  $(document).ready(function () {   

  $('.submit-form').on('click',function(e) {
    var email=$('.email').val();
    
    if($('.operator').val()=='')
    {
      $('#operator').css('display','block');
    }else{
      $('#operator').css('display','none');
    }
    
    if($('.address').val()=='')
    {
      $('#address').css('display','block');
    }else{
      $('#address').css('display','none');
    }
    if($('.county').val()=='')
    {
      $('#county').css('display','block');
    }else{
      $('#county').css('display','none');
    }
    if($('.neighborhoods').val()=='')
    {
      $('#neighborhoods').css('display','block');
    }else{
      $('#neighborhoods').css('display','none');
    }

    if($('.postcode').val()=='' || !/^[0-9]+$/.test($('.postcode').val()) || $('.postcode').val().length<6)
    {
      $('#postcode').css('display','block');
    }else{
      $('#postcode').css('display','none');
    }

    if($('.address1').val()=='')
    {
      $('#address1').css('display','block');
    }else{
      $('#address1').css('display','none');
    }
    if($('.county1').val()=='')
    {
      $('#county1').css('display','block');
    }else{
      $('#county1').css('display','none');
    }
    if($('.neighborhoods1').val()=='')
    {
      $('#neighborhoods1').css('display','block');
    }else{
      $('#neighborhoods1').css('display','none');
    }
    if($('.postcode1').val()=='' || !/^[0-9]+$/.test($('.postcode').val()) || $('.postcode').val().length<6)
    {
      $('#postcode1').css('display','block');
    }else{
      $('#postcode1').css('display','none');
    }

    if($('.trip_date_time').val()=='')
    {
      $('#trip_date_time').css('display','block');
    }else{
      $('#trip_date_time').css('display','none');
    }

    if($('.no_of_passengers').val()=='')
    {
      $('#no_of_passengers').css('display','block');
    }else{
      $('#no_of_passengers').css('display','none');
    }

    if($('.trip_amount').val()=='')
    {
      $('#trip_amount').css('display','block');
    }else{
      $('#trip_amount').css('display','none');
    }

    if($('.operator').val()!="" && $('.address').val()!=""  && $('.county').val()!="" && $('.neighborhoods').val()!="" && $('.postcode').val()!="" && $('.address1').val()!="" && $('.county1').val()!="" && $('.neighborhoods1').val()!="" && $('.postcode1').val()!="" && $('.trip_date_time').val()!="" && $('.no_of_passengers').val()!="" && $('.trip_amount').val()!="")
    {
      $('form#add_form').submit();
    }    
    
  });
});
</script>

<script type="text/javascript">
        $(function() {
       //  //-- indi-validation --
       //      $( "#from_state_id").change(function() { 
       //        alert('sdsd');
       //      });
       //      $( "#country_id").change(function() { 
       //          if($( "#country_id" ).val()==''){$("#country_idError").show();}else{$( "#country_idError" ).hide();} 
       //        });
            
       //      $( "#parish_name").keyup(function() { 
       //          if($( "#parish_name" ).val()==''){$("#parish_nameError").show();}else{$( "#parish_nameError" ).hide();} 
       //        });

       $('#from_state_id').on('change',function(e) {
                 
                 var from_state_id = e.target.value;
                 //alert(from_state_id);
                 $.ajax({
                       
                       url:"{{ route('state') }}",
                       type:"get",
                       data: {
                           state_id: from_state_id
                        },
                      
                       success:function (data) {

                        var select = $('#from_city_id').select();
                        select.empty();

                        $('#from_city_id').prepend('<option value="">Select Neighborhoods</option>');
                        $.each(data,function(key, value) {
                            select.append('<option value=' + value.id + '>' + value.city_name + '</option>');
                        });

                       }
                   })
                });

       $('#to_state_id').on('change',function(e) {
                 
                 var to_state_id = e.target.value;
                 //alert(from_state_id);
                 $.ajax({
                       
                       url:"{{ route('state') }}",
                       type:"get",
                       data: {
                           state_id: to_state_id
                        },
                      
                       success:function (data) {

                        var select = $('#to_city_id').select();
                        select.empty();

                        $('#to_city_id').prepend('<option value="">Select Neighborhoods</option>');
                        $.each(data,function(key, value) {
                            select.append('<option value=' + value.id + '>' + value.city_name + '</option>');
                        });

                       }
                   })
                });


      });
     </script>
@endsection