@extends('layouts.app')

    @section('title', '420 Finder')

    @section('content')

        <div class="dash-analytics">
           <div class="d-box text-center p-4 mb-5" style="border-radius: 20px;">
               <h1 style="font-weight: 900; font-style: italic;" class="d-size">MASTER DASHBOARD</h1>
           </div>

{{--                <p class="text-black-50">Today's Analytics</p>--}}
                <div class="row mt-4">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-sm-6 col-md-3 mb-3">
                        <div class="card business-card">
                            <h5>Total brands</h5>
                          <div class="card-content">
                              <p class="mb-0">{{ $totalbrands }}</p>
                              <div class="card-icon card-icon-blue">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"></path><path d="M7 5V2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v3h4a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h4zM4 16v3h16v-3H4zm0-2h16V7H4v7zM9 3v2h6V3H9zm2 8h2v2h-2v-2z"></path></svg>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6 col-md-3 mb-3">
                        <div class="card business-card">
                            <h5>Total published brands</h5>
                          <div class="card-content">
                              <p class="mb-0">{{ $publishedbrands }}</p>
                              <div class="card-icon card-icon-blue">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"></path><path d="M7 5V2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v3h4a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h4zM4 16v3h16v-3H4zm0-2h16V7H4v7zM9 3v2h6V3H9zm2 8h2v2h-2v-2z"></path></svg>
                              </div>
                        </div>

                        </div>
                      </div>
                      <div class="col-sm-6 col-md-3 mb-3">
                        <div class="card business-card">
                          <h5>Total unpublished brands</h5>
                          <div class="card-content">
                            <p class="mb-0">{{ $unpublishedbrands }}</p>
                            <div class="card-icon card-icon-blue">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"></path><path d="M7 5V2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v3h4a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h4zM4 16v3h16v-3H4zm0-2h16V7H4v7zM9 3v2h6V3H9zm2 8h2v2h-2v-2z"></path></svg>
                              </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6 col-md-3 mb-3">
                        <div class="card business-card">
                          <h5>Total Delivery</h5>
                          <div class="card-content">
                            <p class="mb-0">{{ $totalDelivery }}</p>
                            <div class="card-icon card-icon-purple">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M20 22H4a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1zm-1-2V4H5v16h14zM7 6h4v4H7V6zm0 6h10v2H7v-2zm0 4h10v2H7v-2zm6-9h4v2h-4V7z"/></svg>
                              </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6 col-md-3 mb-3">
                        <div class="card business-card">
                            <h5>Total Dispensary</h5>
                          <div class="card-content">
                              <p class="mb-0">{{ $totalDispensary }}</p>
                              <div class="card-icon card-icon-orange">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M8 1v4H4v14h16V3h1.008c.548 0 .992.445.992.993v16.014a1 1 0 0 1-.992.993H2.992A.993.993 0 0 1 2 20.007V3.993A1 1 0 0 1 2.992 3H6V1h2zm4 7l4 4h-3v4h-2v-4H8l4-4zm6-7v4h-8V3h6V1h2z"/></svg>
                              </div>
                          </div>
                        </div>
                      </div>
{{--                      <div class="col-sm-6 col-md-3 mb-3">--}}
{{--                        <div class="card business-card">--}}
{{--                          <h5>Total product reviews</h5>--}}
{{--                          <div class="card-content">--}}
{{--                              <p class="mb-0">{{ $totalproductreviews }}</p>--}}
{{--                            <div class="card-icon card-icon-orange">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M8 1v4H4v14h16V3h1.008c.548 0 .992.445.992.993v16.014a1 1 0 0 1-.992.993H2.992A.993.993 0 0 1 2 20.007V3.993A1 1 0 0 1 2.992 3H6V1h2zm4 7l4 4h-3v4h-2v-4H8l4-4zm6-7v4h-8V3h6V1h2z"/></svg>--}}
{{--                            </div>--}}
{{--                          </div>--}}
{{--                        </div>--}}
{{--                      </div>--}}
                    </div>
                  </div>
                </div>
                </div>

         {{-- CHARTS --}}
        <div class="row chart-row">
                    <div class="col-xs-12 col-md-8 chart-col">
                        <div class="line-chart">
                            {!! $chart->container() !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-4 chart-col">
                        <div class="pie-chart">
                            {!! $pieChart->container() !!}
                        </div>
                    </div>
          </div>
@endsection


@section('styles')
    <style>

        .chart-row {
            margin: 2rem 0;
        }

        .chart-row .line-chart,
        .chart-row .pie-chart {
            padding: 1rem;
            background-color: #fff;
            margin: 1rem 0;
            box-shadow: 1px 1px 13px 1px rgb(0 0 0 / 19%);
        }

        .apexcharts-title-text {
            font-size: 1.2rem;
        }
    </style>
@endsection
@push('scripts')
     <script src="{{ $chart->cdn() }}"></script>
     {{ $chart->script() }}
     {{ $pieChart->script() }}
@endpush

