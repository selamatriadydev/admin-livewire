<div>
    <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-xl-12 col-lg-12 col-md-12 col-12">
            <!-- Bg -->
            <div class="pt-20 rounded-top" style="background: url('{{ asset('dash-ui/assets/images/background/profile-cover.jpg') }}');no-repeat;background-size: cover;"></div>
            <div class="card rounded-bottom rounded-0 smooth-shadow-sm mb-5">
              <div class="d-flex align-items-center justify-content-between pt-4 pb-6 px-4">
                <div class="d-flex align-items-center">
                  <!-- avatar -->
                  <div class="avatar-xxl avatar-indicators avatar-online me-2 position-relative d-flex justify-content-end align-items-end mt-n10">
                  <img src="../assets/images/avatar/avatar-11.jpg" class="avatar-xxl
                  rounded-circle border border-2 " alt="Image">
                <a href="#!" class="position-absolute top-0 right-0 me-2">
                  <img src="../assets/images/svg/checked-mark.svg" alt="Image" class="icon-sm">
                </a>
                  </div>
                  <!-- text -->
                  <div class="lh-1">
                    <h2 class="mb-0">
                      {{ $users->name }}
                      <a href="#!" class="text-decoration-none">
                      </a>
                    </h2>
                    <p class="mb-0 d-block">{{ $users->role_name }}</p>
                  </div>
                </div>
                <div>
                  <a href="#!" class="btn btn-outline-primary d-none d-md-block" wire:click="editProfile">Edit Profile</a>
                </div>
              </div>
              <!-- nav -->
              <ul class="nav nav-lt-tab px-4" id="pills-tab" role="tablist">
                @foreach ($listNav as $item)
                    <li class="nav-item">
                        <a class="nav-link {{ $listNavActive == $item ? 'active' : '' }}" wire:click="toogleNav('{{ $item }}')" href="#">{{ $item }}</a>
                    </li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
        <!-- content -->
        <div>
          <!-- row -->
          <div class="row">
            @switch($listNavActive)
                @case('Project')
                    @livewire('settings.user-profile.profile-project')
                    @break
                @case('Team')
                    @livewire('settings.user-profile.profile-teams')
                    @break
                @case('Activity')
                    @livewire('settings.user-profile.profile-log')
                    @break
                @default
                    <div class="col-xl-12 col-lg-12 col-md-12 col-12 mb-5">
                        <!-- card -->
                        <div class="card h-100">
                        <!-- card body -->
                        <div class="card-header">
                            <h4 class="mb-0">About Me</h4>
                        </div>
                        <div class="card-body">
                            <!-- card title -->
        
                            <h5 class="text-uppercase">Bio</h5>
                            <!-- text -->
                            <p class="mt-2 mb-6">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Suspen disse var ius enim in eros elementum tristique.
                            Duis cursus, mi quis viverra ornare, eros dolor interdum
                            nulla, ut commodo diam libero vitae erat.
                            </p>
                            <!-- row -->
                            <div class="row">
                            <div class="col-12 mb-5">
                                <!-- text -->
                                <h5 class="text-uppercase">Position</h5>
                                <p class="mb-0">{{ $users->role_name }}</p>
                            </div>
                            <div class="col-6 mb-5">
                                <h5 class="text-uppercase">Name</h5>
                                <p class="mb-0">{{ $users->name }}</p>
                            </div>
                            <div class="col-6 mb-5">
                                <h5 class="text-uppercase">
                                Date of Birth
                                </h5>
                                <p class="mb-0">01.10.1997</p>
                            </div>
                            <div class="col-6">
                                <h5 class="text-uppercase">Email</h5>
                                <p class="mb-0">{{ $users->email }}</p>
                            </div>
                            <div class="col-6">
                                <h5 class="text-uppercase">Location</h5>
                                <p class="mb-0">Ahmedabad, India</p>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
            @endswitch
            
          </div>
        </div>
      </div>
      @include('components.off-canvas')
      <livewire:component.swal-alert />
</div>
