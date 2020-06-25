@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <section class="users-view">
            <!-- Media object starts -->
            <div class="row">
                <div class="col-12 col-sm-7">
                    <div class="media d-flex align-items-center">
                        <a href="javascript:;">
                            <img src="{{ asset('app-assets/img/portrait/small/avatar-s-2.png')}}" alt="user view avatar"
                                class="users-avatar-shadow rounded" height="64" width="64">
                        </a>
                        <div class="media-body ml-3">
                            <h4>
                                <span class="users-view-name">{{$user->full_name}}</span>
                                {{-- <span class="text-muted font-medium-1">
                                    <span>@</span>
                                    <span class="users-view-username">dean3004</span>
                                </span> --}}
                            </h4>
                            <span>ID:</span>
                            <span class="users-view-id">{{$user->id}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-5 d-flex justify-content-end align-items-center">
                    <a href="{{url('admin/users/'.$user->id.'/edit')}}" class="btn btn-sm btn-primary px-3 py-1">Edit</a>
                    <a href="{{url('admin/users')}}" class="btn btn-sm btn-primary px-3 py-1 ml-2">Go Back</a>
                </div>
                
            </div>
            <!-- Media object ends -->

            <div class="row">
                <div class="col-12">
                    <!-- Card data starts -->
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-xl-4">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td>Registered:</td>
                                                    <td>{{$user->created_at}}</td>
                                                </tr>
                                                
                                                <tr>
                                                    <td>Status</td>
                                                    <td><span class="badge bg-light-success users-view-status">{{$user->status}}</span></td>
                                                    
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card data ends -->
                </div>
                <div class="col-12">
                    <!-- User detail starts -->
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="col-12">
                                    <h5 class="mb-2 text-bold-500"><i class="ft-info mr-2"></i> Personal Info</h5>
                                    <div class="table-responsive">
                                        <table class="table table-borderless">
                                            <tbody>
                                                
                                                <tr>
                                                    <td>Name:</td>
                                                    <td class="users-view-name">{{$user->full_name}}</td>
                                                </tr>
                                                <tr>
                                                    <td>E-mail:</td>
                                                    <td>{{$user->email}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Business:</td>
                                                    <td>{{$user->business_name}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Sub Domain:</td>
                                                    <td><a href="javascript:;">{{$user->company_domain}}</a></td>
                                                </tr>
                                                <tr>
                                                    <td>Phone:</td>
                                                    <td>{{$user->phone}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Location:</td>
                                                    <td>{{$user->location}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                   <h5 class="mb-2 text-bold-500"><i class="ft-info mr-2"></i> Verification Detail</h5>
                                    <div class="table-responsive">
                                        <table class="table table-borderless m-0">
                                            <tbody>
                                               
                                                <tr>
                                                    <td>Verification Code:</td>
                                                    <td>{{$user->verification_code}}</td>
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- User detail ends -->
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/page-users.css')}}">
@endpush
@push('js')
<!-- BEGIN PAGE LEVEL JS-->
<script src="{{ asset('app-assets/js/page-users.js')}}"></script>
<!-- END PAGE LEVEL JS-->
@endpush