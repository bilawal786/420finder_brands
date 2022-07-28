@extends('layouts.app')

    @section('title', '420 Finder')

    @section('content')

    <section class="pb-0">
        <div class="container-fluid px-0">
          <div class="row">
              <div class="col-md-12 p-5 bg-light">
                <div class="card mb-5">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <h4>My Brands</h4>
                      </div>
                      <div class="col-md-6 text-end">
                        <a href="{{ route('dashboardbrandscreate') }}" class="appointment-btn" style="margin-left: 0px !important;">Add New</a>
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
                                  <img src="{{ $brand->logo }}" style="width: 35px; height: 35px;">
                                </td>
                                <td>{{ $brand->name }}</td>
                                <td>
                                  @if($brand->status == 0)
                                    <span class="badge bg-warning">Unpublished</span>
                                  @else
                                    <span class="badge bg-primary">Published</span>
                                  @endif
                                </td>
                                <td>
                                  <a href="{{ route('eidtdashboardbrand', ['id' => $brand->id]) }}" class="btn border bg-white">Edit</a>
                                </td>
                                <td>
                                  <a href="{{ route('viewprofilebrand', ['id' => $brand->id]) }}" class="btn border bg-white">Manage</a>
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

@endsection
