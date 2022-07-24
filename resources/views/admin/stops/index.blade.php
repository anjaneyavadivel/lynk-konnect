@extends('admin.layouts.app')


@section('content')

@include('admin.include.header')


@include('admin.include.sidebar')  

<div class="page">
      <div class="page-header">
        <h1 class="page-title">Stops Management</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="">Stops Management</a></li>
          <!-- <li class="breadcrumb-item active">DataTables</li> -->
        </ol>
        <div class="page-header-actions">
          <a class="btn btn-sm btn-primary btn-round" href="{{ url('add_stop') }}">
        <i class="icon md-plus" aria-hidden="true"></i>
        <span class="hidden-sm-down">Add Stops</span>
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
            <div>
              <select class="form-control" id="route_id" name="route_id">
                <option value="0">Select</option>
                  @foreach ($routeList as $rval)
                    <option value="{{ $rval->id }}"<?php if($rval->id==$route_id){echo 'selected';}?>>{{ $rval->route_name }}</option>
                  @endforeach
              </select>
              <a class="btn btn-primary" href="{{ url('edit_stop/'.$route_id)}}">Edit</a>
            </div>
            
            <table class="table table-hover dataTable table-striped w-full" id="exampleTableTools">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Stops</th>
                </tr>
              </thead>
              
              <tbody>
                 @php $i=0 @endphp
                 @foreach ($list as $key => $val)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $val->state_name }}</td>
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
  <script type="text/javascript">
    $(function() {
      $('#route_id').on('change',function(e) {
        var route_id = $('#route_id').val();
       
       
       window.location = 'http://localhost/lynk-konnect-v1/manage_stop/'+route_id;


      });
    });
  </script>
@endsection