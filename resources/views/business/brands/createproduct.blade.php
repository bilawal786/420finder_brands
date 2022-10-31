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

                    @if (!$brand->is_paid)
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <nav aria-label="breadcrumb" class="pt-2">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('dashboardbrands') }}">Brands</a>
                                        </li>
                                        <li class="breadcrumb-item"><a
                                                href="{{ route('viewprofilebrand', ['id' => $brand->id]) }}">{{ $brand->name }}</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Products</li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="col-md-6 text-end">
                                <a href="{{ route('managebrandproducts', ['slug' => $brand->slug, 'id' => $brand->id]) }}"
                                   class="btn bg-white shadow-sm">Go Back</a>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body pb-5">

                                @include('business.partials.success-error')

                                <form action="{{ route('savebrandproduct') }}" method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="brand_id" value="{{ $brand->id }}">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="" class="pb-2">Avatar image</label>
                                            <img src="{{ asset('dummy.png') }}" alt="" class="w-100 img-thumbnail">
                                            <div class="form-group mt-3">
                                                <input type="file" name="image" class="form-control" required="">
                                            </div>
                                            {{-- <div class="mt-3">
                                              <div class="form-group">
                                                <label for="">Status</label>
                                                <select name="status" class="form-control" required="">
                                                  <option value="">Select</option>
                                                  <option value="0">Unpublished</option>
                                                  <option value="1">Published</option>
                                                </select>
                                              </div>
                                            </div> --}}
                                        </div>


                                        <div class="col-md-10">
                                            <div class="form-group pb-4">
                                                <label for="">Name</label>
                                                <input type="text" name="name" class="form-control" required="">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Description</label>
                                                <textarea id="editor1" name="description" cols="5" rows="5"
                                                          class="form-control" required=""></textarea>
                                            </div>
                                            <div class="form-group pt-3">
                                                <label for="">External ID</label>
                                                <input type="text" name="sku" class="form-control">
                                            </div>
                                            <div class="form-group pt-3">
                                                <label for="">Suggested Price*</label>
                                                <input type="number" name="suggested_price" class="form-control"
                                                       required="">
                                            </div>
                                            <div class="form-group pt-3">
                                                <label for="">Gallery Images</label>
                                                <input type="file" name="galleryimages[]" multiple=""
                                                       class="form-control">
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-md-12">
                                                    <h5><strong>Categorization</strong></h5>
                                                </div>
                                                <div class="col-md-3 border p-3">
                                                    <h6 class="mb-3"><strong>Main Categories <span
                                                                class="text-danger">*</span></strong></h6>
                                                    <ul class="list-unstyled">
                                                        @foreach($categories as $category)
                                                            <li class="mb-2">
                                                                <label for="">
                                                                    <input rel="{{ $category->name }}" type="radio"
                                                                           name="category_id" class="mainCategory"
                                                                           value="{{ $category->id }}"
                                                                           required=""> {{ $category->name }}
                                                                </label>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                {{-- <div class="col-md-9 border p-3">
                                                  <div class="row border p-2 mb-3">
                                                    <div class="col-md-12 selectedcats">
                                                      Start by selecting a main category
                                                    </div>
                                                  </div>
                                                  <div id="typesubcategories"></div>
                                                </div> --}}
                                            </div>
                                            <div class="form-group pt-4">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h5><strong>Featured Products</strong></h5>
                                                        <p>Make this a featured product and select the position on your
                                                            landing page</p>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="">
                                                            <input type="checkbox" name="is_featured"> Featured?
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group pt-4">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h5><strong>Strain (Optional)</strong> </h5>
                                                        Not available?   <a data-bs-toggle="modal" data-bs-target="#phonenumber" class="cursor-pointer">Click here to add</a>
                                                    </div>
                                                    <div class="col-md-12">
                                                        @if($strains->count() >0)
                                                            <select name="strain_id" class="select2 form-control"
                                                                    required="">
                                                                <option value="">No Strain Selected</option>
                                                                @foreach($strains as $strain)
                                                                    <option
                                                                        value="{{ $strain->id }}">{{ $strain->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group pt-4">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h5><strong>Genetics (Optional)</strong></h5>
                                                    </div>
                                                    <div class="row">
                                                        @if($genetics->count() >0)
                                                            @foreach($genetics as $genetic)
                                                                <div class="col-md-2 mb-3">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio"
                                                                               name="genetic_id"
                                                                               id="{{ $genetic->name }}"
                                                                               value="{{ $genetic->id }}" required="">
                                                                        <label class="form-check-label"
                                                                               for="{{ $genetic->name }}">
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
                                                        <h5><strong>Cannabinoids (Optional)</strong></h5>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">THC % (Optional)</label>
                                                                <input type="number" name="thc_percentage"
                                                                       class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">CBD % (Optional)</label>
                                                                <input type="number" name="cbd_percentage"
                                                                       class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-5">
                                                <div class="form-group">
                                                    <button class="appointment-btn"
                                                            style="margin-left: 0px !important;border: 0px;">Save
                                                        Changes
                                                    </button>
                                                    <a href="{{ route('dashboardbrands') }}"
                                                       class="btn bg-dark text-white shadow-sm br-30 px-5 ms-2">Cancel</a>
                                                </div>
                                            </div>

                                        </div>
                                        {{-- COL 10 --}}
                                    </div>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="card">
                            <div class="card-body">
                                <h5 class="mb-3">Please complete payment process</h5>
                                <a href="{{ route('managebrandpayments', [$brand->slug, $brand->id]) }}"
                                   class="btn btn-primary">Go to payment</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="phonenumber" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('add.strain') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6><strong>Add New Strain</strong></h6>
                            </div>
                            <div class="col-md-6 text-end pt-2 pe-3">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Add New Strain</label>
                                    <input  type="text" name="strain" value="" placeholder="Add New Strain" class="form-control" required="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="appointment-btn w-100 border-0" style="margin-left: 0px;"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span> Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
