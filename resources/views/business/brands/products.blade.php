@extends('layouts.app')

    @section('title', '420 Finder')

    @section('content')

    <section class="pb-0">
        <div class="container-fluid px-0">
          <div class="row">
              <div class="col-md-12 p-5 bg-light">
                <div class="card mb-3">
                  <div class="card-body">
                    @include('partials/brand-topbar')
                  </div>
                </div>

                @if ($brand->is_paid)
                <div class="row mb-3">
                  <div class="col-md-6">
                    <nav aria-label="breadcrumb" class="pt-2">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboardbrands') }}">Brands</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('viewprofilebrand', ['id' => $brand->id]) }}">{{ $brand->name }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Products</li>
                      </ol>
                    </nav>
                  </div>
                  <div class="col-md-6 text-end">
                    <a href="{{ route('addbrandproduct', ['slug' => $brand->slug, 'id' => $brand->id]) }}" class="btn bg-white shadow-sm">Add Product</a>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <th>#</th>
                          <th>Product Name</th>
                          <th>Category</th>
                          <th>Price</th>
                          <th>Published?</th>
                          <th>Action</th>
                        </thead>
                        <tbody>
                          @if($products->count() > 0)
                            @foreach($products as $index => $product)
                              <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                  <img src="{{ $product->image }}" alt="{{ $product->name }}" style="width: 25px;height: 25px;">
                                  <strong>{{ $product->name }}</strong>
                                </td>

                                <td>
                                   <?php
                                      $category = \App\Models\Category::where('id', $product->category_id)->pluck('name')->first();
                                   ?>

                                   {{ $category }}

                                </td>
                                <td>
                                    $ {{ $product->suggested_price }}
                                </td>
                                <td>
                                  @if($product->status == 0)
                                    No
                                  @else
                                    Yes
                                  @endif
                                </td>
                                <td>
                                  <a href="{{ route('editbrandproduct', ['slug' => $brand->slug, 'brand_id' => $brand->id, 'product_id' => $product->id]) }}" class="btn border bg-white">Edit</a>
                                </td>
                              </tr>
                            @endforeach
                          @else
                            <tr class="text-center">
                              <td colspan="6">No Product Found.</td>
                            </tr>
                          @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                @else
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-3">Please complete payment process</h5>
                            <a href="{{ route('managebrandpayments', [$brand->slug, $brand->id]) }}" class="btn btn-primary">Go to payment</a>
                        </div>
                    </div>
                @endif

              </div>
          </div>
        </div>
    </section>

@endsection
