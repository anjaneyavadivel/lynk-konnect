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
        <h1 class="page-title">Routes Management</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="">Routes Management</a></li>
          <li class="breadcrumb-item active">Edit Routes</li>
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
                    <form method="POST" action="{{ url('edit_route') }}" id="add_form">
                      <input type="hidden" name="id" value="<?php if(isset($editview->id)){ echo $editview->id;} ?>">
                      @csrf
                      <div class="row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">Route name <span class="error">*</span></label>
                            <input class="form-control route_name1" type="text" id="route_name" name="route_name" value="{{ $editview->route_name }}">
                            <span class="error" id="route_name1" style="display:none">Route Name is required</span>
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">From County <span class="error">*</span></label>
                            <select class="form-control country" id="from_route_state_id" name="from_route_state_id">
                              <option value="">Select</option>
                              @foreach ($stateList as $Sval)
                              <option value="{{ $Sval->id }}"<?php if($Sval->id == $editview->from_route_state_id) { echo 'selected';}?>>{{ $Sval->state_name }}</option>
                              @endforeach
                            </select>
                            <span class="error" id="country" style="display:none">From County is required</span>
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">From  Neighborhoods <span class="error">*</span></label>
                          <select class="form-control neighborhoods" id="from_route_city_id" name="from_route_city_id">
                              <option value="">Select Neighborhoods</option>
                              @foreach ($from_cityview as $fc_val)
                              <option value="{{ $fc_val->id }}"<?php if($fc_val->id == $editview->from_route_city_id) { echo 'selected';}?>>{{ $fc_val->city_name }}</option>
                              @endforeach
                          </select>
                          <span class="error" id="neighborhoods" style="display:none">Neighborhoods is required</span>
                        </div>
                      </div>


                      <div class="row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">To County <span class="error">*</span></label>
                            <select class="form-control to_county" id="to_route_state_id" name="to_route_state_id">
                              <option value="">Select</option>
                              @foreach ($stateList as $STval)
                              <option value="{{ $STval->id }}"<?php if($STval->id == $editview->to_route_state_id) { echo 'selected';}?>>{{ $STval->state_name }}</option>
                              @endforeach
                            </select>
                            <span class="error" id="to_county" style="display:none">To County is required</span>
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">To  Neighborhoods <span class="error">*</span></label>
                          <select class="form-control to_neighborhoods" id="to_route_city_id" name="to_route_city_id">
                               @foreach ($to_cityview as $tc_val)
                              <option value="{{ $tc_val->id }}"<?php if($tc_val->id == $editview->to_route_city_id) { echo 'selected';}?>>{{ $tc_val->city_name }}</option>
                              @endforeach>
                          </select>
                          <span class="error" id="to_neighborhoods" style="display:none">To Neighborhoods is required</span>
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">Description <span class="error">*</span></label>
                            <textarea class="form-control description1" id="description" name="description" placeholder="" autocomplete="off">{{ $editview->description }}</textarea>
                            <span class="error" id="description1" style="display:none">To Neighborhoods is required</span>
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
    var email=$('.email').val();
    
    if($('.route_name1').val()=='')
    {
      $('#route_name1').css('display','block');
    }else{
      $('#route_name1').css('display','none');
    }
    
    if($('.country').val()=='')
    {
      $('#country').css('display','block');
    }else{
      $('#country').css('display','none');
    }
    if($('.neighborhoods').val()=='')
    {
      $('#neighborhoods').css('display','block');
    }else{
      $('#neighborhoods').css('display','none');
    }
    if($('.to_county').val()=='')
    {
      $('#to_county').css('display','block');
    }else{
      $('#to_county').css('display','none');
    }
    if($('.to_neighborhoods').val()=='')
    {
      $('#to_neighborhoods').css('display','block');
    }else{
      $('#to_neighborhoods').css('display','none');
    }
    if($('.description1').val()=='')
    {
      $('#description1').css('display','block');
    }else{
      $('#description1').css('display','none');
    }
    

    if($('.route_name1').val()!="" && $('.country').val()!="" && $('.neighborhoods').val()!="" && $('.to_county').val()!="" && $('.to_neighborhoods').val()!="" && $('.description1').val()!="")
    {
      $('form#add_form').submit();
    }
    
    
  });
});
</script>
<script type="text/javascript">
        $(function() {
       
       $('#from_route_state_id').on('change',function(e) {
                 
                 var from_route_state_id = e.target.value;
                 //alert(from_state_id);
                 $.ajax({
                       
                       url:"{{ route('state') }}",
                       type:"get",
                       data: {
                           state_id: from_route_state_id
                        },
                      
                       success:function (data) {

                        var select = $('#from_route_city_id').select();
                        select.empty();

                        $('#from_route_city_id').prepend('<option value="">Select Neighborhoods</option>');
                        $.each(data,function(key, value) {
                            select.append('<option value=' + value.id + '>' + value.city_name + '</option>');
                        });

                       }
                   })
                });

       $('#to_route_state_id').on('change',function(e) {
                 
                 var to_route_state_id = e.target.value;
                 //alert(from_state_id);
                 $.ajax({
                       
                       url:"{{ route('state') }}",
                       type:"get",
                       data: {
                           state_id: to_route_state_id
                        },
                      
                       success:function (data) {

                        var select = $('#to_route_city_id').select();
                        select.empty();

                        $('#to_route_city_id').prepend('<option value="">Select Neighborhoods</option>');
                        $.each(data,function(key, value) {
                            select.append('<option value=' + value.id + '>' + value.city_name + '</option>');
                        });

                       }
                   })
                });


      });
     </script>
@endsection