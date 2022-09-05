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
        <h1 class="page-title">Transaction Management</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="">Transaction</a></li>
          <!-- <li class="breadcrumb-item active">DataTables</li> -->
        </ol>
        <!-- <div class="page-header-actions">
          <a class="btn btn-sm btn-primary btn-round" href="{{ url('add_trip') }}">
        <i class="icon md-plus" aria-hidden="true"></i>
        <span class="hidden-sm-down">Add Trip</span>
      </a>
        </div> -->
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
                  <th>Transaction Id</th>
                  <th>Trip Id</th>
                  <th>Operator</th>
                  <th>Trasaction Date</th>
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
                 @php $i=0 @endphp
                 @foreach ($list as $key => $val)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $val->uniq_id }}</td>
                  <td>{{ $val->trip_id }}</td>
                  <td>{{ $val->company_name }}</td>
                  <td>{{ date('d-m-Y',strtotime($val->created_at)) }}</td>
                  <td>{{ $val->trip_amount }} </td>
                  <td>@if($val->status==1) Unpaid @else Paid @endif</td>
                  <td>
                    @if($val->status==1)
                    <form method="POST" action="{{ url('pay_trip') }}">
                      @csrf
                      <input type="hidden" value="{{$val->id}}" name="id">
                      <input type="hidden" value="2" name="pay_status">
                     <button tyep="submit" class="btn btn-primary" style="margin: 6px;">Pay</button>
                    </form>
                     @else - @endif
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
                    columns: [ 0,1,2,3,4 ,5]
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
                  columns: [ 0,1,2,3,4,5]
                }
            },
  
        ]
    } );
  } );
  </script>
@endsection