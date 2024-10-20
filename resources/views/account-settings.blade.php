<!-- resources/views/home.blade.php -->

@extends('layouts.app')

@section('title', 'Matepoint - Account Settings')

@section('content') 
<!-- content -->
     <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
              <div class="row align-items-center">
                <div class="col-9">
                  <h4 class="fw-semibold mb-8">Account Setting</h4>
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a class="text-muted" href="/">Home</a></li>
                      <li class="breadcrumb-item" aria-current="page">Account Setting</li>
                    </ol>
                  </nav>
                </div>
                <div class="col-3">
                  <div class="text-center mb-n5">  
                    <img src="{{ asset('assets/images/breadcrumb/ChatBc.png') }}" alt="" class="img-fluid mb-n4">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <ul class="nav nav-pills user-profile-tab" id="pills-tab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link position-relative rounded-0 active d-flex align-items-center justify-content-center bg-transparent fs-3 py-4" id="pills-account-tab" data-bs-toggle="pill" data-bs-target="#pills-account" type="button" role="tab" aria-controls="pills-account" aria-selected="true">
                  <i class="ti ti-user-circle me-2 fs-6"></i>
                  <span class="d-none d-md-block">Account</span> 
                </button>
              </li> 
            </ul>
            <div class="card-body">
              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-account" role="tabpanel" aria-labelledby="pills-account-tab" tabindex="0">
                  <div class="row">
                    <div class="col-lg-6 d-flex align-items-stretch">
                      <div class="card w-100 position-relative overflow-hidden">
                        <div class="card-body p-4">
                          <h5 class="card-title fw-semibold">Change Profile</h5>
                          <p class="card-subtitle mb-4">Change your profile picture from here</p>
                          <div class="text-center">
                            <img src="{{ asset('assets/images/profile/user-1.jpg ') }}" alt="" class="img-fluid rounded-circle" width="120" height="120">
                            <div class="d-flex align-items-center justify-content-center my-4 gap-3">
                              <button class="btn btn-primary">Upload</button>
                              <button class="btn btn-outline-danger">Reset</button>
                            </div>
                            <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 d-flex align-items-stretch">
                      <div class="card w-100 position-relative overflow-hidden">
                        <div class="card-body p-4">
                          <h5 class="card-title fw-semibold">Change Password</h5>
                          <p class="card-subtitle mb-4">To change your password please confirm here</p>
                          <form>
                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Current Password</label>
                              <input type="password" class="form-control" id="exampleInputPassword1" value="12345678910">
                            </div>
                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">New Password</label>
                              <input type="password" class="form-control" id="exampleInputPassword1" value="12345678910">
                            </div>
                            <div class="">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Confirm Password</label>
                              <input type="password" class="form-control" id="exampleInputPassword1" value="12345678910">
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="card w-100 position-relative overflow-hidden mb-0">
                        <div class="card-body p-4">
                          <h5 class="card-title fw-semibold">Personal Details</h5>
                          <p class="card-subtitle mb-4">To change your personal detail , edit and save from here</p>
                          <form>
                            <div class="row">
                              <div class="col-lg-6">
                                <div class="mb-4">
                                  <label for="exampleInputPassword1" class="form-label fw-semibold">Your Name</label>
                                  <input type="text" class="form-control" id="exampleInputtext" placeholder="Mathew Anderson">
                                </div>
                                <div class="mb-4">
                                  <label for="exampleInputPassword1" class="form-label fw-semibold">Location</label>
                                  <select class="form-select" aria-label="Default select example">
                                    <option selected>United Kingdom</option>
                                    <option value="1">United States</option>
                                    <option value="2">United Kingdom</option>
                                    <option value="3">India</option>
                                    <option value="3">Russia</option>
                                  </select>
                                </div>
                                <div class="mb-4">
                                  <label for="exampleInputPassword1" class="form-label fw-semibold">Email</label>
                                  <input type="email" class="form-control" id="exampleInputtext" placeholder="info@modernize.com">
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="mb-4">
                                  <label for="exampleInputPassword1" class="form-label fw-semibold">Store Name</label>
                                  <input type="text" class="form-control" id="exampleInputtext" placeholder="Maxima Studio">
                                </div>
                                <div class="mb-4">
                                  <label for="exampleInputPassword1" class="form-label fw-semibold">Currency</label>
                                  <select class="form-select" aria-label="Default select example">
                                    <option selected>India (INR)</option>
                                    <option value="1">US Dollar ($)</option>
                                    <option value="2">United Kingdom (Pound)</option>
                                    <option value="3">India (INR)</option>
                                    <option value="3">Russia (Ruble)</option>
                                  </select>
                                </div>
                                <div class="mb-4">
                                  <label for="exampleInputPassword1" class="form-label fw-semibold">Phone</label>
                                  <input type="text" class="form-control" id="exampleInputtext" placeholder="+91 12345 65478">
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="">
                                  <label for="exampleInputPassword1" class="form-label fw-semibold">Address</label>
                                  <input type="text" class="form-control" id="exampleInputtext" placeholder="814 Howard Street, 120065, India">
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="d-flex align-items-center justify-content-end mt-4 gap-3">
                                  <button class="btn btn-primary">Save</button>
                                  <button class="btn btn-light-danger text-danger">Cancel</button>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> 
              </div>
            </div>
          </div>
<!-- content -->
@endsection
