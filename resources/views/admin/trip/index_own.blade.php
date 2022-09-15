@extends('admin.layouts.app')


@section('content')

@include('admin.include.header')


@include('admin.include.sidebar')  
<style>
  @media print {
      table td:last-child {display:none}
      table th:last-child {display:none}
  }
</style>

<?php use App\Http\Controllers\Admin\TripController; ?>

<div class="page">
      <div class="page-header">
        <h1 class="page-title">Trip Own Management</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="">Trip Own Management</a></li>
          <!-- <li class="breadcrumb-item active">DataTables</li> -->
        </ol>
        <div class="page-header-actions">
          <a class="btn btn-sm btn-primary btn-round" href="{{ url('add_trip') }}">
        <i class="icon md-plus" aria-hidden="true"></i>
        <span class="hidden-sm-down">Add Trip</span>
      </a>
        </div>
      </div>

      <div class="page-content">
        
        <!-- Panel Table Tools -->
        <div class="panel">
          <!-- <header class="panel-heading">
            <h3 class="panel-title">Users Management</h3>
          </header> -->
          <div class="panel-body">
 @if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif
            <table class="table table-hover dataTable table-striped w-full" id="example">
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
                  <?php if($val->trip_status == 1){ echo "Active"; } ?>
                  <?php  if($val->trip_status == 2){ echo'Trip taken by '.$val->takenby;} ?>
                  <?php  if($val->trip_status == 3){ echo 'Trip Completed';} ?>
                  <?php  if($val->trip_status == 4){ echo 'Return Trip';} ?>   
                  </td>
                  <td>
                     <a class="btn btn-primary" href="{{ url('show_trip/'. $val->id)}}">View</a>
                     @if($val->trip_date > date('Y-m-d')) @if($val->trip_status==3)<a class="btn btn-primary" href="{{ url('edit_trip/'. $val->id)}}">Edit</a>@endif @endif
                     @if($val->trip_status==1)
                     <form method="POST" action="{{ url('complete_trip') }}">
                      @csrf
                      <input type="hidden" value="{{$val->id}}" name="id">
                      <input type="hidden" value="2" name="trip_status">
                     <button tyep="submit" class="btn btn-primary" style="margin: 6px;">Take Trip</button>
                    </form>
                     @elseif($val->trip_status==2)
                     <form method="POST" action="{{ url('complete_trip') }}">
                      @csrf
                      <input type="hidden" value="{{$val->id}}" name="id">
                      <input type="hidden" value="3" name="trip_status">
                     <button tyep="submit" class="btn btn-primary" style="margin: 6px;">Complete Trip</button>
                    </form>                     
                    @endif
                    @if($val->trip_date>=date('Y-m-dd'))
                     <a class="btn btn-primary" href="{{ url('return_trip/'. $val->id)}}" style="margin: 6px;">Return Trip</a>
                   
                     @endif
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
    </div>

@include('admin.include.footer')
<script>
  $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [  0,1,2,3,4,5,6,7]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'csvHtml5',
                exportOptions: {
                  columns: [ 0,1,2,3,4,5,6,7]
                }
            },
  
        ]
    } );
  } );
  </script>
@endsection