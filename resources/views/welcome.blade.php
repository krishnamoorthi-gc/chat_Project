<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- SEO Meta Tags -->
    <title>AI Chatbot Builder | Create Smart Customer Support Bots in Minutes | ChatBotGPT</title>
    <meta name="description" content="Build intelligent AI chatbots powered by GPT technology. Automate customer support, capture leads, and boost conversions 24/7. No coding required. Free trial available.">
    <meta name="keywords" content="AI chatbot, chatbot builder, customer support automation, lead generation chatbot, GPT chatbot, conversational AI, chatbot platform, AI customer service, automated chat support, intelligent chatbot">
    <meta name="author" content="ChatBotGPT">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="AI Chatbot Builder | Create Smart Customer Support Bots">
    <meta property="og:description" content="Build intelligent AI chatbots powered by GPT technology. Automate customer support, capture leads, and boost conversions 24/7.">
    <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url('/') }}">
    <meta property="twitter:title" content="AI Chatbot Builder | Create Smart Customer Support Bots">
    <meta property="twitter:description" content="Build intelligent AI chatbots powered by GPT technology. Automate customer support, capture leads, and boost conversions 24/7.">
    <meta property="twitter:image" content="{{ asset('images/og-image.jpg') }}">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url('/') }}">
    
    <!-- Structured Data / Schema.org -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "SoftwareApplication",
        "name": "ChatBotGPT",
        "applicationCategory": "BusinessApplication",
        "offers": {
            "@type": "Offer",
            "price": "0",
            "priceCurrency": "USD"
        },
        "description": "AI-powered chatbot builder for customer support automation and lead generation",
        "operatingSystem": "Web-based",
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "4.8",
            "ratingCount": "2847"
        }
    }
    </script>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #818cf8;
            --secondary: #8b5cf6;
            --accent: #ec4899;
            --success: #10b981;
            --dark: #0f172a;
            --gray: #64748b;
            --light-bg: #f8fafc;
            --gradient-1: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-2: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --gradient-3: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --gradient-primary: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        }
        
        body {
            font-family: 'Inter', sans-serif;
            color: var(--dark);
            overflow-x: hidden;
            background: #ffffff;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
        }
        
        /* Navbar */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            padding: 1.2rem 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        
        .navbar.scrolled {
            padding: 0.8rem 0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }
        
        .navbar-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 1.5rem;
            font-weight: 800;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }
        
        .nav-links a {
            color: var(--gray);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .nav-links a:hover {
            color: var(--primary);
        }
        
        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            display: inline-block;
        }
        
        .btn-primary {
            background: var(--gradient-primary);
            color: white;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.4);
        }
        
        .btn-outline {
            border: 2px solid var(--primary);
            color: var(--primary);
            background: transparent;
        }
        
        .btn-outline:hover {
            background: var(--primary);
            color: white;
        }
        
        /* Hero Section */
        .hero {
            padding: 140px 2rem 100px;
            background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
            position: relative;
            overflow: hidden;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.1) 0%, transparent 70%);
            animation: float 20s infinite ease-in-out;
        }
        
        .hero::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(139, 92, 246, 0.08) 0%, transparent 70%);
            animation: float 15s infinite ease-in-out reverse;
        }
        
        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            50% { transform: translate(30px, 30px) rotate(5deg); }
        }
        
        .hero-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            position: relative;
            z-index: 1;
        }
        
        .hero-content h1 {
            font-size: 3.5rem;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            color: var(--dark);
        }
        
        .gradient-text {
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .hero-content p {
            font-size: 1.25rem;
            color: var(--gray);
            margin-bottom: 2rem;
            line-height: 1.8;
        }
        
        .hero-cta {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
        }
        
        .trust-badges {
            display: flex;
            gap: 2rem;
            align-items: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }
        
        .trust-badge {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        .trust-badge i {
            color: var(--success);
            font-size: 1.2rem;
        }
        
        /* Chatbot Demo */
        .chatbot-demo {
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            animation: slideInRight 1s ease-out;
        }
        
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .chatbot-header {
            background: var(--gradient-primary);
            padding: 1.5rem;
            color: white;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .chatbot-avatar {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
        
        .chatbot-info h4 {
            margin: 0;
            font-size: 1.1rem;
        }
        
        .chatbot-status {
            font-size: 0.85rem;
            opacity: 0.9;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .status-dot {
            width: 8px;
            height: 8px;
            background: #10b981;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        
        .chatbot-messages {
            padding: 2rem;
            min-height: 350px;
            background: #f8fafc;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        
        .message {
            display: flex;
            gap: 0.75rem;
            animation: fadeInUp 0.5s ease-out;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .message.user {
            flex-direction: row-reverse;
        }
        
        .message-avatar {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        
        .message.bot .message-avatar {
            background: var(--gradient-primary);
            color: white;
        }
        
        .message.user .message-avatar {
            background: #e2e8f0;
            color: var(--dark);
        }
        
        .message-content {
            background: white;
            padding: 1rem 1.25rem;
            border-radius: 16px;
            max-width: 75%;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }
        
        .message.user .message-content {
            background: var(--gradient-primary);
            color: white;
        }
        
        .typing-indicator {
            display: flex;
            gap: 0.3rem;
            padding: 1rem;
        }
        
        .typing-dot {
            width: 8px;
            height: 8px;
            background: var(--gray);
            border-radius: 50%;
            animation: typing 1.4s infinite;
        }
        
        .typing-dot:nth-child(2) { animation-delay: 0.2s; }
        .typing-dot:nth-child(3) { animation-delay: 0.4s; }
        
        @keyframes typing {
            0%, 60%, 100% { transform: translateY(0); }
            30% { transform: translateY(-10px); }
        }
        
        /* Workflow Section */
        .workflow {
            padding: 100px 2rem;
            background: white;
        }
        
        .section-header {
            text-align: center;
            max-width: 700px;
            margin: 0 auto 4rem;
        }
        
        .section-badge {
            display: inline-block;
            padding: 0.5rem 1rem;
            background: rgba(99, 102, 241, 0.1);
            color: var(--primary);
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }
        
        .section-header h2 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        
        .section-header p {
            font-size: 1.1rem;
            color: var(--gray);
        }
        
        .workflow-steps {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
            position: relative;
        }
        
        .workflow-step {
            text-align: center;
            position: relative;
        }
        
        .step-icon {
            width: 100px;
            height: 100px;
            margin: 0 auto 1.5rem;
            background: var(--gradient-primary);
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: white;
            box-shadow: 0 10px 30px rgba(99, 102, 241, 0.3);
            transition: transform 0.3s ease;
        }
        
        .workflow-step:hover .step-icon {
            transform: translateY(-10px) scale(1.05);
        }
        
        .step-number {
            position: absolute;
            top: -10px;
            right: -10px;
            width: 32px;
            height: 32px;
            background: var(--accent);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.9rem;
            box-shadow: 0 4px 12px rgba(236, 72, 153, 0.4);
        }
        
        .workflow-step h3 {
            font-size: 1.3rem;
            margin-bottom: 0.75rem;
        }
        
        .workflow-step p {
            color: var(--gray);
            line-height: 1.6;
        }
        
        /* Features Section */
        .features {
            padding: 100px 2rem;
            background: var(--light-bg);
        }
        
        .features-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }
        
        .feature-card {
            background: white;
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1);
        }
        
        .feature-icon {
            width: 60px;
            height: 60px;
            background: var(--gradient-primary);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: white;
            margin-bottom: 1.5rem;
        }
        
        .feature-card h3 {
            font-size: 1.4rem;
            margin-bottom: 1rem;
        }
        
        .feature-card p {
            color: var(--gray);
            line-height: 1.7;
        }
        
        /* Stats Section */
        .stats {
            padding: 80px 2rem;
            background: var(--gradient-primary);
            color: white;
        }
        
        .stats-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 3rem;
            text-align: center;
        }
        
        .stat-item h3 {
            font-size: 3rem;
            margin-bottom: 0.5rem;
        }
        
        .stat-item p {
            font-size: 1.1rem;
            opacity: 0.9;
        }
        
        /* CTA Section */
        .cta {
            padding: 100px 2rem;
            background: white;
            text-align: center;
        }
        
        .cta-container {
            max-width: 800px;
            margin: 0 auto;
            background: var(--gradient-primary);
            padding: 4rem 3rem;
            border-radius: 30px;
            color: white;
            box-shadow: 0 20px 60px rgba(99, 102, 241, 0.3);
        }
        
        .cta-container h2 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        
        .cta-container p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            opacity: 0.95;
        }
        
        .btn-white {
            background: white;
            color: var(--primary);
            padding: 1rem 2.5rem;
            font-size: 1.1rem;
        }
        
        .btn-white:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(255, 255, 255, 0.3);
        }
        
        /* Footer */
        .footer {
            padding: 3rem 2rem;
            background: var(--dark);
            color: white;
            text-align: center;
        }
        
        .footer p {
            margin: 0;
            opacity: 0.8;
        }
        
        /* Responsive */
        @media (max-width: 968px) {
            .hero-container {
                grid-template-columns: 1fr;
                gap: 3rem;
            }
            
            .hero-content h1 {
                font-size: 2.5rem;
            }
            
            .workflow-steps {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .features-grid {
                grid-template-columns: 1fr;
            }
            
            .stats-container {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .nav-links {
                display: none;
            }
        }
        
        @media (max-width: 640px) {
            .hero-content h1 {
                font-size: 2rem;
            }
            
            .hero-cta {
                flex-direction: column;
            }
            
            .workflow-steps {
                grid-template-columns: 1fr;
            }
            
            .stats-container {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar" id="navbar">
        <div class="navbar-container">
            <div class="logo">🤖 ChatBotGPT</div>
            <div class="nav-links">
                <a href="#features">Features</a>
                <a href="#workflow">How It Works</a>
                <a href="#pricing">Pricing</a>
                @if(Auth::check())
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Get Started Free</a>
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-container">
            <div class="hero-content">
                <h1>
                    Build <span class="gradient-text">AI-Powered Chatbots</span> That Convert Visitors Into Customers
                </h1>
                <p>
                    Create intelligent chatbots in minutes with GPT technology. Automate customer support, capture qualified leads, and boost sales 24/7 without writing a single line of code.
                </p>
                <div class="hero-cta">
                    <a href="{{ route('register') }}" class="btn btn-primary">
                        <i class="bi bi-rocket-takeoff"></i> Start Free Trial
                    </a>
                    <a href="#workflow" class="btn btn-outline">
                        <i class="bi bi-play-circle"></i> See How It Works
                    </a>
                </div>
                <div class="trust-badges">
                    <div class="trust-badge">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>No credit card required</span>
                    </div>
                    <div class="trust-badge">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>Setup in 5 minutes</span>
                    </div>
                    <div class="trust-badge">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>Cancel anytime</span>
                    </div>
                </div>
            </div>
            
            <div class="chatbot-demo">
                <div class="chatbot-header">
                    <div class="chatbot-avatar">
                        <i class="bi bi-robot"></i>
                    </div>
                    <div class="chatbot-info">
                        <h4>Support Assistant</h4>
                        <div class="chatbot-status">
                            <span class="status-dot"></span>
                            <span>Online & Ready</span>
                        </div>
                    </div>
                </div>
                <div class="chatbot-messages">
                    <div class="message bot">
                        <div class="message-avatar">
                            <i class="bi bi-robot"></i>
                        </div>
                        <div class="message-content">
                            👋 Hi! I'm your AI assistant. How can I help you today?
                        </div>
                    </div>
                    <div class="message user">
                        <div class="message-avatar">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <div class="message-content">
                            What are your pricing plans?
                        </div>
                    </div>
                    <div class="message bot">
                        <div class="message-avatar">
                            <i class="bi bi-robot"></i>
                        </div>
                        <div class="message-content">
                            We offer flexible pricing starting at $29/month. Our plans include unlimited conversations, lead capture, and 24/7 support. Would you like to see a detailed comparison?
                        </div>
                    </div>
                    <div class="message user">
                        <div class="message-avatar">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <div class="message-content">
                            Yes, please!
                        </div>
                    </div>
                    <div class="message bot">
                        <div class="message-avatar">
                            <i class="bi bi-robot"></i>
                        </div>
                        <div class="message-content">
                            <div class="typing-indicator">
                                <div class="typing-dot"></div>
                                <div class="typing-dot"></div>
                                <div class="typing-dot"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Workflow Section -->
    <section class="workflow" id="workflow">
        <div class="section-header">
            <span class="section-badge">🚀 Simple Process</span>
            <h2>Launch Your AI Chatbot in 4 Easy Steps</h2>
            <p>No technical skills required. Get your intelligent chatbot up and running in minutes, not weeks.</p>
        </div>
        
        <div class="workflow-steps">
            <div class="workflow-step">
                <div class="step-icon">
                    <span class="step-number">1</span>
                    <i class="bi bi-file-earmark-text"></i>
                </div>
                <h3>Upload Your Data</h3>
                <p>Import documents, FAQs, website content, or paste text. Support for PDF, DOCX, URLs, and more.</p>
            </div>
            
            <div class="workflow-step">
                <div class="step-icon">
                    <span class="step-number">2</span>
                    <i class="bi bi-cpu"></i>
                </div>
                <h3>AI Training</h3>
                <p>Our GPT-powered system automatically learns from your content and creates intelligent responses.</p>
            </div>
            
            <div class="workflow-step">
                <div class="step-icon">
                    <span class="step-number">3</span>
                    <i class="bi bi-palette"></i>
                </div>
                <h3>Customize Design</h3>
                <p>Match your brand with custom colors, logos, and welcome messages. Make it uniquely yours.</p>
            </div>
            
            <div class="workflow-step">
                <div class="step-icon">
                    <span class="step-number">4</span>
                    <i class="bi bi-rocket-takeoff"></i>
                </div>
                <h3>Deploy & Scale</h3>
                <p>Embed on your website with one line of code. Works on any platform - WordPress, Shopify, React, and more.</p>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <div class="section-header">
            <span class="section-badge">✨ Powerful Features</span>
            <h2>Everything You Need to Succeed</h2>
            <p>Advanced AI capabilities designed to transform your customer experience</p>
        </div>
        
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="bi bi-lightning-charge"></i>
                </div>
                <h3>GPT-4 Powered</h3>
                <p>Leverage the latest AI technology for human-like conversations that understand context and intent.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="bi bi-people"></i>
                </div>
                <h3>Lead Generation</h3>
                <p>Automatically capture visitor information, qualify leads, and sync with your CRM for instant follow-up.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="bi bi-globe"></i>
                </div>
                <h3>Multi-Language</h3>
                <p>Communicate with customers worldwide. Support for 50+ languages with automatic translation.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="bi bi-graph-up"></i>
                </div>
                <h3>Analytics Dashboard</h3>
                <p>Track conversations, measure performance, and gain insights to optimize your chatbot strategy.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="bi bi-shield-check"></i>
                </div>
                <h3>Enterprise Security</h3>
                <p>Bank-level encryption, GDPR compliant, and SOC 2 certified to protect your data and privacy.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="bi bi-puzzle"></i>
                </div>
                <h3>Easy Integration</h3>
                <p>Seamlessly connect with popular tools like Slack, Zapier, HubSpot, Salesforce, and more.</p>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="stats-container">
            <div class="stat-item">
                <h3>10M+</h3>
                <p>Conversations Handled</p>
            </div>
            <div class="stat-item">
                <h3>50K+</h3>
                <p>Active Chatbots</p>
            </div>
            <div class="stat-item">
                <h3>98%</h3>
                <p>Customer Satisfaction</p>
            </div>
            <div class="stat-item">
                <h3>24/7</h3>
                <p>Support Available</p>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="cta-container">
            <h2>Ready to Transform Your Customer Experience?</h2>
            <p>Join thousands of businesses using AI chatbots to automate support and boost conversions</p>
            <a href="{{ route('register') }}" class="btn btn-white">
                <i class="bi bi-rocket-takeoff"></i> Start Your Free Trial Now
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; {{ date('Y') }} ChatBotGPT. All rights reserved. Built with ❤️ for better customer experiences.</p>
    </footer>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Animate elements on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.workflow-step, .feature-card').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'all 0.6s ease-out';
            observer.observe(el);
        });
    </script>
</body>
</html>
