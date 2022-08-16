@extends('admin.layouts.app')
@section('content')
@include('admin.include.header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
@include('admin.include.sidebar')  
<style>
  .error{
    color:red;
  }
  </style>  
<div class="page">
      <div class="page-header">
        <h1 class="page-title">Profile</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Dashboard</a></li>
          <li class="breadcrumb-item active"><a href="">Profile</a></li>
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

                    <form method="POST" action="{{ route('profile_update') }}" id="add_form">
                      @csrf
                      <div class="row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">First Name <span class="error">*</span> </label>
                          <input type="text" class="form-control fname" required  id="inputBasicFirstName" name="fname" value="{{$user_info->fname}}"
                            placeholder="" autocomplete="off" />
                            <span class="error" id="fname" style="display:none">First Name is required</span>
                        </div>
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">Last Name</label>
                          <input type="text" class="form-control lname" id="inputBasicFirstName" name="lname" value="{{$user_info->lname}}"
                            placeholder="" autocomplete="off" />
                            <span class="error" id="lname" style="display:none">Last Name is required</span>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">Email <span class="error">*</span> </label>
                          <input type="text" class="form-control email" id="inputBasicFirstName"  required name="email" readonly value="{{$user_info->email}}"
                            placeholder="" autocomplete="off" />
                            <span class="error" id="lname" style="display:none">Email is required</span>
                        </div>
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">Password</label>
                          <input type="password" id="password" class="form-control fname" id="inputBasicFirstName" name="password" value=""
                            placeholder="" autocomplete="off" />
                            <span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password" style="margin-left: 227px;margin-top: -24px; position: absolute;"></span>
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
    
    if($('.country_name').val()=='')
    {
      $('#country_name').css('display','block');
    }else{
      $('#country_name').css('display','none');
    }
    
    if($('.country_name').val()!="" )
    {
      $('form#add_form').submit();
    }
    
    
  });
});

$(document).on('click', '.toggle-password', function() {

$(this).toggleClass("fa-eye fa-eye-slash");

var input = $("#password");
input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
});
</script>
@endsection