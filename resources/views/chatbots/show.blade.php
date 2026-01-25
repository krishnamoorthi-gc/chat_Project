@extends('layouts.dashboard')

@section('title', $chatbot->name)

@section('content')
<div class="container-fluid p-0">
    <!-- Tabs Navigation -->
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom">
        <ul class="nav nav-tabs border-0" id="chatbotTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active fw-bold px-4 border-0 position-relative" id="training-tab" data-bs-toggle="tab" data-bs-target="#training" type="button" role="tab">
                    <i class="bi bi-hammer me-2"></i>Training
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-bold px-4 border-0 position-relative" id="appearance-tab" data-bs-toggle="tab" data-bs-target="#appearance" type="button" role="tab">
                    <i class="bi bi-palette me-2"></i>Appearance
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-bold px-4 border-0 position-relative" id="embed-tab" data-bs-toggle="tab" data-bs-target="#embed" type="button" role="tab">
                    <i class="bi bi-code-slash me-2"></i>Embed & Share
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-bold px-4 border-0 position-relative" id="leads-tab" data-bs-toggle="tab" data-bs-target="#leads" type="button" role="tab">
                    <i class="bi bi-people me-2"></i>Captured Leads
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-bold px-4 border-0 position-relative" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab">
                    <i class="bi bi-gear me-2"></i>Settings
                </button>
            </li>
        </ul>
        <div class="pb-2">
             <button class="btn btn-primary btn-sm shadow-sm" style="background: var(--dash-primary); border: none; border-radius: 8px;" onclick="window.open('{{ route('chat.widget', $chatbot) }}', '_blank')">
                <i class="bi bi-play-fill me-1"></i> Preview
             </button>
        </div>
    </div>

    <style>
        .nav-tabs .nav-link {
            color: var(--dash-text-gray);
            padding-bottom: 15px;
            background: none;
        }
        .nav-tabs .nav-link.active {
            color: var(--dash-primary);
        }
        .nav-tabs .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 20%;
            right: 20%;
            height: 3px;
            background: var(--dash-primary);
            border-radius: 3px 3px 0 0;
        }
        .ingestion-card {
            cursor: pointer;
            transition: all 0.2s;
            border: 1px solid transparent;
        }
        .ingestion-card:hover {
            transform: translateY(-3px);
            border-color: var(--dash-primary);
            background-color: #f0effb;
        }
        .ingestion-card i {
            font-size: 2rem;
            margin-bottom: 15px;
            color: var(--dash-primary);
        }
        .smallest {
            font-size: 0.75rem;
        }
    </style>

    <div class="tab-content" id="chatbotTabsContent">
        <!-- 1. Training Tab -->
        <div class="tab-pane fade show active" id="training" role="tabpanel">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Ingestion Methods Selector -->
                    <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px;">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3">Knowledge Ingestion</h5>
                            <p class="text-muted small mb-4">Choose how you want to add knowledge to your chatbot.</p>
                            
                            <div class="row g-3">
                                <div class="col-6 col-md-3">
                                    <div class="card h-100 ingestion-card p-3 text-center rounded-4 shadow-none bg-light" onclick="document.getElementById('file-input').click()">
                                        <i class="bi bi-file-earmark-arrow-up"></i>
                                        <h6 class="fw-bold small mb-1">Upload Docs</h6>
                                        <span class="text-muted" style="font-size: 0.65rem;">PDF, DOCX, TXT</span>
                                        <input type="file" id="file-input" class="d-none" multiple accept=".pdf,.docx,.txt">
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="card h-100 ingestion-card p-3 text-center rounded-4 shadow-none bg-light" data-bs-toggle="modal" data-bs-target="#textInputModal">
                                        <i class="bi bi-body-text"></i>
                                        <h6 class="fw-bold small mb-1">Text/Para</h6>
                                        <span class="text-muted" style="font-size: 0.65rem;">Manual Entry</span>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="card h-100 ingestion-card p-3 text-center rounded-4 shadow-none bg-light" data-bs-toggle="modal" data-bs-target="#qaInputModal">
                                        <i class="bi bi-patch-question"></i>
                                        <h6 class="fw-bold small mb-1">Q&A Pairs</h6>
                                        <span class="text-muted" style="font-size: 0.65rem;">Specific Answers</span>
                                        @if(($chatbot->settings['response_mode'] ?? 'ai') == 'direct')
                                            <div class="mt-2"><span class="badge bg-success" style="font-size: 0.55rem;">Direct Mode: No AI Limits</span></div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="card h-100 ingestion-card p-3 text-center rounded-4 shadow-none bg-light" data-bs-toggle="modal" data-bs-target="#imageUploadModal">
                                        <i class="bi bi-image"></i>
                                        <h6 class="fw-bold small mb-1">Upload Images</h6>
                                        <span class="text-muted" style="font-size: 0.65rem;">OCR Training</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px;">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="fw-bold mb-0">Trained Data Sources</h6>
                                <button class="btn btn-sm btn-link text-muted" onclick="location.reload()"><i class="bi bi-arrow-clockwise"></i> Refresh</button>
                            </div>
                            
                            @if($chatbot->knowledgeSources->isEmpty())
                                <div class="text-center py-5 bg-light rounded-4">
                                    <i class="bi bi-inbox fs-1 text-muted opacity-50 d-block mb-3"></i>
                                    <p class="text-muted mb-0">No data sources added yet.</p>
                                </div>
                            @else
                                <div class="list-group list-group-flush">
                                    @foreach($chatbot->knowledgeSources as $source)
                                        <div class="list-group-item d-flex justify-content-between align-items-center px-0 py-3 border-0">
                                            <div class="d-flex align-items-center flex-grow-1 overflow-hidden">
                                                <div class="me-3 p-2 rounded-3 bg-light">
                                                    @if($source->type == 'file') <i class="bi bi-file-earmark-text text-primary fs-4"></i>
                                                    @elseif($source->type == 'url') <i class="bi bi-link-45deg text-success fs-4"></i>
                                                    @elseif($source->type == 'text') <i class="bi bi-body-text text-info fs-4"></i>
                                                    @else <i class="bi bi-patch-question text-warning fs-4"></i>
                                                    @endif
                                                </div>
                                                <div class="text-truncate">
                                                    <h6 class="mb-0 fw-semibold text-truncate">{{ $source->title }}</h6>
                                                    <div class="d-flex align-items-center gap-2 mt-1">
                                                        <small class="text-muted" style="font-size: 0.7rem;">{{ $source->created_at->diffForHumans() }}</small>
                                                        @if($source->status == 'processed') <span class="badge bg-success-soft text-success rounded-pill" style="font-size: 0.6rem; background: #e6fffa;">Active</span>
                                                        @elseif($source->status == 'failed') <span class="badge bg-danger-soft text-danger rounded-pill" style="font-size: 0.6rem; background: #fff5f5;" title="{{ $source->error_message }}">Failed <i class="bi bi-info-circle"></i></span>
                                                        @else <span class="badge bg-blue-soft text-primary rounded-pill border-0" style="font-size: 0.6rem; background: #ebf8ff;">Processing...</span>
                                                        @endif
                                                    </div>
                                                    @if($source->status == 'failed' && $source->error_message)
                                                        <div class="text-danger mt-1" style="font-size: 0.65rem; line-height: 1.2;">
                                                            <i class="bi bi-exclamation-circle-fill me-1"></i>{{ Str::limit($source->error_message, 60) }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="dropdown">
                                                <button class="btn btn-link text-muted p-0" type="button" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></button>
                                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
                                                    <li>
                                                        <button type="button" class="dropdown-item" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#viewContentModal" 
                                                            data-title="{{ $source->title }}"
                                                            data-type="{{ $source->type }}"
                                                            data-content="{{ $source->content }}"
                                                            data-url="{{ $source->file_path ? asset('storage/' . $source->file_path) : '' }}">
                                                            <i class="bi bi-eye me-2"></i>View
                                                        </button>
                                                    </li>
                                                    @if($source->status == 'failed')
                                                        <li>
                                                            <form action="{{ route('knowledge.retry', $source) }}" method="POST">
                                                                @csrf
                                                                <button type="submit" class="dropdown-item">
                                                                    <i class="bi bi-arrow-clockwise me-2"></i>Retry
                                                                </button>
                                                            </form>
                                                        </li>
                                                    @endif
                                                    <li>
                                                        <button type="button" class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-action="{{ route('knowledge.destroy', $source) }}">
                                                            <i class="bi bi-trash me-2"></i>Delete
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px;">
                        <div class="card-body p-4 text-center">
                            <h3 class="fw-bold mb-0 text-primary">{{ $chatbot->knowledgeSources->where('status', 'processed')->count() }}</h3>
                            <p class="text-muted small mb-3">Trained Knowledge Blocks</p>
                            <div class="d-grid gap-2">
                                <button class="btn btn-outline-primary py-2" data-bs-toggle="modal" data-bs-target="#crawlUrlModal"><i class="bi bi-link-45deg me-1"></i> Crawl Website</button>
                                <button class="btn btn-outline-secondary py-2" data-bs-toggle="modal" data-bs-target="#crawlSitemapModal"><i class="bi bi-diagram-3 me-1"></i> Fetch Sitemap</button>
                            </div>

                            @if($chatbot->knowledgeSources->where('status', 'failed')->count() > 0)
                                <div class="alert alert-warning border-0 rounded-4 p-3 mt-4 text-start">
                                    <div class="d-flex align-items-start">
                                        <i class="bi bi-exclamation-triangle-fill text-warning fs-5 me-3 mt-1"></i>
                                        <div>
                                            <h6 class="fw-bold mb-1" style="font-size: 0.8rem;">Ingestion Issues</h6>
                                            <p class="text-muted small mb-0" style="font-size: 0.75rem;">{{ $chatbot->knowledgeSources->where('status', 'failed')->count() }} source(s) failed. Check the list to retry or delete.</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Appearance Tab (Simplified for brevity, but kept logic) -->
        <div class="tab-pane fade" id="appearance" role="tabpanel">
            <div class="row">
                <div class="col-lg-7">
                    <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px;">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4">Chatbot Branding</h5>
                            <form id="appearanceForm">
                                <div class="mb-4">
                                    <label class="form-label fw-bold small text-muted text-uppercase">Primary Color</label>
                                    <div class="d-flex gap-3 align-items-center">
                                        <input type="color" class="form-control form-control-color border-0 border-radius-8" name="primary_color" value="{{ $chatbot->settings['branding']['primary_color'] ?? '#6c5dd3' }}" style="width: 60px; height: 40px; border-radius: 8px;">
                                        <input type="text" class="form-control bg-light border-0" value="{{ $chatbot->settings['branding']['primary_color'] ?? '#6c5dd3' }}" readonly style="border-radius: 8px;">
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-bold small text-muted text-uppercase">Display Name</label>
                                    <input type="text" class="form-control bg-light border-0" name="display_name" value="{{ $chatbot->settings['branding']['display_name'] ?? $chatbot->name }}" style="padding: 12px; border-radius: 10px;">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-bold small text-muted text-uppercase">Welcome Message</label>
                                    <textarea class="form-control bg-light border-0" name="branding[welcome_message]" rows="3" style="border-radius: 10px;">{{ $chatbot->settings['branding']['welcome_message'] ?? 'Hi! How can I help you today?' }}</textarea>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-bold small text-muted text-uppercase">Chatbot Icon</label>
                                    <div class="d-flex align-items-center gap-3">
                                        <div id="preview-icon-container" class="rounded-circle overflow-hidden d-flex align-items-center justify-content-center bg-light border" style="width: 50px; height: 50px;">
                                            @if(isset($chatbot->settings['branding']['icon_url']))
                                                <img src="{{ $chatbot->settings['branding']['icon_url'] }}" id="current-icon-img" style="width: 100%; height: 100%; object-fit: cover;">
                                            @else
                                                <i class="bi bi-robot fs-4" id="current-icon-icon"></i>
                                            @endif
                                        </div>
                                        <div class="flex-grow-1">
                                            <input type="file" name="icon" class="form-control bg-light border-0" accept="image/*" id="icon-input">
                                            <div class="form-text small" style="font-size: 0.65rem;">Recommended size: 128x128px</div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary fw-bold" style="background: var(--dash-primary); border: none; padding: 12px 30px; border-radius: 12px;">Update Branding</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div style="background: #f1f5f9; border-radius: 20px; padding: 30px; border: 1px solid #e2e8f0; height: 550px; display:flex; flex-direction:column; justify-content: center; align-items: center; position: relative;">
                        <span class="badge bg-white text-primary shadow-sm border px-3 py-2 rounded-pill position-absolute top-0 start-50 translate-middle-x mt-3" style="font-size: 0.65rem; font-weight: 700;">LIVE PREVIEW</span>
                        
                        <!-- Mini Widget Mockup -->
                        <div style="width: 100%; max-width: 320px; background: white; border-radius: 20px; box-shadow: 0 20px 50px rgba(0,0,0,0.1); overflow:hidden; display:flex; flex-direction:column; border: 1px solid rgba(0,0,0,0.05);">
                            <!-- Header -->
                            <div style="background: linear-gradient(135deg, {{ $chatbot->settings['branding']['primary_color'] ?? '#6366f1' }}, #4f46e5); padding: 16px; color: white; display:flex; align-items:center; gap: 10px;">
                                <div style="width: 32px; height: 32px; background: rgba(255,255,255,0.2); backdrop-filter: blur(4px); border-radius: 8px; display:flex; align-items:center; justify-content:center; overflow:hidden; border: 1px solid rgba(255,255,255,0.3);">
                                    @if(isset($chatbot->settings['branding']['icon_url']))
                                        <img src="{{ $chatbot->settings['branding']['icon_url'] }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                        <i class="bi bi-robot" style="font-size: 1rem;"></i>
                                    @endif
                                </div>
                                <div>
                                    <div class="fw-bold" style="font-size: 0.85rem; line-height: 1.2;">{{ $chatbot->settings['branding']['display_name'] ?? $chatbot->name }}</div>
                                    <div style="font-size: 0.6rem; opacity: 0.8;"><span style="width: 6px; height: 6px; background: #4ade80; border-radius: 50%; display: inline-block; margin-right: 4px;"></span>Online</div>
                                </div>
                            </div>
                            
                            <!-- Body -->
                            <div style="flex:1; padding: 20px; background: #fff; min-height: 250px; display:flex; flex-direction:column; gap: 12px;">
                                <div style="display:flex; gap: 8px; align-items: flex-start;">
                                    <div style="width: 26px; height: 26px; background: #fff; border-radius: 6px; display:flex; align-items:center; justify-content:center; overflow:hidden; color: {{ $chatbot->settings['branding']['primary_color'] ?? '#6366f1' }}; border: 1px solid #f1f5f9; box-shadow: 0 2px 5px rgba(0,0,0,0.05); flex-shrink: 0; margin-top: 2px;">
                                        @if(isset($chatbot->settings['branding']['icon_url']))
                                            <img src="{{ $chatbot->settings['branding']['icon_url'] }}" style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                            <i class="bi bi-robot" style="font-size: 0.7rem;"></i>
                                        @endif
                                    </div>
                                    <div style="background: #f8fafc; color: #334155; padding: 10px 14px; border-radius: 14px 14px 14px 4px; max-width: 85%; font-size: 0.8rem; line-height: 1.4; border: 1px solid #f1f5f9;">
                                        {{ $chatbot->settings['branding']['welcome_message'] ?? 'Hi! How can I help you today?' }}
                                    </div>
                                </div>
                                <div style="background: linear-gradient(135deg, {{ $chatbot->settings['branding']['primary_color'] ?? '#6366f1' }}, #4f46e5); color: white; padding: 10px 14px; border-radius: 14px 14px 4px 14px; align-self: flex-end; max-width: 85%; font-size: 0.8rem; line-height: 1.4; box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);">
                                    I need some help with my order.
                                </div>
                            </div>
                            
                            <!-- Footer -->
                            <div style="padding: 12px 16px; border-top: 1px solid #f1f5f9; background: white; display:flex; gap: 8px; align-items: center;">
                                <div style="flex:1; background: #f8fafc; border: 1px solid #f1f5f9; border-radius: 10px; padding: 8px 12px; font-size: 0.75rem; color: #94a3b8;">Write a message...</div>
                                <div style="width: 32px; height: 32px; background: linear-gradient(135deg, {{ $chatbot->settings['branding']['primary_color'] ?? '#6366f1' }}, #4f46e5); color: white; border-radius: 8px; display:flex; align-items:center; justify-content:center; font-size: 0.8rem; box-shadow: 0 4px 10px rgba(99, 102, 241, 0.2);">
                                    <i class="bi bi-send-fill" style="margin-left: 1px;"></i>
                                </div>
                            </div>
                            <div style="text-align: center; padding-bottom: 6px; font-size: 0.55rem; color: #cbd5e1; text-transform: uppercase; letter-spacing: 0.5px;">Powered by Chatbot AI</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Embed Tab -->
        <div class="tab-pane fade" id="embed" role="tabpanel">
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Integrate on your site</h5>
                    <p class="text-muted mb-4">Copy this script to add the floating chat bubble to your website.</p>
                    <div class="p-4 bg-dark text-white rounded-4 position-relative shadow-lg overflow-hidden">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-secondary text-uppercase" style="font-size: 0.6rem; letter-spacing: 1px;">Copy This Script</span>
                            <button class="btn btn-sm btn-outline-light border-0" onclick="copyEmbedCode()"><i class="bi bi-clipboard me-1"></i> Copy Code</button>
                        </div>
                        <pre class="mb-0 overflow-auto" id="embedCodeMarkup" style="font-family: 'Courier New', Courier, monospace; font-size: 0.85rem; color: #a5d6ff;"><code id="embed-code-text">&lt;!-- AI Chatbot Embed Code --&gt;
&lt;script 
    src="{{ url('chat-loader.js') }}" 
    data-chatbot-id="{{ $chatbot->id }}" 
    data-base-url="{{ url('/') }}"
    data-primary-color="{{ $chatbot->settings['branding']['primary_color'] ?? '#6366f1' }}"
&gt;&lt;/script&gt;</code></pre>
                    </div>
                    <div class="mt-4 p-3 bg-blue-soft rounded-4 border-0" style="background: #ebf8ff;">
                        <div class="d-flex">
                            <i class="bi bi-puzzle-fill text-primary mt-1 me-3"></i>
                            <p class="small text-primary mb-0"><strong>Universal Support:</strong> This code works with HTML, WordPress, Shopify, React, and any other web platform.</p>
                        </div>
                    <div class="mt-5 pt-4 border-top">
                        <h6 class="fw-bold mb-3"><i class="bi bi-phone me-2"></i>Mobile App Integration</h6>
                        <p class="text-muted small mb-3">For mobile apps (Flutter, React Native, Swift, Kotlin), use a <strong>WebView</strong> component and point it to your direct widget URL:</p>
                        <div class="p-3 bg-light rounded-4 d-flex justify-content-between align-items-center">
                            <code class="text-primary small" id="mobile-url">{{ route('chat.widget', $chatbot) }}</code>
                            <button class="btn btn-sm btn-outline-primary border-0" onclick="navigator.clipboard.writeText(document.getElementById('mobile-url').innerText); alert('URL Copied!')"><i class="bi bi-copy"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <!-- 4. Leads Tab -->
        <div class="tab-pane fade" id="leads" role="tabpanel">
            <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                <div class="card-header bg-white border-0 p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="fw-bold mb-1">Captured Leads</h5>
                            <p class="text-muted small mb-0">Visitors who interacted with this chatbot</p>
                        </div>
                        @if($chatbot->leads->isNotEmpty())
                            <span class="badge bg-primary-soft text-primary px-3 py-2" style="background: #eef2ff;">
                                {{ $chatbot->leads->count() }} {{ Str::plural('Lead', $chatbot->leads->count()) }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($chatbot->leads->isEmpty())
                        <div class="text-center py-5">
                            <i class="bi bi-person-badge display-3 text-light mb-3"></i>
                            <h5 class="fw-bold">No leads captured yet</h5>
                            <p class="text-muted">
                                @if(!($chatbot->settings['lead_form_enabled'] ?? false))
                                    Turn on Lead Generation in <a href="#settings" onclick="document.getElementById('settings-tab').click()" class="text-primary">settings</a> to start collecting customer data.
                                @else
                                    Leads will appear here once visitors start chatting with your bot.
                                @endif
                            </p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="ps-4 border-0">Contact</th>
                                        <th class="border-0">IP / Location</th>
                                        <th class="border-0">Visits</th>
                                        <th class="border-0">Last Interaction</th>
                                        <th class="border-0">Device</th>
                                        <th class="pe-4 border-0 text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($chatbot->leads as $lead)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-3 text-primary">
                                                    <i class="bi bi-person-fill"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-bold">{{ $lead->name ?? 'Guest Visitor' }}</div>
                                                    <div class="small text-muted">{{ $lead->email ?? 'No email provided' }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-bold small">{{ $lead->ip_address }}</div>
                                            @if($lead->city || $lead->country)
                                                <div class="text-muted small">
                                                    {{ $lead->city }}@if($lead->region), {{ $lead->region }}@endif, {{ $lead->country }}
                                                </div>
                                            @else
                                                <div class="text-muted small">Unknown Location</div>
                                            @endif
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
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="settings" role="tabpanel">
            <form action="{{ route('chatbots.update', $chatbot) }}" method="POST">
                @csrf @method('PUT')
                
                <div class="row g-4">
                    <!-- Left Column: Identity & Intelligence -->
                    <div class="col-lg-7">
                        <!-- 1. Identity Card -->
                        <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
                            <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 p-2 rounded-3 text-primary me-3">
                                        <i class="bi bi-robot fs-5"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Identity & Language</h6>
                                        <p class="text-muted small mb-0">Basic configuration for your chatbot.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-3">
                                    <div class="col-md-7">
                                        <label class="form-label small fw-bold text-muted text-uppercase">Chatbot Name</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-0"><i class="bi bi-fonts"></i></span>
                                            <input type="text" class="form-control bg-light border-0 py-2 fw-bold" name="name" value="{{ $chatbot->name }}" placeholder="e.g. Support Bot">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <label class="form-label small fw-bold text-muted text-uppercase">Language</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-0"><i class="bi bi-translate"></i></span>
                                            <select class="form-select bg-light border-0 py-2 cursor-pointer" name="language">
                                                <option value="en" {{ ($chatbot->settings['language'] ?? 'en') == 'en' ? 'selected' : '' }}>English</option>
                                                <option value="es" {{ ($chatbot->settings['language'] ?? 'en') == 'es' ? 'selected' : '' }}>Spanish</option>
                                                <option value="fr" {{ ($chatbot->settings['language'] ?? 'en') == 'fr' ? 'selected' : '' }}>French</option>
                                                <option value="de" {{ ($chatbot->settings['language'] ?? 'en') == 'de' ? 'selected' : '' }}>German</option>
                                                <option value="it" {{ ($chatbot->settings['language'] ?? 'en') == 'it' ? 'selected' : '' }}>Italian</option>
                                                <option value="pt" {{ ($chatbot->settings['language'] ?? 'en') == 'pt' ? 'selected' : '' }}>Portuguese</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 2. System Intelligence Card -->
                        <div class="card border-0 shadow-sm rounded-4 mb-4">
                            <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-info bg-opacity-10 p-2 rounded-3 text-info me-3">
                                            <i class="bi bi-cpu fs-5"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1">System Instructions</h6>
                                            <p class="text-muted small mb-0">Define persona and constraints.</p>
                                        </div>
                                    </div>
                                    <span class="badge bg-light text-muted border">Advanced</span>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <div class="bg-light p-3 rounded-4 border-0">
                                    <textarea class="form-control bg-transparent border-0" rows="10" name="prompt_template" placeholder="You are a helpful AI assistant. Answer concisely..." style="resize: none;">{{ $chatbot->prompt_template }}</textarea>
                                </div>
                                <div class="d-flex gap-2 mt-3 overflow-x-auto pb-2">
                                    <small class="text-muted fw-bold text-uppercase flex-shrink-0" style="font-size: 0.65rem; padding-top: 4px;">Quick Templates:</small>
                                    <button type="button" class="badge bg-white text-dark border shadow-sm fw-normal py-2 px-3" onclick="setPrompt('Support')">Customer Support</button>
                                    <button type="button" class="badge bg-white text-dark border shadow-sm fw-normal py-2 px-3" onclick="setPrompt('Sales')">Sales Agent</button>
                                    <button type="button" class="badge bg-white text-dark border shadow-sm fw-normal py-2 px-3" onclick="setPrompt('Teacher')">Tutor/Teacher</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Behavior & Leads -->
                    <div class="col-lg-5">
                        <!-- Save Button (Sticky/Prominent) -->
                        <div class="card border-0 shadow-sm rounded-4 mb-4 bg-primary text-white overflow-hidden">
                            <div class="card-body p-4 d-flex justify-content-between align-items-center position-relative">
                                <div class="position-absolute top-0 start-0 w-100 h-100 bg-gradient-primary opacity-50"></div>
                                <div class="position-relative z-1">
                                    <h6 class="fw-bold mb-1">Unsaved Changes?</h6>
                                    <p class="small text-white-50 mb-0">Don't forget to update your bot.</p>
                                </div>
                                <button type="submit" class="btn btn-light text-primary fw-bold px-4 py-2 rounded-pill shadow-sm position-relative z-1">
                                    <i class="bi bi-check-lg me-1"></i> Save Settings
                                </button>
                            </div>
                        </div>

                        <!-- 3. Lead Generation -->
                        <div class="card border-0 shadow-sm rounded-4 mb-4">
                             <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-success bg-opacity-10 p-2 rounded-3 text-success me-3">
                                            <i class="bi bi-person-lines-fill fs-5"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-0">Lead Collection</h6>
                                            <p class="text-muted small mb-0">Collect user details before chat</p>
                                        </div>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="enableLeadForm" name="lead_form_enabled" value="1" {{ ($chatbot->settings['lead_form_enabled'] ?? false) ? 'checked' : '' }} style="transform: scale(1.3);">
                                    </div>
                                </div>
                                <div class="bg-light rounded-3 p-3 border-start border-4 border-success">
                                    <div class="d-flex gap-2 mb-2">
                                        <span class="badge bg-white text-dark border">Name</span>
                                        <span class="badge bg-white text-dark border">Email</span>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <span class="badge bg-white text-dark border">City</span>
                                        <span class="badge bg-white text-dark border">Country</span>
                                    </div>
                                    <div class="mt-2 text-muted" style="font-size: 0.7rem;">
                                        <i class="bi bi-info-circle me-1"></i> Users must fill this form to proceed.
                                    </div>
                                </div>
                             </div>
                        </div>

                        <!-- 4. Response Logic -->
                        <div class="card border-0 shadow-sm rounded-4 mb-4">
                            <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                                <h6 class="fw-bold mb-0"><i class="bi bi-chat-dots me-2 text-secondary"></i>Response Style</h6>
                            </div>
                            <div class="card-body p-4">
                                <div class="d-flex flex-column gap-3">
                                    <label class="d-flex align-items-start p-3 border rounded-4 cursor-pointer hover-shadow transition-all {{ ($chatbot->settings['response_mode'] ?? 'ai') == 'ai' ? 'bg-primary-soft border-primary' : 'bg-white' }}" onclick="selectRadioCard(this)">
                                        <div class="me-3 mt-1">
                                            <input type="radio" name="response_mode" value="ai" class="form-check-input" {{ ($chatbot->settings['response_mode'] ?? 'ai') == 'ai' ? 'checked' : '' }}>
                                        </div>
                                        <div>
                                            <span class="fw-bold d-block text-dark small mb-1">✨ AI Summarization</span>
                                            <span class="text-muted d-block" style="font-size: 0.75rem; line-height: 1.4;">Uses GPT to generate natural, human-like answers based on your data. Best for support.</span>
                                        </div>
                                    </label>
                                    
                                    <label class="d-flex align-items-start p-3 border rounded-4 cursor-pointer hover-shadow transition-all {{ ($chatbot->settings['response_mode'] ?? 'ai') == 'direct' ? 'bg-primary-soft border-primary' : 'bg-white' }}" onclick="selectRadioCard(this)">
                                        <div class="me-3 mt-1">
                                            <input type="radio" name="response_mode" value="direct" class="form-check-input" {{ ($chatbot->settings['response_mode'] ?? 'ai') == 'direct' ? 'checked' : '' }}>
                                        </div>
                                        <div>
                                            <span class="fw-bold d-block text-dark small mb-1">📄 Strict Matching</span>
                                            <span class="text-muted d-block" style="font-size: 0.75rem; line-height: 1.4;">Returns the exact text chunk from your documents. Best for legal or compliance.</span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- 5. Suggested Questions -->
                        <div class="card border-0 shadow-sm rounded-4 mb-4">
                             <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h6 class="fw-bold mb-0 text-truncate"><i class="bi bi-signpost-split me-2 text-warning"></i>Starters</h6>
                                    <div class="form-check form-switch">
                                        <label class="form-check-label small me-2" for="showSuggestedQuestions">Show</label>
                                        <input class="form-check-input" type="checkbox" role="switch" id="showSuggestedQuestions" name="show_suggested_questions" value="1" {{ ($chatbot->settings['show_suggested_questions'] ?? false) ? 'checked' : '' }}>
                                    </div>
                                </div>
                                <div class="p-3 bg-light rounded-4">
                                    <div id="suggested-questions-container">
                                        @php $suggestions = $chatbot->settings['suggested_questions'] ?? []; @endphp
                                        @foreach($suggestions as $index => $question)
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control border-0 bg-white shadow-sm" name="suggested_questions[]" value="{{ $question }}" placeholder="e.g. Pricing?" style="border-radius: 8px 0 0 8px; font-size: 0.85rem;">
                                                <button class="btn btn-white bg-white text-danger border-0 shadow-sm" type="button" onclick="this.closest('.input-group').remove()" style="border-radius: 0 8px 8px 0;"><i class="bi bi-trash"></i></button>
                                            </div>
                                        @endforeach
                                        @if(count($suggestions) == 0)
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control border-0 bg-white shadow-sm" name="suggested_questions[]" placeholder="e.g. How does this work?" style="border-radius: 8px 0 0 8px; font-size: 0.85rem;">
                                            </div>
                                        @endif
                                    </div>
                                    <button type="button" class="btn btn-sm btn-link text-decoration-none fw-bold mt-1 w-100 text-center text-primary" onclick="addSuggestedQuestion()">
                                        <i class="bi bi-plus-circle me-1"></i> Add Question
                                    </button>
                                </div>
                             </div>
                        </div>

                        <!-- 6. Danger Zone -->
                        <div class="card border border-danger border-opacity-10 shadow-none rounded-4 mb-4" style="background: #fff5f5;">
                            <div class="card-body p-4 d-flex align-items-center justify-content-between">
                                <div>
                                    <h6 class="fw-bold text-danger mb-1">Delete Chatbot</h6>
                                    <p class="small text-muted mb-0">Permanently remove details.</p>
                                </div>
                                <button type="button" class="btn btn-white text-danger border border-danger border-opacity-25 bg-white shadow-sm fw-bold btn-sm px-3" data-bs-toggle="modal" data-bs-target="#deleteChatbotModal">Delete</button>
                            </div>
                        </div>

                    </div>
                </div>
            </form>

            <script>
                function addSuggestedQuestion() {
                    const container = document.getElementById('suggested-questions-container');
                    if (container.children.length >= 4) {
                        alert('Max 4 suggested questions allowed.');
                        return;
                    }
                    const div = document.createElement('div');
                    div.className = 'input-group mb-2';
                    div.innerHTML = `
                        <input type="text" class="form-control border-0 bg-white shadow-sm" name="suggested_questions[]" placeholder="New Question" style="border-radius: 8px 0 0 8px; font-size: 0.85rem;">
                        <button class="btn btn-white bg-white text-danger border-0 shadow-sm" type="button" onclick="this.closest('.input-group').remove()" style="border-radius: 0 8px 8px 0;"><i class="bi bi-trash"></i></button>
                    `;
                    container.appendChild(div);
                }

                function setPrompt(type) {
                    const ta = document.querySelector('textarea[name="prompt_template"]');
                    if(type === 'Support') ta.value = "You are a friendly Customer Support Agent. Answer questions clearly and concisely based on the context provided. If you don't know the answer, politely ask the user to contact support@example.com.";
                    if(type === 'Sales') ta.value = "You are a persuasive Sales Representative. Highlight the benefits of our products. Be energetic and helpful. Try to close the deal by suggesting they sign up.";
                    if(type === 'Teacher') ta.value = "You are a patient Tutor. Explain concepts in simple terms. Use analogies where possible. Encourage specific questions.";
                }
                
                function selectRadioCard(element) {
                    // Visual selection logic if needed, though radio default handling combined with label click works
                    document.querySelectorAll('input[name="response_mode"]').forEach(el => {
                         el.closest('label').classList.remove('bg-primary-soft', 'border-primary');
                         el.closest('label').classList.add('bg-white');
                    });
                    element.classList.remove('bg-white');
                    element.classList.add('bg-primary-soft', 'border-primary');
                }
            </script>
            
            <style>
                .bg-primary-soft { background-color: #eef2ff; }
                .hover-shadow:hover { box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
                .transition-all { transition: all 0.2s ease; }
            </style>
        </div>
    </div>
</div>

<!-- MODALS -->

<!-- Text Paragraph Modal -->
<div class="modal fade" id="textInputModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-body p-4">
                <h5 class="fw-bold mb-3">Add Text Block</h5>
                <form id="textForm">
                    <div class="mb-3">
                        <label class="small fw-bold text-muted">TITLE/HEADING</label>
                        <input type="text" class="form-control bg-light border-0" name="title" placeholder="e.g. Refund Policy" required>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold text-muted">CONTENT PARAGRAPH</label>
                        <textarea class="form-control bg-light border-0" name="content" rows="6" placeholder="Paste your text content here..." required></textarea>
                    </div>
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary py-2 fw-bold" style="border-radius: 10px; background: var(--dash-primary); border:none;">Train AI with Text</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Q&A Modal -->
<div class="modal fade" id="qaInputModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-body p-4">
                <h5 class="fw-bold mb-3">Add Q&A Pairs</h5>
                <form id="qaForm">
                    <div id="qa-container">
                        <div class="qa-pair mb-3 p-3 bg-light rounded-4">
                            <div class="mb-2">
                                <label class="small fw-bold text-muted">QUESTION</label>
                                <input type="text" class="form-control border-0" name="qa_pairs[0][q]" placeholder="e.g. What is your return window?" required>
                            </div>
                            <div>
                                <label class="small fw-bold text-muted">ANSWER</label>
                                <textarea class="form-control border-0" name="qa_pairs[0][a]" rows="2" placeholder="e.g. We offer a 30-day return policy." required></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-link text-primary p-0 mb-3 fw-bold" onclick="addQAPair()">+ Add another pair</button>
                    <div class="d-grid mt-2">
                        <button type="submit" class="btn btn-primary py-2 fw-bold" style="border-radius: 10px; background: var(--dash-primary); border:none;">Train AI with Q&A</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Image Upload Modal -->
<div class="modal fade" id="imageUploadModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-body p-5 text-center">
                <i class="bi bi-image text-muted display-1 mb-3"></i>
                <h5 class="fw-bold">OCR Knowledge (Beta)</h5>
                <p class="text-muted small">Upload screenshots of docs or product images to extract knowledge.</p>
                <button class="btn btn-primary px-4 fw-bold" style="border-radius: 10px; background: var(--dash-primary); border:none;" onclick="document.getElementById('image-input').click()">Select Images</button>
                <input type="file" id="image-input" class="d-none" multiple accept="image/*">
            </div>
        </div>
    </div>
</div>

<!-- Crawl URL Modal -->
<div class="modal fade" id="crawlUrlModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-body p-4">
                <h5 class="fw-bold mb-3">Website Link</h5>
                <form id="crawlUrlForm">
                    <input type="url" class="form-control bg-light border-0 p-3 mb-3" name="url" placeholder="https://example.com" required style="border-radius: 10px;">
                    <button type="submit" class="btn btn-primary w-100 py-2 fw-bold" style="border-radius: 10px; background: var(--dash-primary); border:none;">Crawl and Ingest</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Sitemap Modal -->
<div class="modal fade" id="crawlSitemapModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-body p-4">
                <h5 class="fw-bold mb-3">Sitemap Ingestion</h5>
                <form id="crawlSitemapForm">
                    <input type="url" class="form-control bg-light border-0 p-3 mb-3" name="url" placeholder="https://example.com/sitemap.xml" required style="border-radius: 10px;">
                    <button type="submit" class="btn btn-primary w-100 py-2 fw-bold" style="border-radius: 10px; background: var(--dash-primary); border:none;">Process Full Site</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-body p-4 text-center">
                <h5 class="fw-bold">Delete Source?</h5>
                <p class="text-muted small">This will remove this knowledge block from the AI's training.</p>
                <form id="deleteForm" method="POST">
                    @csrf @method('DELETE')
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-danger py-2 fw-bold" style="border-radius: 10px;">Delete Permanently</button>
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Chatbot Modal -->
<div class="modal fade" id="deleteChatbotModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-body p-4 text-center">
                <div class="mb-3 text-danger"><i class="bi bi-exclamation-triangle-fill display-4"></i></div>
                <h5 class="fw-bold">Delete Chatbot?</h5>
                <p class="text-muted">This action cannot be undone. All trained knowledge and settings will be lost.</p>
                <div class="d-grid gap-2 mt-4">
                    <form action="{{ route('chatbots.destroy', $chatbot) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100 py-2 fw-bold" style="border-radius: 10px;">Yes, Delete Everything</button>
                    </form>
                    <button type="button" class="btn btn-light py-2 fw-bold" data-bs-toggle="modal" style="border-radius: 10px;" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- View Content Modal -->
<div class="modal fade" id="viewContentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-header border-0 pb-0">
                <h5 class="fw-bold mb-0" id="viewContentTitle">Source Content</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div id="filePreviewContainer" class="mb-3 d-none">
                    <!-- Preview will be injected here -->
                </div>
                <div id="textContentContainer">
                    <label class="small fw-bold text-muted mb-2">EXTRACTED KNOWLEDGE</label>
                    <div class="bg-light p-3 rounded-4" style="max-height: 400px; overflow-y: auto;">
                        <pre id="viewContentBody" style="white-space: pre-wrap; font-family: inherit; font-size: 0.9rem; margin-bottom: 0;"></pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let qaIndex = 1;
    function addQAPair() {
        const container = document.getElementById('qa-container');
        const div = document.createElement('div');
        div.className = 'qa-pair mb-3 p-3 bg-light rounded-4';
        div.innerHTML = `
            <div class="mb-2">
                <label class="small fw-bold text-muted">QUESTION</label>
                <input type="text" class="form-control border-0" name="qa_pairs[${qaIndex}][q]" placeholder="..." required>
            </div>
            <div>
                <label class="small fw-bold text-muted">ANSWER</label>
                <textarea class="form-control border-0" name="qa_pairs[${qaIndex}][a]" rows="2" placeholder="..." required></textarea>
            </div>
        `;
        container.appendChild(div);
        qaIndex++;
    }

    const handleFormSubmit = (formId, route, method = 'POST') => {
        const form = document.getElementById(formId);
        if(!form) return;
        form.onsubmit = (e) => {
            e.preventDefault();
            const btn = form.querySelector('button[type="submit"]');
            btn.disabled = true; btn.innerHTML = 'Training...';

            const formData = new FormData(form);
            formData.append('chatbot_id', '{{ $chatbot->id }}');
            formData.append('_token', '{{ csrf_token() }}');

            fetch(route, { method: method, body: formData, headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(res => res.json())
            .then(() => location.reload())
            .catch(() => { alert('Failed'); btn.disabled = false; btn.innerHTML = 'Try Again'; });
        };
    };

    // File Upload
    document.getElementById('file-input').onchange = (e) => {
        const formData = new FormData();
        formData.append('chatbot_id', '{{ $chatbot->id }}');
        formData.append('_token', '{{ csrf_token() }}');
        for(let f of e.target.files) formData.append('files[]', f);
        fetch('{{ route("knowledge.upload") }}', { method: 'POST', body: formData }).then(() => location.reload());
    };

    // Image Upload (OCR)
    const imageInput = document.getElementById('image-input');
    if (imageInput) {
        imageInput.onchange = (e) => {
            const formData = new FormData();
            formData.append('chatbot_id', '{{ $chatbot->id }}');
            formData.append('_token', '{{ csrf_token() }}');
            for(let f of e.target.files) formData.append('files[]', f);
            
            // Show loading state on the modal button
            const modalBtn = document.querySelector('#imageUploadModal button');
            modalBtn.disabled = true;
            modalBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Extracting Text...';
            
            fetch('{{ route("knowledge.upload") }}', { method: 'POST', body: formData })
            .then(() => location.reload())
            .catch(() => { alert('OCR Failed'); location.reload(); });
        };
    }

    handleFormSubmit('textForm', '{{ route("knowledge.storeText") }}');
    handleFormSubmit('qaForm', '{{ route("knowledge.storeQA") }}');

    // Appearance Form Submit
    const appearanceForm = document.getElementById('appearanceForm');
    if (appearanceForm) {
        appearanceForm.onsubmit = (e) => {
            e.preventDefault();
            const btn = appearanceForm.querySelector('button[type="submit"]');
            btn.disabled = true; btn.innerHTML = 'Saving...';
            
            const formData = new FormData(appearanceForm);
            formData.append('_method', 'PUT');
            formData.append('_token', '{{ csrf_token() }}');

            fetch('{{ route("chatbots.update", $chatbot) }}', {
                method: 'POST', // Use POST with _method PUT for file support
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(res => res.json())
            .then(() => location.reload())
            .catch(() => { alert('Failed'); btn.disabled = false; btn.innerHTML = 'Update Branding'; });
        };
    }
    
    // Original Crawl Logic
    const handleCrawl = (formId, isSitemap = false) => {
        const form = document.getElementById(formId);
        if(!form) return;
        form.onsubmit = (e) => {
            e.preventDefault();
            const btn = form.querySelector('button[type="submit"]');
            btn.disabled = true; btn.innerHTML = 'Crawling...';
            const formData = new FormData(form);
            formData.append('chatbot_id', '{{ $chatbot->id }}');
            formData.append('is_sitemap', isSitemap ? '1' : '0');
            formData.append('_token', '{{ csrf_token() }}');
            fetch('{{ route("knowledge.crawl") }}', { method: 'POST', body: formData }).then(() => location.reload());
        };
    };
    handleCrawl('crawlUrlForm', false);
    handleCrawl('crawlSitemapForm', true);

    const deleteModal = document.getElementById('deleteModal');
    if (deleteModal) {
        deleteModal.addEventListener('show.bs.modal', event => {
            document.getElementById('deleteForm').action = event.relatedTarget.getAttribute('data-action');
        });
    }

    const viewContentModal = document.getElementById('viewContentModal');
    if (viewContentModal) {
        viewContentModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const title = button.getAttribute('data-title');
            const type = button.getAttribute('data-type');
            const content = button.getAttribute('data-content');
            const fileUrl = button.getAttribute('data-url');

            document.getElementById('viewContentTitle').textContent = title;
            document.getElementById('viewContentBody').textContent = content || "No extracted content available yet.";
            
            const previewContainer = document.getElementById('filePreviewContainer');
            previewContainer.innerHTML = '';
            previewContainer.classList.add('d-none');

            if (type === 'file' && fileUrl) {
                previewContainer.classList.remove('d-none');
                const ext = fileUrl.split('.').pop().toLowerCase();
                
                if (['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(ext)) {
                    previewContainer.innerHTML = `<img src="${fileUrl}" class="img-fluid rounded-4 shadow-sm border" style="max-height: 300px; width: 100%; object-fit: contain;">`;
                } else if (ext === 'pdf') {
                    previewContainer.innerHTML = `<iframe src="${fileUrl}" style="width: 100%; height: 400px; border-radius: 12px; border:none;"></iframe>`;
                } else {
                    previewContainer.innerHTML = `<div class="p-3 bg-light rounded-4 text-center">
                        <i class="bi bi-file-earmark-arrow-down fs-1 text-primary d-block mb-2"></i>
                        <a href="${fileUrl}" target="_blank" class="btn btn-primary btn-sm fw-bold">Open Original File</a>
                    </div>`;
                }
            }
        });
    }

    function copyEmbedCode() {
        const text = document.getElementById('embed-code-text').innerText;
        navigator.clipboard.writeText(text).then(() => {
            alert('Embed code copied! You can now paste it into your website.');
        });
    }
</script>
@endsection
