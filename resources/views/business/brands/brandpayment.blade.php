@extends('layouts.app')

    @section('title', '420 Finder')

    @php
    $months = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');
    @endphp

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
                <div class="card">
                  <div class="card-body">

                    @include('business.partials.success-error')

                    @if (!$brand->is_paid)
                    {{-- PAYMENT CHECKOUT --}}
                    <div class="form-group">
                       <div class="payment mt-3">
                            <h4 class="text-center"><strong>Payment</strong></h4>
                            <div class="row mt-4">
                                <div class="col-6 mx-auto">

                               <form action="{{ route('storebrandpayment') }}" method="POST" id="store-brand-payment">
                                   @csrf
                                   <div class="row">
                                  <div class="form-group name-on-card col-6 mb-3">
                                        <label for="name-on-card">Name on Card</label>
                                        <input type="text" class="form-control" id="name-on-card" name="name_on_card" value="{{ old('name_on_card') }}" required>

                                   </div>

                                   <input type="hidden" name="brand_id" value="{{ $brand->id }}">

                                   <div class="form-group CVV col-6">
                                        <label for="cvv">CVV</label>
                                         <input type="number" class="form-control" id="cvv" name="cvv" value="{{ old('cvv') }}" required>
                                   </div>


                                    <div class="form-group col-6 mb-3" id="card-number-field">
                                          <label for="cardNumber">Card Number</label>
                                          <input type="number" class="form-control" id="cardNumber" name="card_number" value="{{ old('card_number') }}" required>
                                     </div>

                                        <div class="form-group col-6" id="expiration-date">
                                           <label>Expiration Date</label><br/>
                                           <select class="form-control" id="expiration-month" name="expiration_month" style="float: left; width: 100px; margin-right: 10px;" required>
                                                       @foreach($months as $k=>$v)
                                                           <option value="{{ $k }}" {{ old('expiration_month') == $k ? 'selected' : '' }}>{{ $v }}</option>
                                                       @endforeach
                                                   </select>
                                           <select class="form-control" id="expiration-year" name="expiration_year"  style="float: left; width: 100px;" required>

                                                       @for($i = date('Y'); $i <= (date('Y') + 15); $i++)
                                                       <option value="{{ $i }}">{{ $i }}</option>
                                                       @endfor
                                            </select>
                                       </div>

                                       <div class="form-group">
                                           <button class="btn" id="store-brand-payment-submit" style="background: #f8971c; color: #fff">Pay</button>
                                       </div>
                                   </div>
                               </div>
                               </form>

                                </div>
                           </div>
                    </div>
                    {{-- PAYMENT CHECKOUT ENDS --}}
                    @else
                        <p>Payment option for this brand has been disabled.</p>
                    @endif

                  </div>
                </div>
              </div>
          </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script>
        $(function() {
            $("#store-brand-payment").submit(function () {
                $("#store-brand-payment-submit").attr("disabled", true);
                return true;
            });
        });
    </script>
@endpush

