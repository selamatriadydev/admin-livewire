<div>
    <div class="container d-flex flex-column">
        <div class="row align-items-center justify-content-center g-0
            min-vh-100">
          <div class="col-12 col-md-8 col-lg-6 col-xxl-4 py-8 py-xl-0">
            <!-- Card -->
            <div class="card smooth-shadow-md">
              <!-- Card body -->
              <div class="card-body p-6">
                <div class="mb-4">
                  <a href="../index.html"><img src="../assets/images/brand/logo/logo-primary.svg" class="mb-2" alt=""></a>
                  <p class="mb-6">Please enter your user information.</p>
                </div>
                <!-- Form -->
                <form wire:submit.prevent="login">
                  <!-- Username -->
                  <div class="mb-3">
                    <label for="email" class="form-label">Username or email</label>
                    <input type="text" wire:model.lazy="email" class="form-control @error('email') is-invalid @enderror"placeholder="Email address here">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div> 
                    @enderror
                  </div>
                  <!-- Password -->
                  <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" wire:model.lazy="password" class="form-control @error('password') is-invalid @enderror"placeholder="**************">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                  </div>
                  <!-- Checkbox -->
                  <div>
                    <!-- Button -->
                    <div class="d-grid">
                      <button type="submit" class="btn btn-primary">Sign
                        in</button>
                    </div>
    
                    <div class="d-md-flex justify-content-between mt-4">
                      <div class="mb-2 mb-md-0">
                        <a href="{{ route('auth.register') }}" class="fs-5">Create An
                            Account </a>
                      </div>
                      <div>
                        <a href="forget-password.html" class="text-inherit
                            fs-5">Forgot your password?</a>
                      </div>
    
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <livewire:component.swal-alert />
</div>
