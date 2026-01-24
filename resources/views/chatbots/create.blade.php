@extends('layouts.dashboard')

@section('title', 'Create Chatbot')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm mt-5" style="border-radius: var(--dash-border-radius);">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                     <div style="width: 60px; height: 60px; background: #f0effb; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; color: var(--dash-primary); font-size: 1.8rem; margin-bottom: 20px;">
                        <i class="bi bi-robot"></i>
                    </div>
                    <h3 class="fw-bold">Create New Chatbot</h3>
                    <p class="text-muted">Give your AI assistant a name to get started.</p>
                </div>

                <form action="{{ route('chatbots.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="form-label fw-bold small text-uppercase text-muted">Chatbot Name</label>
                        <input type="text" class="form-control form-control-lg bg-light border-0" id="name" name="name" placeholder="e.g. Sales Support Bot" required style="border-radius: 12px; padding: 15px;">
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg" style="background: var(--dash-primary); border: none; border-radius: 12px; font-weight: 600;">
                            Create & Continue <i class="bi bi-arrow-right ms-2"></i>
                        </button>
                        <a href="{{ route('chatbots.index') }}" class="btn btn-link text-muted" style="text-decoration: none;">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
