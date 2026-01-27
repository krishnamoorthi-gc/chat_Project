@extends('layouts.dashboard')

@section('title')
    Live Support: {{ $conversation->lead->name ?? 'Guest' }}
@endsection

@section('content')
<div class="row h-100" style="min-height: calc(100vh - 200px);">
    <div class="col-lg-8 h-100">
        <div class="card border-0 shadow-sm d-flex flex-column h-100" style="border-radius: 24px; overflow: hidden;">
            <!-- Header -->
            <div class="card-header bg-white border-bottom py-3 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <img src="https://ui-avatars.com/api/?name={{ $conversation->lead->name ?? 'Guest' }}&background=6c5dd3&color=fff" class="rounded-circle me-3" width="45">
                    <div>
                        <h6 class="mb-0 fw-bold">{{ $conversation->lead->name ?? 'Guest User' }}</h6>
                        <div class="d-flex align-items-center">
                            <span class="status-dot online me-2"></span>
                            <small class="text-success fw-bold">Active Now</small>
                        </div>
                    </div>
                </div>
                <div class="actions">
                    <button class="btn btn-outline-warning btn-sm rounded-pill px-3 me-2" id="toggleHumanSupport">
                        {{ $conversation->status === 'human' ? 'Switch back to Bot' : 'Take Control (Live)' }}
                    </button>
                    <a href="{{ route('conversations.index') }}" class="btn btn-light btn-sm rounded-circle">
                        <i class="bi bi-x-lg"></i>
                    </a>
                </div>
            </div>

            <!-- Chat Messages Area -->
            <div class="card-body bg-light p-4 overflow-auto" id="chatMessages" style="flex: 1; max-height: 500px;">
                @foreach($conversation->messages as $msg)
                    <div class="message-wrapper {{ $msg->sender === 'admin' ? 'admin' : ($msg->sender === 'bot' ? 'bot' : 'user') }} mb-4">
                        <div class="message-bubble {{ $msg->sender }} shadow-sm">
                            @if($msg->file_path)
                                <div class="message-file mb-2">
                                    @if(in_array(strtolower($msg->file_type), ['jpg', 'jpeg', 'png', 'gif']))
                                        <img src="{{ $msg->file_path }}" class="img-fluid rounded" style="max-width: 200px;">
                                    @else
                                        <a href="{{ $msg->file_path }}" target="_blank" class="btn btn-sm btn-light border">
                                            <i class="bi bi-file-earmark"></i> Download File
                                        </a>
                                    @endif
                                </div>
                            @endif
                            <div class="text">{{ $msg->message }}</div>
                            <div class="time small opacity-50">{{ $msg->created_at->format('H:i') }}</div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Footer / Input -->
            <div class="card-footer bg-white border-top p-3">
                <form id="replyForm" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group gap-2 align-items-center">
                        <label for="fileInput" class="btn btn-light rounded-circle mb-0" style="width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-paperclip"></i>
                            <input type="file" id="fileInput" name="file" class="d-none">
                        </label>
                        <input type="text" id="messageInput" name="message" class="form-control border-0 bg-light rounded-pill px-4" placeholder="Type your reply here..." style="height: 45px;">
                        <button type="submit" class="btn btn-primary rounded-circle" style="width: 45px; height: 45px;">
                            <i class="bi bi-send-fill"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Sidebar Info -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm" style="border-radius: 24px;">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-4">User Details</h6>
                <div class="detail-item mb-3">
                    <label class="text-muted small d-block">Full Name</label>
                    <span class="fw-bold">{{ $conversation->lead->name ?? 'Guest User' }}</span>
                </div>
                <div class="detail-item mb-3">
                    <label class="text-muted small d-block">Email Address</label>
                    <span class="fw-bold">{{ $conversation->lead->email ?? 'Not captured' }}</span>
                </div>
                <div class="detail-item mb-3">
                    <label class="text-muted small d-block">Location</label>
                    <span class="fw-bold"><i class="bi bi-geo-alt-fill text-danger"></i> {{ $conversation->lead->city ?? 'Unknown' }}, {{ $conversation->lead->country ?? '' }}</span>
                </div>
                <hr>
                <h6 class="fw-bold mb-3">Active Bot</h6>
                <div class="d-flex align-items-center p-3 bg-light rounded-3">
                    <i class="bi bi-robot fs-3 text-primary me-3"></i>
                    <div>
                        <div class="fw-bold">{{ $conversation->chatbot->name }}</div>
                        <div class="text-muted small">Status: Active</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .message-bubble {
        max-width: 80%;
        padding: 12px 16px;
        border-radius: 20px;
        position: relative;
    }
    .message-wrapper.user { display: flex; justify-content: flex-start; }
    .message-wrapper.user .message-bubble { 
        background: white; 
        color: #11142d; 
        border-bottom-left-radius: 4px;
    }
    
    .message-wrapper.admin { display: flex; justify-content: flex-end; }
    .message-wrapper.admin .message-bubble { 
        background: #7c69ef; 
        color: white; 
        border-bottom-right-radius: 4px;
    }

    .message-wrapper.bot { display: flex; justify-content: flex-start; }
    .message-wrapper.bot .message-bubble { 
        background: #e1e4ed; 
        color: #11142d; 
        border-bottom-left-radius: 4px;
        font-style: italic;
    }

    .status-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        display: inline-block;
    }
    .status-dot.online { background-color: #10b981; animation: pulse 2s infinite; }
    @keyframes pulse { 0% { transform: scale(0.95); opacity: 1; } 50% { transform: scale(1.1); opacity: 0.7; } 100% { transform: scale(0.95); opacity: 1; } }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatContainer = document.getElementById('chatMessages');
    const replyForm = document.getElementById('replyForm');
    let lastMessageId = {{ $conversation->messages->last()->id ?? 0 }};

    // Auto-scroll to bottom
    chatContainer.scrollTop = chatContainer.scrollHeight;

    // Polling for new messages
    setInterval(async () => {
        try {
            const response = await fetch(`{{ route('conversations.updates', $conversation) }}?last_message_id=${lastMessageId}`);
            const data = await response.json();
            
            if (data.messages && data.messages.length > 0) {
                data.messages.forEach(msg => {
                    appendMessage(msg);
                    lastMessageId = msg.id;
                });
                chatContainer.scrollTop = chatContainer.scrollHeight;
            }
        } catch (error) {
            console.error('Polling error:', error);
        }
    }, 3000);

    function appendMessage(msg) {
        const div = document.createElement('div');
        div.className = `message-wrapper ${msg.sender} mb-4`;
        
        let fileHtml = '';
        if (msg.file_path) {
            if (['jpg', 'jpeg', 'png', 'gif'].includes(msg.file_type.toLowerCase())) {
                fileHtml = `<div class="message-file mb-2"><img src="${msg.file_path}" class="img-fluid rounded" style="max-width: 200px;"></div>`;
            } else {
                fileHtml = `<div class="message-file mb-2"><a href="${msg.file_path}" target="_blank" class="btn btn-sm btn-light border"><i class="bi bi-file-earmark"></i> Download File</a></div>`;
            }
        }

        div.innerHTML = `
            <div class="message-bubble ${msg.sender} shadow-sm">
                ${fileHtml}
                <div class="text">${msg.message || ''}</div>
                <div class="time small opacity-50">${new Date().getHours()}:${new Date().getMinutes()}</div>
            </div>
        `;
        chatContainer.appendChild(div);
    }

    // Toggle Human Support
    const toggleBtn = document.getElementById('toggleHumanSupport');
    toggleBtn.addEventListener('click', async () => {
        try {
            const response = await fetch(`{{ route('conversations.toggle', $conversation) }}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            const data = await response.json();
            toggleBtn.textContent = data.status === 'human' ? 'Switch back to Bot' : 'Take Control (Live)';
            toggleBtn.className = data.status === 'human' ? 'btn btn-outline-primary btn-sm rounded-pill px-3 me-2' : 'btn btn-outline-warning btn-sm rounded-pill px-3 me-2';
        } catch (error) {
            console.error('Toggle error:', error);
        }
    });

    // Handle Form Submit
    replyForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(replyForm);
        const msg = document.getElementById('messageInput').value;
        if (!msg && !document.getElementById('fileInput').files.length) return;

        try {
            const response = await fetch(`{{ route('conversations.reply', $conversation) }}`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            const data = await response.json();
            if (data.status === 'success') {
                document.getElementById('messageInput').value = '';
                document.getElementById('fileInput').value = '';
                appendMessage(data.message);
                lastMessageId = data.message.id;
                chatContainer.scrollTop = chatContainer.scrollHeight;
            }
        } catch (error) {
            console.error('Submit error:', error);
        }
    });
});
</script>
@endsection
