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

<div class="page">
      <div class="page-header">
        <h1 class="page-title">Driver Management</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="">Driver Management</a></li>
          <!-- <li class="breadcrumb-item active">DataTables</li> -->
        </ol>
        <div class="page-header-actions">
          <a class="btn btn-sm btn-primary btn-round" href="{{ url('add_driver') }}">
        <i class="icon md-plus" aria-hidden="true"></i>
        <span class="hidden-sm-down">Add Driver</span>
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
                  <th>No</th>
                  <th>Company Name</th>
                  <th>Name</th>
                  <th>Eamil</th>
                  <th>Contact Number</th>
                  <th>Action</th>
                </tr>
              </thead>
             
              <tbody>
                 @php $i=0 @endphp
                 @foreach ($list as $key => $val)               
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $val->company_name }}</td>
                  <td>{{ $val->fname }} {{ $val->lname }}</td>
                  <td>{{ $val->email }}</td>
                  <td>{{ $val->contactnumber }}</td>            
                  <td>
                     <a class="btn btn-primary" href="{{ url('edit_driver/'. $val->driverid)}}">Edit</a>
                  </td>
                </tr>
                @endforeach
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
                    columns: [ 0,1,2,3,4 ]
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
                  columns: [ 0,1,2,3,4]
                }
            },
  
        ]
    } );
  } );
  </script>
@endsection