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

                @if ($brand->is_paid)
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-12 text-end">
                        <a data-bs-toggle="modal" data-bs-target="#addnewfeed" class="btn bg-white shadow-sm border cursor-pointer">Add New</a>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="table-responsive">
                          <table class="table">
                            <thead>
                              <th>#</th>
                              <th>Image</th>
                              <th>Name</th>
                              <th>Created At</th>
                              <th></th>
                            </thead>
                            <tbody>
                              @if($feeds->count() > 0)
                                @foreach($feeds as $index => $feed)
                                  <tr>
                                    <td>{{ $index +1 }}</td>
                                    <td>
                                      <img src="{{ $feed->image }}" style="width: 35px; height: 35px;">
                                    </td>
                                    <td>
                                      {{ substr($feed->description, 0,70) }}...
                                    </td>
                                    <td>
                                      {{ $feed->created_at->diffForHumans() }}
                                    </td>
                                    <td>
                                      <a rel="{{ $feed->id }}" data-bs-toggle="modal" data-bs-target="#editfeed" class="btn bg-white border me-2 cursor-pointer editfeed">Edit</a>
                                      <a href="{{ route('removebrandfeed', ['id' => $feed->id]) }}" class="btn bg-white border" onclick="return confirm('Are you sure you want to delete this post?');"><i class="fa fa-trash"></i></a>
                                    </td>
                                  </tr>
                                @endforeach
                              @else
                              <tr>
                                <td colspan="4">No Feeds.</td>
                              </tr>
                              @endif
                            </tbody>
                          </table>
                        </div>
                      </div>
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

  <!-- Add Feed -->
  <div class="modal fade" id="addnewfeed" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('savebrandfeed') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <h6><strong>New Post</strong></h6>
              </div>
              <div class="col-md-6 text-end pt-2 pe-3">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
            </div>
          <div class="row my-3">
            <div class="col-md-12">
              <input type="hidden" name="brand_id" value="{{ $brand->id }}">
                <div class="form-group">
                  <label for="">Add Photo</label>
                  <input type="file" name="image" class="form-control" required="">
                </div>
                <div class="form-group pt-3">
                  <label for="">Description</label>
                  <textarea name="description" class="form-control" cols="5" rows="5" placeholder="Write here..." required=""></textarea>
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

  <!-- Add Feed -->
  <div class="modal fade" id="editfeed" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('updatebrandfeed') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <h6><strong>Edit Post</strong></h6>
              </div>
              <div class="col-md-6 text-end pt-2 pe-3">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
            </div>
          <div class="row my-3">
            <div class="col-md-12">
              <input id="feed_id" type="hidden" name="feed_id" value="">
              <input type="hidden" name="brand_id" value="{{ $brand->id }}">
                <div class="form-group">
                  <label for="">Change Photo</label><br>
                  <img id="feeImage" src="" class="w-25 img-thumbnail mb-2 mt-2">
                  <input type="file" name="image" class="form-control">
                </div>
                <div class="form-group pt-3">
                  <label for="">Description</label>
                  <textarea id="feedDescription" name="description" class="form-control" cols="5" rows="5" placeholder="Write here..." required=""></textarea>
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
