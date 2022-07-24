@extends('admin.layouts.app')


@section('content')

    @include('admin.include.header')

    @include('admin.include.sidebar')    
    
    <!-- Page -->
    <div class="page">
      <div class="page-content container-fluid">
        <div class="row" data-plugin="matchHeight" data-by-row="true">
          <div class="col-xl-3 col-md-6">
            <!-- Widget Linearea One-->
            <div class="card card-shadow" id="widgetLineareaOne">
              <div class="card-block p-20 pt-10">
                <div class="clearfix">
                  <div class="grey-800 float-left py-10">
                    <i class="icon md-account grey-600 font-size-24 vertical-align-bottom mr-5"></i>                    User
                  </div>
                  <span class="float-right grey-700 font-size-30">1,253</span>
                </div>
                <div class="mb-20 grey-500">
                  <i class="icon md-long-arrow-up green-500 font-size-16"></i>                  15% From this yesterday
                </div>
                <div class="ct-chart h-50"></div>
              </div>
            </div>
            <!-- End Widget Linearea One -->
          </div>
          <div class="col-xl-3 col-md-6">
            <!-- Widget Linearea Two -->
            <div class="card card-shadow" id="widgetLineareaTwo">
              <div class="card-block p-20 pt-10">
                <div class="clearfix">
                  <div class="grey-800 float-left py-10">
                    <i class="icon md-flash grey-600 font-size-24 vertical-align-bottom mr-5"></i>                    VISITS
                  </div>
                  <span class="float-right grey-700 font-size-30">2,425</span>
                </div>
                <div class="mb-20 grey-500">
                  <i class="icon md-long-arrow-up green-500 font-size-16"></i>                  34.2% From this week
                </div>
                <div class="ct-chart h-50"></div>
              </div>
            </div>
            <!-- End Widget Linearea Two -->
          </div>
          <div class="col-xl-3 col-md-6">
            <!-- Widget Linearea Three -->
            <div class="card card-shadow" id="widgetLineareaThree">
              <div class="card-block p-20 pt-10">
                <div class="clearfix">
                  <div class="grey-800 float-left py-10">
                    <i class="icon md-chart grey-600 font-size-24 vertical-align-bottom mr-5"></i>                    Total Clicks
                  </div>
                  <span class="float-right grey-700 font-size-30">1,864</span>
                </div>
                <div class="mb-20 grey-500">
                  <i class="icon md-long-arrow-down red-500 font-size-16"></i>                  15% From this yesterday
                </div>
                <div class="ct-chart h-50"></div>
              </div>
            </div>
            <!-- End Widget Linearea Three -->
          </div>
          <div class="col-xl-3 col-md-6">
            <!-- Widget Linearea Four -->
            <div class="card card-shadow" id="widgetLineareaFour">
              <div class="card-block p-20 pt-10">
                <div class="clearfix">
                  <div class="grey-800 float-left py-10">
                    <i class="icon md-view-list grey-600 font-size-24 vertical-align-bottom mr-5"></i>                    Items
                  </div>
                  <span class="float-right grey-700 font-size-30">845</span>
                </div>
                <div class="mb-20 grey-500">
                  <i class="icon md-long-arrow-up green-500 font-size-16"></i>                  18.4% From this yesterday
                </div>
                <div class="ct-chart h-50"></div>
              </div>
            </div>
            <!-- End Widget Linearea Four -->
          </div>

         

         
          <div class="col-xxl-5 col-lg-6">
            <!-- Panel Projects -->
            <div class="panel" id="projects">
              <div class="panel-heading">
                <h3 class="panel-title">Projects</h3>
              </div>
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <td>Projects</td>
                      <td>Completed</td>
                      <td>Date</td>
                      <td>Actions</td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>The sun climbing plan</td>
                      <td>
                        <span data-plugin="peityPie" data-skin="red">7/10</span>
                      </td>
                      <td>Jan 1, 2017</td>
                      <td>
                        <button type="button" class="btn btn-sm btn-icon btn-pure btn-default"
                          data-toggle="tooltip" data-original-title="Edit">
                          <i class="icon md-wrench" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-icon btn-pure btn-default"
                          data-toggle="tooltip" data-original-title="Delete">
                          <i class="icon md-close" aria-hidden="true"></i>
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>Lunar probe project</td>
                      <td>
                        <span data-plugin="peityPie" data-skin="blue">3/10</span>
                      </td>
                      <td>Feb 12, 2017</td>
                      <td>
                        <button type="button" class="btn btn-sm btn-icon btn-pure btn-default"
                          data-toggle="tooltip" data-original-title="Edit">
                          <i class="icon md-wrench" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-icon btn-pure btn-default"
                          data-toggle="tooltip" data-original-title="Delete">
                          <i class="icon md-close" aria-hidden="true"></i>
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>Dream successful plan</td>
                      <td>
                        <span data-plugin="peityPie" data-skin="green">9/10</span>
                      </td>
                      <td>Apr 9, 2017</td>
                      <td>
                        <button type="button" class="btn btn-sm btn-icon btn-pure btn-default"
                          data-toggle="tooltip" data-original-title="Edit">
                          <i class="icon md-wrench" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-icon btn-pure btn-default"
                          data-toggle="tooltip" data-original-title="Delete">
                          <i class="icon md-close" aria-hidden="true"></i>
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>Office automatization</td>
                      <td>
                        <span data-plugin="peityPie" data-skin="orange">5/10</span>
                      </td>
                      <td>May 15, 2017</td>
                      <td>
                        <button type="button" class="btn btn-sm btn-icon btn-pure btn-default"
                          data-toggle="tooltip" data-original-title="Edit">
                          <i class="icon md-wrench" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-icon btn-pure btn-default"
                          data-toggle="tooltip" data-original-title="Delete">
                          <i class="icon md-close" aria-hidden="true"></i>
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>Open strategy</td>
                      <td>
                        <span data-plugin="peityPie" data-skin="brown">2/10</span>
                      </td>
                      <td>Jun 2, 2017</td>
                      <td>
                        <button type="button" class="btn btn-sm btn-icon btn-pure btn-default"
                          data-toggle="tooltip" data-original-title="Edit">
                          <i class="icon md-wrench" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-icon btn-pure btn-default"
                          data-toggle="tooltip" data-original-title="Delete">
                          <i class="icon md-close" aria-hidden="true"></i>
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- End Panel Projects -->
          </div>

          <div class="col-xxl-7 col-lg-6">
            <!-- Panel Projects Status -->
            <div class="panel" id="projects-status">
              <div class="panel-heading">
                <h3 class="panel-title">
                  Projects Status
                  <span class="badge badge-pill badge-info">5</span>
                </h3>
              </div>
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <td>ID</td>
                      <td>Project</td>
                      <td>Status</td>
                      <td class="text-left">Progress</td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>619</td>
                      <td>The sun climbing plan</td>
                      <td>
                        <span class="badge badge-primary">Developing</span>
                      </td>
                      <td>
                        <span data-plugin="peityLine">5,3,2,-1,-3,-2,2,3,5,2</span>
                      </td>
                    </tr>
                    <tr>
                      <td>620</td>
                      <td>Lunar probe project</td>
                      <td>
                        <span class="badge badge-warning">Design</span>
                      </td>
                      <td>
                        <span data-plugin="peityLine">1,-1,0,2,3,1,-1,1,4,2</span>
                      </td>
                    </tr>
                    <tr>
                      <td>621</td>
                      <td>Dream successful plan</td>
                      <td>
                        <span class="badge badge-info">Testing</span>
                      </td>
                      <td>
                        <span data-plugin="peityLine">2,3,-1,-3,-1,0,2,4,5,3</span>
                      </td>
                    </tr>
                    <tr>
                      <td>622</td>
                      <td>Office automatization</td>
                      <td>
                        <span class="badge badge-danger">Canceled</span>
                      </td>
                      <td>
                        <span data-plugin="peityLine">1,-2,0,2,4,5,3,2,4,2</span>
                      </td>
                    </tr>
                    <tr>
                      <td>623</td>
                      <td>Open strategy</td>
                      <td>
                        <span class="badge badge-default">Reply waiting</span>
                      </td>
                      <td>
                        <span data-plugin="peityLine">4,2,-1,-3,-2,1,3,5,2,4</span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- End Panel Projects Stats -->
          </div>

        </div>
      </div>
    </div>
    <!-- End Page -->

    @include('admin.include.footer')
    

@endsection