@extends('admin.layouts.app')


@section('content')

@include('admin.include.header')


@include('admin.include.sidebar')  

<div class="page">
      <div class="page-header">
        <h1 class="page-title">Company Management</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="">Company Management</a></li>
          <li class="breadcrumb-item active">Create Company</li>
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

                    <form method="POST" action="{{ url('edit_company') }}">
                      <input type="hidden" name="id" value="<?php if(isset($editview->id)){ echo $editview->id;} ?>">
                      @csrf
                      <div class="row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">Company Name</label>
                          <input type="text" class="form-control" id="inputBasicFirstName" name="company_name"
                            placeholder="" autocomplete="off" value="@if(isset($editview->company_name)){{ $editview->company_name }}@else{{old('company_name')}}@endif" />
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">Address</label>
                         <!--  <input type="text" class="form-control" id="inputBasicFirstName" name="company_name"
                            placeholder="Company Name" autocomplete="off" /> -->

                            <textarea class="form-control" id="inputBasicFirstName" name="address" placeholder="" autocomplete="off">@if(isset($editview->address)){{ $editview->address }}@else{{old('address')}}@endif</textarea>
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">Landmark</label>
                          <input type="text" class="form-control" id="inputBasicFirstName" name="landmark"
                            placeholder="" autocomplete="off" value="@if(isset($editview->landmark)){{ $editview->landmark }}@else{{old('landmark')}}@endif" />
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">Latitude</label>
                          <input type="text" class="form-control" id="inputBasicFirstName" name="latitude"
                            placeholder="" autocomplete="off" value="@if(isset($editview->latitude)){{ $editview->latitude }}@else{{old('latitude')}}@endif"/>
                        </div>
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicLastName">Longitutude</label>
                          <input type="text" class="form-control" id="inputBasicLastName" name="longitutude"
                            placeholder="" autocomplete="off" value="@if(isset($editview->longitutude)){{ $editview->longitutude }}@else{{old('longitutude')}}@endif"/>
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
                    
                      <div class="row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">Contact person</label>
                          <input type="text" class="form-control" id="inputBasicFirstName" name="contact_person"
                             autocomplete="off" value="@if(isset($editview->contact_person)){{ $editview->contact_person }}@else{{old('contact_person')}}@endif" />
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">Contact no </label>
                          <input type="text" class="form-control" id="inputBasicFirstName" name="contact_no1"
                             autocomplete="off" value="@if(isset($editview->contact_no1)){{ $editview->contact_no1 }}@else{{old('contact_no1')}}@endif"/>
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">Alternate no </label>
                          <input type="text" class="form-control" id="inputBasicFirstName" name="contact_no2"
                             autocomplete="off" value="@if(isset($editview->contact_no2)){{ $editview->contact_no2 }}@else{{old('contact_no2')}}@endif"/>
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
@endsection