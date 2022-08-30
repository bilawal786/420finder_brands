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
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 p-5 bg-light" style="padding-top: 0 !important;">
                <div class="row">
                    <div class="col-6"><h4 class="pt-4"><strong>State List</strong></h4></div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card p-3 mt-3 shadow-sm">
                            <div class="row">
                                <div class="col-md-12">
                                    <h6><strong>State Name</strong></h6>
                                    <p class="text-black-50">{{ $brand->business_name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
