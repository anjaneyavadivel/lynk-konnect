@extends('admin.layouts.app')

@section('content')

@include('admin.include.header')

@include('admin.include.sidebar')  

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

                    <form method="POST" action="{{ url('edit_role') }}">
                        <input type="hidden" name="id" value="<?php if(isset($role->id)){ echo $role->id;} ?>">
                      @csrf
                      <div class="row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">Name</label>
                          <input type="text" class="form-control" id="inputBasicFirstName" name="name"
                            placeholder="Name" value="@if(isset($role->name)){{ $role->name }}@else{{old('name')}}@endif"/>
                        </div>
                       
                      </div>
                      
                      <div class="form-group form-material">
                        <label class="form-control-label" for="inputBasicEmail">Permission</label>
                        <br> 
                        
                        @foreach($permission as $value)
                           <input type="checkbox" class="icheckbox-primary" id="inputUnchecked" data-plugin="iCheck" data-checkbox-class="icheckbox_flat-blue" name="permission[]" <?php if(in_array($value->id, $rolePermissions)){ echo 'checked'; } ?> />  {{ $value->name}}  <br>
                        @endforeach  
                      </div>
                     
                      <div class="form-group form-material">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </form>
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
@endsection