@extends('layouts.app')

@section('title', '420 Finder')

@section('content')
    <div class="dash-analytics">
        <div class="d-box text-center p-4 mb-5" style="border-radius: 20px;">
            <h1 style="font-weight: 900; font-style: italic;" class="d-size">BRANDS</h1>
        </div>
        <div style="padding: 10px" class="card panel panel-headline">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        @php
                            $text = DB::table('tests')->first();
                        @endphp
                        <h4>
                            {!! $text->del_sales_marketing !!}
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <section class="pb-0">
            <div class="container-fluid px-0">
                <div class="row">
                    <div class="col-md-12 pX-5 bg-light">
                        <div class="card mb-5">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4>My Brands</h4>
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <a href="{{ route('dashboardbrandscreate') }}" class="appointment-btn"
                                           style="margin-left: 0px !important;">Add New</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="table responsive">
                                    <table class="table table-borderless">
                                        <thead>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Edit</th>
                                        <th>Manage</th>
                                        </thead>
                                        <tbody>
                                        @if($brands->count() > 0)

                                            @foreach($brands as $index => $brand)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>
                                                        <img src="{{ $brand->profile_picture }}"
                                                             style="width: 35px; height: 35px;">
                                                    </td>
                                                    <td>{{ $brand->business_name }}</td>
                                                    <td>
                                                        @if($brand->approve == 1)
                                                            <span class="badge bg-primary">Published</span>
                                                        @else
                                                            <span class="badge bg-warning">Unpublished</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($brand->approve == 1)
                                                            <a href="{{ route('eidtdashboardbrand', ['id' => $brand->id]) }}"
                                                               class="appointment-btn">Edit</a>
                                                        @else
                                                            <span class="badge bg-warning">Unpublished</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($brand->approve == 1)
                                                            <a href="{{ route('accountSettingBrand', ['id' => $brand->id]) }}"
                                                               class="appointment-btn">Manage</a>
                                                        @else
                                                            <span class="badge bg-warning">Unpublished</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach

                                        @else
                                            <tr>
                                                <td colspan="5">No Brand Found!</td>
                                            </tr>
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
    </div>
@endsection
