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
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 p-5 bg-light" style="padding-top: 0 !important;">
                <div class="row">
                    <div class="col-6"><h4 class="pt-4"><strong>State List</strong></h4></div>
                </div>
                <div class="row">
                    @foreach($states as $row)
                    <div class="col-md-6">
                        <div class="card p-3 mt-3 shadow-sm">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6><strong>State {{$loop->index + 1}}</strong></h6>
                                    <p class="text-black-50">{{ $row->name }}
                                        @if($row->status == 0)
                                            <span class="badge" style="background: #979700;">Pending</span>
                                        @endif
                                        @if($row->status == 1)
                                            <span class="badge" style="    background: #047604;">Aproved</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="col-md-6 text-end">
                                    <a href="{{ route('deleteState', [$row->brand_id, 'state_id'=>$row->state_id]) }}" class="cursor-pointer">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="col-md-6">
                        <div class="card p-3 mt-3 shadow-sm">
                            <div class="row">
                                <div class="col-md-12">
                                    <h6><strong>Add New State</strong></h6>
                                    <button data-bs-toggle="modal" data-bs-target="#addstare" class="btn appointment-btn">Add State</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- First Name -->
    <div class="modal fade" id="addstare" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('addstate', [$brand->id]) }}" method="POST">
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
                                    <label for="">State / Province</label>
                                    <select required name="state_id" id="state_province" class="form-control">
                                        <option value="">Select State</option>
                                        @foreach ($getstate as $row)
                                            <option value="{{ $row->id }}" > {{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button id="addstate" type="submit" class="appointment-btn w-100 border-0" style="margin-left: 0px;"><span class="spinner-border spinner-border-sm" role="addstare" aria-hidden="true" style="display: none;"></span> Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
