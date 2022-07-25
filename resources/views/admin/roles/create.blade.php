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
        <h1 class="page-title">Roles Management</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="">Roles Management</a></li>
          <li class="breadcrumb-item active">Create User</li>
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

                    {!! Form::open(array('route' => 'roles.store','method'=>'POST', 'id' => "add_form")) !!}
                      
                      <div class="row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">Name <span class="error">*</span></label>
                          <!-- <input type="text" class="form-control" id="inputBasicFirstName" name="name"
                            placeholder="Name" autocomplete="off" /> -->
                            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control name')) !!}
                            <span class="error" id="name" style="display:none">Name is required</span>
                        </div>
                       
                      </div>
                      
                      <div class="form-group form-material">
                        <label class="form-control-label" for="inputBasicEmail">Permission <span class="error">*</span></label>
                        <br>
                         

                        @foreach($permission as $value)

                            <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name permission')) }}

                            {{ $value->name }}</label>

                        <br/>

                        @endforeach 
                        <span class="error" id="permission" style="display:none">Permission is required</span>
                      </div>
                      
                      <div class="form-group form-material">
                        <button type="button" class="btn btn-primary submit-form">Submit</button>
                      </div>
                    {!! Form::close() !!}
                  </div>
                </div>
                <!-- End Example Basic Form -->
              </div>
              
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
    
    if($('.name').val()=='')
    {
      $('#name').css('display','block');
    }else{
      $('#name').css('display','none');
    }
    var test=$('input[name="permission[]"]:checked').length > 0;
    if(test==false)
    {
      $('#permission').css('display','block');
    }else{
      $('#permission').css('display','none');
    }

    if($('.name').val()!="" && test==true)
    {
      $('form#add_form').submit();
    }
    
    
  });
});
</script>
@endsection