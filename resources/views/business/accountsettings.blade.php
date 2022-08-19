@extends('layouts.app')

    @section('title', '420 Finder')

    @section('content')

    <section class="pb-0">
        <div class="container-fluid px-0">
          <div class="row">
              <div class="col-md-12 p-5 bg-light">
                <h4 class="pb-3">Account Details</h4>

                <div class="row">
                  <div class="col-md-6">

                    <div class="card p-3 mt-3 shadow-sm">
                      <div class="row">
                        <div class="col-md-6">
                          <h6><strong>First Name</strong></h6>
                          <p class="text-black-50">{{ $business->first_name }}</p>
                        </div>
                        <div class="col-md-6 text-end">
                          <a data-bs-toggle="modal" data-bs-target="#firstname" class="cursor-pointer">Edit</a>
                        </div>
                      </div>
                    </div>

                  </div>
                  <div class="col-md-6">

                    <div class="card p-3 mt-3 shadow-sm">
                      <div class="row">
                        <div class="col-md-6">
                          <h6><strong>Last Name</strong></h6>
                          <p class="text-black-50">{{ $business->last_name }}</p>
                        </div>
                        <div class="col-md-6 text-end">
                          <a data-bs-toggle="modal" data-bs-target="#lastname" class="cursor-pointer">Edit</a>
                        </div>
                      </div>
                    </div>

                  </div>
                  <div class="col-md-6">

                    <div class="card p-3 mt-3 shadow-sm bg-light">
                      <div class="row">
                        <div class="col-md-6">
                          <h6><strong>Email</strong></h6>
                          <p class="text-black-50">{{ $business->email }}</p>
                        </div>
                      </div>
                    </div>

                  </div>
                  <div class="col-md-6">

                    <div class="card p-3 mt-3 shadow-sm">
                      <div class="row">
                        <div class="col-md-6">
                          <h6><strong>Phone</strong></h6>
                          <p class="text-black-50">{{ $business->phone_number }}</p>
                        </div>
                        <div class="col-md-6 text-end">
                          <a data-bs-toggle="modal" data-bs-target="#phonenumber" class="cursor-pointer">Edit</a>
                        </div>
                      </div>
                    </div>

                  </div>
                  <div class="col-md-6">

                    <div class="card p-3 mt-3 shadow-sm">
                      <div class="row">
                        <div class="col-md-6">
                          <h6><strong>Business Name</strong></h6>
                          <p class="text-black-50">{{ $business->business_name }}</p>
                        </div>
                        <div class="col-md-6 text-end">
                          <a data-bs-toggle="modal" data-bs-target="#businessname" class="cursor-pointer">Edit</a>
                        </div>
                      </div>
                    </div>

                  </div>
                  <div class="col-md-6">

                    <div class="card p-3 mt-3 shadow-sm bg-light">
                      <div class="row">
                        <div class="col-md-6">
                          <h6><strong>Business Type</strong></h6>
                          <p class="text-black-50">{{ $business->business_type }}</p>
                        </div>
                      </div>
                    </div>

                  </div>
                  <div class="col-md-6">

                    <div class="card p-3 mt-3 shadow-sm bg-light">
                      <div class="row">
                        <div class="col-md-6">
                          <h6><strong>Country</strong></h6>
                          <p class="text-black-50">{{ $business->country }}</p>
                        </div>
                      </div>
                    </div>

                  </div>
                  <div class="col-md-6">

                    <div class="card p-3 mt-3 shadow-sm">
                      <div class="row">
                        <div class="col-md-6">
                          <h6><strong>Address Line 1</strong></h6>
                          <p class="text-black-50">{{ $business->address_line_1 }}</p>
                        </div>
                        <div class="col-md-6 text-end">
                          <a data-bs-toggle="modal" data-bs-target="#addressline1" class="cursor-pointer">Edit</a>
                        </div>
                      </div>
                    </div>

                  </div>
                    <div class="col-md-6">

                        <div class="card p-3 mt-3 shadow-sm">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6><strong>State / Province</strong></h6>
                                    <?php $state = \Illuminate\Support\Facades\DB::table('states')->where('id','=',$business->state_province)->first(); ?>
                                    <p class="text-black-50">{{ $state->name }}</p>
                                </div>
                                <div class="col-md-6 text-end">
                                    <a data-bs-toggle="modal" data-bs-target="#addressline10" class="cursor-pointer">Edit</a>
                                </div>
                            </div>
                        </div>

                    </div>
                  <div class="col-md-6">

                    <div class="card p-3 mt-3 shadow-sm">
                      <div class="row">
                        <div class="col-md-6">
                          <h6><strong>Address Line 2</strong></h6>
                          <p class="text-black-50">{{ $business->address_line_2 }}</p>
                        </div>
                        <div class="col-md-6 text-end">
                          <a data-bs-toggle="modal" data-bs-target="#addressline2" class="cursor-pointer">Edit</a>
                        </div>
                      </div>
                    </div>

                  </div>
                  <div class="col-md-6">

                    <div class="card p-3 mt-3 shadow-sm bg-light">
                      <div class="row">
                        <div class="col-md-6">
                          <h6><strong>City</strong></h6>
                          <p class="text-black-50">{{ $business->city }}</p>
                        </div>
                      </div>
                    </div>

                  </div>

                  <div class="col-md-6">

                    <div class="card p-3 mt-3 shadow-sm bg-light">
                      <div class="row">
                        <div class="col-md-6">
                          <h6><strong>State / Province</strong></h6>
                          <p class="text-black-50">{{ $business->state_province }}</p>
                        </div>
                      </div>
                    </div>

                  </div>

                  <div class="col-md-6">

                    <div class="card p-3 mt-3 shadow-sm bg-light">
                      <div class="row">
                        <div class="col-md-6">
                          <h6><strong>Postal Code</strong></h6>
                          <p class="text-black-50">{{ $business->postal_code }}</p>
                        </div>
                      </div>
                    </div>

                  </div>
                  <div class="col-md-6">

                    <div class="card p-3 mt-3 shadow-sm">
                      <div class="row">
                        <div class="col-md-6">
                          <h6><strong>Website</strong></h6>
                          <p class="text-black-50">{{ $business->website }}</p>
                        </div>
                        <div class="col-md-6 text-end">
                          <a data-bs-toggle="modal" data-bs-target="#website" class="cursor-pointer">Edit</a>
                        </div>
                      </div>
                    </div>

                  </div>
                  <div class="col-md-6">

                    <div class="card p-3 mt-3 shadow-sm bg-light">
                      <div class="row">
                        <div class="col-md-6">
                          <h6><strong>License Number</strong></h6>
                          <p class="text-black-50">{{ $business->license_number }}</p>
                        </div>
                      </div>
                    </div>

                  </div>
                  <div class="col-md-6">

                    <div class="card p-3 mt-3 shadow-sm bg-light">
                      <div class="row">
                        <div class="col-md-6">
                          <h6><strong>License Type</strong></h6>
                          <p class="text-black-50">{{ $business->license_type }}</p>
                        </div>
                      </div>
                    </div>

                  </div>
                  <div class="col-md-6">

                    <div class="card p-3 mt-3 shadow-sm bg-light">
                      <div class="row">
                        <div class="col-md-6">
                          <h6><strong>License Expiration</strong></h6>
                          <p class="text-black-50">{{ $business->license_expiration }}</p>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>

              </div>
          </div>
        </div>
    </section>

  <!-- First Name -->
  <div class="modal fade" id="firstname" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('updatefirstname') }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <h6><strong>Update First Name</strong></h6>
              </div>
              <div class="col-md-6 text-end pt-2 pe-3">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
            </div>
          <div class="row my-3">
            <div class="col-md-12">
                <div class="form-group">
                  <label for="">First Name</label>
                  <input id="editfirstname" type="text" name="name" value="{{ $business->first_name }}" placeholder="Enter First Name" class="form-control" required="">
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <button id="updatefirstname" type="button" class="appointment-btn w-100 border-0" style="margin-left: 0px;"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span> Save</button>
            </div>
          </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Last Name -->
  <div class="modal fade" id="lastname" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('updatelastname') }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <h6><strong>Update Last Name</strong></h6>
              </div>
              <div class="col-md-6 text-end pt-2 pe-3">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
            </div>
          <div class="row my-3">
            <div class="col-md-12">
                <div class="form-group">
                  <label for="">Last Name</label>
                  <input id="editlastname" type="text" name="name" value="{{ $business->last_name }}" placeholder="Enter Last Name" class="form-control" required="">
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <button id="updatelastname" type="button" class="appointment-btn w-100 border-0" style="margin-left: 0px;"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span> Save</button>
            </div>
          </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Phone Number -->
  <div class="modal fade" id="phonenumber" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('updatephonenumber') }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <h6><strong>Update Phone Number</strong></h6>
              </div>
              <div class="col-md-6 text-end pt-2 pe-3">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
            </div>
          <div class="row my-3">
            <div class="col-md-12">
                <div class="form-group">
                  <label for="">Phone Number</label>
                  <input id="editphonenumber" type="text" name="name" value="{{ $business->phone_number }}" placeholder="Enter Last Name" class="form-control" required="">
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <button id="updatephonenumber" type="button" class="appointment-btn w-100 border-0" style="margin-left: 0px;"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span> Save</button>
            </div>
          </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Business Name -->
  <div class="modal fade" id="businessname" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('updatebusinessname') }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <h6><strong>Update Business Name</strong></h6>
              </div>
              <div class="col-md-6 text-end pt-2 pe-3">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
            </div>

          <div class="row my-3">
            <div class="col-md-12">
                <div class="form-group">
                  <label for="">Business Name</label>
                  <input id="editbusinessname" type="text" name="name" value="{{ $business->business_name }}" placeholder="Enter Last Name" class="form-control" required="">
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <button id="updatebusinessname" type="button" class="appointment-btn w-100 border-0" style="margin-left: 0px;"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span> Save</button>
            </div>
          </div>
          </div>
        </form>
      </div>

    </div>
  </div>

    <!-- Address Line 1 -->
    <div class="modal fade" id="addressline10" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('updateState') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6><strong>Update Address Line 1</strong></h6>
                            </div>
                            <div class="col-md-6 text-end pt-2 pe-3">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Address Line 1</label>
                                    <select name="state_province"  class="form-control"
                                            style="margin-bottom: 1.2rem;" required>
                                        <option value="">Select State</option>
                                        @foreach ($statee as $row)

                                            <option value="{{ $row->id }}" {{ ($row->id == $business->state_province) ? 'selected' : '' }}>{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button  type="submit" class="appointment-btn w-100 border-0" style="margin-left: 0px;"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span> Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Address Line 1 -->
  <div class="modal fade" id="addressline1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('updateaddresslineone') }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <h6><strong>Update Address Line 1</strong></h6>
              </div>
              <div class="col-md-6 text-end pt-2 pe-3">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
            </div>
          <div class="row my-3">
            <div class="col-md-12">
                <div class="form-group">
                  <label for="">Address Line 1</label>
                  <input id="editaddressline1" type="text" name="name" value="{{ $business->address_line_1 }}" placeholder="Enter Address Line 1" class="form-control" required="">
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <button id="updateaddresslineone" type="button" class="appointment-btn w-100 border-0" style="margin-left: 0px;"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span> Save</button>
            </div>
          </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Address Line 2 -->
  <div class="modal fade" id="addressline2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('updateaddresslinetwo') }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <h6><strong>Update Address Line 2</strong></h6>
              </div>
              <div class="col-md-6 text-end pt-2 pe-3">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
            </div>
          <div class="row my-3">
            <div class="col-md-12">
                <div class="form-group">
                  <label for="">Address Line 2</label>
                  <input id="editaddressline2" type="text" name="name" value="{{ $business->address_line_2 }}" placeholder="Enter Address Line 2" class="form-control" required="">
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <button id="updateaddresslinetwo" type="button" class="appointment-btn w-100 border-0" style="margin-left: 0px;"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span> Save</button>
            </div>
          </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- website -->
  <div class="modal fade" id="website" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('updatewebsite') }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <h6><strong>Update Website URL</strong></h6>
              </div>
              <div class="col-md-6 text-end pt-2 pe-3">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
            </div>
          <div class="row my-3">
            <div class="col-md-12">
                <div class="form-group">
                  <label for="">Website URL</label>
                  <input id="editwebsite" type="text" name="name" value="{{ $business->website }}" placeholder="Enter website url" class="form-control" required="">
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <button id="updatewebsite" type="button" class="appointment-btn w-100 border-0" style="margin-left: 0px;"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span> Save</button>
            </div>
          </div>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection
