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
        <h1 class="page-title">Users Management</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="">Users Management</a></li>
          <!-- <li class="breadcrumb-item active">DataTables</li> -->
        </ol>
        <div class="page-header-actions">
          <a class="btn btn-sm btn-primary btn-round" href="{{ url('add_user') }}">
        <i class="icon md-plus" aria-hidden="true"></i>
        <span class="hidden-sm-down">Add Users</span>
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
<!--  @if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif -->
@include('admin.flash-message')
            <table class="table table-hover dataTable table-striped w-full" id="example">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Company</th>
                  <th>Roles</th>
                  <th class="not-export-col">Action</th>
                </tr>
              </thead>
              <!-- <tfoot>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Company</th>
                  <th>Roles</th>
                  <th>Action</th>
                </tr>
              </tfoot> -->
              <tbody>
                 @php $i=0 @endphp
                 @foreach ($list as $key => $user)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $user->fname }} {{ $user->lname }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->company_name }}</td>
                  <td>{{ $user->role_name}}</td>
                  <td class="not-export-col">
                    @if($user->role_id==1)
                       <a class="btn btn-primary" href="{{ url('edit_driver/'. $user->driverid)}}">Edit</a>
                    @else
                    <a class="btn btn-primary" href="{{ url('edit_user/'. $user->id)}}">Edit</a>
                    @endif
                   
                    <!-- {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}

            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}

        {!! Form::close() !!} -->
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
<!-- <script type="text/javascript">
  $('#exampleTableTools').dataTable( {
  "pageLength": 10
} );  
</script> -->
<script>
 $(document).ready(function() {
  $('#example').DataTable( {
      dom: 'Bfrtip',
      buttons: [
          {
              extend: 'copyHtml5',
              exportOptions: {
                  columns: [ 0,1,2,3,4]
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