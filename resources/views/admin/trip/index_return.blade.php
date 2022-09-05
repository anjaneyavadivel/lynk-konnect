@extends('admin.layouts.app')


@section('content')

@include('admin.include.header')


@include('admin.include.sidebar')  


<div class="page">
      <div class="page-header">
        <h1 class="page-title">Return Trip</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Dashboard</li>
          <li class="breadcrumb-item">Manage Own Trip</li>
          <li class="breadcrumb-item"><a href="">Return Trip</a></li>
          <!-- <li class="breadcrumb-item active">DataTables</li> -->
        </ol>
        
      </div>

      <div class="page-content">        
        <!-- Panel Table Tools -->
        <div class="panel">
        <form action="{{route('return_trip', $id)}}" method="POST">
          @csrf
          <div class="form-row"style="margin-left: 26px;">
            <div class="form-group form-material col-md-4" style="margin-top: 12px;"> 
            <label class="form-control-label" for="inputBasicFirstName">Distance (KM)</label>                       
            <select class="form-control" id="distence" name="distence">
                <option value="">Select distance</option>
                <option value="10" @if($distence==10) selected @endif>10</option>
                <option value="20" @if($distence==20) selected @endif>20</option>
                <option value="30" @if($distence==30) selected @endif>30</option>
                <option value="50" @if($distence==50) selected @endif>50</option>
                <option value="100" @if($distence==100) selected @endif>100</option>
              </select>                         
          </div>
          <div class="form-group form-material col-md-4" style="margin-top: 30px;">   
          <button type="submit" class="btn btn-primary submit-form waves-effect waves-classic">Submit</button>
          </div>
        </div>
        
        </form>
          <!-- <header class="panel-heading">
            <h3 class="panel-title">Users Management</h3>
          </header> -->
          <div class="panel-body">

          

            @if ($message = Session::get('success'))
            <div class="alert alert-success">
              <p>{{ $message }}</p>
            </div>
            @endif
            
            <table class="table table-hover dataTable table-striped w-full" id="">
              <thead>
                <tr>
                  <th>SNo</th>
                  <th>Trip Date</th>
                  <th>Trip Time</th>
                  <th>Boarding</th>
                  <th>Destination</th>
                  <th>Posted by</th>                  
                  <th>Passengers count</th>
                  <th>Amount</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <!-- <tfoot>
                <tr>
                  <th>No</th>
                  <th>Company Name</th>
                  <th>Action</th>
                </tr>
              </tfoot> -->
              <tbody>
              @if($list)
                 @php $i=0 @endphp
                 @foreach ($list as $key => $val)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ date('d-m-Y',strtotime($val->trip_date)) }}</td>                  
                  <td>{{ date('H:i a',strtotime($val->trip_time)) }}</td>
                  <td>{{ $val->from_address }} <br> {{$val->f_state_name }}</td>
                  <td>{{ $val->to_address }} <br> {{ $val->t_state_name }}</td>
                  <td>{{ $val->owner_fname }}</td>
                  <td>{{ $val->no_of_passengers }}</td>
                  <td>{{ $val->trip_amount}}</td>
                  <td>
                  <?php if($val->trip_status == 1){ echo "New Trip"; } ?>
                  <?php  if($val->trip_status == 2){ echo 'Inprogress';} ?>
                  <?php  if($val->trip_status == 3){ echo 'Completed Trip';} ?>
                  <?php  if($val->trip_status == 4){ echo 'Return Trip';} ?>
                  </td>
                  <td>
                     <a class="btn btn-primary" href="{{ url('show_trip/'. $val->id)}}">View</a>
                     @if($val->trip_date > date('Y-m-d'))<a class="btn btn-primary" href="{{ url('edit_trip/'. $val->id)}}">Edit</a>@endif
                  </td>
                </tr>
                @endforeach
                @else
                <tr>
                  <td colspan="5">No data found</td>
                </tr>
                @endif
              </tbody>
            </table>
          </div>
        </div>
        <!-- End Panel Table Tools -->
        
      </div>

      <div class="page-content">        
        <!-- Panel Table Tools -->
        <div class="panel">
          <header class="panel-heading">
            <h3 class="panel-title">Suggestion Trip</h3>
          </header>
          <div class="panel-body">            
            <table class="table table-hover dataTable table-striped w-full" id="">
              <thead>
                <tr>
                  <th>SNo</th>
                  <th>Trip Date</th>
                  <th>Trip Time</th>
                  <th>Boarding</th>
                  <th>Destination</th>
                  <th>Posted by</th>                  
                  <th>Passengers count</th>
                  <th>Amount</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <!-- <tfoot>
                <tr>
                  <th>No</th>
                  <th>Company Name</th>
                  <th>Action</th>
                </tr>
              </tfoot> -->
              <tbody>
              @if($suggestion_trip)
                 @php $i=0 @endphp
                 @foreach ($suggestion_trip as $key => $val)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ date('d-m-Y',strtotime($val->trip_date)) }}</td>                  
                  <td>{{ date('H:i a',strtotime($val->trip_time)) }}</td>
                  <td>{{ $val->from_address }} <br> {{$val->f_state_name }}</td>
                  <td>{{ $val->to_address }} <br> {{ $val->t_state_name }}</td>
                  <td>{{ $val->owner_fname }}</td>
                  <td>{{ $val->no_of_passengers }}</td>
                  <td>{{ $val->trip_amount}}</td>
                  <td>
                  <?php if($val->trip_status == 1){ echo "New Trip"; } ?>
                  <?php  if($val->trip_status == 2){ echo 'Inprogress';} ?>
                  <?php  if($val->trip_status == 3){ echo 'Completed Trip';} ?>
                  <?php  if($val->trip_status == 4){ echo 'Return Trip';} ?>
                  </td>
                  <td>
                     <a class="btn btn-primary" href="{{ url('show_trip/'. $val->id)}}">View</a>
                     @if($val->trip_date > date('Y-m-d'))<a class="btn btn-primary" href="{{ url('edit_trip/'. $val->id)}}">Edit</a>@endif
                  </td>
                </tr>
                @endforeach
                @else
                <tr>
                  <td colspan="9">No data found</td>
                </tr>
                @endif
              </tbody>
            </table>
          </div>
        </div>
        <!-- End Panel Table Tools -->
        
      </div>
    </div>

@include('admin.include.footer')
<script>
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'print','copy'
        ]
    } );

    $('#example1').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'print','copy'
        ]
    } );
} );
  </script>
@endsection