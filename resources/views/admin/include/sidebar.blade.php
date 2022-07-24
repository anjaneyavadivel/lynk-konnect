<div class="site-menubar">
      <div class="site-menubar-body">
        <div>
          <div>
            <ul class="site-menu" data-plugin="menu">
              <li class="site-menu-category">General</li>
              <li class="site-menu-item active">
                <a class="animsition-link" href="{{ url('dashboard') }}">
                        <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
                        <span class="site-menu-title">Dashboard</span>
                    </a>
              </li>
              
              @can('user-list')
              <li class="site-menu-item has-sub">
                <a href="javascript:void(0)">
                        <i class="site-menu-icon md-account-circle" aria-hidden="true"></i>
                        <span class="site-menu-title">Users</span>
                                <span class="site-menu-arrow"></span>
                    </a>
                <ul class="site-menu-sub">
                  <li class="site-menu-item">
                    <a class="animsition-link" href="{{ url('manage_users')}}">
                      <span class="site-menu-title">Manage Users</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="{{ url('add_user') }}">
                      <span class="site-menu-title">Add Users</span>
                    </a>
                  </li>
                </ul>
              </li>
              @endcan
              @can('role-list')
              <li class="site-menu-item has-sub">
                <a href="javascript:void(0)">
                        <i class="site-menu-icon md-bookmark" aria-hidden="true"></i>
                        <span class="site-menu-title">Roles</span>
                                <span class="site-menu-arrow"></span>
                    </a>
                <ul class="site-menu-sub">
                  <li class="site-menu-item">
                    <a class="animsition-link" href="{{ url('roles')}}">
                      <span class="site-menu-title">Manage Roles</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="{{ route('roles.create') }}">
                      <span class="site-menu-title">Add Roles</span>
                    </a>
                  </li>
                </ul>
              </li>
              @endcan
              @can('company-list')
              <li class="site-menu-item has-sub">
                <a href="javascript:void(0)">
                        <i class="site-menu-icon md-account" aria-hidden="true"></i>
                        <span class="site-menu-title">Company</span>
                                <span class="site-menu-arrow"></span>
                    </a>
                <ul class="site-menu-sub">
                  <li class="site-menu-item">
                    <a class="animsition-link" href="{{ url('manage_company')}}">
                      <span class="site-menu-title">Manage Company</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="{{ url('add_company') }}">
                      <span class="site-menu-title">Add Comapny</span>
                    </a>
                  </li>
                </ul>
              </li>
              @endcan

              <li class="site-menu-item has-sub">
                <a href="javascript:void(0)">
                        <i class="site-menu-icon md-google-pages" aria-hidden="true"></i>
                        <span class="site-menu-title">Driver</span>
                                <span class="site-menu-arrow"></span>
                    </a>
                <ul class="site-menu-sub">
                  <li class="site-menu-item">
                    <a class="animsition-link" href="{{ url('manage_driver')}}">
                      <span class="site-menu-title">Manage Driver</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="{{ url('add_driver') }}">
                      <span class="site-menu-title">Add Driver</span>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="site-menu-item has-sub">
                <a href="javascript:void(0)">
                        <i class="site-menu-icon glyphicon-transfer" aria-hidden="true"></i>
                        <span class="site-menu-title">Trips</span>
                                <span class="site-menu-arrow"></span>
                    </a>
                <ul class="site-menu-sub">
                  <?php  $ff = Auth::user()->id; ?>
                   @if($ff == 2)
                  <li class="site-menu-item">
                    <a class="animsition-link" href="{{ url('manage_trip')}}">
                      <span class="site-menu-title">Manage Trip</span>
                    </a>
                  </li>
                  @endif
                  <li class="site-menu-item">
                    <a class="animsition-link" href="{{ url('manage_own_trip')}}">
                      <span class="site-menu-title">Manage Own Trip</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="{{ url('add_trip') }}">
                      <span class="site-menu-title">Add Trip</span>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="site-menu-item has-sub">
                <a href="javascript:void(0)">
                        <i class="site-menu-icon glyphicon-list" aria-hidden="true"></i>
                        <span class="site-menu-title">Transaction</span>
                                <span class="site-menu-arrow"></span>
                    </a>
                <ul class="site-menu-sub">
                  <li class="site-menu-item">
                    <a class="animsition-link" href="{{ url('manage_transaction')}}">
                      <span class="site-menu-title">Manage Transaction</span>
                    </a>
                  </li>
                 <!--  <li class="site-menu-item">
                    <a class="animsition-link" href="{{ url('add_trip') }}">
                      <span class="site-menu-title">Add Trip</span>
                    </a>
                  </li> -->
                </ul>
              </li>


              @can('state-list')
              <li class="site-menu-item has-sub">
                <a href="javascript:void(0)">
                        <i class="site-menu-icon md-view-compact" aria-hidden="true"></i>
                        <span class="site-menu-title">Master Settings</span>
                                <span class="site-menu-arrow"></span>
                    </a>
                <ul class="site-menu-sub">
                  <!-- <li class="site-menu-item">
                    <a class="animsition-link" href="{{ url('manage_country')}}">
                      <span class="site-menu-title">Country</span>
                    </a>
                  </li> -->
                  <li class="site-menu-item">
                    <a class="animsition-link" href="{{ url('manage_state') }}">
                      <span class="site-menu-title">Counties</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="{{ url('manage_city') }}">
                      <span class="site-menu-title">Neighborhoods</span>
                    </a>
                  </li>

                  <li class="site-menu-item">
                    <a class="animsition-link" href="{{ url('manage_route') }}">
                      <span class="site-menu-title">Routes</span>
                    </a>
                  </li>

                  <li class="site-menu-item">
                    <a class="animsition-link" href="{{ url('manage_stop/0') }}">
                      <span class="site-menu-title">Stops</span>
                    </a>
                  </li>

                </ul>
              </li>
              @endcan

            </ul>
           </div>
        </div>
      </div>
    
      <div class="site-menubar-footer">
        <a href="#" class="fold-show" data-placement="top" data-toggle="tooltip"
          data-original-title="">
          <!-- <span class="icon md-settings" aria-hidden="true"></span> -->
        </a>
        <a href="#" data-placement="top" data-toggle="tooltip" data-original-title="">
          <!-- <span class="icon md-eye-off" aria-hidden="true"></span> -->
        </a>
        <a href="#" data-placement="top" data-toggle="tooltip" data-original-title="">
          <!-- <span class="icon md-power" aria-hidden="true"></span> -->
        </a>
      </div>
    </div> 