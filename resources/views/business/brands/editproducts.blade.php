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

                @if($brand->is_paid)
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
                    <a href="{{ route('managebrandproducts', ['slug' => $brand->slug, 'id' => $brand->id]) }}" class="btn bg-white shadow-sm">Go Back</a>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body pb-5">

                    @include('business.partials.success-error')

                    <form action="{{ route('updatebrandproduct') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" name="product_id" value="{{ $product->id }}">
                      <input type="hidden" name="brand_id" value="{{ $brand->id }}">
                      <div class="row">
                        <div class="col-md-2">
                          <label for="" class="pb-2">Avatar image</label>
                          <img src="{{ $product->image }}" alt="" class="w-100 img-thumbnail">
                          <div class="form-group mt-3">
                            <input type="file" name="image" class="form-control">
                          </div>
                          <div class="mt-3">
                            <div class="form-group">
                              <label for="">Status</label>
                              <select name="status" class="form-control" required="">
                                @if($product->status == 0)
                                  <option value="0">Unpublished</option>
                                  <option value="1">Published</option>
                                @else
                                  <option value="1">Published</option>
                                  <option value="0">Unpublished</option>
                                @endif

                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-10">
                          <div class="form-group pb-4">
                            <label for="">Name</label>
                            <input type="text" name="name" value="{{ $product->name }}" class="form-control" required="">
                          </div>
                          <div class="form-group">
                            <label for="">Description</label>
                            <textarea id="editor1" name="description" cols="5" rows="5" class="form-control" required="">{{ $product->description }}</textarea>
                          </div>
                          <div class="form-group pt-3">
                            <label for="">External ID</label>
                            <input type="text" name="sku" value="{{ $product->sku }}" class="form-control">
                          </div>
                          <div class="form-group pt-3">
                            <label for="">Suggested Price*</label>
                            <input type="number" name="suggested_price" value="{{ $product->suggested_price }}" class="form-control" required="">
                          </div>
                          <div class="form-group pt-3">
                            <label for="">Gallery Images</label>
                            <div class="row">
                              @if($gallery->count() > 0)
                                @foreach($gallery as $single)
                                  <div class="col-md-1 py-3">
                                    <a href="{{ route('removegalleryimage', ['id' => $single->id]) }}" onclick="return confirm('Are you sure you want to delete this image?');">
                                      <img src="{{ $single->image }}" alt="{{ $product->name }}" class="w-100 img-thumbnail">
                                    </a>
                                  </div>
                                @endforeach
                              @endif
                            </div>
                            <input type="file" name="galleryimages[]" multiple="" class="form-control">
                          </div>
                          <div class="form-group pt-4">
                            <div class="row">
                              <div class="col-md-12">
                                <h5><strong>Featured Products</strong></h5>
                                <p>Make this a featured product and select the position on your landing page</p>
                              </div>
                              <div class="col-md-12">
                                <label for="">
                                  <input type="checkbox" name="is_featured" @if($product->is_featured == 1) checked @endif> Featured?
                                </label>
                              </div>
                            </div>
                          </div>
                          <div class="form-group pt-4">
                            <div class="row">
                              <div class="col-md-12">
                                <h5><strong>Strain*</strong></h5>
                              </div>
                              <div class="col-md-12">
                                @if($strains->count() >0)
                                  <select name="strain_id" class="select2 form-control" required="">

                                    @foreach($strains as $strain)

                                      @if($product->strain_id == $strain->id)
                                        <option value="{{ $product->strain_id }}" selected="">{{ $strain->name }}</option>
                                      @else
                                        <option value="{{ $strain->id }}">{{ $strain->name }}</option>
                                      @endif

                                    @endforeach
                                  </select>
                                @endif
                              </div>
                            </div>
                          </div>
                          <div class="form-group pt-4">
                            <div class="row">
                              <div class="col-md-12">
                                <h5><strong>Genetics</strong></h5>
                              </div>
                              <div class="row">
                                @if($genetics->count() >0)
                                  @foreach($genetics as $genetic)
                                    <div class="col-md-2 mb-3">
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="genetic_id" id="{{ $genetic->name }}" value="{{ $genetic->id }}"
                                        @if($genetic->id == $product->genetic_id)
                                           checked
                                        @endif
                                        required=""
                                        >
                                        <label class="form-check-label" for="{{ $genetic->name }}">
                                          {{ $genetic->name }}
                                        </label>
                                      </div>
                                    </div>
                                  @endforeach
                                @endif
                              </div>
                            </div>
                          </div>
                          <div class="form-group pt-4">
                            <div class="row">
                              <div class="col-md-12">
                                <h5><strong>Cannabinoids</strong></h5>
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="">THC %</label>
                                    <input type="number" name="thc_percentage" value="{{ $product->thc_percentage }}" class="form-control">
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="">CBD %</label>
                                    <input type="number" name="cbd_percentage" value="{{ $product->cbd_percentage }}" class="form-control">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row mt-4">
                            <div class="form-group">
                              <button class="appointment-btn" style="margin-left: 0px !important;border: 0px;">Save Changes</button>
                              <a href="{{ route('dashboardbrands') }}" class="btn bg-dark text-white shadow-sm br-30 px-5 ms-2">Cancel</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
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
