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
                          <div class="form-group pb-3">
                            <label for="">Description</label>
                            <textarea id="editor1" name="description" cols="5" rows="5" class="form-control">{{ $brand->introduction }}</textarea>
                          </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group pb-3">
                                        <label for="">Address Line 1</label>
                                        <input id="address_line_1" type="text" name="address_line_1" value="{{ $brand->address_line_1 }}" class="form-control" required="">
                                        <input id="latitude" type="hidden" name="latitude">
                                        <input id="longitude" type="hidden" name="longitude">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group pb-3">
                                        <label for="">Address Line 2</label>
                                        <input id="address_line_2" type="text" name="address_line_2" value="{{ $brand->address_line_2 }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group pb-3">
                                        <label for="">City</label>
                                        <input id="city" type="text" name="city" class="form-control" value="{{ $brand->city }}" readonly>
                                    </div>
                                </div>

{{--                                <div class="col-md-6">--}}
{{--                                    <div class="form-group pb-3">--}}
{{--                                        <label for="">State / Province</label>--}}
{{--                                        <select required name="state_province" id="state_province" class="form-control">--}}
{{--                                            <option value="">Select State</option>--}}
{{--                                            @foreach ($state as $row)--}}
{{--                                                <option value="{{ $row->id }}" {{ ( $row->id == $brand->state_province) ? 'selected' : '' }} > {{ $row->name }}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="col-md-6">
                                    <div class="form-group pb-3">
                                        <label for="">Country</label>
                                        <input id="country" type="text" name="country" class="form-control" value="{{ $brand->country }}"  readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group pb-3">
                                        <label for="">Postal code</label>
                                        <input id="postcode" type="text" name="postal_code" value="{{ $brand->postal_code }}" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group pb-3">
                                        <label for="">Business Phone #</label>
                                        <input  type="text" name="business_phone_number" id="businessPhoneNumber" class="form-control" value="{{ $brand->business_phone_number }}" >
                                    </div>
                                </div>
                            </div>
                            <h4><strong>License</strong></h4>
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
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Expiration</label>
                                      <input type="date" name="license_expiration" value="{{ $brand->license_expiration }}" class="form-control" required="">
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
@push('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyCrAR67o9XfYUXH6u66iVXYhqsOzse6Uz8"></script>
    <script>
        let autocomplete = '';
        let postalField = '';
        let address1Field = '';
        let address2Field = '';
        function initAutocomplete() {
            address1Field = document.querySelector("#address_line_1");
            address2Field = document.querySelector("#address_line_2");
            postalField = document.querySelector("#postcode");

            // Create the autocomplete object, restricting the search predictions to
            // addresses in the US and Canada.
            autocomplete = new google.maps.places.Autocomplete(address1Field, {
                componentRestrictions: { country: "us" },
                fields: ["address_components", "geometry"],
                types: ["address"],
            });
            address1Field.focus();

            // When the user selects an address from the drop-down, populate the
            // address fields in the form.
            autocomplete.addListener("place_changed", fillInAddress);
        }

        function fillInAddress() {
            // Get the place details from the autocomplete object.
            const place = autocomplete.getPlace();
            let address1 = "";
            let postcode = "";

            document.querySelector("#latitude").value = autocomplete.getPlace().geometry.location.lat();
            document.querySelector("#longitude").value = autocomplete.getPlace().geometry.location.lng();



            // Get each component of the address from the place details,
            // and then fill-in the corresponding field on the form.
            // place.address_components are google.maps.GeocoderAddressComponent objects
            // which are documented at http://goo.gle/3l5i5Mr
            for (const component of place.address_components) {
                // @ts-ignore remove once typings fixed
                const componentType = component.types[0];


                switch (componentType) {
                    case "street_number": {
                        address1 = `${component.long_name} ${address1}`;
                        break;
                    }

                    case "route": {
                        address1 += component.short_name;
                        break;
                    }

                    case "postal_code": {
                        postcode = `${component.long_name}${postcode}`;
                        break;
                    }

                    case "postal_code_suffix": {
                        postcode = `${postcode}-${component.long_name}`;
                        break;
                    }

                    case "locality":
                        document.querySelector("#city").value = component.long_name;
                        break;

                    case "administrative_area_level_1": {
                        // document.querySelector("#state").value = component.short_name;
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: "/states",
                            method:"GET",
                            success:function(data) {

                                data.forEach(myFunction)

                                function myFunction(item, index, arr) {

                                    if(arr[index].name == component.long_name){
                                        console.log(arr[index].id);
                                        document.querySelector("#state_province").value = arr[index].id;

                                    }
                                }
                            }
                        });


                        break;
                    }

                    case "country":
                        document.querySelector("#country").value = component.long_name;
                        break;
                }
            }

            address1Field.value = address1;
            postalField.value = postcode;

            // After filling the form with address components from the Autocomplete
            // prediction, set cursor focus on the second address line to encourage
            // entry of subpremise information such as apartment, unit, or floor number.
            address2Field.focus();
        }
        google.maps.event.addDomListener(window, 'load', initAutocomplete);

        $('#businessPhoneNumber').on('change', function() {
            let phoneNumber = $('#businessPhoneNumber').val();
            let x = phoneNumber.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
            phoneNumber = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');

            $('#businessPhoneNumber').val(phoneNumber);
        });

    </script>
@endpush
