<div>
  <main id="main-wrapper" class="main-wrapper">
    <div class="header">
    <!-- navbar -->
        <div class="navbar-custom navbar navbar-expand-lg">
            <div class="container-fluid px-0">
                <a class="navbar-brand d-block d-md-none" href="{{ route('home') }}">
                    <img src="{{ asset('dash-ui/assets/images/brand/logo/logo-2.svg') }}" alt="Image">
                </a>
                <a id="nav-toggle" href="#!" class="ms-auto ms-md-0 me-0 me-lg-3 " wire:click="toggledSidebar">
                  <i data-feather="menu" class="nav-icon me-2 icon-xs"></i></a>
                <!--Navbar nav -->
                <ul class="navbar-nav navbar-right-wrap ms-lg-auto d-flex nav-top-wrap align-items-center ms-4 ms-lg-0">
                  <a href="#" class="form-check form-switch theme-switch btn btn-ghost btn-icon rounded-circle" wire:click="toggledThemeApp">
                    <i class="icon-xs" data-feather="{{ $themeAppIcon }}"></i>
                  </a>
                    
              
                  <li class="dropdown stopevent ms-2">
                    <a class="btn btn-ghost btn-icon rounded-circle" href="#!" role="button" id="dropdownNotification" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-xs" data-feather="bell"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end" aria-labelledby="dropdownNotification">
                      <div>
                        <div class="border-bottom px-3 pt-2 pb-3 d-flex
                          justify-content-between align-items-center">
                          <p class="mb-0 text-dark fw-medium fs-4">Notifications</p>
                          <a href="#!" class="text-muted">
                            <span>
                              <i class="me-1 icon-xxs" data-feather="settings"></i>
                            </span>
                          </a>
                        </div>
                        <div data-simplebar="init" style="height: 250px;"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: auto; overflow: hidden;"><div class="simplebar-content" style="padding: 0px;">
                        <!-- List group -->
                        <ul class="list-group list-group-flush notification-list-scroll">
                          <!-- List group item -->
                          <li class="list-group-item bg-light">
                            <a href="#!" class="text-muted">
                                <h5 class=" mb-1">Rishi Chopra</h5>
                                <p class="mb-0">
                                  Mauris blandit erat id nunc blandit, ac eleifend dolor pretium.
                                </p>
                            </a>
                          </li>
                          <!-- List group item -->
                          <li class="list-group-item">
                            <a href="#!" class="text-muted">
                                <h5 class=" mb-1">Neha Kannned</h5>
                                <p class="mb-0">
                                  Proin at elit vel est condimentum elementum id in ante. Maecenas et sapien metus.
                                </p>
                            </a>
                          </li>
                          <!-- List group item -->
                          <li class="list-group-item">
                            <a href="#!" class="text-muted">
                                <h5 class=" mb-1">Nirmala Chauhan</h5>
                                <p class="mb-0">
                                  Morbi maximus urna lobortis elit sollicitudin sollicitudieget elit vel pretium.
                                </p>
                            </a>
                          </li>
                          <!-- List group item -->
                          <li class="list-group-item">
                            <a href="#!" class="text-muted">
                                <h5 class=" mb-1">Sina Ray</h5>
                                <p class="mb-0">
                                  Sed aliquam augue sit amet mauris volutpat hendrerit sed nunc eu diam.
                                </p>
                            </a>
                          </li>
                        </ul>
                        </div></div></div></div><div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: hidden;"><div class="simplebar-scrollbar" style="height: 0px; display: none;"></div></div></div>
                        <div class="border-top px-3 py-2 text-center">
                          <a href="#!" class="text-inherit ">
                            View all Notifications
                          </a>
                        </div>
                      </div>
                    </div>
                  </li>
                  <!-- List -->
                  <li class="dropdown ms-2">
                    <a class="rounded-circle" href="#!" role="button" id="dropdownUser" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <div class="avatar avatar-md avatar-indicators avatar-online">
                        <img alt="avatar" src="{{ asset('dash-ui/assets/images/avatar/avatar-11.jpg') }}" class="rounded-circle">
                      </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                      <div class="px-4 pb-0 pt-2">
                        <div class="lh-1 ">
                          <h5 class="mb-1"> {{ $name_user }}</h5>
                          <a href="#!" class="text-inherit fs-6">{{ $role_user }}</a>
                        </div>
                        <div class=" dropdown-divider mt-3 mb-2"></div>
                      </div>
                      <ul class="list-unstyled">
                        <li>
                          <a class="dropdown-item d-flex align-items-center" href="{{ route('app.user-profile') }}" >
                            <i class="me-2 icon-xxs dropdown-item-icon" data-feather="user"></i> Profile
                          </a>
                        </li>
                        {{-- <li>
                          <a class="dropdown-item" href="#!">
                            <i class="me-2 icon-xxs dropdown-item-icon" data-feather="activity"></i> Log
                          </a>
                        </li> --}}
                        {{-- <li>
                          <a class="dropdown-item d-flex align-items-center" href="#!">
                            <i class="me-2 icon-xxs dropdown-item-icon" data-feather="settings"></i>Settings
                          </a>
                        </li> --}}
                        <li>
                          <a class="dropdown-item" href="#" wire:click="logout">
                            <i class="me-2 icon-xxs dropdown-item-icon" data-feather="power"></i>Sign Out
                          </a>
                        </li>
                      </ul>
              
                    </div>
                  </li>
                </ul>
            </div>
        </div>
    </div>
</div>