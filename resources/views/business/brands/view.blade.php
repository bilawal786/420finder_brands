@extends('layouts.app')

    @section('title', '420 Finder')

    @section('content')

    <section class="pb-0">
        <div class="container-fluid px-0">
          <div class="row">
              <div class="col-md-12 p-5 bg-light">
                <div class="card mb-5">
                  <div class="card-body">
                    @include('partials/brand-topbar')
                  </div>
                </div>
                <div class="card">
                  <div class="card-body">
                    <div class="pb-3">
                      <h6><strong>Contact Name</strong></h6>
                      <p class="text-black-50">{{ $business->first_name }} {{ $business->last_name }}</p>
                    </div>
                    <div class="pb-3">
                      <h6><strong>Contact Email</strong></h6>
                      <p class="text-black-50">{{ $business->email }}</p>
                    </div>
                    <div class="pb-3">
                      <h6><strong>Contact Phone Number</strong></h6>
                      <p class="text-black-50">{{ $business->phone_number }}</p>
                    </div>
                    <div class="pb-3">
                      <h6><strong>Website</strong></h6>
                      <p class="text-black-50">{{ $business->website }}</p>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
    </section>

@endsection
