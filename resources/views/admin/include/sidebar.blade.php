<div class="site-menubar">
      <div class="site-menubar-body">
        <div>
          <div>
            <ul class="site-menu" data-plugin="menu">
              <li class="site-menu-category">General</li>
              <li class="site-menu-item @if(collect(request()->segments())->last()=='dashboard') active @endif">
                <a class="animsition-link" href="{{ url('dashboard') }}">
                        <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
                        <span class="site-menu-title">Dashboard</span>
                    </a>
              </li>
              @php $user_info=Auth::user()->roles->first()->id; @endphp
              @can('user-list')               
              @if($user_info==3)
              <li class="site-menu-item has-sub @if(collect(request()->segments())->last()=='manage_users') active @elseif(collect(request()->segments())->last()=='add_user') active @endif">
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
              @endif
              @endcan
              @can('role-list')
              
              <!-- <li class="site-menu-item has-sub @if(collect(request()->segments())->last()=='roles') active @elseif(request()->path()=='roles/create') active @endif">
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
              </li> -->
              @endcan
              @can('company-list')
              @if($user_info==3 || $user_info==2)
              <li class="site-menu-item has-sub @if(collect(request()->segments())->last()=='manage_company') active @elseif(request()->path()=='add_company') active @endif">
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
              @endif
              @endcan
              @if($user_info==3 || $user_info==2)
              <li class="site-menu-item has-sub @if(collect(request()->segments())->last()=='manage_driver') active @elseif(request()->path()=='add_driver') active @endif">
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
              @endif
              <li class="site-menu-item has-sub  @if(collect(request()->segments())->last()=='manage_trip') active @elseif(request()->path()=='manage_own_trip') active @elseif(request()->path()=='add_trip') active @endif">
                <a href="javascript:void(0)">
                        <i class="site-menu-icon glyphicon-transfer" aria-hidden="true"></i>
                        <span class="site-menu-title">Trips</span>
                                <span class="site-menu-arrow"></span>
                    </a>
                <ul class="site-menu-sub">
                  <?php  $ff = Auth::user()->id; ?>
                  @if($user_info==3)
                  <li class="site-menu-item">
                    <a class="animsition-link" href="{{ url('manage_trip')}}">
                      <span class="site-menu-title">Manage Trip</span>
                    </a>
                  </li>
                  @endif
                 @if($user_info!=1)
                  <li class="site-menu-item">
                    <a class="animsition-link" href="{{ url('manage_own_trip')}}">
                      <span class="site-menu-title">Manage Own Trip</span>
                    </a>
                  </li>
                  @endif
                  <li class="site-menu-item">
                    <a class="animsition-link" href="{{ url('add_trip') }}">
                      <span class="site-menu-title">Add Trip</span>
                    </a>
                  </li>
                </ul>
              </li>
              @if($user_info==3 || $user_info==2)
              <li class="site-menu-item has-sub @if(collect(request()->segments())->last()=='manage_transaction') active @endif">
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
            @endif

              @can('state-list')
              @if($user_info==3)
              <li class="site-menu-item has-sub @if(collect(request()->segments())->last()=='manage_state') active @elseif(request()->path()=='manage_city') active @elseif(request()->path()=='manage_route') active @elseif(request()->path()=='manage_stop/0') active @endif">
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

                  <!-- <li class="site-menu-item">
                    <a class="animsition-link" href="{{ url('manage_route') }}">
                      <span class="site-menu-title">Routes</span>
                    </a>
                  </li>

                  <li class="site-menu-item">
                    <a class="animsition-link" href="{{ url('manage_stop/0') }}">
                      <span class="site-menu-title">Stops</span>
                    </a>
                  </li> -->

                </ul>
              </li>
              @endif
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