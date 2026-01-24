@extends('layouts.dashboard')

@section('title', 'Knowledge Base')

@section('content')
<div class="container-fluid p-0">
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <!-- Header Section -->
            <div class="card border-0 shadow-sm mb-4 overflow-hidden" style="border-radius: 24px; background: linear-gradient(135deg, #6c5dd3 0%, #4f46e5 100%);">
                <div class="card-body p-5 text-white">
                    <div class="row align-items-center">
                        <div class="col-md-7">
                            <h1 class="fw-bold mb-3">Welcome to the Help Center</h1>
                            <p class="lead mb-0 opacity-75">Learn how to train your AI chatbot, integrate it into your apps, and capture more leads.</p>
                        </div>
                        <div class="col-md-5 text-end d-none d-md-block">
                            <i class="bi bi-patch-question display-1 opacity-25"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Navigation -->
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <a href="#data-feed" class="text-decoration-none">
                        <div class="card border-0 shadow-sm h-100 p-4 text-center rounded-4 hover-lift">
                            <i class="bi bi-database-fill-add text-primary display-5 mb-3"></i>
                            <h6 class="fw-bold text-dark">Training Data</h6>
                            <p class="text-muted small mb-0">Learn how to feed your bot with PDFs, URLs, and OCR.</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#embed-code" class="text-decoration-none">
                        <div class="card border-0 shadow-sm h-100 p-4 text-center rounded-4 hover-lift">
                            <i class="bi bi-code-slash text-success display-5 mb-3"></i>
                            <h6 class="fw-bold text-dark">Embed Code</h6>
                            <p class="text-muted small mb-0">How to add the chat bubble to your website.</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#mobile-apps" class="text-decoration-none">
                        <div class="card border-0 shadow-sm h-100 p-4 text-center rounded-4 hover-lift">
                            <i class="bi bi-phone-fill text-warning display-5 mb-3"></i>
                            <h6 class="fw-bold text-dark">App Integration</h6>
                            <p class="text-muted small mb-0">Using WebViews for Flutter and React Native.</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Detailed Content -->
            
            <!-- Section 1: Data Feeding -->
            <div id="data-feed" class="section-card mb-5">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h2 class="fw-bold mb-4">1. Adding Content (Data Feed)</h2>
                        <p class="text-muted">Our AI can learn from multiple sources to become an expert on your business. You can provide knowledge using:</p>
                        <ul class="list-unstyled">
                            <li class="mb-3 d-flex align-items-start">
                                <i class="bi bi-check-circle-fill text-success me-3 mt-1"></i>
                                <div>
                                    <strong>Document Uploads:</strong> Upload PDFs, Excel sheets, and Word documents. The AI parses the text and indexes it for searching.
                                </div>
                            </li>
                            <li class="mb-3 d-flex align-items-start">
                                <i class="bi bi-check-circle-fill text-success me-3 mt-1"></i>
                                <div>
                                    <strong>Website Crawling:</strong> Provide a URL or a Sitemap. Our bot will visit the pages and extract the content automatically.
                                </div>
                            </li>
                            <li class="mb-3 d-flex align-items-start">
                                <i class="bi bi-check-circle-fill text-success me-3 mt-1"></i>
                                <div>
                                    <strong>OCR Knowledge (Images):</strong> Upload screenshots of documents or product labels. Gemini AI will "read" the images and extract the text.
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6 text-center">
                        <img src="{{ asset('images/help/data-feed.png') }}" class="img-fluid rounded-4 shadow-lg border" alt="Data Feed Guide">
                    </div>
                </div>
            </div>

            <!-- Section 2: Embed Code -->
            <div id="embed-code" class="section-card mb-5 bg-white p-5 rounded-5 shadow-sm">
                <div class="row align-items-center flex-row-reverse">
                    <div class="col-lg-6">
                        <h2 class="fw-bold mb-4">2. Integration: The Embed Code</h2>
                        <p class="text-muted">To add the floating chatbot to your website, simply copy the **Embed Code** from your chatbot settings and paste it before the closing <code>&lt;/body&gt;</code> tag of your HTML.</p>
                        <p class="text-muted">The script will handle everything: creating the bubble, styling it based on your branding, and opening the chat interface when clicked.</p>
                        <div class="alert alert-info border-0 rounded-4 p-3 d-flex align-items-center">
                            <i class="bi bi-info-circle-fill me-3 fs-3"></i>
                            <div>
                                <strong>Pro Tip:</strong> You can change the colors and welcome message from the Dashboard instantly without changing the code on your site.
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <img src="{{ asset('images/help/embed.png') }}" class="img-fluid rounded-4 shadow-lg border" alt="Embed Guide">
                    </div>
                </div>
            </div>

            <!-- Section 3: Mobile & Applications -->
            <div id="mobile-apps" class="section-card mb-5">
                <h2 class="fw-bold mb-4 text-center">3. Mobile & External Applications</h2>
                <div class="row g-4 mt-2">
                    <div class="col-md-6">
                        <div class="bg-white p-4 rounded-4 shadow-sm border-top border-4 border-warning h-100">
                            <h5 class="fw-bold">Cross-Platform Apps</h5>
                            <p class="text-muted">For Flutter, React Native, or Ionic apps, use a <strong>WebView</strong> component. This allows you to embed the widget directly into your app's navigation flow.</p>
                            <code>WebView(initialUrl: 'your_widget_url')</code>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bg-white p-4 rounded-4 shadow-sm border-top border-4 border-primary h-100">
                            <h5 class="fw-bold">Direct Link</h5>
                            <p class="text-muted">You can also share the direct widget URL as a link in emails or social media. It works perfectly as a standalone chat page on any browser.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Help -->
            <div class="text-center py-5 border-top mt-5">
                <h4 class="fw-bold">Still have questions?</h4>
                <p class="text-muted">Our support team is here to help you get started.</p>
                <button class="btn btn-primary px-5 py-3 fw-bold rounded-pill shadow-lg" style="background: #6c5dd3; border:none;">Contact Support</button>
            </div>
        </div>
    </div>
</div>

<style>
    .section-card {
        padding: 40px;
    }
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-lift:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
    }
    code {
        background: #f1f5f9;
        padding: 4px 8px;
        border-radius: 6px;
        color: #e83e8c;
    }
</style>
@endsection
