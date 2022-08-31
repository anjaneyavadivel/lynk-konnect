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

                    <form method="POST" action="{{ url('add_company') }}" id="add_form" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">Company Name <span class="error">*</span></label>
                          <input type="text" class="form-control company" id="inputBasicFirstName" name="company_name"
                            placeholder="" autocomplete="off" />
                            <span class="error" id="company"  style="display:none">Company is required</span>
                        </div>
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">Company Email <span class="error">*</span></label>
                          <input type="email" class="form-control email" id="inputBasicFirstName" name="emailid"
                            placeholder="" autocomplete="off" />
                            <span class="error" id="emailid"  style="display:none">Email is required</span>
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">Address <span class="error">*</span></label>
                         <!--  <input type="text" class="form-control" id="inputBasicFirstName" name="company_name"
                            placeholder="Company Name" autocomplete="off" /> -->

                            <textarea class="form-control address" id="inputBasicFirstName" name="address" placeholder="" autocomplete="off"></textarea>
                            <span class="error" id="address" style="display:none">Address is required</span>
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">Landmark <span class="error">*</span></label>
                          <input type="text" class="form-control landmark" id="inputBasicFirstName" name="landmark"
                            placeholder="" autocomplete="off" />
                            <span class="error" id="landmark" style="display:none">Landmark is required</span>
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">Country <span class="error">*</span></label>
                          <select class="form-control county" id="state_id" name="state_id">
                              <option value="">Select County</option>
                              @foreach ($stateList as $Sval)
                              <option value="{{ $Sval->id }}">{{ $Sval->state_name }}</option>
                              @endforeach
                          </select>
                          <span class="error" id="county" style="display:none">County is required</span>
                        </div>
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicLastName">Neighborhoods <span class="error">*</span></label>
                          <select class="form-control city_id1" id="city_id" name="city_id">
                              <option value="">Select Neighborhoods</option>
                          </select> 
                          <span class="error" id="city_id1" style="display:none">Neighborhoods is required</span>
                        </div>
                      </div>
                      
                      <div class="form-group form-material">
                        <button type="submit" class="btn btn-primary submit-form">Submit</button>
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
                          <label class="form-control-label" for="inputBasicFirstName">Postcode <span class="error">*</span></label>
                          <input type="text" class="form-control postcode1" name="postcode" id="postcode" 
                             autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57"/>
                             <span class="error" id="postcode1" style="display:none">Postcode is required and Postcode should be 6 digit</span>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">Contact person <span class="error">*</span></label>
                          <input type="text" class="form-control contact_person" id="inputBasicFirstName" name="contact_person"
                             autocomplete="off" />
                             <span class="error" id="contact_person" style="display:none">Contact person is required</span>
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">Contact no  <span class="error">*</span></label>
                          <input type="text" class="form-control contact_no1" id="inputBasicFirstName" name="contact_no1"
                             autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57"/>
                             <span class="error" id="contact_no1" style="display:none">Contact no is required and Contact no should be 10 digit</span>
                        </div>
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">Alternate no  <span class="error">*</span></label>
                          <input type="text" class="form-control contact_no2" id="inputBasicFirstName" name="contact_no2"
                             autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57"/>
                             <span class="error" id="contact_no2" style="display:none">Alternate no is required and Alternate no should be 10 digit</span>
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">Website <span class="error">*</span></label>
                          <input type="url" class="form-control website1" id="website" name="website"
                             autocomplete="off" placeholder="https://example.com" pattern="^(http(s)?:\/\/)+[\w\-\._~:\/?#[\]@!\$&'\(\)\*\+,;=.]+$"  required />
                             <span class="error" id="website1" style="display:none">Website is required</span> 
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">Operator Licence </label>
                          <input type="file" name="licence" id="input-file-events" class="dropify-event" style="opacity: 1 !important; margin-top: 33px;margin-left: 18px;" data-default-file="../../../global/photos/placeholder.png"/>
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

  $('#add_form').on('submit',function(e) {
    e.preventDefault();
    
    if($('.company').val()=='')
    {
      $('#company').css('display','block');
    }else{
      $('#company').css('display','none');
    }
    if($('.address').val()=='')
    {
      $('#address').css('display','block');
    }else{
      $('#address').css('display','none');
    }
    if($('.postcode1').val()=='' || !/^[0-9]+$/.test($('.postcode').val()))
    {
      $('#postcode1').css('display','block');
    }else{
      $('#postcode1').css('display','none');
    }    
    if($('.landmark').val()=='')
    {
      $('#landmark').css('display','block');
    }else{
      $('#landmark').css('display','none');
    }    
    if($('.contact_person').val()=='')
    {
      $('#contact_person').css('display','block');
    }else{
      $('#contact_person').css('display','none');
    }
    if($('.email').val()=='')
    {
      $('#emailid').css('display','block');
    }else{
      $('#emailid').css('display','none');
    }
    if($('.contact_no1').val()=='')
    {
      $('#contact_no1').css('display','block');
    }else{
      $('#contact_no1').css('display','none');
    }    
    if($('.contact_no2').val()=='')
    {
      $('#contact_no2').css('display','block');
    }else{
      $('#contact_no2').css('display','none');
    }    
    if($('.county').val()=='')
    {
      $('#county').css('display','block');
    }else{
      $('#county').css('display','none');
    }
    if($('.city_id1').val()=='')
    {
      $('#city_id1').css('display','block');
    }else{
      $('#city_id1').css('display','none');
    }

    if($('.website1').val()=='')
    {
      $('#website1').css('display','block');
    }else{
      $('#website1').css('display','none');
    }

    if($('.company').val()!="" && $('.address').val()!="" &&$('.email').val()!=""  && $('.postcode1').val()!="" && $('.landmark').val()!="" && $('.contact_person').val()!="" && $('.contact_no1').val()!="" &&  $('.contact_no2').val()!="" &&  $('.county').val()!="" && $('.city_id1').val()!="" && $('.website1').val()!="")
    {
  
      $('#add_form')[0].submit();
    }
  });

</script>

<script type="text/javascript">
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
     </script>
@endsection