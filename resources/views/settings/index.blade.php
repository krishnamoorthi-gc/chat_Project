@extends('layouts.dashboard')

@section('title', 'Settings')

@section('content')
<div class="container-fluid p-0">
    <div class="row g-4">
        <!-- Sidebar / Navigation -->
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 20px;">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link active text-start mb-2 rounded-3 fw-bold" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="true">
                        <i class="bi bi-person me-2"></i> Profile Details
                    </button>
                    <button class="nav-link text-start mb-2 rounded-3 fw-bold" id="v-pills-security-tab" data-bs-toggle="pill" data-bs-target="#v-pills-security" type="button" role="tab" aria-controls="v-pills-security" aria-selected="false">
                        <i class="bi bi-shield-lock me-2"></i> Security
                    </button>
                    <button class="nav-link text-start mb-2 rounded-3 fw-bold" id="v-pills-plan-tab" data-bs-toggle="pill" data-bs-target="#v-pills-plan" type="button" role="tab" aria-controls="v-pills-plan" aria-selected="false">
                        <i class="bi bi-credit-card me-2"></i> Billing & Plan
                    </button>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="col-md-9">
            <div class="tab-content" id="v-pills-tabContent">
                
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Profile Tab -->
                <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    <div class="card border-0 shadow-sm p-4" style="border-radius: 20px;">
                        <h5 class="fw-bold mb-4">Edit Profile</h5>
                        
                        <div class="d-flex align-items-center mb-4">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=6c5dd3&color=fff&size=128" alt="Profile" class="rounded-circle" width="80" height="80">
                            <div class="ms-3">
                                <h6 class="fw-bold mb-1">{{ $user->name }}</h6>
                                <p class="text-muted small mb-2">Admin Account</p>
                                <button class="btn btn-sm btn-outline-primary rounded-pill">Change Avatar</button>
                            </div>
                        </div>

                        <form action="{{ route('settings.update') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted">Full Name</label>
                                    <input type="text" name="name" class="form-control form-control-lg bg-white border fs-6" value="{{ old('name', $user->name) }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted">Email Address</label>
                                    <input type="email" name="email" class="form-control form-control-lg bg-white border fs-6" value="{{ old('email', $user->email) }}">
                                </div>
                                <div class="col-12 text-end mt-4">
                                    <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill fw-bold">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Security Tab -->
                <div class="tab-pane fade" id="v-pills-security" role="tabpanel" aria-labelledby="v-pills-security-tab">
                    <div class="card border-0 shadow-sm p-4" style="border-radius: 20px;">
                        <h5 class="fw-bold mb-4">Change Password</h5>
                        
                        <form action="{{ route('settings.password') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label small fw-bold text-muted">Current Password</label>
                                    <input type="password" name="current_password" class="form-control form-control-lg bg-white border fs-6">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted">New Password</label>
                                    <input type="password" name="new_password" class="form-control form-control-lg bg-white border fs-6">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted">Confirm New Password</label>
                                    <input type="password" name="new_password_confirmation" class="form-control form-control-lg bg-white border fs-6">
                                </div>
                                <div class="col-12 text-end mt-4">
                                    <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill fw-bold">Update Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Billing Tab -->
                <div class="tab-pane fade" id="v-pills-plan" role="tabpanel" aria-labelledby="v-pills-plan-tab">
                    <div class="card border-0 shadow-sm p-4" style="border-radius: 20px;">
                        <h5 class="fw-bold mb-4">Current Plan</h5>
                        
                        <div class="card bg-light border-0 p-3 mb-4 rounded-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="fw-bold text-primary mb-1">Free Tier</h6>
                                    <p class="small text-muted mb-0">Basic features access</p>
                                </div>
                                <span class="badge bg-primary rounded-pill px-3 py-2">Active</span>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button class="btn btn-primary py-2 rounded-pill">Upgrade to Pro</button>
                            <button class="btn btn-outline-secondary py-2 rounded-pill">View Billing History</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    .nav-pills .nav-link {
        color: #64748b;
        transition: all 0.2s;
    }
    .nav-pills .nav-link:hover {
        background: rgba(108, 93, 211, 0.05);
        color: #6c5dd3;
    }
    .nav-pills .nav-link.active {
        background: #6c5dd3;
        color: white;
        box-shadow: 0 4px 12px rgba(108, 93, 211, 0.3);
    }
</style>
@endsection
