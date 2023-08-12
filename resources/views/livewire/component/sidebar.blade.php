<div>
     <!-- Sidebar -->
     <div class="navbar-vertical navbar nav-dashboard">
        <div class="h-100" data-simplebar="init"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 0px;">
            <!-- Brand logo -->
            <a class="navbar-brand" href="../index.html">
                <img src="../assets/images/brand/logo/logo-2.svg" alt="dash ui - bootstrap 5 admin dashboard template">
            </a>
            <!-- Navbar nav -->
            <ul class="navbar-nav flex-column" id="sideNavbar">
                @foreach ($sidebarItems as $item)
                    @if ($item['is_child'])
                        <li class="nav-item">
                            <a class="nav-link has-arrow {{ in_array($activeSidebar,$item['method_data']) ? 'collapsed' : '' }}" href="#!" data-bs-toggle="collapse" data-bs-target="#navPages-{{ $item['method'] }}" aria-expanded="false" aria-controls="navPages-{{ $item['method'] }}">
                                <i data-feather="{{ $item['icon'] ?? 'layers' }}" class="nav-icon icon-xs me-2"></i> {{ $item['title'] }}
                            </a>
                            <div id="navPages-{{ $item['method'] }}" class="collapse {{ in_array($activeSidebar,$item['method_data']) ? 'show' : '' }}" data-bs-parent="#sideNavbar">
                                <ul class="nav flex-column">
                                    @foreach ($item['child_data'] as $sub)
                                        <li class="nav-item">
                                            <a class="nav-link {{ $activeSidebar === $sub['method'] ? 'active' : '' }}" href="{{ url($sub['url']) }}">
                                                {{ $sub['title'] }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link has-arrow {{ $activeSidebar === $item['method'] ? 'active' : '' }}" href="{{ url($item['url']) }}">
                                <i data-feather="{{ $item['icon'] ?? 'layers' }}" class="nav-icon icon-xs me-2"></i>  {{ $item['title'] }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
   
        </div></div></div></div><div class="simplebar-placeholder" style="width: auto; height: 1625px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 131px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div></div>
       </div>
</div>
