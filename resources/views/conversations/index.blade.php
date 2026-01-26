@extends('layouts.dashboard')

@section('title', 'Conversations')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
            <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold">Active Conversations</h5>
                <div class="badges">
                    <span class="badge bg-primary rounded-pill">{{ $conversations->total() }} Total</span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">User / Lead</th>
                                <th>Chatbot</th>
                                <th>Last Message</th>
                                <th>Status</th>
                                <th>Time</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($conversations as $convo)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle bg-soft-primary text-primary me-3">
                                            {{ strtoupper(substr($convo->lead->name ?? 'Guest', 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold">{{ $convo->lead->name ?? 'Guest User' }}</div>
                                            <div class="text-muted small">{{ $convo->lead->email ?? 'No email captured' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        <i class="bi bi-robot me-1 text-primary"></i>
                                        {{ $convo->chatbot->name }}
                                    </span>
                                </td>
                                <td>
                                    <div class="text-truncate" style="max-width: 250px;">
                                        {{ $convo->messages->first()->message ?? 'No messages' }}
                                    </div>
                                </td>
                                <td>
                                    @if($convo->status === 'human')
                                        <span class="badge bg-warning text-dark"><i class="bi bi-person-fill"></i> Human Support</span>
                                    @elseif($convo->status === 'active')
                                        <span class="badge bg-success text-white">Bot Active</span>
                                    @else
                                        <span class="badge bg-secondary text-white">Ended</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="small text-muted">
                                        {{ $convo->last_message_at ? $convo->last_message_at->diffForHumans() : $convo->created_at->diffForHumans() }}
                                    </div>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('conversations.show', $convo) }}" class="btn btn-sm btn-primary rounded-pill px-3">
                                        View Live
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="py-4">
                                        <i class="bi bi-chat-dots-fill text-muted" style="font-size: 3rem;"></i>
                                        <h5 class="mt-3 text-muted">No conversations found yet</h5>
                                        <p class="text-muted small">When users interact with your bot, they will appear here.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($conversations->hasPages())
            <div class="card-footer bg-white border-top py-3">
                {{ $conversations->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    .bg-soft-primary {
        background-color: rgba(108, 93, 211, 0.1);
    }
    .avatar-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1.1rem;
    }
    .table thead th {
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #808191;
        border-top: none;
    }
    .table tbody td {
        padding-top: 1rem;
        padding-bottom: 1rem;
        font-size: 0.9rem;
    }
</style>
@endsection
