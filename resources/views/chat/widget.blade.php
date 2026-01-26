<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot Widget</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --primary-color: {{ $chatbot->settings['branding']['primary_color'] ?? '#6366f1' }};
            --primary-gradient: linear-gradient(135deg, var(--primary-color), #4f46e5);
            --bg-body: #f8fafc;
            --msg-bot-bg: #ffffff;
            --msg-user-bg: var(--primary-color);
            --text-main: #1e293b;
            --text-muted: #64748b;
        }

        * { box-sizing: border-box; }
        
        body { 
            font-family: 'Inter', sans-serif; 
            margin: 0; 
            background: var(--bg-body); 
            height: 100vh; 
            display: flex; 
            flex-direction: column; 
            color: var(--text-main);
            overflow: hidden;
        }

        /* Header Styling */
        .chat-header { 
            background: var(--primary-gradient); 
            padding: 16px 20px; 
            color: white; 
            display: flex; 
            align-items: center; 
            gap: 12px; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            z-index: 10;
        }
        
        .header-icon {
            width: 36px;
            height: 36px;
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(4px);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            overflow: hidden;
            border: 1px solid rgba(255,255,255,0.3);
        }
        .header-icon img { width: 100%; height: 100%; object-fit: cover; }

        .header-info h6 { margin: 0; font-size: 0.95rem; font-weight: 700; }
        .header-info span { font-size: 0.7rem; opacity: 0.8; font-weight: 500; display: flex; align-items: center; gap: 4px; }
        .online-dot { width: 6px; height: 6px; background: #4ade80; border-radius: 50%; display: inline-block; }

        /* Chat Body */
        .chat-body { 
            flex: 1; 
            padding: 20px; 
            overflow-y: auto; 
            display: flex; 
            flex-direction: column; 
            gap: 16px;
            scroll-behavior: smooth;
        }

        /* Custom Scrollbar */
        .chat-body::-webkit-scrollbar { width: 5px; }
        .chat-body::-webkit-scrollbar-track { background: transparent; }
        .chat-body::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }

        /* Message Containers */
        .bot-msg-group { display: flex; gap: 10px; align-items: flex-start; max-width: 85%; }
        
        .bot-avatar { 
            width: 28px; height: 28px; 
            background: white; 
            border-radius: 8px; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-size: 0.85rem; 
            color: var(--primary-color); 
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            flex-shrink: 0; 
            overflow: hidden;
            margin-top: 4px;
        }
        .bot-avatar img { width: 100%; height: 100%; object-fit: cover; }

        .message { 
            padding: 12px 16px; 
            border-radius: 16px; 
            font-size: 0.92rem; 
            line-height: 1.5; 
            position: relative;
            animation: fadeIn 0.3s ease-out;
        }

        @keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }

        .message.bot { 
            background: var(--msg-bot-bg); 
            color: #334155; 
            border-bottom-left-radius: 4px; 
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
            border: 1px solid #f1f5f9;
        }

        .message.user { 
            background: var(--primary-gradient); 
            color: white; 
            align-self: flex-end; 
            border-bottom-right-radius: 4px; 
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
            max-width: 85%;
        }

        /* Footer / Input */
        .chat-footer { 
            padding: 16px 20px; 
            background: white;
            border-top: 1px solid #f1f5f9; 
            display: flex; 
            align-items: center;
            gap: 12px; 
        }

        .input-wrapper {
            flex: 1;
            position: relative;
            display: flex;
            align-items: center;
        }

        .chat-input { 
            width: 100%;
            border: 1.5px solid #f1f5f9; 
            background: #f8fafc; 
            padding: 12px 16px; 
            border-radius: 12px; 
            font-size: 0.9rem; 
            outline: none; 
            transition: all 0.2s;
            font-family: inherit;
        }
        .chat-input:focus { border-color: var(--primary-color); background: white; box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1); }

        .send-btn { 
            background: var(--primary-gradient); 
            color: white; 
            border: none; 
            width: 42px; height: 42px; 
            border-radius: 10px; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            cursor: pointer; 
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 4px 10px rgba(99, 102, 241, 0.2);
        }
        .send-btn:hover { transform: scale(1.05); }
        .send-btn:active { transform: scale(0.95); }
        .send-btn i { font-size: 1.1rem; margin-left: 2px; }

        .typing { 
            padding: 0 20px 10px 20px;
            font-size: 0.75rem; 
            color: var(--text-muted); 
            display: none; 
            align-items: center;
            gap: 6px;
        }
        .dot { width: 4px; height: 4px; background: var(--text-muted); border-radius: 50%; animation: blink 1.4s infinite both; }
        .dot:nth-child(2) { animation-delay: 0.2s; }
        .dot:nth-child(3) { animation-delay: 0.4s; }
        @keyframes blink { 0%, 80%, 100% { opacity: 0; } 40% { opacity: 1; } }

        .branding-lite {
            text-align: center;
            padding-bottom: 8px;
            font-size: 0.65rem;
            color: #cbd5e1;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
    </style>
</head>
<body>
    <!-- Lead Capture Form -->
    @if($chatbot->settings['lead_form_enabled'] ?? false)
    <div id="leadFormOverlay" style="display:none; position:absolute; top:0; left:0; width:100%; height:100%; background: var(--bg-body); z-index:100; flex-direction:column; justify-content:center; padding:30px;">
        <div class="text-center mb-4">
            <div style="width: 60px; height: 60px; background:white; border-radius:20px; box-shadow:0 10px 30px rgba(0,0,0,0.05); display:inline-flex; align-items:center; justify-content:center; margin-bottom:20px;">
                @if(isset($chatbot->settings['branding']['icon_url']))
                    <img src="{{ $chatbot->settings['branding']['icon_url'] }}" style="width:100%; height:100%; object-fit:cover; border-radius:20px;">
                @else
                    <i class="bi bi-robot fs-1" style="color: var(--primary-color);"></i>
                @endif
            </div>
            <h4 style="font-weight:800; margin-bottom:8px; color:var(--text-main);">Welcome! 👋</h4>
            <p style="font-size:0.9rem; color:var(--text-muted); margin:0;">Please introduce yourself to start chatting.</p>
        </div>
        <form id="leadForm" style="background:white; padding:25px; border-radius:20px; box-shadow:0 4px 20px rgba(0,0,0,0.02);">
            <div style="margin-bottom:15px;">
                <label style="font-size:0.75rem; font-weight:700; color:var(--text-muted); text-transform:uppercase; margin-bottom:6px; display:block;">Full Name</label>
                <input type="text" name="name" required style="width:100%; padding:12px; border:2px solid #f1f5f9; border-radius:12px; font-family:inherit; outline:none; transition:border-color 0.2s;" onfocus="this.style.borderColor=getComputedStyle(document.documentElement).getPropertyValue('--primary-color')">
            </div>
            <div style="margin-bottom:15px;">
                <label style="font-size:0.75rem; font-weight:700; color:var(--text-muted); text-transform:uppercase; margin-bottom:6px; display:block;">Email Address</label>
                <input type="email" name="email" required style="width:100%; padding:12px; border:2px solid #f1f5f9; border-radius:12px; font-family:inherit; outline:none; transition:border-color 0.2s;" onfocus="this.style.borderColor=getComputedStyle(document.documentElement).getPropertyValue('--primary-color')">
            </div>
            <div style="display:flex; gap:10px; margin-bottom:20px;">
                <div style="flex:1;">
                    <label style="font-size:0.75rem; font-weight:700; color:var(--text-muted); text-transform:uppercase; margin-bottom:6px; display:block;">City</label>
                    <input type="text" name="city" required style="width:100%; padding:12px; border:2px solid #f1f5f9; border-radius:12px; font-family:inherit; outline:none; transition:border-color 0.2s;" onfocus="this.style.borderColor=getComputedStyle(document.documentElement).getPropertyValue('--primary-color')">
                </div>
                <div style="flex:1;">
                    <label style="font-size:0.75rem; font-weight:700; color:var(--text-muted); text-transform:uppercase; margin-bottom:6px; display:block;">Country</label>
                    <input type="text" name="country" required style="width:100%; padding:12px; border:2px solid #f1f5f9; border-radius:12px; font-family:inherit; outline:none; transition:border-color 0.2s;" onfocus="this.style.borderColor=getComputedStyle(document.documentElement).getPropertyValue('--primary-color')">
                </div>
            </div>
            <button type="submit" id="startChatBtn" style="width:100%; background:var(--primary-gradient); color:white; border:none; padding:14px; border-radius:12px; font-weight:600; cursor:pointer; font-size:1rem; box-shadow:0 4px 15px rgba(99, 102, 241, 0.3);">Start Conversation</button>
        </form>
    </div>
    @endif

    <div class="chat-header">
        <div class="header-icon">
            @if(isset($chatbot->settings['branding']['icon_url']))
                <img src="{{ $chatbot->settings['branding']['icon_url'] }}">
            @else
                <i class="bi bi-robot"></i>
            @endif
        </div>
        <div class="header-actions" style="margin-left:auto; display:flex; align-items:center; gap:8px;">
            <!-- Dropdown Menu -->
            <div class="dropdown" style="position:relative;">
                <button onclick="toggleMenu()" class="icon-btn" style="background:transparent; border:none; color:white; font-size:1.1rem; cursor:pointer; width:30px; height:30px; display:flex; align-items:center; justify-content:center; border-radius:50%; transition:background 0.2s;">
                    <i class="bi bi-three-dots-vertical"></i>
                </button>
                <div id="menuDropdown" style="display:none; position:absolute; top:100%; right:0; background:white; border-radius:12px; box-shadow:0 10px 30px rgba(0,0,0,0.15); min-width:180px; overflow:hidden; z-index:20; margin-top:8px; animation: fadeIn 0.1s ease-out;">
                    <button onclick="refreshChat()" style="width:100%; text-align:left; padding:12px 16px; border:none; background:transparent; font-size:0.85rem; color:#334155; cursor:pointer; display:flex; align-items:center; gap:10px; transition:background 0.1s;">
                        <i class="bi bi-arrow-clockwise"></i> Refresh chat
                    </button>
                    <button onclick="downloadChat()" style="width:100%; text-align:left; padding:12px 16px; border:none; background:transparent; font-size:0.85rem; color:#334155; cursor:pointer; display:flex; align-items:center; gap:10px; transition:background 0.1s; border-top:1px solid #f1f5f9;">
                        <i class="bi bi-download"></i> Download
                    </button>
                </div>
            </div>
            
            <!-- Window Controls -->
            <button onclick="toggleMaximize()" class="icon-btn" style="background:transparent; border:none; color:white; font-size:1rem; cursor:pointer; width:30px; height:30px; display:flex; align-items:center; justify-content:center; border-radius:50%; transition:background 0.2s;">
                <i class="bi bi-arrows-angle-expand" id="maxIcon"></i>
            </button>
            <button onclick="closeWidget()" class="icon-btn" style="background:transparent; border:none; color:white; font-size:1.2rem; cursor:pointer; width:30px; height:30px; display:flex; align-items:center; justify-content:center;  border-radius:50%; transition:background 0.2s;">
                <i class="bi bi-x"></i>
            </button>
        </div>
    </div>

    <div class="chat-body" id="chatContainer">
        <!-- Messages will appear here -->
        <div class="bot-msg-group">
            <div class="bot-avatar">
                @if(isset($chatbot->settings['branding']['icon_url']))
                    <img src="{{ $chatbot->settings['branding']['icon_url'] }}">
                @else
                    <i class="bi bi-robot"></i>
                @endif
            </div>
            <div class="message bot">
                {{ $chatbot->settings['branding']['welcome_message'] ?? __('widget.welcome_default') }}
                
                @if($chatbot->settings['show_suggested_questions'] ?? false)
                    <div style="margin-top:12px; display:flex; flex-direction:column; gap:8px;">
                        <span style="font-size:0.75rem; font-weight:600; opacity:0.8;">Ask me about:</span>
                         @foreach($chatbot->settings['suggested_questions'] ?? [] as $question)
                            <button onclick="askQuestion('{{ addslashes($question) }}')" style="text-align:left; background: #f1f5f9; border: 1px solid #cbd5e1; padding: 8px 12px; border-radius: 12px; font-size: 0.85rem; cursor: pointer; color: var(--primary-color); transition: all 0.2s; font-weight: 500;">
                                {{ $question }}
                            </button>
                         @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="typing" id="typingIndicator">
        <span>{{ __('widget.is_thinking', ['name' => $chatbot->settings['branding']['display_name'] ?? $chatbot->name]) }}</span>
        <div class="dot"></div><div class="dot"></div><div class="dot"></div>
    </div>

    <div class="chat-footer">
        <div class="input-wrapper">
            <label for="widgetFileInput" style="cursor:pointer; margin-right:8px; color:var(--text-muted); display:flex; align-items:center;">
                <i class="bi bi-paperclip fs-5"></i>
                <input type="file" id="widgetFileInput" class="d-none">
            </label>
            <input type="text" class="chat-input" id="userInput" placeholder="{{ __('widget.input_placeholder') }}" autocomplete="off">
        </div>
        <button class="send-btn" id="sendBtn" title="{{ __('widget.send') }}"><i class="bi bi-send-fill"></i></button>
    </div>
    <div class="branding-lite">{{ __('widget.powered_by') }}</div>

    <script>
        const chatContainer = document.getElementById('chatContainer');
        const userInput = document.getElementById('userInput');
        const sendBtn = document.getElementById('sendBtn');
        const typingIndicator = document.getElementById('typingIndicator');
        const leadFormOverlay = document.getElementById('leadFormOverlay');
        const leadForm = document.getElementById('leadForm');
        const menuDropdown = document.getElementById('menuDropdown');
        
        let isMaximized = false;
        
        // Lead Form Logic
        const chatbotId = '{{ $chatbot->id }}';
        const isLeadFormEnabled = {{ ($chatbot->settings['lead_form_enabled'] ?? false) ? 'true' : 'false' }};
        const hasSubmittedLead = localStorage.getItem('chatbot_lead_submitted_' + chatbotId);

        if (isLeadFormEnabled && !hasSubmittedLead) {
            if (leadFormOverlay) {
                leadFormOverlay.style.display = 'flex';
            }
        }

        if (leadForm) {
            leadForm.onsubmit = (e) => {
                e.preventDefault();
                const btn = document.getElementById('startChatBtn');
                const originalText = btn.innerText;
                btn.innerText = 'Saving...';
                btn.disabled = true;

                const formData = new FormData(leadForm);
                formData.append('chatbot_id', chatbotId);
                formData.append('_token', '{{ csrf_token() }}');

                fetch('{{ route("chat.lead") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    localStorage.setItem('chatbot_lead_submitted_' + chatbotId, 'true');
                    leadFormOverlay.style.display = 'none';
                })
                .catch(err => {
                    alert('Error saving details. Please try again.');
                    btn.innerText = originalText;
                    btn.disabled = false;
                });
            };
        }

        function toggleMenu() {
            if(menuDropdown)
                menuDropdown.style.display = (menuDropdown.style.display === 'block') ? 'none' : 'block';
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (menuDropdown && !event.target.closest('.dropdown')) {
                menuDropdown.style.display = 'none';
            }
        });

        function refreshChat() {
            if(confirm('Start a new conversation?')) {
                location.reload();
            }
        }

        function downloadChat() {
            let transcript = "Chat Transcript - " + new Date().toLocaleString() + "\n\n";
            const messages = document.querySelectorAll('.message');
            messages.forEach(msg => {
                const role = msg.classList.contains('user') ? 'User' : 'Bot';
                transcript += role + ": " + msg.innerText + "\n\n";
            });
            
            const blob = new Blob([transcript], { type: 'text/plain' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'chat-transcript.txt';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            window.URL.revokeObjectURL(url);
            if(menuDropdown) menuDropdown.style.display = 'none';
        }

        function toggleMaximize() {
            isMaximized = !isMaximized;
            const icon = document.getElementById('maxIcon');
            if(isMaximized) {
                icon.className = 'bi bi-fullscreen-exit';
                window.parent.postMessage({ action: 'maximize_chatbot', chatbotId: '{{ $chatbot->id }}' }, '*');
            } else {
                icon.className = 'bi bi-arrows-angle-expand';
                window.parent.postMessage({ action: 'restore_chatbot', chatbotId: '{{ $chatbot->id }}' }, '*');
            }
        }

        function closeWidget() {
             window.parent.postMessage({ action: 'close_chatbot', chatbotId: '{{ $chatbot->id }}' }, '*');
        }

        function askQuestion(question) {
            userInput.value = question;
            sendMessage();
        }

        const translations = {
            error_connecting: "{{ __('widget.error_connecting') }}",
            network_issue: "{{ __('widget.network_issue') }}"
        };

        let lastMessageId = 0;

        const addMessage = (msg, role) => {
            const text = typeof msg === 'string' ? msg : msg.message;
            const id = (typeof msg === 'object' && msg.id) ? msg.id : null;
            const file_path = msg.file_path || null;
            const file_type = msg.file_type || null;

            if (id && document.querySelector(`.message[data-id="${id}"]`)) {
                return;
            }

            let fileHtml = '';
            if (file_path) {
                if (file_type && ['jpg', 'jpeg', 'png', 'gif'].includes(file_type.toLowerCase())) {
                    fileHtml = `<div style="margin-bottom:8px;"><img src="${file_path}" style="max-width:100%; border-radius:8px;"></div>`;
                } else {
                    fileHtml = `<div style="margin-bottom:8px;"><a href="${file_path}" target="_blank" style="color:inherit; text-decoration:underline;">📎 Attachment</a></div>`;
                }
            }

            if (role === 'bot' || role === 'admin') {
                const group = document.createElement('div');
                group.className = 'bot-msg-group';
                const iconHtml = `{!! isset($chatbot->settings['branding']['icon_url']) ? '<img src="'.$chatbot->settings['branding']['icon_url'].'">' : '<i class="bi bi-robot"></i>' !!}`;
                group.innerHTML = `
                    <div class="bot-avatar">${role === 'admin' ? '<i class="bi bi-person-fill"></i>' : iconHtml}</div>
                    <div class="message bot" ${id ? `data-id="${id}"` : ''}>
                        ${fileHtml}
                        ${text || ''}
                    </div>
                `;
                chatContainer.appendChild(group);
            } else {
                const div = document.createElement('div');
                div.className = `message ${role}`;
                if (id) div.dataset.id = id;
                div.innerHTML = `
                    ${fileHtml}
                    ${text || ''}
                `;
                chatContainer.appendChild(div);
            }
            chatContainer.scrollTop = chatContainer.scrollHeight;
        };

        const sendMessage = () => {
            const message = userInput.value.trim();
            const fileInput = document.getElementById('widgetFileInput');
            const file = fileInput.files[0];

            if (!message && !file) return;

            // Simplified preview for user
            addMessage(message, 'user');
            
            const formData = new FormData();
            formData.append('chatbot_id', '{{ $chatbot->id }}');
            formData.append('message', message);
            if (file) formData.append('file', file);

            userInput.value = '';
            fileInput.value = '';
            typingIndicator.style.display = 'flex';
            chatContainer.scrollTop = chatContainer.scrollHeight;

            fetch('{{ route("chat.send") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                typingIndicator.style.display = 'none';
                if (data.answer) {
                    addMessage({ message: data.answer, id: data.message_id, sender: 'bot' }, 'bot');
                    if (data.message_id) {
                        lastMessageId = data.message_id;
                    }
                } else if (data.status === 'waiting_for_agent') {
                    // Do nothing, waiting for pollution to pick up admin reply
                }
            })
            .catch(() => {
                typingIndicator.style.display = 'none';
                addMessage(translations.network_issue, 'bot');
            });
        };

        // Polling for updates (for Live Support)
        setInterval(async () => {
            try {
                const response = await fetch(`{{ route('chat.updates') }}?chatbot_id={{ $chatbot->id }}&last_message_id=${lastMessageId}`);
                const data = await response.json();
                
                if (data.messages && data.messages.length > 0) {
                    data.messages.forEach(msg => {
                        // Only add messages not sent by 'user' (since they are added locally immediately)
                        // Actually, to be safe and handle multi-device, we could check sender
                        if (msg.sender !== 'user') {
                            addMessage(msg, msg.sender);
                        }
                        lastMessageId = msg.id;
                    });
                }
            } catch (error) {
                // Silent fail for polling
            }
        }, 4000);

        // Initial lastMessageId setup if needed (though it starts at 0)
        // We could fetch history here too if we wanted.

        sendBtn.onclick = sendMessage;
        userInput.onkeypress = (e) => { if (e.key === 'Enter') sendMessage(); };
    </script>
</body>
</html>

