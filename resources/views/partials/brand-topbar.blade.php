@php
  $contactDetail = '';
  $productmanagement = '';
  $manageverifications = '';
  $feeds = '';
  $payments = '';
  $accontSetting = '';
  $getState  = '';

  if($active == 'contact-details') {
    $contactDetail = 'navActive';
  } elseif($active == 'product-management') {
    $productmanagement = 'navActive';
  } elseif($active == 'manage-verifications') {
    $manageverifications = 'navActive';
  } elseif($active == 'feeds') {
    $feeds = 'navActive';
  } elseif($active == 'payments') {
    $payments = 'navActive';
  } elseif($active == 'account-setting'){
    $accontSetting = 'navActive';
  } elseif($active == 'states'){
    $getState = 'navActive';
  }

@endphp
<div class="row">
  <div class="col-md-10">
    <ul class="list-unstyled d-flex mb-0 pt-2">
        <li class="me-4 {{ $accontSetting }}">
            <h6>
                <a href="{{ route('accountSettingBrand', ['id' => $brand->id]) }}">Account Details</a>
            </h6>
        </li>
{{--      <li class="me-4 {{ $contactDetail }}">--}}
{{--        <h6>--}}
{{--          <a href="{{ route('viewprofilebrand', ['id' => $brand->id]) }}">CONTACT DETAILS</a>--}}
{{--        </h6>--}}
{{--      </li>--}}
{{--      <li class="me-4 {{ $payments }}">--}}
{{--        <h6 style="font-size: 1.1rem">--}}
{{--          <a href="{{ route('managebrandpayments', [$brand->slug, $brand->id]) }}">Payments</a>--}}
{{--        </h6>--}}
{{--      </li>--}}
      <li class="me-4 {{ $productmanagement }}">
        <h6>
          <a href="{{ route('managebrandproducts', ['id' => $brand->id]) }}">Product Management</a>
        </h6>
      </li>
      <li class="me-4 {{ $manageverifications }}">
        <h6>
          <a href="{{ route('manageverifications', [ 'id' => $brand->id]) }}">Manage Verifications</a>
        </h6>
      </li>
      <li class="me-4 {{ $getState }}">
        <h6>
          <a href="{{ route('brandStates', ['id' => $brand->id]) }}">States</a>
        </h6>
      </li>
        <li class="me-4 {{ $feeds }}">
            <h6>
                <a href="{{ route('viewbrandfeeds', ['id' => $brand->id]) }}">Feed</a>
            </h6>
        </li>
    </ul>
  </div>
  {{-- <div class="col-md-2 text-end">
    <a href="" class="appointment-btn" style="margin-left: 0px !important;">View brand <i class="fas fa-share"></i></a>
  </div> --}}
</div>
