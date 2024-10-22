<!-- resources/views/home.blade.php -->

@extends('layouts.app')

@section('title', 'Matepoint - Dashboard')

@section('content') 
<!-- content -->

<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Pricing</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted " href="./index.html">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Pricing</li>
          </ol>
        </nav>
      </div>
      <div class="col-3">
        <div class="text-center mb-n5">  
          <img src="{{asset('assets/images/breadcrumb/ChatBc.png')}}" alt="" class="img-fluid mb-n4">
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row justify-content-center">
  <div class="col-lg-6 text-center">
    <h2 class="fw-bolder mb-0 fs-8 lh-base">Flexible Plans Tailored to Fit Your Community's Unique Needs!</h2>
  </div>
</div>
<div class="row">
  <div class="col-6">
    <div class="card">
      <div class="card-body">
        <span class="fw-bolder text-uppercase fs-7 d-block mb-7">Offline</span>
        <div class="my-4 text-center">
          <i class="ti ti-map-pin fs-13"></i>
        </div>
        <button class="btn btn-primary fw-bolder rounded-2 py-6 w-100 text-capitalize">Choose</button>
      </div>
    </div>
  </div> 
  <div class="col-6">
    <div class="card">
      <div class="card-body">
        <span class="fw-bolder text-uppercase fs-2 d-block mb-7">gold</span>
        <div class="my-4">
          <img src="{{asset('assets/images/backgrounds/gold.png')}}" alt="" class="img-fluid" width="80" height="80">
        </div>
        <div class="d-flex mb-3">
          <h5 class="fw-bolder fs-6 mb-0">$</h5>
          <h2 class="fw-bolder fs-12 ms-2 mb-0">9.99</h2>
          <span class="ms-2 fs-4 d-flex align-items-center">/mo</span>
        </div>
        <ul class="list-unstyled mb-7">
          <li class="d-flex align-items-center gap-2 py-2">
            <i class="ti ti-check text-primary fs-4"></i>
            <span class="text-dark">5 Members</span>
          </li>
          <li class="d-flex align-items-center gap-2 py-2">
            <i class="ti ti-check text-primary fs-4"></i>
            <span class="text-dark">Single Devise</span>
          </li>
          <li class="d-flex align-items-center gap-2 py-2">
            <i class="ti ti-check text-primary fs-4"></i>
            <span class="text-dark">120GB Storage</span>
          </li>
          <li class="d-flex align-items-center gap-2 py-2">
            <i class="ti ti-check text-primary fs-4"></i>
            <span class="text-dark">Monthly Backups</span>
          </li>
          <li class="d-flex align-items-center gap-2 py-2">
            <i class="ti ti-check text-primary fs-4"></i>
            <span class="text-dark">Permissions & workflows</span>
          </li>
        </ul>
        <button class="btn btn-primary fw-bolder rounded-2 py-6 w-100 text-capitalize">choose gold</button>
      </div>
    </div>
  </div>
</div> 


<button class="btn me-1 mb-1 btn-light-primary text-primary btn-lg px-4 fs-4 font-medium" >
Medium Modal
</button>

<div class="modal fade" id="bs-example-modal-md" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-sm">
    <form action="POST" id="updateForm">
      <div class="modal-content">
        <div class="modal-header d-flex align-items-center">
          <h4 class="modal-title" id="myModalLabel">
            Pilih Sharing Session 
          </h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body"> 
          <div class="d-flex justify-content-center gap-2">
           <input type="radio" class="form-check" name="sharingSession" id="offline">
           <label for="offline" class="fw-bolder text-muted">Offline</label>
           <input type="radio" id="online" class="form-check" name="sharingSession">
           <label for="online" class="fw-bolder text-muted">Online</label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-light-success text-success font-medium waves-effect">
            Save
          </button>
          <button type="button" class="btn btn-light-danger text-danger font-medium waves-effect" data-bs-dismiss="modal">
            Close
          </button>
        </div>
      </div> 
    </form>
  </div> 
</div>

<!-- content -->
@endsection
