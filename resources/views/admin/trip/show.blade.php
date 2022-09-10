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

                    <form method="POST" action="{{ url('add_trip') }}">
                      @csrf
                      <div class="form-row">
                        <div class="form-group form-material col-md-4">
                          <label class="form-control-label" for="inputBasicFirstName">Operator</label>
                          <!-- <input type="text" class="form-control" id="inputBasicFirstName" name="company_name"
                            placeholder="" autocomplete="off" /> -->
                           <select class="form-control" id="select" name="trip_owner_company_id">
                              <option value="">Select</option>
                              @foreach ($companyList as $Cval)
                              <option value="{{ $Cval->id }}" <?php if($list->trip_owner_company_id == $Cval->id){ echo 'selected';}?>>{{ $Cval->company_name }}</option>
                              @endforeach
                            </select>
                        </div>

                        <div class="form-row col-md-4">
                          <div class="form-group form-material col-md-12" style="margin-bottom:0px">
                            <label class="form-control-label" for="inputBasicFirstName">Trip Date <span class="error">*</span></label>
                          </div>
                          <div class="example" style="margin-bottom:0px; margin-top:0px;">
                            <div class="input-group">
                              <span class="input-group-addon">
                                <i class="icon md-calendar" aria-hidden="true"></i>
                              </span>
                              <input data-date-format="dd-mm-yyyy" readonly type="text" pattern="([0-9]{2})\/([0-9]{2})\/([0-9]{4})" class="form-control trip_date_time" data-plugin="datepicker" name="trip_date" id="trip_date" value="{{ $list->trip_date }}">
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
                              <input type="text" class="form-control trip_time" data-plugin="timepicker" name="trip_time" id="trip_time" onkeyup="myFunction()"  value="{{ $list->trip_time }}"/>
                            </div>
                          </div>
                        </div>
                        <input type="hidden" class="form-control" name="trip_date" id="trip_date" value="<?php echo $list->trip_date; ?>">
                      <input type="hidden" class="form-control" name="trip_time" id="trip_time" value="<?php echo $list->trip_time; ?>">
                          <span class="error" id="trip_date_time" style="display:none">Trip Date/Time is required</span> 
                          @if($list->trip_status==4)
                        <button id="confirm_trip" class="btn btn-primary animation-scale-up waves-effect waves-classic">Click here to confirm the trip</button>
                        @endif
                      </div>

                      <div class="form-row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">From Address</label>
                            <textarea class="form-control" id="inputBasicFirstName" name="from_address" placeholder="" autocomplete="off"><?php echo $list->from_address; ?></textarea>
                        </div>
                        
                      </div>

                      <div class="form-row">
                        <div class="form-group form-material col-md-4">
                          <label class="form-control-label" for="inputBasicFirstName">From County</label>
                          <select class="form-control" id="select" name="from_state_id">
                              <option value="">Select</option>
                              @foreach ($stateList as $Sval)
                              <option value="{{ $Sval->id }}" <?php if($list->from_state_id == $Sval->id){ echo 'selected';}?>>{{ $Sval->state_name }}</option>
                              @endforeach
                          </select>  
                        </div>                        
                        <div class="form-group form-material col-md-4">
                          <label class="form-control-label" for="inputBasicFirstName">From Neighborhoods</label>
                          <select class="form-control" id="select" name="from_city_id">
                              <option value="">Select</option>
                              @foreach ($companyList as $Cval)
                              <option value="{{ $Cval->id }}" <?php if($list->from_state_id == $Sval->id){ echo 'selected';}?>>{{ $Cval->company_name }}</option>
                              @endforeach
                          </select>  
                        </div>
                        <input type="hidden" name="from_city_id" value="{{$list->from_city_id}}">
                        <div class="form-group form-material col-md-4">
                          <label class="form-control-label" for="inputBasicLastName">From Postcode</label>
                          <input type="text" class="form-control" id="select" name="from_postcode" value="<?php  echo $list->from_postcode; ?>">
                              
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group form-material col-md-3" style="margin-bottom:0px;">
                          <label class="form-control-label" for="inputBasicLastName">From Latitude <span class="error">*</span></label>
                          <input name="from_latitude" class="from-lat form-control" required value="<?php  echo $list->from_latitude; ?>" type="text" placeholder="Latitude" style="margin-bottom:10px;" readonly >
                                             
                        </div>
                        <div class="form-group form-material col-md-3"  style="margin-bottom:0px;">
                            <label class="form-control-label" for="inputBasicLastName">From Longitude <span class="error">*</span></label>
                            <input name="from_longitude" class="from-long form-control" required value="<?php  echo $list->from_longitude; ?>" type="text" placeholder="Longitude" style="width: 161px;" readonly>
                            <input type="hidden" name="map_from_address" id="map_from_address" value="<?php  echo $list->map_from_address; ?>"> 
                        </div>
                        
                        <div class="form-group form-material col-md-3" style="margin:30px;">
                            <a href="javascript::" class="get-lotitude" data-type="1"> Get Latitude & Longitude</a>
                        </div>
                        <span class="error" id="latitude-error-1" style="display:none">From address Latitude & longitude is required</span>  
                      </div>


                      <div class="form-row">
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">To Address</label>
                            <textarea class="form-control" id="inputBasicFirstName" name="to_address" placeholder="" autocomplete="off"><?php  echo $list->to_address; ?></textarea>
                        </div>
                       
                      </div>

                      <div class="form-row">
                        <div class="form-group form-material col-md-4">
                          <label class="form-control-label" for="inputBasicFirstName">To County</label>
                          <select class="form-control" id="select" name="to_state_id">
                              <option value="">Select</option>
                              @foreach ($stateList as $STval)
                              <option value="{{ $STval->id }}" <?php if($list->to_state_id == $STval->id){ echo 'selected';}?>>{{ $STval->state_name }}</option>
                              @endforeach
                          </select>  
                        </div>
                        <div class="form-group form-material col-md-4">
                          <label class="form-control-label" for="inputBasicFirstName">To Neighborhoods</label>
                          <select class="form-control" id="select" name="to_city_id">
                              <option value="">Select</option>
                              @foreach ($companyList as $Cval)
                              <option value="{{ $Cval->id }}" <?php if($list->to_state_id == $STval->id){ echo 'selected';}?>>{{ $Cval->company_name }}</option>
                              @endforeach
                          </select>  
                        </div>
                        <input type="hidden" name="to_city_id" value="{{$list->to_city_id}}">
                        <div class="form-group form-material col-md-4">
                          <label class="form-control-label" for="inputBasicLastName">To Postcode</label>
                          <input type="text" class="form-control" id="select" name="to_postcode" value="<?php echo $list->to_postcode; ?>">
                              
                        </div>
                      </div>
                      <div class="form-row">                        
                        <div class="form-group form-material col-md-3"  style="margin-bottom:0px;">
                          <label class="form-control-label" for="inputBasicLastName">To Latitude <span class="error">*</span></label>
                          <input name="to_latitude" class="to-lat form-control" required value="<?php  echo $list->to_latitude; ?>" type="text" placeholder="Latitude" style="margin-bottom:10px;" readonly>
                                         
                        </div>
                        <div class="form-group form-material col-md-3"  style="margin-bottom:0px;">
                          <label class="form-control-label" for="inputBasicLastName">To Longitude <span class="error">*</span></label>
                          <input name="to_longitude" class="to-long form-control" required
                           value="<?php  echo $list->to_longitude; ?>" type="text" placeholder="Longitude" style="width: 161px;" readonly>
                           <input type="hidden" name="map_to_address" id="map_to_address" value="<?php  echo $list->map_to_address; ?>">                  
                        </div> 
                        <div class="form-group form-material col-md-3" style="margin:30px;">
                          <a href="javascript::" class="get-lotitude" data-type="2"> Get Latitude & Longitude</a>
                      </div>
                        <span class="error" id="latitude-error-2" style="display:none"> To address Latitude & longitude is required</span> 
                      </div>  

                      <div class="form-row">
                        
                        <div class="form-group form-material col-md-12">
                          <label class="form-control-label" for="inputBasicFirstName">Trip Description</label>
                          <textarea class="form-control" id="inputBasicFirstName" name="description_trip" placeholder="" autocomplete="off"><?php echo $list->description_trip; ?></textarea>
                        </div>
                       <div class="form-group form-material col-md-4">
                          <label class="form-control-label" for="inputBasicFirstName">No of persons  <span class="error">*</span></label>
                          <input type="number" class="form-control no_of_passengers" id="inputBasicFirstName" name="no_of_passengers" value="<?php echo $list->no_of_passengers; ?>"
                             autocomplete="off" required />
                             <span class="error" id="no_of_passengers" style="display:none">No of persons is required</span> 
                        </div>
                      
                        <div class="form-group form-material col-md-4">
                          <label class="form-control-label" for="inputBasicFirstName">Trip amount <span class="error">*</span></label>
                          <input type="number" class="form-control trip_amount" id="inputBasicFirstName" name="trip_amount"
                             autocomplete="off" required value="<?php echo $list->trip_amount; ?>" />
                             <span class="error" id="trip_amount" style="display:none">Trip amount is required</span> 

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
       $(function() {
        
        $( "#confirm_trip").change(function() { 
                alert('sdsd');
              });
        //-- indi-validation --
            $( "#country_id").change(function() { 
                if($( "#country_id" ).val()==''){$("#country_idError").show();}else{$( "#country_idError" ).hide();} 
              });
            
            $( "#parish_name").keyup(function() { 
                if($( "#parish_name" ).val()==''){$("#parish_nameError").show();}else{$( "#parish_nameError" ).hide();} 
              });

      });
      $('.get-lotitude').click(function(){
       
       $('#mapModal').modal('show');
       var ltype=$(this).attr('data-type');
       if(ltype==2){
         $('.modal-title').html("Get To Location's Co-ordinates");         
         $('.lotitude-label').html('To Latitude');
         $('.longitude-label').html('To Longitude');
         var laat=$('.to-lat').val();
         var long=$('.to-long').val();
         var searchTextField= $('#map_to_address').val();

       }
       if(ltype==1){
         $('.modal-title').html("Get From Location's Co-ordinates");
         $('.lotitude-label').html('From Latitude');
         $('.longitude-label').html('From Longitude');
         var laat=$('.from-lat').val();
         var long=$('.from-long').val();
         var searchTextField= $('#map_from_address').val();
       }
       $('.MapLat').val(laat);
       $('.MapLon').val(long);
       $('#searchTextField').val(searchTextField);
       $('.type').val(ltype);
       //Google  map
        var lat = laat,
            lng =long,
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
     var searchTextField= $('#searchTextField').val();
     if(type==1){
       $('.from-lat').val(lat);
       $('.from-long').val(long);
       $('#map_from_address').val(searchTextField);
     }
     else if(type==2){
       $('.to-lat').val(lat);
       $('.to-long').val(long);
       $('#map_to_address').val(searchTextField);
     }
     $('#mapModal').modal('hide');
   });
     </script>
@endsection