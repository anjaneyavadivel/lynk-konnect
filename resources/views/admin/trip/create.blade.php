@extends('admin.layouts.app')


@section('content')

@include('admin.include.header')


@include('admin.include.sidebar')  
<style>
  .error{
    color:red;
  }
  .form-row{
     margin-top: 15px;
  }
  .pac-container {
    z-index: 10000 !important;
}
  </style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<div class="page">
      <div class="page-header">
        <h1 class="page-title">Trip Management</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="">Trip Management</a></li>
          <li class="breadcrumb-item active">Create Trip</li>
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
              

              <div class="col-md-12">
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

                    <form method="POST" action="{{ url('add_trip') }}" id="add_form">
                      @csrf
                      <div class="form-row">
                      <?php if(Auth::user()->id == 2){ ?>
                      
                        <div class="form-group form-material col-md-4">
                          <label class="form-control-label" for="inputBasicFirstName">Operator <span class="error">*</span></label>
                           <select class="form-control operator" id="select" name="trip_owner_company_id">
                              @foreach ($companyList as $Cval)
                              <option value="{{ $Cval->id }}">{{ $Cval->company_name }}</option>
                              @endforeach
                            </select>
                            <span class="error" id="operator" style="display:none">Operator is required</span>
                        </div>
                      
                    <?php } ?>
                    <div class="form-row col-md-4">
                    <div class="form-group form-material col-md-12" style="margin-bottom:0px">
                      <label class="form-control-label" for="inputBasicFirstName">Trip Date <span class="error">*</span></label>
                    </div>
                    <div class="example" style="margin-bottom:0px; margin-top:0px;">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="icon md-calendar" aria-hidden="true"></i>
                        </span>
                        <input data-date-format="dd-mm-yyyy" readonly type="text" pattern="([0-9]{2})\/([0-9]{2})\/([0-9]{4})" class="form-control trip_date_time" data-plugin="datepicker" name="trip_date" id="trip_date">
                      </div>
                    </div>
                  </div>
                  <div class="form-row col-md-4">
                  <div class="form-group form-material col-md-12" style="margin-bottom:0px">
                    <label class="form-control-label" for="inputBasicFirstName">Trip Time <span class="error">*</span></label>
                  </div>
                    <div class="example" style="margin-bottom:0px; margin-top:0px;">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="icon md-time" aria-hidden="true"></i>
                        </span>
                        <input type="text" class="form-control trip_time" data-plugin="timepicker" name="trip_time" id="trip_time" onkeyup="myFunction()"/>
                      </div>
                    </div>
                  </div>
                    <span class="error" id="trip_date_time" style="display:none">Trip Date/Time is required</span> 
                  </div>
                  <div class="form-row"  style="margin-top:30px">
                        <div class="form-group form-material col-md-6" >
                          <label class="form-control-label" for="inputBasicFirstName">From Address <span class="error">*</span></label>
                            <textarea class="form-control address" id="inputBasicFirstName" name="from_address" placeholder="" autocomplete="off" required></textarea>
                            <span class="error" id="address" style="display:none">Address is required</span>
                        </div>                       
                                  
                  </div>
                      <div class="form-row">
                        <div class="form-group form-material col-md-4">
                          <label class="form-control-label" for="inputBasicFirstName">From County <span class="error">*</span></label>
                          <select class="form-control county" id="from_state_id" name="from_state_id" required>
                              <option value="">Select County</option>
                              @foreach ($stateList as $Sval)
                              <option value="{{ $Sval->id }}">{{ $Sval->state_name }}</option>
                              @endforeach
                          </select>  
                          <span class="error" id="county" style="display:none">County is required</span>
                        </div>
                        <div class="form-group form-material col-md-4">
                          <label class="form-control-label" for="inputBasicFirstName">From  Neighborhoods <span class="error">*</span></label>
                          <select class="form-control neighborhoods" id="from_city_id" name="from_city_id">
                              <option value="">Select Neighborhoods</option>
                          </select>  
                          <span class="error" id="neighborhoods" style="display:none">Neighborhoods is required</span>
                        </div>
                        <div class="form-group form-material col-md-4">
                          <label class="form-control-label" for="inputBasicLastName">From Postcode <span class="error">*</span></label>
                          <input type="number" class="form-control postcode" id="select" name="from_postcode" required> 
                          <span class="error" id="postcode" style="display:none">Postcode is required</span> 
                        </div>
                      </div>
                    
                      <div class="form-row">
                        <div class="form-group form-material col-md-3" style="margin-bottom:0px;">
                          <label class="form-control-label" for="inputBasicLastName">From Latitude <span class="error">*</span></label>
                          <input name="from_latitude" class="from-lat form-control" value="" type="text" placeholder="Latitude" style="margin-bottom:10px;" readonly>
                                             
                        </div>
                        <div class="form-group form-material col-md-3"  style="margin-bottom:0px;">
                            <label class="form-control-label" for="inputBasicLastName">From Longitude <span class="error">*</span></label>
                            <input name="from_longitude" class="from-long form-control" value="" type="text" placeholder="Longitude" style="width: 161px;" readonly>
                           
                        </div>
                        
                        <div class="form-group form-material col-md-3" style="margin:30px;">
                            <a href="javascript::" class="get-lotitude" data-type="1"> Get Latitude & Longitude</a>
                        </div>
                        <span class="error" id="latitude-error-1" style="display:none">From address Latitude & longitude is required</span>  
                      </div>
                      <div class="form-row" style="margin-top:30px">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">To Address <span class="error">*</span></label>
                            <textarea class="form-control address1" id="inputBasicFirstName" name="to_address" placeholder="" autocomplete="off"></textarea>
                            <span class="error" id="address1" style="display:none">Address is required</span> 
                        </div>                    
                      </div>

                      <div class="form-row">                        
                        <div class="form-group form-material col-md-3"  style="margin-bottom:0px;">
                          <label class="form-control-label" for="inputBasicLastName">To Latitude <span class="error">*</span></label>
                          <input name="to_latitude" class="to-lat form-control" value="" type="text" placeholder="Latitude" style="margin-bottom:10px;" readonly>
                                         
                        </div>
                        <div class="form-group form-material col-md-3"  style="margin-bottom:0px;">
                          <label class="form-control-label" for="inputBasicLastName">To Longitude <span class="error">*</span></label>
                          <input name="to_longitude" class="to-long form-control" value="" type="text" placeholder="Longitude" style="width: 161px;" readonly>
                                             
                        </div> 
                        <div class="form-group form-material col-md-3" style="margin:30px;">
                          <a href="javascript::" class="get-lotitude" data-type="1"> Get Latitude & Longitude</a>
                      </div>
                        <span class="error" id="latitude-error-2" style="display:none"> To address Latitude & longitude is required</span> 
                      </div>  
   
                      <div class="form-row">
                        <div class="form-group form-material col-md-4">
                          <label class="form-control-label" for="inputBasicFirstName">To County <span class="error">*</span></label>
                          <select class="form-control county1" id="to_state_id" name="to_state_id" required>
                              <option value="">Select County</option>
                              @foreach ($stateList as $Sval)
                              <option value="{{ $Sval->id }}">{{ $Sval->state_name }}</option>
                              @endforeach
                          </select>  
                          <span class="error" id="county1" style="display:none">County is required</span> 
                        </div>
                        <div class="form-group form-material col-md-4">
                          <label class="form-control-label" for="inputBasicFirstName">To Neighborhoods <span class="error">*</span></label>
                          <select class="form-control neighborhoods1" id="to_city_id" name="to_city_id">
                              <option value="">Select Neighborhoods</option>
                          </select>  
                          <span class="error" id="neighborhoods1" style="display:none">Neighborhoods is required</span> 
                        </div>
                        <div class="form-group form-material col-md-4">
                          <label class="form-control-label" for="inputBasicLastName">To Postcode <span class="error">*</span></label>
                          <input type="number" class="form-control postcode1" id="select" name="to_postcode" required>
                          <span class="error" id="postcode1" style="display:none">Postcode is required</span> 
                        </div>
                      </div>

                      <div class="form-row">
                      
                        <div class="form-group form-material col-md-12">
                          <label class="form-control-label" for="inputBasicFirstName">Trip Description</label>
                          <textarea class="form-control" id="inputBasicFirstName" name="description_trip" placeholder="" autocomplete="off"></textarea>
                        </div>
                       <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">No of persons  <span class="error">*</span></label>
                          <input type="number" class="form-control no_of_passengers" id="inputBasicFirstName" name="no_of_passengers"
                             autocomplete="off" required/>
                             <span class="error" id="no_of_passengers" style="display:none">No of persons is required</span> 
                        </div>
                      
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">Trip amount <span class="error">*</span></label>
                          <input type="number" class="form-control trip_amount" id="inputBasicFirstName" name="trip_amount"
                             autocomplete="off" required/>
                             <span class="error" id="trip_amount" style="display:none">Trip amount is required</span> 
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
              </div> <!-- End Example Basic Form (Form row) -->
          </form>             
            </div>
          </div>
        </div>
        <!-- End Panel Table Tools -->        
      </div>
    </div>

    <div class="modal fade" id="mapModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Get From Location's Co-ordinates</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" class="type" value="">

            <div class="row col-sm-12">
              <label class="form-control-label" for="inputBasicLastName">Search Location <span class="error">*</span></label>
              <input id="searchTextField" type="text" size="50" class="form-control" style="direction: ltr;">
            </div>
            <div class="row form-material" style="margin-top: 20px;">
              <div class="form-group form-material col-md-6">
                <label class="form-control-label lotitude-label" for="inputBasicLastName">From Latitude <span class="error">*</span></label>
                <input name="latitude" class="MapLat form-control" value="" type="text" placeholder="Latitude" style="margin-bottom:10px;" disabled>
              </div>
              <div class="form-group form-material col-md-6">
                  <label class="form-control-label longitude-label" for="inputBasicLastName">From Longitude <span class="error">*</span></label>
                  <input name="longitude" class="MapLon form-control" value="" type="text" placeholder="Longitude" style="width: 161px;" disabled>
              </div>
            </div>
            <div id="map_canvas" style="height: 350px;width:100%;margin: 0.5em;"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary save-location">Save changes</button>
          </div>
        </div>
      </div>
    </div>

@include('admin.include.footer')
<script src="http://maps.google.com/maps/api/js?libraries=places&region=uk&language=en&sensor=true&key=AIzaSyA4yR0QYbk-PSt19ImAdnw3nKHWfTvhXRo"></script>
<script type="text/javascript">

function myFunction()
{
  $('#trip_time').val('');
}

  $(document).ready(function () {   

  $('.submit-form').on('click',function(e) {
    var email=$('.email').val();
    
    if($('.operator').val()=='')
    {
      $('#operator').css('display','block');
    }else{
      $('#operator').css('display','none');
    }
    
    if($('.address').val()=='')
    {
      $('#address').css('display','block');
    }else{
      $('#address').css('display','none');
    }

    if($('.county').val()=='')
    {
      $('#county').css('display','block');
    }else{
      $('#county').css('display','none');
    }
    if($('.neighborhoods').val()=='')
    {
      $('#neighborhoods').css('display','block');
    }else{
      $('#neighborhoods').css('display','none');
    }

    if($('.postcode').val()=='' || !/^[0-9]+$/.test($('.postcode').val()) || $('.postcode').val().length<6)
    {
      $('#postcode').css('display','block');
    }else{
      $('#postcode').css('display','none');
    }

    if($('.address1').val()=='')
    {
      $('#address1').css('display','block');
    }else{
      $('#address1').css('display','none');
    }

    if($('.to-lat').val()=='')
    {
      $('#latitude-error-2').css('display','block');
    }else{
      $('#latitude-error-2').css('display','none');
    }

    if($('.to-long').val()=='')
    {
      $('#latitude-error-2').css('display','block');
    }else{
      $('#latitude-error-2').css('display','none');
    }

    if($('.from-lat').val()=='')
    {
      $('#latitude-error-1').css('display','block');
    }else{
      $('#latitude-error-1').css('display','none');
    }

    if($('.from-long').val()=='')
    {
      $('#latitude-error-1').css('display','block');
    }else{
      $('#latitude-error-1').css('display','none');
    }


    if($('.county1').val()=='')
    {
      $('#county1').css('display','block');
    }else{
      $('#county1').css('display','none');
    }
    if($('.neighborhoods1').val()=='')
    {
      $('#neighborhoods1').css('display','block');
    }else{
      $('#neighborhoods1').css('display','none');
    }
    if($('.postcode1').val()=='' || !/^[0-9]+$/.test($('.postcode').val()) || $('.postcode').val().length<6)
    {
      $('#postcode1').css('display','block');
    }else{
      $('#postcode1').css('display','none');
    }

    
    if($('.trip_date_time').val()=='' || $('.trip_time').val()=='')
    {
      $('#trip_date_time').css('display','block');
    }else{
      $('#trip_date_time').css('display','none');
    }
    

    if($('.no_of_passengers').val()=='')
    {
      $('#no_of_passengers').css('display','block');
    }else{
      $('#no_of_passengers').css('display','none');
    }

    if($('.trip_amount').val()=='')
    {
      $('#trip_amount').css('display','block');
    }else{
      $('#trip_amount').css('display','none');
    }

    if($('.operator').val()!="" && $('.address').val()!=""  && $('.county').val()!="" && $('.neighborhoods').val()!="" && $('.postcode').val()!="" && $('.address1').val()!="" && $('.county1').val()!="" && $('.neighborhoods1').val()!="" && $('.postcode1').val()!="" && $('.trip_date_time').val()!="" && $('.no_of_passengers').val()!="" && $('.trip_amount').val()!="")
    {
      $('form#add_form').submit();
    }    
    
  });
});
</script>

<script type="text/javascript">
        $(function() {
       //  //-- indi-validation --
       //      $( "#from_state_id").change(function() { 
       //        alert('sdsd');
       //      });
       //      $( "#country_id").change(function() { 
       //          if($( "#country_id" ).val()==''){$("#country_idError").show();}else{$( "#country_idError" ).hide();} 
       //        });
            
       //      $( "#parish_name").keyup(function() { 
       //          if($( "#parish_name" ).val()==''){$("#parish_nameError").show();}else{$( "#parish_nameError" ).hide();} 
       //        });

       $('#from_state_id').on('change',function(e) {
                 
                 var from_state_id = e.target.value;
                 //alert(from_state_id);
                 $.ajax({
                       
                       url:"{{ route('state') }}",
                       type:"get",
                       data: {
                           state_id: from_state_id
                        },
                      
                       success:function (data) {

                        var select = $('#from_city_id').select();
                        select.empty();

                        $('#from_city_id').prepend('<option value="">Select Neighborhoods</option>');
                        $.each(data,function(key, value) {
                            select.append('<option value=' + value.id + '>' + value.city_name + '</option>');
                        });

                       }
                   })
                });

       $('#to_state_id').on('change',function(e) {
                 
                 var to_state_id = e.target.value;
                 //alert(from_state_id);
                 $.ajax({
                       
                       url:"{{ route('state') }}",
                       type:"get",
                       data: {
                           state_id: to_state_id
                        },
                      
                       success:function (data) {

                        var select = $('#to_city_id').select();
                        select.empty();

                        $('#to_city_id').prepend('<option value="">Select Neighborhoods</option>');
                        $.each(data,function(key, value) {
                            select.append('<option value=' + value.id + '>' + value.city_name + '</option>');
                        });

                       }
                   })
                });


      });

      $('.get-lotitude').click(function(){
       
        $('#mapModal').modal('show');
        var ltype=$(this).attr('data-type');
        if(ltype==2){
          $('.modal-title').html("Get To Location's Co-ordinates");         
          $('.lotitude-label').html('To Latitude');
          $('.longitude-label').html('To Longitude');
        }
        if(ltype==1){
          $('.modal-title').html("Get From Location's Co-ordinates");
          $('.lotitude-label').html('From Latitude');
          $('.longitude-label').html('From Longitude');
        }
        $('.type').val(ltype);
        //Google  map
         var lat = 44.88623409320778,
             lng = -87.86480712897173,
             latlng = new google.maps.LatLng(lat, lng),
             image = 'http://www.google.com/intl/en_us/mapfiles/ms/micons/blue-dot.png';

         //zoomControl: true,
         //zoomControlOptions: google.maps.ZoomControlStyle.LARGE,

         var mapOptions = {
             center: new google.maps.LatLng(lat, lng),
             zoom: 13,
             mapTypeId: google.maps.MapTypeId.ROADMAP,
             panControl: true,
             panControlOptions: {
                 position: google.maps.ControlPosition.TOP_RIGHT
             },
             zoomControl: true,
             zoomControlOptions: {
                 style: google.maps.ZoomControlStyle.LARGE,
                 position: google.maps.ControlPosition.TOP_left
             }
         },
         map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions),
             marker = new google.maps.Marker({
                 position: latlng,
                 map: map,
              
                 //animation: google.maps.Animation.DROP,
                 icon: image
             });

         var input = document.getElementById('searchTextField');
         var autocomplete = new google.maps.places.Autocomplete(input, {
             types: ["geocode"]
         });

         autocomplete.bindTo('bounds', map);
         var infowindow = new google.maps.InfoWindow();

         google.maps.event.addListener(autocomplete, 'place_changed', function (event) {
             infowindow.close();
             var place = autocomplete.getPlace();
             if (place.geometry.viewport) {
                 map.fitBounds(place.geometry.viewport);
             } else {
                 map.setCenter(place.geometry.location);
                 map.setZoom(17);
             }

             moveMarker(place.name, place.geometry.location);
             $('.MapLat').val(place.geometry.location.lat());
             $('.MapLon').val(place.geometry.location.lng());
         });
         
         google.maps.event.addListener(map, 'click', function (event) {
          
             $('.MapLat').val(event.latLng.lat());
             $('.MapLon').val(event.latLng.lng());
             infowindow.close();
                     var geocoder = new google.maps.Geocoder();
                     geocoder.geocode({
                         "latLng":event.latLng
                     }, function (results, status) {
                         console.log(results, status);
                         if (status == google.maps.GeocoderStatus.OK) {
                             console.log(results);
                             var lat = results[0].geometry.location.lat(),
                                 lng = results[0].geometry.location.lng(),
                                 placeName = results[0].address_components[0].long_name,
                                 latlng = new google.maps.LatLng(lat, lng);

                             moveMarker(placeName, latlng);
                             $("#searchTextField").val(results[0].formatted_address);
                         }
                     });
         });

         function moveMarker(placeName, latlng) {
             marker.setIcon(image);
             marker.setPosition(latlng);
             infowindow.setContent(placeName);
             //infowindow.open(map, marker);
         }

     });
  
    $('.save-location').on('click',function(){
      var lat= $('.MapLat').val();
      var long= $('.MapLon').val();
      var type= $('.type').val();
      if(type==1){
        $('.from-lat').val(lat);
        $('.from-long').val(long);
      }
      else if(type==2){
        $('.to-lat').val(lat);
        $('.to-long').val(long);
      }
      $('#mapModal').modal('hide');
    });

     </script>
@endsection