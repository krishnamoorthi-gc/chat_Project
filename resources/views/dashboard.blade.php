@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid p-0">
    <div class="row g-4">
        <!-- Center Column -->
        <div class="col-xl-8">
            <!-- Stats Cards -->
            <div class="stats-row mb-4">
                <div class="stat-card">
                    <div class="stat-info">
                        <p>Total Chatbots</p>
                        <h3>{{ $totalChatbots }}</h3>
                        <div class="stat-trend up">
                            <i class="bi bi-arrow-up-right"></i> +14% Inc
                        </div>
                    </div>
                    <div class="stat-circle">
                        <svg width="70" height="70" viewBox="0 0 36 36">
                            <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#eee" stroke-width="3" />
                            <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#6c5dd3" stroke-width="3" stroke-dasharray="74, 100" />
                        </svg>
                        <div style="position: absolute; top:0; left:0; width:100%; height:100%; display:flex; align-items:center; justify-content:center; font-size: 0.75rem; font-weight:700; color:#6c5dd3;">
                            74%
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <p>Active Chatbots</p>
                        <h3>{{ $activeChatbots }}</h3>
                        <div class="stat-trend up" style="color: #ffce73;">
                            <i class="bi bi-arrow-up-right"></i> +06% Inc
                        </div>
                    </div>
                    <div class="stat-circle">
                        <svg width="70" height="70" viewBox="0 0 36 36">
                            <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#eee" stroke-width="3" />
                             <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#ffce73" stroke-width="3" stroke-dasharray="60, 100" />
                        </svg>
                        <div style="position: absolute; top:0; left:0; width:100%; height:100%; display:flex; align-items:center; justify-content:center; font-size: 0.75rem; font-weight:700; color:#ffce73;">
                            60%
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <p>Knowledge Sources</p>
                        <h3>{{ $totalKnowledgeSources }}</h3>
                        <div class="stat-trend down">
                            <i class="bi bi-arrow-down-right"></i> +04% Dec
                        </div>
                    </div>
                    <div class="stat-circle">
                        <svg width="70" height="70" viewBox="0 0 36 36">
                            <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#eee" stroke-width="3" />
                             <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#ff754c" stroke-width="3" stroke-dasharray="46, 100" />
                        </svg>
                        <div style="position: absolute; top:0; left:0; width:100%; height:100%; display:flex; align-items:center; justify-content:center; font-size: 0.75rem; font-weight:700; color:#ff754c;">
                            46%
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Row -->
            <div class="chart-section mb-4">
                <div class="main-chart">
                    <div class="section-header">
                        <h5>Active Conversations</h5>
                    </div>
                    <div style="display:flex; justify-content:space-between; align-items:flex-end; height: 180px; padding: 10px 0;">
                        @foreach(['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] as $day)
                            <div style="text-align:center; width: 10%;">
                                <div style="height: 140px; display:flex; flex-direction:column-reverse; margin-bottom: 10px;">
                                    <div style="height: {{ rand(20, 60) }}%; background:#6c5dd3; border-radius: 4px; width: 8px; margin: 0 auto;"></div>
                                </div>
                                <span style="font-size: 0.7rem; color: #808191;">{{ $day }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="side-chart">
                    <div class="section-header">
                        <h5>Sources</h5>
                    </div>
                    <div class="p-2">
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1 small"><span>PDF</span><span>80%</span></div>
                            <div class="progress" style="height:5px;"><div class="progress-bar bg-primary" style="width:80%"></div></div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1 small"><span>Excel</span><span>20%</span></div>
                            <div class="progress" style="height:5px;"><div class="progress-bar bg-warning" style="width:20%"></div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side Stats (Used to be right sidebar) -->
        <div class="col-xl-4 d-none d-xl-block">
            <div class="card border-0 shadow-sm p-4 mb-4" style="border-radius: 20px;">
                <h6 class="fw-bold mb-3">Recently Added</h6>
                <div class="action-card purple">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h3>95</h3>
                            <span>Support Bot</span>
                        </div>
                        <div class="form-check form-switch"><input class="form-check-input" type="checkbox" checked></div>
                    </div>
                </div>
                <div class="action-card mt-3">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h3>42</h3>
                            <span>Sales Pro</span>
                        </div>
                        <div class="form-check form-switch"><input class="form-check-input" type="checkbox" checked></div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm p-4" style="border-radius: 20px;">
                <h6 class="fw-bold mb-3">Recent Activity</h6>
                <div class="reminder-item mb-3">
                    <div class="reminder-icon"><i class="bi bi-file-earmark-pdf"></i></div>
                    <div class="reminder-info">
                        <h6>New source added</h6>
                        <p class="small">Knowledge base updated</p>
                    </div>
                </div>
                <div class="reminder-item">
                    <div class="reminder-icon" style="background:#fff8e7; color:#ffce73;"><i class="bi bi-chat-dots"></i></div>
                    <div class="reminder-info">
                        <h6>New conversation</h6>
                        <p class="small">Support bot active</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
