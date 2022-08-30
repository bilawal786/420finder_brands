@extends('layouts.app')

@section('title', '420 Finder')

@section('content')

    <section class="p-0">
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
    </section>
    <section class="pb-0">
        <div class="container-fluid px-0">
            <div class="row">
                <div class="col-md-12 p-5 bg-light" style="padding-top: 0 !important;">
                    <div class="row">
                        <div class="col-6"><h4 class="pt-4"><strong>Account Details</strong></h4></div>
                        <div class="col-6" style=" text-align: right;"><h4 class="pt-4"><a href="{{route('eidtdashboardbrand', $brand->id)}}" class="text-right" >Edit</a></h4></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card p-3 mt-3 shadow-sm">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6><strong>Name</strong></h6>
                                        <p class="text-black-50">{{ $brand->business_name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card p-3 mt-3 shadow-sm">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6><strong>Type</strong></h6>
                                        <p class="text-black-50">{{ $brand->business_type }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card p-3 mt-3 shadow-sm">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6><strong>Description</strong></h6>
                                        <p class="text-black-50">{{ $brand->introduction }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card p-3 mt-3 shadow-sm">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6><strong>Email</strong></h6>
                                        <p class="text-black-50">{{ $brand->email }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card p-3 mt-3 shadow-sm">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6><strong>Phone</strong></h6>
                                        <p class="text-black-50">{{ $brand->phone_number }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4 class="pt-4">
                        <strong>Address</strong>
                    </h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card p-3 mt-3 shadow-sm">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6><strong>Address Line 1</strong></h6>
                                        <p class="text-black-50">{{ $brand->address_line_1 }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card p-3 mt-3 shadow-sm">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6><strong>Address Line 2</strong></h6>
                                        <p class="text-black-50">{{ $brand->address_line_2 }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card p-3 mt-3 shadow-sm">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6><strong>City</strong></h6>
                                        <p class="text-black-50">{{ $brand->city }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card p-3 mt-3 shadow-sm">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6><strong>State / Province</strong></h6>
                                        <?php $state = \Illuminate\Support\Facades\DB::table('states')->where('id','=',$brand->state_province)->first(); ?>
                                        <p class="text-black-50">{{ $state->name ?? '' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card p-3 mt-3 shadow-sm">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6><strong>Country</strong></h6>
                                        <p class="text-black-50">{{ $brand->country }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card p-3 mt-3 shadow-sm">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6><strong>Postal Code</strong></h6>
                                        <p class="text-black-50">{{ $brand->postal_code }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4 class="pt-4">
                        <strong>You Tuebe</strong>
                    </h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card p-3 mt-3 shadow-sm">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6><strong>Featured Video ID</strong></h6>
                                        <p class="text-black-50">{{ $brand->yt_featured_url }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card p-3 mt-3 shadow-sm">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6><strong>Featured Playlist ID</strong></h6>
                                        <p class="text-black-50">{{ $brand->yt_playlist_url }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4 class="pt-4">
                        <strong>Social Networks</strong>
                    </h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card p-3 mt-3 shadow-sm">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6><strong>Website URL</strong></h6>
                                        <p class="text-black-50">{{ $brand->website }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card p-3 mt-3 shadow-sm">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6><strong>Instagram URL</strong></h6>
                                        <p class="text-black-50">{{ $brand->instagram }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card p-3 mt-3 shadow-sm">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6><strong>Twitter URL</strong></h6>
                                        <p class="text-black-50">{{ $brand->twitter }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card p-3 mt-3 shadow-sm">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6><strong>Facebook Page URL</strong></h6>
                                        <p class="text-black-50">{{ $brand->facebook }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4 class="pt-4">
                        <strong>License</strong>
                    </h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card p-3 mt-3 shadow-sm">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6><strong>License Number</strong></h6>
                                        <p class="text-black-50">{{ $brand->license_number }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="card p-3 mt-3 shadow-sm">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6><strong>License Type</strong></h6>
                                        <p class="text-black-50">{{ $brand->license_type }}</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="card p-3 mt-3 shadow-sm">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6><strong>License Expiration</strong></h6>
                                        <p class="text-black-50">{{ $brand->license_expiration }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
