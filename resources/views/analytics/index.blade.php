@extends('layouts.dashboard')

@section('title', 'Analytics')

@section('content')
<div class="container-fluid p-0">
    <!-- Header Stats -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 20px; background: linear-gradient(135deg, #6c5dd3 0%, #4f46e5 100%); color: white;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="opacity-75 fw-bold">Total Conversations</div>
                    <i class="bi bi-chat-text fs-4 opacity-50"></i>
                </div>
                <h2 class="display-5 fw-bold mb-0">{{ $totalConversations }}</h2>
                <div class="mt-3 small opacity-75">
                    <i class="bi bi-arrow-up"></i> All time
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 20px; background: white;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="text-muted fw-bold">Total Messages</div>
                    <div class="icon-box bg-light text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        <i class="bi bi-envelope"></i>
                    </div>
                </div>
                <h2 class="display-5 fw-bold mb-0 text-dark">{{ $totalMessages }}</h2>
                <div class="mt-3 small text-muted">
                    Processed by AI
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 20px; background: white;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="text-muted fw-bold">Leads Captured</div>
                    <div class="icon-box bg-light text-success rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        <i class="bi bi-people"></i>
                    </div>
                </div>
                <h2 class="display-5 fw-bold mb-0 text-dark">{{ $totalLeads }}</h2>
                <div class="mt-3 small text-success">
                    <i class="bi bi-arrow-up-short"></i> Conversion Rate
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row g-4 mb-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 20px;">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold m-0">Conversation Traffic</h5>
                    <select class="form-select form-select-sm" style="width: auto; border-radius: 10px;">
                        <option>Last 7 Days</option>
                        <option>Last 30 Days</option>
                    </select>
                </div>
                <div style="height: 300px;">
                    <canvas id="trafficChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 20px;">
                <h5 class="fw-bold mb-4">User Satisfaction</h5>
                <div class="text-center py-4">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle border border-5 border-primary" style="width: 150px; height: 150px; border-color: #6c5dd3 !important;">
                        <div>
                            <h3 class="fw-bold mb-0">98%</h3>
                            <small class="text-muted">Positive</small>
                        </div>
                    </div>
                </div>
                <div class="mt-auto">
                    <div class="d-flex justify-content-between small text-muted mb-1">
                        <span>5 Star</span>
                        <span>85%</span>
                    </div>
                    <div class="progress mb-3" style="height: 6px; border-radius: 10px;">
                        <div class="progress-bar" style="width: 85%; background-color: #6c5dd3;"></div>
                    </div>
                    <div class="d-flex justify-content-between small text-muted mb-1">
                        <span>4 Star</span>
                        <span>13%</span>
                    </div>
                    <div class="progress mb-3" style="height: 6px; border-radius: 10px;">
                        <div class="progress-bar bg-info" style="width: 13%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card border-0 shadow-sm p-4" style="border-radius: 20px;">
        <h5 class="fw-bold mb-4">Recent Engagement</h5>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="bg-light text-muted small text-uppercase">
                    <tr>
                        <th class="border-0 rounded-start ps-3 py-3">Date</th>
                        <th class="border-0">Messages</th>
                        <th class="border-0 text-end rounded-end pe-3">Trend</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($conversationsChart->reverse() as $data)
                    <tr>
                        <td class="ps-3 fw-bold">{{ \Carbon\Carbon::parse($data->date)->format('M d, Y') }}</td>
                        <td>{{ $data->count }} Conversations</td>
                        <td class="text-end pe-3">
                            <span class="badge bg-light text-primary rounded-pill px-3 py-2">
                                Activity Recorded
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('trafficChart').getContext('2d');
        
        // Prepare data from PHP
        const labels = {!! json_encode($conversationsChart->pluck('date')) !!};
        const data = {!! json_encode($conversationsChart->pluck('count')) !!};

        // Create gradient
        let gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(108, 93, 211, 0.2)');
        gradient.addColorStop(1, 'rgba(108, 93, 211, 0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Conversations',
                    data: data,
                    backgroundColor: gradient,
                    borderColor: '#6c5dd3',
                    borderWidth: 3,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#6c5dd3',
                    pointBorderWidth: 3,
                    pointRadius: 6,
                    pointHoverRadius: 8,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            borderDash: [5, 5],
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
