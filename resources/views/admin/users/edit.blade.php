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
        <h1 class="page-title">Users Management</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="">Users Management</a></li>
          <li class="breadcrumb-item active">Edit User</li>
        </ol>
        <!-- <div class="page-header-actions">
          <a class="btn btn-sm btn-primary btn-round" href="{{ route('add_user') }}">
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

                    <form method="POST" action="{{ url('edit_user') }}">
                       <input type="hidden" name="id" value="<?php if(isset($editview->id)){ echo $editview->id;} ?>">
                      @csrf
                      <div class="row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">First Name <span class="error">*</span></label>
                          <input type="text" class="form-control fname" id="inputBasicFirstName" name="fname"
                            placeholder="Name" autocomplete="off" value="@if(isset($editview->fname)){{ $editview->fname }}@else{{old('fname')}}@endif" />
                            <span class="error" id="fname" style="display:none">First Name is required</span>
                        </div>
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicLastName">Last Name</label>
                          <input type="text" class="form-control" id="inputBasicLastName" name="lname"
                            placeholder="Name" autocomplete="off" value="@if(isset($editview->lname)){{ $editview->lname }}@else{{old('lname')}}@endif"  />
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
                        <label class="form-control-label" for="inputBasicEmail">Email Address <span class="error">*</span></label>
                        <input type="email" class="form-control email" id="inputBasicEmail" name="email"
                          placeholder="Email Address" autocomplete="off" value="@if(isset($editview->email)){{ $editview->email }}@else{{old('email')}}@endif"/>
                          <span class="error" id="email" style="display:none">Email is required</span>
                      </div>
                      <div class="form-group form-material">
                        <label class="form-control-label" for="inputBasicPassword">Password <span class="error">*</span></label>
                        <input type="text" class="form-control password" id="inputBasicPassword" name="password"
                          placeholder="Password" autocomplete="off" />
                          <span class="error" id="password"  style="display:none">Password is required and Password should be above 6 digit</span>
                      </div>

                      <!-- <div class="form-group form-material">
                        <label class="form-control-label" for="inputBasicPassword">Role</label>
                        <input type="password" class="form-control" id="inputBasicPassword" name="password"
                          placeholder="Password" autocomplete="off" />
                      </div> -->

                  <div class="form-group form-material" data-plugin="formMaterial">
                    <label class="form-control-label" for="select">Company <span class="error">*</span></label>
                    
                    <select class="form-control company" id="select" name="company_id">
                      <option value="">Select</option>
                      @foreach ($companyList as $Cval)
                      <option value="{{ $Cval->id }}"  <?php if($editview->company_id == $Cval->id){ echo 'selected';}?>>{{ $Cval->company_name }}</option>
                      @endforeach
                    </select>
                    <span class="error" id="company"  style="display:none">Company is required</span>
                  </div>

                  <div class="form-group form-material" data-plugin="formMaterial">
                    <label class="form-control-label" for="select">Role <span class="error">*</span></label>
                    
                    <select class="form-control role" id="select" name="role_id">
                      @foreach ($roleList as $val)
                      <option id="{{ $val->id }}"<?php if($userRole[0] == $val->id){ echo 'selected';}?>>{{ $val->name }}</option>
                      @endforeach
                    </select>
                    <span class="error" id="role" style="display:none">Role is required</span>
                  </div>

                      
                      <div class="form-group form-material">
                        <button type="button" class="btn btn-primary submit-form">Submit</button>
                      </div>
                    </form>
                  </div>
                </div>
                <!-- End Example Basic Form -->
              </div>
<!-- Example Basic Form (Form row) -->
              <!-- <div class="col-md-6">
                
                <div class="example-wrap">
                  <h4 class="example-title">Basic Form (Form row)</h4>
                  <div class="example">
                    <form autocomplete="off">
                      <div class="form-row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">First Name</label>
                          <input type="text" class="form-control" id="inputBasicFirstName" name="inputFirstName"
                            placeholder="First Name" autocomplete="off" />
                        </div>
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicLastName">Last Name</label>
                          <input type="text" class="form-control" id="inputBasicLastName" name="inputLastName"
                            placeholder="Last Name" autocomplete="off" />
                        </div>
                      </div>
                      <div class="form-group form-material">
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
                      </div>
                      <div class="form-group form-material">
                        <label class="form-control-label" for="inputBasicEmail">Email Address</label>
                        <input type="email" class="form-control" id="inputBasicEmail" name="inputEmail"
                          placeholder="Email Address" autocomplete="off" />
                      </div>
                      <div class="form-group form-material">
                        <label class="form-control-label" for="inputBasicPassword">Password</label>
                        <input type="password" class="form-control" id="inputBasicPassword" name="inputPassword"
                          placeholder="Password" autocomplete="off" />
                      </div>
                      <div class="form-group form-material">
                        <div class="checkbox-custom checkbox-default">
                          <input type="checkbox" id="inputBasicRemember" name="inputCheckbox" checked autocomplete="off"
                          />
                          <label for="inputBasicRemember">Remember Me</label>
                        </div>
                      </div>
                      <div class="form-group form-material">
                        <button type="button" class="btn btn-primary">Sign Up</button>
                      </div>
                    </form>
                  </div>
                </div>
               
              </div> --> <!-- End Example Basic Form (Form row) -->

              
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
    if($('.role').val()=='')
    {
      $('#role').css('display','block');
    }else{
      $('#role').css('display','none');
    }

    if($('.fname').val()!="" && $('.email').val()!="" && $('.password').val()!="" && $('.company').val()!="" && $('.role').val()!="")
    {
      $('form#add_user').submit();
    }
    
    
  });
});
</script>
@endsection