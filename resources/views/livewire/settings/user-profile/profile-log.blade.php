<div>
    <div class="py-6">
        <div class="row">
          <div class="offset-lg-1 col-lg-10 col-md-12 col-12">
            <!-- row -->
            {{-- <div class="row align-items-center mb-6">
              <div class="col-lg-6 col-md-12 col-12">
                <!-- form -->
                <form>
                  <input type="search" class="form-control" placeholder="Search Your Activity">
                </form>
              </div>
              <div class="col-lg-6 col-md-12 col-12 d-flex justify-content-end">
                <!-- form -->
              <div>
                <a href="#!" class="btn btn-ghost btn-icon btn-sm rounded-circle texttooltip" data-template="filterOne">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter icon-xs"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
                  <div class="d-none" id="filterOne">
                    <span>Filter</span>
                  </div>
                </a>
                <a href="#!" class="btn btn-outline-secondary ms-3">
                  Delete
                </a>
              </div>

              </div>
            </div> --}}
            <!-- hr -->

            <div class="mb-8">
              <!-- card -->
              <div class="card bg-gray-300 shadow-none mb-4">
                <!-- card body -->
                <div class="card-body">
                  <div class="d-flex justify-content-between
                    align-items-center">
                    <div>
                      <h5 class="mb-0">Today</h5>
                    </div>
                  </div>
                </div>
              </div>
              <!-- card -->
              <div class="card">
                <!-- list group -->
                <ul class="list-group list-group-flush">
                  <!-- list group item -->
                  @foreach ($logsToday as $item)
                    <li class="list-group-item p-3">
                      <div class="d-flex justify-content-between
                        align-items-center">
                        <div class="d-flex align-items-center">
                          <!-- content -->
                          <div class="ms-3">
                            <p class="mb-0
                              font-weight-medium"><a href="#!">You </a> <strong>{{ $item->event }}</strong> {{ $item->keterangan }}</p>
                          </div>
                        </div>
                        <div>
                                <!-- dropdown -->
                          {{-- <div class="dropdown dropstart">
                            <a href="#!" class="btn btn-ghost btn-icon btn-sm rounded-circle" id="dropdownactivityOne" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical icon-xs"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownactivityOne">
                              <a class="dropdown-item d-flex align-items-center" href="#!">Action</a>
                              <a class="dropdown-item d-flex align-items-center" href="#!">Another action</a>
                              <a class="dropdown-item d-flex align-items-center" href="#!">Something else
                                here</a>
                            </div>
                          </div> --}}
                        </div>
                      </div>
                    </li>
                  @endforeach
                    
                </ul>
              </div>
            </div>
            <div class="mb-8">
                    <!-- card -->
              <div class="card bg-gray-300 shadow-none mb-4">
                      <!-- card body -->
                <div class="card-body">
                  <div class="d-flex justify-content-between
                    align-items-center">
                    <div>
                      <h5 class="mb-0">Yesterday</h5>
                    </div>
                  </div>
                </div>
              </div>
                    <!-- card -->
              <div class="card">
                      <!-- list group -->
                <ul class="list-group list-group-flush">
                      <!-- list group item  -->
                    @foreach ($logsYesterday as $item)
                      <li class="list-group-item p-3">
                        <div class="d-flex justify-content-between
                          align-items-center">
                          <div class="d-flex align-items-center">
                            <!-- content  -->
                            <div class="ms-3">
                              <p class="mb-0
                                font-weight-medium"><a href="#!">You </a><strong>{{ $item->event }}</strong> {{ $item->keterangan }}</p>
                            </div>
                          </div>
                          <div>
                            <!-- dropdown  -->
                            {{-- <div class="dropdown dropstart">
                              <a href="#!" class="btn btn-ghost btn-icon btn-sm rounded-circle" id="dropdownactivitySeven" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical icon-xs"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                              </a>
                              <div class="dropdown-menu" aria-labelledby="dropdownactivitySeven">
                                <a class="dropdown-item d-flex align-items-center" href="#!">Action</a>
                                <a class="dropdown-item d-flex align-items-center" href="#!">Another action</a>
                                <a class="dropdown-item d-flex align-items-center" href="#!">Something else
                                  here</a>
                              </div>
                            </div> --}}
                          </div>
                        </div>
                      </li>
                    @endforeach
                </ul>
              </div>
            </div>
            <div class="mb-8">
               <!-- card  -->
              <div class="card bg-gray-300 shadow-none mb-4">
                 <!-- card body  -->
                <div class="card-body">
                  <div class="d-flex justify-content-between
                    align-items-center">
                    <div>
                      <h5 class="mb-0">All Log</h5>
                    </div>
                  </div>
                </div>
              </div>
               <!-- card  -->
              <div class="card">
                 <!-- list group  -->
                <ul class="list-group list-group-flush">
                   <!-- list group item  -->
                   @foreach ($logsAll as $item)
                    <li class="list-group-item p-3">
                      <div class="d-flex justify-content-between
                        align-items-center">
                        <div class="d-flex align-items-center">
                          <!-- content -->
                          <div class="ms-3">
                            <p class="mb-0
                              font-weight-medium"><a href="#!">You</a> <strong>{{ $item->event }}</strong> {{ $item->keterangan }}</p>
                          </div>
                        </div>
                        <div>
                          <!-- dropdown  -->
                          {{-- <div class="dropdown dropstart">
                            <a href="#!" id="dropdownactivityTen" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-ghost btn-sm btn-icon rounded-circle">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical icon-xs"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownactivityTen">
                              <a class="dropdown-item d-flex align-items-center" href="#!">Action</a>
                              <a class="dropdown-item d-flex align-items-center" href="#!">Another action</a>
                              <a class="dropdown-item d-flex align-items-center" href="#!">Something else
                                here</a>
                            </div>
                          </div> --}}
                        </div>
                      </div>
                    </li>
                   @endforeach
                   <!-- list group item  -->
                         <!-- list group item  -->
                  <li class="list-group-item p-3">
                    <div class="py-2 text-center">
                      {{ $logsAll->links() }}
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
