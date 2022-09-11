@extends('admin.layouts.app')
@section('content')

    @include('admin.include.header')

    @include('admin.include.sidebar')    
    
    <!-- Page -->
    <div class="page">
      <div class="page-content container-fluid">
        <div class="row" data-plugin="matchHeight" data-by-row="true">
          @php $user_info=Auth::user()->role_id; @endphp
          @can('user-list')             
          @if($user_info==0 || $user_info==3)
          <div class="col-xl-3 col-md-6">
            <!-- Widget Linearea One-->
            <div class="card card-shadow" id="widgetLineareaOne">
              <div class="card-block p-20 pt-10">
                <div class="clearfix">
                  <div class="grey-800 float-left py-10">
                    <i class="icon md-account grey-600 font-size-24 vertical-align-bottom mr-5"></i>USER
                  </div>
                  <span class="float-right grey-700 font-size-30">{{ $usercount}}</span>
                </div>
               
                <div class="ct-chart h-50"></div>
              </div>
            </div>
            <!-- End Widget Linearea One -->
          </div>
          @endif
          @endcan
          @if($user_info==0 || $user_info==3)
          <div class="col-xl-3 col-md-6">
            <!-- Widget Linearea Two -->
            <div class="card card-shadow" id="widgetLineareaTwo">
              <div class="card-block p-20 pt-10">
                <div class="clearfix">
                  <div class="grey-800 float-left py-10">
                    <i class="icon md-flash grey-600 font-size-24 vertical-align-bottom mr-5"></i>COMPANY
                  </div>
                  <span class="float-right grey-700 font-size-30"> {{ $companycount}}</span>
                </div>
                
                <div class="ct-chart h-50"></div>
              </div>
            </div>
            <!-- End Widget Linearea Two -->
          </div>
          @endif

          @if($user_info==0 || $user_info==3 || $user_info==2)
          <div class="col-xl-3 col-md-6">
            <!-- Widget Linearea Three -->
            <div class="card card-shadow" id="widgetLineareaThree">
              <div class="card-block p-20 pt-10">
                <div class="clearfix">
                  <div class="grey-800 float-left py-10">
                    <i class="icon md-chart grey-600 font-size-24 vertical-align-bottom mr-5"></i>DRIVER
                  </div>
                  <span class="float-right grey-700 font-size-30">{{ $divercount}}</span>
                </div>
                
                <div class="ct-chart h-50"></div>
              </div>
            </div>
            <!-- End Widget Linearea Three -->
          </div>
          @endif
        
          <div class="col-xl-3 col-md-6">
            <!-- Widget Linearea Four -->
            <div class="card card-shadow" id="widgetLineareaFour">
              <div class="card-block p-20 pt-10">
                <div class="clearfix">
                  <div class="grey-800 float-left py-10">
                    <i class="icon md-view-list grey-600 font-size-24 vertical-align-bottom mr-5"></i> TRIPS</div>
                  <span class="float-right grey-700 font-size-30">{{ $tripcount}}</span>
                </div>
                
                <div class="ct-chart h-50"></div>
              </div>
            </div>
            <!-- End Widget Linearea Four -->
          </div>
       
        </div>
      </div>
    </div>
    <!-- End Page -->

    @include('admin.include.footer')
    

@endsection