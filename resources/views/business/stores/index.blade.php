@extends('layouts.app')

@section('title', '420 Finder')

@section('content')
    <div class="dash-analytics">
        <div class="d-box text-center p-4 mb-5" style="border-radius: 20px;">
            <h1 style="font-weight: 900; font-style: italic;" class="d-size">MASTER DASHBOARD</h1>
        </div>
    <section class="pb-0">
        <div class="container-fluid px-0">
            <div class="row">
                <div class="col-md-12 p-5 bg-light">
                    <div class="card mb-5">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>My Businesses</h4>
                                </div>
                                <div class="col-md-6 text-end">
                                    <a href="{{ route('addnewstore') }}" class="appointment-btn"
                                       style="margin-left: 0px !important;">Add New Business</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="table responsive">

                                <table class="table">
                                    <thead>
                                    <th>#</th>
                                    <th>Business Name</th>
                                    <th>Business Type</th>
                                    <th>Status</th>
                                    <th>View Business</th>
                                    <th>Manage Business</th>
                                    <th>Created At</th>
                                    </thead>
                                    <tbody>
                                    @if($stores->count() > 0)
                                        @foreach($stores as $index => $store)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $store->business_name }}</td>
                                                <td>
                                                    {{ $store->business_type }}
                                                </td>
                                                <td>
                                                    @if($store->approve == 1)
                                                        <span class="label label-default">Approved</span>
                                                    @else
                                                        <span class="label label-danger">In Proccess</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($store->business_type == 'Dispensary')
                                                        @if(env('APP_ENV') === "local")
                                                            <a href="http://127.0.0.1:8000/dispensaries/{{ $store->business_name }}/{{ $store->id }}"
                                                               class="appointment-btn" target="_blank">View</a>
                                                        @else
                                                            <a href="http://420finder.net/dispensaries/{{ $store->business_name }}/{{ $store->id }}"
                                                               class="appointment-btn" target="_blank">View</a>
                                                        @endif
                                                    @elseif ($store->business_type == 'brand')

                                                        @if(env('APP_ENV') === "local")
                                                            <a href="http://127.0.0.1:8000/brand/{{ $store->business_name }}/{{ $store->id }}"
                                                               class="appointment-btn" target="_blank">View</a>
                                                        @else
                                                            <a href="http://420finder.net/brand/{{ $store->business_name }}/{{ $store->id }}"
                                                               class="appointment-btn" target="_blank">View</a>

                                                        @endif

                                                    @else
                                                        @if(env('APP_ENV') === "local")
                                                            <a href="http://127.0.0.1:8000/deliveries/{{ $store->business_name }}/{{ $store->id }}"
                                                               class="appointment-btn" target="_blank">View</a>
                                                        @else
                                                            <a href="http://420finder.net/deliveries/{{ $store->business_name }}/{{ $store->id }}"
                                                               class="appointment-btn" target="_blank">View</a>
                                                        @endif

                                                    @endif
                                                </td>
                                                <td>
                                                    @if($store->business_type == 'Dispensary')
                                                        @if(env('APP_ENV') === "local")
                                                            <a href="http://127.0.0.1:8003/redirect-to-dispansary/{{ $store->id }}"
                                                               class="appointment-btn" target="_blank">Manage</a>
                                                        @else
                                                            <a href="https://dispensaries.420finder.net/redirect-to-dispansary/{{ $store->id }}"
                                                               class="appointment-btn" target="_blank">Manage</a>
                                                        @endif
                                                    @elseif ($store->business_type == 'Brand')

                                                        <a href="/index" class="appointment-btn"
                                                           target="_blank">Manage</a>

                                                    @else
                                                        @if(env('APP_ENV') === "local")
                                                            <a href="http://127.0.0.1:8004/redirect-to-delivery/{{ $store->id }}"
                                                               class="appointment-btn" target="_blank">Manage</a>
                                                        @else
                                                            <a href="https://deliveries.420finder.net/redirect-to-delivery/{{ $store->id }}"
                                                               class="appointment-btn" target="_blank">Manage</a>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>{{ $store->created_at->diffForHumans() }}</td>
                                            </tr>
                                        @endforeach
                                    @else

                                    @endif
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
