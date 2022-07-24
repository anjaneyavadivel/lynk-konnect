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
        <h1 class="page-title">County Management</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="">County Management</a></li>
          <li class="breadcrumb-item active">Edit County</li>
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

                    <form method="POST" action="{{ url('edit_state') }}" id="add_form">
                      <input type="hidden" name="id" value="<?php if(isset($editview->id)){ echo $editview->id;} ?>">
                      @csrf
                      <input type="hidden" name="country_id" value="1">

                      <div class="row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">County <span class="error">*</span></label>
                          <input type="text" class="form-control" id="inputBasicFirstName" name="state_name"
                            placeholder="" autocomplete="off" value="@if(isset($editview->state_name)){{ $editview->state_name }}@else{{old('state_name')}}@endif" />
                            <span class="error" id="country_name" style="display:none">Country Name is required</span>
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">Description</label>
                            <textarea class="form-control" id="inputBasicFirstName" name="description" placeholder="" autocomplete="off">@if(isset($editview->description)){{ $editview->description }}@else{{old('description')}}@endif</textarea>
                        </div>
                      </div>

                     
                      
                      <div class="form-group form-material">
                        <button type="button" class="submit-form btn btn-primary">Submit</button>
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
</script>
@endsection