@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="row g-4">
    <!-- Stats Cards -->
    <div class="col-md-6">
        <div class="card border-0 shadow-sm p-4" style="border-radius: 20px; background: white;">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0" style="background: rgba(108, 93, 211, 0.1); width: 60px; height: 60px; border-radius: 15px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-people-fill" style="color: #6c5dd3; font-size: 24px;"></i>
                </div>
                <div class="ms-3">
                    <h6 class="text-muted mb-1">Total Registered Users</h6>
                    <h3 class="fw-bold mb-0">{{ $totalUsers }}</h3>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card border-0 shadow-sm p-4" style="border-radius: 20px; background: white;">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0" style="background: rgba(255, 206, 115, 0.1); width: 60px; height: 60px; border-radius: 15px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-robot" style="color: #ffce73; font-size: 24px;"></i>
                </div>
                <div class="ms-3">
                    <h6 class="text-muted mb-1">Total Chatbots Created</h6>
                    <h3 class="fw-bold mb-0">{{ $totalBots }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Users -->
    <div class="col-12">
        <div class="card border-0 shadow-sm p-4" style="border-radius: 20px; background: white;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0">Recently Joined Users</h5>
                <a href="{{ route('admin.users.index') }}" class="btn btn-sm" style="background: #6c5dd3; color: white;">View All Users</a>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Plan</th>
                            <th>Joined</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentUsers as $user)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://ui-avatars.com/api/?name={{ $user->name }}&background=6c5dd3&color=fff" class="rounded-circle me-2" width="30">
                                    <span class="fw-medium">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->is_active)
                                    <span class="badge bg-success-subtle text-success">Active</span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger">Disabled</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-primary-subtle text-primary text-uppercase">{{ $user->plan_type }}</span>
                            </td>
                            <td>{{ $user->created_at->diffForHumans() }}</td>
                            <td>
                                <a href="{{ route('admin.users.bots', $user) }}" class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-robot"></i> Bots
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
