@extends('layouts.admin')

@section('title', 'Pricing Plans Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Pricing Plans</h4>
    <button class="btn" style="background: #6c5dd3; color: white;" data-bs-toggle="modal" data-bs-target="#addPlanModal">
        <i class="bi bi-plus-lg me-2"></i>Add New Plan
    </button>
</div>

<div class="row g-4">
    @foreach($plans as $plan)
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 20px; background: white;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0">{{ $plan->name }}</h5>
                <div>
                    <span class="badge {{ $plan->is_active ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }} mb-2">
                        {{ $plan->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
            </div>
            
            <div class="mb-3">
                <h3 class="fw-bold mb-0">${{ number_format($plan->price, 2) }} <small class="text-muted" style="font-size: 0.9rem;">/ {{ $plan->billing_cycle }}</small></h3>
            </div>

            <p class="text-muted small mb-4">{{ Str::limit($plan->description, 100) }}</p>

            <div class="mb-4">
                <h6 class="fw-bold small mb-2">Features:</h6>
                <ul class="list-unstyled mb-0">
                    @foreach($plan->features ?? [] as $feature)
                    <li class="small text-muted mb-1"><i class="bi bi-check2 text-primary me-2"></i>{{ $feature }}</li>
                    @endforeach
                </ul>
            </div>
            
            <div class="mt-auto d-flex gap-2">
                <button class="btn btn-light flex-grow-1" data-bs-toggle="modal" data-bs-target="#editPlanModal{{ $plan->id }}">
                    <i class="bi bi-pencil-square me-2"></i>Edit
                </button>
                <form action="{{ route('admin.pricing.destroy', $plan) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this plan?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Plan Modal -->
    <div class="modal fade" id="editPlanModal{{ $plan->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0" style="border-radius: 20px;">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Edit {{ $plan->name }} Plan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.pricing.update', $plan) }}" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label small text-muted">Plan Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $plan->name }}" required placeholder="e.g. Pro Plan">
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label class="form-label small text-muted">Price ($)</label>
                                <input type="number" step="0.01" name="price" class="form-control" value="{{ $plan->price }}" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label small text-muted">Billing Cycle</label>
                                <select name="billing_cycle" class="form-select">
                                    <option value="monthly" {{ $plan->billing_cycle == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                    <option value="yearly" {{ $plan->billing_cycle == 'yearly' ? 'selected' : '' }}>Yearly</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-muted">Description</label>
                            <textarea name="description" class="form-control" rows="2">{{ $plan->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-muted">Payment URL</label>
                            <input type="url" name="payment_url" class="form-control" value="{{ $plan->payment_url }}" required placeholder="https://buy.stripe.com/...">
                        </div>
                        <div class="mb-0">
                            <label class="form-label small text-muted">Features (one per line)</label>
                            <textarea name="features_text" class="form-control" rows="5">{{ implode("\n", $plan->features ?? []) }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn" style="background: #6c5dd3; color: white;">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- Add Plan Modal -->
<div class="modal fade" id="addPlanModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 20px;">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Add New Plan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.pricing.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small text-muted">Plan Name</label>
                        <input type="text" name="name" class="form-control" required placeholder="e.g. Pro Plan">
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label small text-muted">Price ($)</label>
                            <input type="number" step="0.01" name="price" class="form-control" required placeholder="29.00">
                        </div>
                        <div class="col-6">
                            <label class="form-label small text-muted">Billing Cycle</label>
                            <select name="billing_cycle" class="form-select">
                                <option value="monthly">Monthly</option>
                                <option value="yearly">Yearly</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-muted">Description</label>
                        <textarea name="description" class="form-control" rows="2" placeholder="Brief description of the plan..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-muted">Payment URL</label>
                        <input type="url" name="payment_url" class="form-control" required placeholder="https://buy.stripe.com/...">
                    </div>
                    <div class="mb-0">
                        <label class="form-label small text-muted">Features (one per line)</label>
                        <textarea name="features_text" class="form-control" rows="5" placeholder="Feature 1&#10;Feature 2&#10;Feature 3"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn" style="background: #6c5dd3; color: white;">Create Plan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
