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
        <div class="page-header-actions">
          <a class="btn btn-sm btn-primary btn-round" href="{{ route('roles.index') }}">
        <i class="icon md-chart" aria-hidden="true"></i>
        <span class="hidden-sm-down">Back</span>
      </a>
        </div>
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

                    
                        
                      <div class="row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">Name</label>
                          {{ $role->name }}
                        </div>
                       
                      </div>
                      
                      <div class="form-group form-material">
                        <label class="form-control-label" for="inputBasicEmail">Permission</label>
                        <br> 
                        
                        @if(!empty($rolePermissions))

                @foreach($rolePermissions as $v)

                    <label class="label label-success">{{ $v->name }}</label> <br>

                @endforeach

            @endif

         

                      </div>
                     
                      
                   
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