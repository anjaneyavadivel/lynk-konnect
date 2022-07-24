@extends('admin.layouts.app')


@section('content')

@include('admin.include.header')


@include('admin.include.sidebar')  

<div class="page">
      <div class="page-header">
        <h1 class="page-title">Roles Management</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="">Roles Management</a></li>
          <!-- <li class="breadcrumb-item active">DataTables</li> -->
        </ol>
         @can('role-create')
        <div class="page-header-actions">
          <a class="btn btn-sm btn-primary btn-round" href="{{ route('roles.create') }}">
        <i class="icon md-plus" aria-hidden="true"></i>
        <span class="hidden-sm-down">Add Roles</span>
      </a>
        </div>
        @endcan

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
            <table class="table table-hover dataTable table-striped w-full" id="exampleTableTools">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
                 @php $i=0 @endphp
                 @foreach ($roles as $key => $role)
                <tr>
                  <td>{{ ++$i }}</td>

                <td>{{ $role->name }}</td>

                <td>

                   <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Show</a>

                    @can('role-edit')

                        <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>

                    @endcan

                    @can('role-delete')

                        {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}

                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}

                        {!! Form::close() !!}

                    @endcan

                   

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
@endsection