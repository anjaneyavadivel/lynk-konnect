@extends('admin.layouts.app')


@section('content')

@include('admin.include.header')


@include('admin.include.sidebar')  
<style>
  .error{
    color:red;
  }
  </style>

<div class="page">
      <div class="page-header">
        <h1 class="page-title">Driver Management</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="">Driver Management</a></li>
          <li class="breadcrumb-item active">Create Driver</li>
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

                    <form method="POST" action="{{ url('add_driver') }}" id="add_form"  autocomplete="false">
                      @csrf
                      <?php if(Auth::user()->id == 2){ ?>
                      <div class="row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">Company</label>
                           <select class="form-control operator" id="select" name="company_id">
                              @foreach ($companyList as $Cval)
                              <option value="{{ $Cval->id }}">{{ $Cval->company_name }}</option>
                              @endforeach
                            </select>
                            <span class="error" id="operator" style="display:none">Operator is required</span>
                        </div>
                      </div>
                    <?php } ?>
                      <div class="row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">First Name <span class="error">*</span></label>
                          <input type="text" class="form-control fname" id="inputBasicFirstName" name="fname"
                            placeholder="First name" autocomplete="off" />
                            <span class="error" id="fname" style="display:none">First Name is required</span>
                        </div>
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicLastName">Last Name</label>
                          <input type="text" class="form-control" id="inputBasicLastName" name="lname"
                            placeholder="Last name" autocomplete="off" />
                        </div>
                      </div>
                      <!-- <div class="form-group form-material">
                        <label class="form-control-label">Gender</label>
                        <div>
                          <div class="radio-custom radio-default radio-inline">
                            <input type="radio" id="inputBasicMale" name="inputGender" />
                            <label for="inputBasicMale">Male</label>
                          </div>
                          <div class="radio-custom radio-default radio-inline">
                            <input type="radio" id="inputBasicFemale" name="inputGender" checked />
                            <label for="inputBasicFemale">Female</label>
                          </div>
                        </div>
                      </div> -->
                      <div class="form-group form-material">
                        <label class="form-control-label" for="">Email Address <span class="error">*</span></label>
                        <input type="email" class="form-control email" name="email"
                          placeholder="Email Address"  autocomplete="false"/>
                          <span class="error" id="email" style="display:none">Email is required</span>
                      </div>
                      <div class="form-group form-material">
                        <label class="form-control-label" for="inputBasicPassword">Password <span class="error">*</span></label>
                       
                          <input type="password" class="form-control password" id="inputBasicPassword" name="password" 
                          autocomplete="new-password" 
                          onblur="this.setAttribute('readonly', 'readonly');" 
                          onfocus="this.removeAttribute('readonly');" readonly>
                          <span class="error" id="password"  style="display:none">Password is required and Password should be above 6 digit</span>
                      </div>
                      <div class="form-group form-material">
                        <input type="checkbox" onclick="Toggle()">
                        <b>Show Password</b>
                       </div>

                      <!-- <div class="form-group form-material">
                        <label class="form-control-label" for="inputBasicPassword">Role</label>
                        <input type="password" class="form-control" id="inputBasicPassword" name="password"
                          placeholder="Password" autocomplete="off" />
                      </div> -->
                 <input type="hidden" name="role_id" value="3">
                 <div class="form-group form-material">
                        <label class="form-control-label" for="">Postcode <span class="error">*</span></label>
                        <input type="text" class="form-control postcode" name="postcode"
                          placeholder="postcode" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57"/>
                          <span class="error" id="postcode" style="display:none">Postcode is required and Postcode should be 6 digit</span>
                      </div>
                      <div class="form-group form-material">
                        <label class="form-control-label" for="">Contactnumber <span class="error">*</span></label>
                        <input type="text" class="form-control contact_no1" name="contactnumber"
                          placeholder="Contact Number" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57"/>
                          <span class="error" id="contactnumber" style="display:none">Contact no is required and Contact no should be 10 digit</span>
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
                  <!-- <h4 class="example-title">Basic Form (Form row)</h4> -->
                  <div class="example">
                      <div class="form-group form-material">
                        <label class="form-control-label" for="">Badge</label>  
                          <input type="file" name="">
                      </div>
                      <div class="form-group form-material">
                        <label class="form-control-label" for="">Address1 <span class="error">*</span></label>
                        <textarea class="form-control address1" id="inputBasicFirstName" name="address1" cols="2"></textarea>
                        <span class="error" id="address1" style="display:none">Address1 is required</span>
                      </div>
                      <div class="form-group form-material">
                        <label class="form-control-label" for="">Address2</label>
                        <textarea class="form-control" id="inputBasicFirstName" name="address2" placeholder="" autocomplete="off"></textarea>
                      </div>
                      <div class="form-row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">From County <span class="error">*</span></label>
                          <select class="form-control country" id="state_id" name="state_id">
                              <option value="">Select County</option>
                              @foreach ($stateList as $Sval)
                              <option value="{{ $Sval->id }}">{{ $Sval->state_name }}</option>
                              @endforeach
                          </select>
                          <span class="error" id="country"  style="display:none">County is required</span>
                        </div>
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">From  Neighborhoods <span class="error">*</span></label>
                          <select class="form-control city_id1" id="city_id" name="city_id">
                              <option value="">Select Neighborhoods</option>
                          </select>
                          <span class="error" id="city_id1" style="display:none">Neighborhoods is required</span>
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
    
    if($('.fname').val()=='')
    {
      $('#fname').css('display','block');
    }else{
      $('#fname').css('display','none');
    }
    filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if($('.email').val()=='' || filter.test(email)==false)
    {
      $('#email').css('display','block');
    }else{
      $('#email').css('display','none');
    }
    if($('.password').val()=='' || $('.password').val().length<6)
    {
      $('#password').css('display','block');
    }else{
      $('#password').css('display','none');
    }
    if($('.company').val()=='')
    {
      $('#company').css('display','block');
    }else{
      $('#company').css('display','none');
    }
    
    if($('.address1').val()=='')
    {
      $('#address1').css('display','block');
    }else{
      $('#address1').css('display','none');
    }
    if($('.country').val()=='')
    {
      $('#country').css('display','block');
    }else{
      $('#country').css('display','none');
    }
    if($('.city_id1').val()=='')
    {
      $('#city_id1').css('display','block');
    }else{
      $('#city_id1').css('display','none');
    }
    if($('.postcode').val()=='' || !/^[0-9]+$/.test($('.postcode').val()) || $('.postcode').val().length<6)
    {
      $('#postcode').css('display','block');
    }else{
      $('#postcode').css('display','none');
    }
    if($('.contact_no1').val()=='')
    {
      $('#contactnumber').css('display','block');
    }else{
      $('#contactnumber').css('display','none');
    }   
    if($('.fname').val()!="" && $('.email').val()!="" && $('.password').val()!="" && $('.company').val()!=""  && $('.address1').val()!="" && $('.country').val()!="" && $('.city_id1').val()!="" && $('.postcode').val()!="")
    {
      $('form#add_form').submit();
    }
    
    
  });
});

    $(function() {
      
       $('#state_id').on('change',function(e) {
                 
           var state_id = e.target.value;
           //alert(from_state_id);
           $.ajax({
                 
                 url:"{{ route('state') }}",
                 type:"get",
                 data: {
                     state_id: state_id
                  },
                
                 success:function (data) {

                  var select = $('#city_id').select();
                  select.empty();

                  $('#city_id').prepend('<option value="">Select Neighborhoods</option>');
                  $.each(data,function(key, value) {
                      select.append('<option value=' + value.id + '>' + value.city_name + '</option>');
                  });

                 }
             })
          });


      });
      function Toggle() {
            var temp = document.getElementById("inputBasicPassword");
            if (temp.type === "password") {
                temp.type = "text";
            }
            else {
                temp.type = "password";
            }
        }
     </script>
     

@endsection