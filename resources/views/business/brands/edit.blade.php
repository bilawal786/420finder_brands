@extends('layouts.app')

    @section('title', '420 Finder')

    @section('content')

    <section class="pb-0">
        <div class="container-fluid px-0">
          <div class="row">
              @if (!$brand->is_paid)
              <div class="col-md-12 p-5 bg-light">
                <div class="card mb-5">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <h4>Update Brand</h4>
                      </div>
                      <div class="col-md-6 text-end">
                        <a href="{{ route('dashboardbrands') }}" class="appointment-btn" style="margin-left: 0px !important;">Go Back</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body pb-5">
                    @include('business.partials.success-error')

                    <form action="{{ route('updatebrand') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" name="brand_id" value="{{ $brand->id }}">
                      <div class="row">
                        <div class="col-md-2">
                          <label for="" class="pb-2">Avatar image</label>
                          @if($brand->profile_picture == NULL)
                            <img src="{{ asset('dummy.png') }}" alt="" class="w-100 img-thumbnail">
                          @else
                            <img src="{{ $brand->profile_picture }}" alt="" class="w-100 img-thumbnail">
                          @endif
                          <div class="form-group mt-3">
                            <input type="file" name="logo" class="form-control">
                          </div>
                          <div class="mt-3">
                            <div class="form-group">
                              <label for="">Status</label>
                              <select name="status" class="form-control" required="">
                                @if($brand->status == 0)
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
                            <input type="text" name="name" value="{{ $brand->business_name }}" class="form-control" required="">
                          </div>
                          <div class="form-group">
                            <label for="">Description</label>
                            <textarea id="editor1" name="description" cols="5" rows="5" class="form-control" required="">{{ $brand->introduction }}</textarea>
                          </div>
                          <div class="row mt-4">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="">License type</label>
                                <select name="license_type" class="form-control" required="">
                                  <option value="{{ $brand->license_type }}">{{ $brand->license_type }}</option>
                                  <option value="Adult-Use Cultivation">Adult-Use Cultivation</option>
                                  <option value="Adult-Use Mfg">Adult-Use Mfg.</option>
                                  <option value="Adult-Use Nonstorefront">Adult-Use Nonstorefront</option>
                                  <option value="Adult-Use Retail">Adult-Use Retail</option>
                                  <option value="Distributor">Distributor</option>
                                  <option value="Event">Event</option>
                                  <option value="Medical Cultivation">Medical Cultivation</option>
                                  <option value="Medical Mfg">Medical Mfg</option>
                                  <option value="Medical Nonstorefront">Medical Nonstorefront</option>
                                  <option value="Medical Retail">Medical Retail</option>
                                  <option value="Microbusiness">Microbusiness</option>
                                  <option value="Testing Lab">Testing Lab</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="">License Number</label>
                                <input type="text" name="license_number" value="{{ $brand->license_number }}" class="form-control" required="">
                              </div>
                            </div>
                          </div>
                          <div class="row mt-4">
                            <div class="col-md-12">
                              <h4><strong>Youtube</strong></h4>
                              <p>Enter YouTube URLs to display videos for the brand page</p>
                              <div class="form-group pb-3">
                                <label for="">Featured Video ID</label>
                                <input type="text" name="yt_featured_url" value="{{ $brand->yt_featured_url }}" placeholder="Enter Brand Featured Video URL" class="form-control">
                              </div>
                              <div class="form-group">
                                <label for="">Featured Playlist ID</label>
                                <input type="text" name="yt_playlist_url" value="{{ $brand->yt_playlist_url }}" placeholder="Enter Brand Playlist URL" class="form-control">
                              </div>
                            </div>
                          </div>
                          <div class="row mt-4">
                            <div class="col-md-12">
                              <h4><strong>Images</strong></h4>
                              <p>Images that will be displayed for the brand</p>
                              <div>
                                @if($brand->cover == NULL)
                                  <img src="{{ asset('placeholder-cover.png') }}" alt="" class="w-50 img-thumbnail">
                                @else
                                  <img src="{{ $brand->cover }}" alt="" class="w-50 img-thumbnail">
                                @endif
                              </div>
                              <div class="form-group pt-3">
                                <label for="">Desktop hero image</label>
                                <input type="file" name="cover" class="form-control">
                              </div>
                            </div>
                          </div>
                          <div class="row mt-4">
                            <div class="col-md-12">
                              <h4><strong>Social Networks</strong></h4>
                              <div class="form-group pb-3">
                                <label for="">Website URL</label>
                                <input type="text" name="website_url" value="{{ $brand->website }}" placeholder="Enter brand website url" class="form-control">
                              </div>
                              <div class="form-group pb-3">
                                <label for="">Instagram URL</label>
                                <input type="text" name="instagram_url" value="{{ $brand->instagram }}" placeholder="Enter brand instagram url" class="form-control">
                              </div>
                              <div class="form-group pb-3">
                                <label for="">Twitter URL</label>
                                <input type="text" name="twitter_url" value="{{ $brand->twitter }}" placeholder="Enter brand twitter url" class="form-control">
                              </div>
                              <div class="form-group pb-3">
                                <label for="">Facebook Page URL</label>
                                <input type="text" name="facebook_url" value="{{ $brand->facebook }}" placeholder="Enter brand facebook page url" class="form-control">
                              </div>
                            </div>
                          </div>
                          <div class="row mt-4">
                            <div class="form-group">
                              <button class="appointment-btn" style="margin-left: 0px !important;border: 0px;">Save Changes</button>
                              <a href="{{ route('dashboardbrands') }}">Cancel</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              @else
              <div class="col-md-12 p-5 bg-light">
              <div class="card">
                  <div class="card-body">
                      <h5 class="mb-3">Please complete payment process</h5>
                      <a href="{{ route('managebrandpayments', [$brand->id]) }}" class="btn btn-primary">Go to payment</a>
                  </div>
              </div>
              </div>
              @endif

          </div>
        </div>
    </section>

@endsection
