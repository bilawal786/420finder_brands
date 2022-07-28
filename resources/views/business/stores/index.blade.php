@extends('layouts.app')

    @section('title', '420 Finder')

    @section('content')

    <section class="pb-0">
        <div class="container-fluid px-0">
          <div class="row">
              <div class="col-md-12 p-5 bg-light">
                <div class="card mb-5">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <h4>My Stores</h4>
                      </div>
                      <div class="col-md-6 text-end">
                        <a href="{{ route('addnewstore') }}" class="appointment-btn" style="margin-left: 0px !important;">Add New</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body">
                    <div class="table responsive">

                      <table class="table">
                        <thead>
                          <th>#</th>
                          <th>Business Name</th>
                          <th>Type</th>
                          <th>View Store</th>
                          <th>Login to account</th>
                          <th>Created At</th>
                        </thead>
                        <tbody>
                          @if($stores->count() > 0)
                            @foreach($stores as $index => $store)
                              <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $store->business_name }}</td>
                                <td>
                                  {{ $store->business_type }}
                                </td>
                                <td>
                                  @if($store->business_type == 'dispensary')
                                    {{-- <a href="{{ route('dispensarysingle', ['name' => $store->business_name, 'id' => $store->id]) }}" target="_blank">View</a> --}}
                                    <a href="http://420finder.net/dispensaries/{{ $store->business_name }}/{{ $store->id }}" target="_blank">View</a>

                                  @elseif ($store->business_type == 'brand')

                                    <a href="http://420finder.net/brand/{{ $store->business_name }}/{{ $store->id }}" target="_blank">View</a>

                                  @else
                                    {{-- <a href="{{ route('deliverysingle', ['name' => $store->business_name, 'id' => $store->id]) }}" target="_blank">View</a> --}}

                                    <a href="http://420finder.net/deliveries/{{ $store->business_name }}/{{ $store->id }}" target="_blank">View</a>

                                  @endif
                                </td>
                                <td>
                                  @if($store->business_type == 'dispensary')
                                    <a href="https://dispensaries.420finder.net" class="text-warning" target="_blank">Login</a>
                                   @elseif ($store->business_type == 'brand')

                                    <a href="https://brand.420finder.net" class="text-warning" target="_blank">Login</a>

                                  @else
                                    <a href="https://dispensaries.420finder.net" class="text-warning" target="_blank">Login</a>
                                  @endif
                                </td>
                                <td>{{ $store->created_at->diffForHumans() }}</td>
                              </tr>
                              @endforeach
                          @else

                          @endif
                        </tbody>
                      </table>

                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
    </section>

@endsection
