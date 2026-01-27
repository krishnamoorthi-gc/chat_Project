@extends('layouts.admin')

@section('title', 'User Management')

@section('content')
<div class="card border-0 shadow-sm p-4" style="border-radius: 20px; background: white;">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Email</th>
                    <th>Bots</th>
                    <th>Plan</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="https://ui-avatars.com/api/?name={{ $user->name }}&background=6c5dd3&color=fff" class="rounded-circle me-3" width="40">
                            <div>
                                <div class="fw-bold">{{ $user->name }}</div>
                                <div class="text-muted small">ID: #{{ $user->id }}</div>
                            </div>
                        </div>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route('admin.users.bots', $user) }}" class="text-decoration-none">
                            <span class="badge rounded-pill bg-light text-dark border">
                                {{ $user->chatbots_count }} Bots
                            </span>
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('admin.users.update-plan', $user) }}" method="POST" class="d-inline">
                            @csrf
                            <select name="plan_type" onchange="this.form.submit()" class="form-select form-select-sm border-0 bg-light" style="width: 120px;">
                                <option value="free" {{ $user->plan_type == 'free' ? 'selected' : '' }}>Free</option>
                                <option value="pro" {{ $user->plan_type == 'pro' ? 'selected' : '' }}>Pro</option>
                                <option value="enterprise" {{ $user->plan_type == 'enterprise' ? 'selected' : '' }}>Enterprise</option>
                            </select>
                        </form>
                    </td>
                    <td>
                        @if($user->is_active)
                            <span class="badge bg-success-subtle text-success">Active</span>
                        @else
                            <span class="badge bg-danger-subtle text-danger">Disabled</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.users.bots', $user) }}" class="btn btn-sm btn-light" title="View Bots">
                                <i class="bi bi-robot"></i>
                            </a>
                            <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm {{ $user->is_active ? 'btn-outline-danger' : 'btn-outline-success' }}">
                                    @if($user->is_active)
                                        <i class="bi bi-person-x-fill"></i> Disable
                                    @else
                                        <i class="bi bi-person-check-fill"></i> Enable
                                    @endif
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
@endsection
