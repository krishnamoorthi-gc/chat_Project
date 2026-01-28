@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="row g-4 mb-4">
    <!-- Stats Cards -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-4" style="border-radius: 20px; background: white;">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0" style="background: rgba(108, 93, 211, 0.1); width: 60px; height: 60px; border-radius: 15px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-people-fill" style="color: #6c5dd3; font-size: 24px;"></i>
                </div>
                <div class="ms-3">
                    <h6 class="text-muted mb-1">Total Users</h6>
                    <h3 class="fw-bold mb-0" id="stat-total-users">{{ $totalUsers }}</h3>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-4" style="border-radius: 20px; background: white;">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0" style="background: rgba(255, 206, 115, 0.1); width: 60px; height: 60px; border-radius: 15px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-robot" style="color: #ffce73; font-size: 24px;"></i>
                </div>
                <div class="ms-3">
                    <h6 class="text-muted mb-1">Total Chatbots</h6>
                    <h3 class="fw-bold mb-0" id="stat-total-bots">{{ $totalBots }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-4" style="border-radius: 20px; background: white;">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0" style="background: rgba(46, 204, 113, 0.1); width: 60px; height: 60px; border-radius: 15px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-eye-fill" style="color: #2ecc71; font-size: 24px;"></i>
                </div>
                <div class="ms-3">
                    <h6 class="text-muted mb-1">Total Views</h6>
                    <h3 class="fw-bold mb-0" id="stat-total-views">{{ $totalVisits }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-4" style="border-radius: 20px; background: white;">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0" style="background: rgba(52, 152, 219, 0.1); width: 60px; height: 60px; border-radius: 15px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-graph-up" style="color: #3498db; font-size: 24px;"></i>
                </div>
                <div class="ms-3">
                    <h6 class="text-muted mb-1">Today's Views</h6>
                    <h3 class="fw-bold mb-0" id="stat-today-views">{{ $todayVisits }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm p-4" style="border-radius: 20px; background: white;">
            <h5 class="fw-bold mb-4">Landing Page Traffic (Last 7 Days)</h5>
            <div style="display:flex; justify-content:space-between; align-items:flex-end; height: 200px; padding: 10px 0;">
                @foreach($visitsByDay as $visit)
                    <div style="text-align:center; width: 12%;">
                        <div style="height: 160px; display:flex; flex-direction:column-reverse; margin-bottom: 10px; background: #f8f9fa; border-radius: 8px;">
                            @php
                                $maxVal = $visitsByDay->max('count') ?: 1;
                                $height = ($visit->count / $maxVal) * 100;
                            @endphp
                            <div style="height: {{ $height }}%; background: linear-gradient(to top, #6c5dd3, #8e82e0); border-radius: 8px; width: 100%;" title="{{ $visit->count }} visits"></div>
                        </div>
                        <span style="font-size: 0.7rem; color: #808191;">{{ \Carbon\Carbon::parse($visit->date)->format('M d') }}</span>
                    </div>
                @endforeach
                @if(count($visitsByDay) == 0)
                    <div class="w-100 text-center text-muted py-5">No traffic data yet.</div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const stats = {
            users: document.getElementById('stat-total-users'),
            bots: document.getElementById('stat-total-bots'),
            views: document.getElementById('stat-total-views'),
            today: document.getElementById('stat-today-views')
        };

        setInterval(() => {
            fetch('{{ route("admin.stats") }}')
                .then(response => response.json())
                .then(data => {
                    if (stats.users) stats.users.innerText = data.totalUsers;
                    if (stats.bots) stats.bots.innerText = data.totalBots;
                    if (stats.views) stats.views.innerText = data.totalVisits;
                    if (stats.today) stats.today.innerText = data.todayVisits;
                })
                .catch(error => console.error('Error fetching admin stats:', error));
        }, 5000); // Update every 5 seconds
    });
</script>

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
