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

                @if($brand->is_paid)
                <div class="card">
                  <div class="card-body">
                    <div class="table responsive">
                      <table class="table table-borderless">
                        <thead>
                          <th>#</th>
                          <th>Retailer</th>
                          <th>Date</th>
                          <th>Verification Status</th>
                          <th>Menu Items</th>
                          <th>Action</th>
                        </thead>
                        <tbody>
                          @if($requests->count() > 0)
                            @foreach($requests as $index => $request)
                              <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                  <?php
                                    $retailer = App\Models\Business::where('id', $request->retailer_id)
                                      ->select('business_name', 'business_type')
                                      ->first();
                                    echo "<strong style='color: #f8971c;'>" . $retailer->business_name . "</strong>";
                                    echo "<p class='text-black-50' style='font-size:12px;'>" . $retailer->business_type . "</p>";
                                  ?>
                                </td>
                                <td>{{ $request->created_at }}</td>
                                <td>
                                  <?php
                                    if ($request->status == '') {
                                        ?>
                                        <span class="badge bg-warning">Pending</span>
                                        <?php
                                    } elseif ($request->status == 0) {
                                        ?>
                                        <span class="badge bg-danger">Rejected</span>
                                        <?php
                                    } elseif ($request->status == 1) {
                                        ?>
                                        <span class="badge bg-info">Approved</span>
                                        <?php
                                    }
                                  ?>
                                </td>
                                <td>
                                    <a rel="{{ $request->id }}" class="viewrequestedproducts cursor-pointer">
                                        <?php
                                            $pids = explode(", ", $request->products);
                                            echo count($pids);
                                        ?>
                                    </a>
                                </td>
                                <td>
                                  @if($request->status == '')
                                    <a href="{{ route('approveproductrequest', ['id' => $request->id]) }}" class="btn btn-primary shadow-sm me-2" onclick="return confirm('Are you sure you want to approve this request?');">Approve</a>
                                    <a href="{{ route('rejectproductrequest', ['id' => $request->id]) }}" class="btn btn-danger shadow-sm" onclick="return confirm('Are you sure you want to reject this request?');">Reject</a>
                                  @else

                                    @if($request->status == 0)
                                      <a class="btn border shadow-sm text-black-50 bg-light">Rejected</a> <a href="{{ route('approveproductrequest', ['id' => $request->id]) }}" class="btn btn-primary shadow-sm me-2" onclick="return confirm('Are you sure you want to approve this request?');">Approve</a>
                                    @else
                                      <a class="btn border shadow-sm text-black-50 bg-light">Approved</a>
                                    @endif

                                  @endif
                                </td>
                              </tr>
                            @endforeach
                          @else
                            <tr class="text-center">
                              <td colspan="6">No Requests Found.</td>
                            </tr>
                          @endif
                        </tbody>
                      </table>
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

    <!-- Requested Products -->
    <div class="modal fade" id="requestedproducts" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6><strong>Requested Products</strong></h6>
                        </div>
                        <div class="col-md-6 text-end pt-2 pe-3">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-md-12">
                            <div id="reqproducts"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
