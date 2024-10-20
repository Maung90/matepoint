<!-- resources/views/home.blade.php -->

@extends('layouts.app')

@section('title', 'Matepoint - List Pembayaran')

@section('content') 
<!-- content -->

  <div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
      <div class="row align-items-center">
        <div class="col-9">
          <h4 class="fw-semibold mb-8">List Pembayaran</h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a class="text-muted " href="/">Dashboard</a></li>
              <li class="breadcrumb-item" aria-current="page">Pembayaran</li>
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
  <div class="widget-content searchable-container list"> 

  </div>

<!-- content -->
@endsection
