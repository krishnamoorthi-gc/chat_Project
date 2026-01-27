@extends('layouts.admin')

@section('title', "Bots by " . $user->name)

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.users.index') }}" class="btn btn-link text-decoration-none p-0">
        <i class="bi bi-arrow-left"></i> Back to Users
    </a>
</div>

<div class="row g-4">
    @forelse($chatbots as $bot)
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 20px; background: white;">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="flex-shrink-0" style="background: rgba(108, 93, 211, 0.1); width: 45px; height: 45px; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-robot" style="color: #6c5dd3; font-size: 20px;"></i>
                </div>
                <div class="text-end">
                    <span class="badge bg-light text-dark border">{{ $bot->leads_count }} Leads</span>
                </div>
            </div>
            
            <h5 class="fw-bold mb-2">{{ $bot->name }}</h5>
            <p class="text-muted small mb-4">{{ Str::limit($bot->prompt_template, 100) }}</p>
            
            <div class="mt-auto pt-3 border-top">
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">Created {{ $bot->created_at->format('M d, Y') }}</small>
                    <a href="{{ route('chat.widget', $bot) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-eye"></i> View Widget
                    </a>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="text-center py-5">
            <i class="bi bi-robot-x text-muted" style="font-size: 48px;"></i>
            <p class="mt-3 text-muted">This user hasn't created any bots yet.</p>
        </div>
    </div>
    @endforelse
</div>
@endsection
