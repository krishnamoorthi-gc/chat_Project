@extends('layouts.dashboard')

@section('title', 'Leads')

@section('content')
<div class="container-fluid p-0">
    <div class="card border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
        <div class="card-header bg-white border-0 p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="fw-bold mb-1">Visitor Leads</h5>
                    <p class="text-muted small mb-0">Track users interacting with your chatbots</p>
                </div>
                <!-- Optional: Filter or Export -->
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 border-0">IP Address</th>
                            <th class="border-0">Location</th>
                            <th class="border-0">Chatbot</th>
                            <th class="border-0">Visits</th>
                            <th class="border-0">Last Interaction</th>
                            <th class="border-0">Device</th>
                            <th class="pe-4 border-0 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($leads as $lead)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-3 text-primary">
                                        <i class="bi bi-geo-alt-fill"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold">{{ $lead->ip_address }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($lead->city || $lead->country)
                                    <span class="badge bg-light text-dark fw-normal">
                                        {{ $lead->city }}@if($lead->region), {{ $lead->region }}@endif, {{ $lead->country }}
                                    </span>
                                @else
                                    <span class="text-muted small">Unknown</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-purple-light text-purple">
                                    {{ $lead->chatbot->name }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="fw-bold me-2">{{ $lead->visit_count }}</span>
                                    <div class="progress" style="width: 50px; height: 4px;">
                                        <div class="progress-bar bg-success" style="width: {{ min($lead->visit_count * 10, 100) }}%"></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="small fw-bold">{{ $lead->last_visit_at->format('M d, Y') }}</div>
                                <div class="text-muted smallest">{{ $lead->last_visit_at->diffForHumans() }}</div>
                            </td>
                            <td>
                                <span class="small text-muted text-truncate d-inline-block" style="max-width: 150px;" title="{{ $lead->user_agent }}">
                                    {{ Str::limit($lead->user_agent, 30) }}
                                </span>
                            </td>
                            <td class="pe-4 text-end">
                                <div class="dropdown">
                                    <button class="btn btn-link text-muted p-0" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm">
                                        <li>
                                            <form action="{{ route('leads.destroy', $lead) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="dropdown-item text-danger small">
                                                    <i class="bi bi-trash me-2"></i>Delete Lead
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <img src="https://illustrations.popsy.co/purple/data-analysis.svg" alt="No data" style="width: 200px; opacity: 0.5;">
                                <p class="text-muted mt-3">No leads collected yet. Start using your chatbots!</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($leads->hasPages())
        <div class="card-footer bg-white border-0 p-4">
            {{ $leads->links() }}
        </div>
        @endif
    </div>
</div>

<style>
    .bg-purple-light {
        background-color: rgba(108, 93, 211, 0.1);
    }
    .text-purple {
        color: #6c5dd3;
    }
    .smallest {
        font-size: 0.75rem;
    }
</style>
@endsection
