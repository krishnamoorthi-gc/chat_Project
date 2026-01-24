@extends('layouts.dashboard')

@section('title', 'My Chatbots')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('chatbots.create') }}" class="btn btn-primary d-flex align-items-center gap-2 shadow-sm" style="background: var(--dash-primary); border: none; padding: 10px 20px; border-radius: 12px;">
            <i class="bi bi-plus-lg"></i> Create New Chatbot
        </a>
    </div>

    @if($chatbots->isEmpty())
        <div class="text-center py-5" style="background: white; border-radius: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.02);">
            <div style="font-size: 4rem; color: #e2e8f0; margin-bottom: 20px;">
                <i class="bi bi-robot"></i>
            </div>
            <h4>No Chatbots Yet</h4>
            <p class="text-muted mb-4">Create your first chatbot to get started with AI training.</p>
            <a href="{{ route('chatbots.create') }}" class="btn btn-primary" style="background: var(--dash-primary); border: none; padding: 10px 25px; border-radius: 12px;">
                Create Chatbot
            </a>
        </div>
    @else
        <div class="row g-4">
            @foreach($chatbots as $chatbot)
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="card h-100 border-0 shadow-sm" style="border-radius: var(--dash-border-radius); overflow: hidden; transition: transform 0.2s; background: white;">
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div style="width: 50px; height: 50px; background: #f0effb; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--dash-primary); font-size: 1.5rem;">
                                <i class="bi bi-robot"></i>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-link text-muted p-0" type="button" data-bs-toggle="dropdown" style="text-decoration: none;">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
                                    <li><a class="dropdown-item" href="{{ route('chatbots.show', $chatbot) }}"><i class="bi bi-gear me-2 text-muted"></i>Manage/Train</a></li>
                                    <li><a class="dropdown-item" href="{{ route('chatbots.edit', $chatbot) }}"><i class="bi bi-pencil me-2 text-muted"></i>Rename</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('chatbots.destroy', $chatbot) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to delete this chatbot?')"><i class="bi bi-trash me-2"></i>Delete</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                        <h5 class="card-title fw-bold mb-1">{{ $chatbot->name }}</h5>
                        <p class="card-text text-muted small mb-4">
                            Created {{ $chatbot->created_at->diffForHumans() }}
                        </p>
                        
                        <div class="mt-auto">
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-database me-2 text-primary"></i>
                                <span class="small fw-semibold">{{ $chatbot->knowledge_sources_count }} Knowledge Sources</span>
                            </div>
                            
                            <a href="{{ route('chatbots.show', $chatbot) }}" class="btn btn-light w-100 fw-bold" style="color: var(--dash-primary); background: #f0effb; border: none; border-radius: 10px;">
                                Train Data <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>

<style>
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.05) !important;
    }
</style>
@endsection
