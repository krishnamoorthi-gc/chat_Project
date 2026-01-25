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
        "@@context": "https://schema.org",
        "@@type": "SoftwareApplication",
        "name": "ChatBotGPT",
        "applicationCategory": "BusinessApplication",
        "offers": {
            "@@type": "Offer",
            "price": "0",
            "priceCurrency": "USD"
        },
        "description": "AI-powered chatbot builder for customer support automation and lead generation",
        "operatingSystem": "Web-based",
        "aggregateRating": {
            "@@type": "AggregateRating",
            "ratingValue": "4.8",
            "ratingCount": "2847"
        }
    }
    </script>
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "FAQPage",
      "mainEntity": [{
        "@@type": "Question",
        "name": "What is an AI chatbot and how does it work?",
        "acceptedAnswer": {
          "@@type": "Answer",
          "text": "An AI chatbot is a software application designed to simulate human conversation using artificial intelligence. It works by processing user input through NLP (Natural Language Processing) models like GPT-4 to understand intent and provide accurate, human-like responses based on the training data you provide."
        }
      }, {
        "@@type": "Question",
        "name": "How do I train the chatbot on my own data?",
        "acceptedAnswer": {
          "@@type": "Answer",
          "text": "Training is simple. You can upload PDF documents, DOCX files, paste text, or simply provide your website URL. Our system will crawl the content and build a knowledge base for your AI assistant in minutes."
        }
      }, {
        "@@type": "Question",
        "name": "Which platforms can I embed ChatBotGPT on?",
        "acceptedAnswer": {
          "@@type": "Answer",
          "text": "You can embed ChatBotGPT on any website using a simple one-line JavaScript snippet. It works seamlessly with WordPress, Shopify, Wix, Squarespace, React, Vue, and custom HTML sites."
        }
      }, {
        "@@type": "Question",
        "name": "Does ChatBotGPT support multiple languages?",
        "acceptedAnswer": {
          "@@type": "Answer",
          "text": "Yes, ChatBotGPT supports over 50 languages. It can automatically detect the user's language and respond accordingly, making it perfect for global businesses."
        }
      }, {
        "@@type": "Question",
        "name": "Is there a free trial available?",
        "acceptedAnswer": {
          "@@type": "Answer",
          "text": "Yes! We offer a 15-day risk-free trial on all our plans (Starter, Pro, and Enterprise). No credit card is required to start your trial."
        }
      }]
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
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --primary-light: #6366f1;
            --secondary: #7c3aed;
            --accent: #db2777;
            --success: #059669;
            --dark: #1e1b4b; /* Deeper midnight blue */
            --gray: #475569; /* Richer gray */
            --light-bg: #f8fafc;
            --gradient-primary: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            --gradient-accent: linear-gradient(135deg, #db2777 0%, #7c3aed 100%);
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
            font-size: 1.6rem;
            font-weight: 800;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            letter-spacing: -0.5px;
            z-index: 1001;
        }

        .mobile-toggle {
            display: none;
            font-size: 1.8rem;
            color: var(--dark);
            cursor: pointer;
            z-index: 1001;
        }

        .logo i {
            -webkit-text-fill-color: initial;
            background: var(--gradient-primary);
            color: white;
            padding: 6px;
            border-radius: 10px;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
        }
        
        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }
        
        .nav-links a {
            color: var(--dark);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            opacity: 0.8;
            font-size: 0.95rem;
        }
        
        .nav-links a:hover {
            color: var(--primary);
            opacity: 1;
            transform: translateY(-1px);
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
            box-shadow: 0 10px 20px rgba(79, 70, 229, 0.25);
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(79, 70, 229, 0.4);
        }
        
        .btn-outline {
            border: 2px solid var(--primary);
            color: var(--primary);
            background: transparent;
            font-weight: 700;
        }
        
        .btn-outline:hover {
            background: var(--primary);
            color: white;
            box-shadow: 0 10px 20px rgba(79, 70, 229, 0.15);
        }
        
        /* Hero Section */
        .hero {
            padding: 160px 2rem 100px;
            background: radial-gradient(circle at top right, #f8fafc 0%, #ffffff 100%);
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
            background: radial-gradient(circle, rgba(79, 70, 229, 0.1) 0%, transparent 70%);
            animation: float 20s infinite ease-in-out;
        }
        
        .hero::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(124, 58, 237, 0.08) 0%, transparent 70%);
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
            font-size: 4rem;
            line-height: 1.1;
            margin-bottom: 2rem;
            color: var(--dark);
            letter-spacing: -1px;
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
            margin-bottom: 2.5rem;
            line-height: 1.7;
            font-weight: 500;
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
            padding: 110px 2rem;
            background: radial-gradient(circle at center, #ffffff 0%, #f1f5f9 100%);
            position: relative;
        }

        .features::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(79, 70, 229, 0.1), transparent);
        }
        
        .features-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2.5rem;
        }
        
        .feature-card {
            background: white;
            padding: 3rem 2.5rem;
            border-radius: 24px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(0, 0, 0, 0.05);
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
        }
        
        .feature-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 20px 40px -5px rgba(0, 0, 0, 0.1), 0 10px 20px -5px rgba(0, 0, 0, 0.04);
            border-color: rgba(79, 70, 229, 0.2);
        }

        .feature-card::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 24px;
            background: var(--gradient-primary);
            opacity: 0;
            z-index: -1;
            transition: opacity 0.4s ease;
            filter: blur(20px);
        }

        .feature-card:hover::after {
            opacity: 0.05;
        }
        
        .feature-icon {
            width: 64px;
            height: 64px;
            background: var(--gradient-primary);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            margin-bottom: 2rem;
            box-shadow: 0 8px 16px rgba(79, 70, 229, 0.2);
            transition: all 0.3s ease;
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 12px 24px rgba(79, 70, 229, 0.3);
        }
        
        .feature-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1.25rem;
            color: var(--dark);
            letter-spacing: -0.5px;
        }
        
        .feature-card p {
            color: var(--gray);
            line-height: 1.7;
            font-size: 1rem;
            margin-bottom: 1.5rem;
            flex-grow: 1;
        }

        .feature-link {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--primary);
            font-weight: 700;
            text-decoration: none;
            font-size: 0.95rem;
            transition: gap 0.3s ease;
        }

        .feature-card:hover .feature-link {
            gap: 0.8rem;
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

        /* Pricing Section */
        .pricing {
            padding: 100px 2rem;
            background: white;
        }

        .pricing-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2.5rem;
        }

        .pricing-card {
            background: white;
            padding: 3rem 2rem;
            border-radius: 30px;
            border: 1px solid rgba(0, 0, 0, 0.05);
            text-align: center;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .pricing-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.1);
            border-color: var(--primary-light);
        }

        .pricing-card.popular {
            background: var(--dark);
            color: white;
            transform: scale(1.05);
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.2);
            border: none;
        }

        .pricing-card.popular:hover {
            transform: scale(1.05) translateY(-10px);
        }

        .popular-badge {
            position: absolute;
            top: 20px;
            right: -35px;
            background: var(--gradient-accent);
            color: white;
            padding: 8px 40px;
            transform: rotate(45deg);
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .plan-name {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .plan-price {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.25rem;
        }

        .plan-price span {
            font-size: 1.5rem;
            font-weight: 600;
            opacity: 0.8;
        }

        .trial-badge {
            display: inline-block;
            padding: 0.4rem 1rem;
            background: rgba(79, 70, 229, 0.1);
            color: var(--primary);
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 2rem;
        }

        .popular .trial-badge {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .plan-features {
            list-style: none;
            margin-bottom: 2.5rem;
            text-align: left;
            flex-grow: 1;
        }

        .plan-features li {
            padding: 0.75rem 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.95rem;
            opacity: 0.9;
        }

        .plan-features li i {
            color: var(--success);
            font-size: 1.1rem;
        }

        .popular .plan-features li i {
            color: #34d399;
        }

        /* Testimonials Section */
        .testimonials {
            padding: 100px 2rem;
            background: var(--light-bg);
            position: relative;
        }

        .testimonials-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }

        .testimonial-card {
            background: white;
            padding: 2.5rem;
            border-radius: 24px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
        }

        .testimonial-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.06);
        }

        .quote-icon {
            font-size: 2rem;
            color: var(--primary-light);
            margin-bottom: 1.5rem;
            opacity: 0.5;
        }

        .testimonial-content {
            font-size: 1.05rem;
            line-height: 1.7;
            color: var(--gray);
            margin-bottom: 2rem;
            font-style: italic;
        }

        .testimonial-user {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .user-info h4 {
            font-size: 1rem;
            margin-bottom: 0.1rem;
        }

        .user-info span {
            font-size: 0.85rem;
            color: var(--gray);
        }

        /* FAQ Section */
        .faq {
            padding: 100px 2rem;
            background: white;
        }

        .faq-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .faq-item {
            margin-bottom: 1rem;
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .faq-item:hover {
            border-color: var(--primary-light);
            box-shadow: 0 4px 20px rgba(79, 70, 229, 0.05);
        }

        .faq-question {
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            font-weight: 600;
            color: var(--dark);
            background: white;
            user-select: none;
        }

        .faq-answer {
            padding: 0 2rem;
            max-height: 0;
            overflow: hidden;
            transition: all 0.3s ease;
            color: var(--gray);
            line-height: 1.7;
        }

        .faq-item.active {
            border-color: var(--primary);
            box-shadow: 0 10px 30px rgba(79, 70, 229, 0.08);
        }

        .faq-item.active .faq-answer {
            padding: 0 2rem 1.5rem;
            max-height: 200px;
        }

        .faq-icon {
            transition: transform 0.3s ease;
            color: var(--primary);
        }

        .faq-item.active .faq-icon {
            transform: rotate(180deg);
        }

        /* Capabilities Section */
        .capabilities {
            padding: 100px 2rem;
            background: #ffffff;
            text-align: center;
        }

        .capabilities-grid {
            max-width: 1100px;
            margin: 4rem auto 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1.25rem;
        }

        .capability-pill {
            background: white;
            padding: 1rem 1.75rem;
            border-radius: 100px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0,0,0,0.06);
            display: flex;
            align-items: center;
            gap: 0.8rem;
            font-weight: 600;
            color: var(--dark);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: default;
        }

        .capability-pill:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(79, 70, 229, 0.12);
            border-color: var(--primary-light);
            color: var(--primary);
        }

        .capability-pill i {
            font-size: 1.2rem;
            color: var(--primary);
            background: rgba(79, 70, 229, 0.08);
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
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
            padding: 5rem 2rem 2rem;
            background: #0a0a1f; /* Deeper dark for footer */
            color: white;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1.5fr;
            gap: 4rem;
            margin-bottom: 4rem;
        }

        .footer-col h4 {
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
            font-weight: 700;
            color: white;
            position: relative;
            padding-bottom: 0.5rem;
        }

        .footer-col h4::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 30px;
            height: 2px;
            background: var(--primary);
        }

        .footer-col p {
            color: rgba(255, 255, 255, 0.6);
            line-height: 1.6;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 0.8rem;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .footer-links a:hover {
            color: var(--primary-light);
            padding-left: 5px;
        }

        .social-links {
            display: flex;
            gap: 1rem;
        }

        .social-links a {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 1.2rem;
        }

        .social-links a:hover {
            background: var(--primary);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(79, 70, 229, 0.3);
        }

        .footer-bottom {
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .footer-bottom p {
            color: rgba(255, 255, 255, 0.4);
            font-size: 0.9rem;
        }

        .footer-legal {
            display: flex;
            gap: 2rem;
        }

        .footer-legal a {
            color: rgba(255, 255, 255, 0.4);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .footer-legal a:hover {
            color: white;
        }

        .newsletter-form {
            display: flex;
            gap: 0.5rem;
        }

        .newsletter-input {
            flex-grow: 1;
            padding: 0.8rem 1rem;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(255, 255, 255, 0.05);
            color: white;
            font-size: 0.9rem;
        }

        .newsletter-btn {
            padding: 0.8rem;
            border-radius: 10px;
            background: var(--primary);
            color: white;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .newsletter-btn:hover {
            background: var(--primary-dark);
        }
        
        /* Responsive */
        @media (max-width: 968px) {
            .navbar-container {
                padding: 0 1.5rem;
            }

            .mobile-toggle {
                display: block;
            }

            .nav-links {
                position: fixed;
                top: 0;
                right: -100%;
                width: 80%;
                height: 100vh;
                background: white;
                flex-direction: column;
                justify-content: center;
                gap: 2rem;
                padding: 2rem;
                transition: all 0.4s ease;
                box-shadow: -10px 0 30px rgba(0,0,0,0.1);
                display: flex; /* Overriding display: none */
                z-index: 1000;
            }

            .nav-links.active {
                right: 0;
            }

            .hero {
                padding: 120px 1.5rem 60px;
            }

            .hero-container {
                grid-template-columns: 1fr;
                gap: 3rem;
                text-align: center;
            }

            .hero-content h1 {
                font-size: 2.8rem;
            }

            .hero-cta {
                justify-content: center;
            }

            .trust-badges {
                justify-content: center;
                flex-wrap: wrap;
            }
            
            .workflow-steps {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .features-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .pricing-grid {
                grid-template-columns: 1fr;
                max-width: 500px;
            }

            .pricing-card.popular {
                transform: scale(1);
            }

            .testimonials-grid {
                grid-template-columns: 1fr;
                max-width: 600px;
            }
            
            .stats-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 640px) {
            .section-header h2 {
                font-size: 2rem;
            }

            .hero-content h1 {
                font-size: 2.2rem;
            }
            
            .hero-cta {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                text-align: center;
            }
            
            .workflow-steps {
                grid-template-columns: 1fr;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }
            
            .stats-container {
                grid-template-columns: 1fr;
                gap: 2.5rem;
            }

            .footer-grid {
                grid-template-columns: 1fr;
                gap: 3rem;
                text-align: center;
            }

            .footer-col h4::after {
                left: 50%;
                transform: translateX(-50%);
            }

            .social-links {
                justify-content: center;
            }

            .footer-bottom {
                flex-direction: column;
                text-align: center;
            }

            .footer-legal {
                justify-content: center;
                flex-wrap: wrap;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar" id="navbar">
        <div class="navbar-container">
            <a href="{{ url('/') }}" class="logo">
                <i class="bi bi-robot"></i>
                <span>ChatBotGPT</span>
            </a>
            <div class="nav-links" id="navLinks">
                <a href="#features">Features</a>
                <a href="#workflow">How It Works</a>
                <a href="#pricing">Pricing</a>
                @if (Auth::check())
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Get Started Free</a>
                @endif
            </div>
            <div class="mobile-toggle" id="mobileToggle">
                <i class="bi bi-list"></i>
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
                <a href="#" class="feature-link">Learn more <i class="bi bi-arrow-right"></i></a>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="bi bi-people"></i>
                </div>
                <h3>Lead Generation</h3>
                <p>Automatically capture visitor information, qualify leads, and sync with your CRM for instant follow-up.</p>
                <a href="#" class="feature-link">Explore leads <i class="bi bi-arrow-right"></i></a>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="bi bi-globe"></i>
                </div>
                <h3>Multi-Language</h3>
                <p>Communicate with customers worldwide. Support for 50+ languages with automatic translation.</p>
                <a href="#" class="feature-link">View languages <i class="bi bi-arrow-right"></i></a>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="bi bi-graph-up"></i>
                </div>
                <h3>Analytics Dashboard</h3>
                <p>Track conversations, measure performance, and gain insights to optimize your chatbot strategy.</p>
                <a href="#" class="feature-link">See analytics <i class="bi bi-arrow-right"></i></a>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="bi bi-shield-check"></i>
                </div>
                <h3>Enterprise Security</h3>
                <p>Bank-level encryption, GDPR compliant, and SOC 2 certified to protect your data and privacy.</p>
                <a href="#" class="feature-link">Review security <i class="bi bi-arrow-right"></i></a>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="bi bi-puzzle"></i>
                </div>
                <h3>Easy Integration</h3>
                <p>Seamlessly connect with popular tools like Slack, Zapier, HubSpot, Salesforce, and more.</p>
                <a href="#" class="feature-link">Integrate now <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
    </section>
    <!-- Capabilities Section -->
    <section class="capabilities" id="capabilities">
        <div class="section-header">
            <span class="section-badge">🛠️ All-in-One Solution</span>
            <h2>Everything You Need to Roll Out Your Own AI Chatbot</h2>
            <p>ChatBotGPT is a production-ready support solution that does the work of a full support staff but at a fraction of the cost.</p>
        </div>

        <div class="capabilities-grid">
            <div class="capability-pill">
                <i class="bi bi-cloud-arrow-up"></i>
                <span>Import Training Content</span>
            </div>
            <div class="capability-pill">
                <i class="bi bi-question-circle"></i>
                <span>Q&A Training</span>
            </div>
            <div class="capability-pill">
                <i class="bi bi-stars"></i>
                <span>GPT-4.1-mini & GPT-4.1</span>
            </div>
            <div class="capability-pill">
                <i class="bi bi-link-45deg"></i>
                <span>Embed on Sites</span>
            </div>
            <div class="capability-pill">
                <i class="bi bi-palette"></i>
                <span>Customize Appearance</span>
            </div>
            <div class="capability-pill">
                <i class="bi bi-lightning-fill"></i>
                <span>Quick Prompts</span>
            </div>
            <div class="capability-pill">
                <i class="bi bi-clock-history"></i>
                <span>Chat History</span>
            </div>
            <div class="capability-pill">
                <i class="bi bi-person-badge"></i>
                <span>Escalate to a Human</span>
            </div>
            <div class="capability-pill">
                <i class="bi bi-translate"></i>
                <span>Language Support</span>
            </div>
            <div class="capability-pill">
                <i class="bi bi-person-plus"></i>
                <span>Lead Generation</span>
            </div>
            <div class="capability-pill">
                <i class="bi bi-layers"></i>
                <span>Functions</span>
            </div>
            <div class="capability-pill">
                <i class="bi bi-envelope-paper"></i>
                <span>Email Summaries</span>
            </div>
            <div class="capability-pill">
                <i class="bi bi-code-slash"></i>
                <span>API</span>
            </div>
            <div class="capability-pill">
                <i class="bi bi-grid-fill"></i>
                <span>Integrations</span>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="pricing" id="pricing">
        <div class="section-header">
            <span class="section-badge">💰 Flexible Plans</span>
            <h2>Simple, Transparent Pricing</h2>
            <p>Choose the perfect plan for your business needs. All plans include a 15-day risk-free trial.</p>
        </div>

        <div class="pricing-grid">
            <!-- Starter Plan -->
            <div class="pricing-card">
                <div class="plan-name">Starter</div>
                <div class="trial-badge">15 Days Free Trial</div>
                <div class="plan-price"><span>$</span>10</div>
                <p style="color: var(--gray); margin-bottom: 2rem;">Per month, billed monthly</p>
                
                <ul class="plan-features">
                    <li><i class="bi bi-check-circle-fill"></i> 1,000 Messages/mo</li>
                    <li><i class="bi bi-check-circle-fill"></i> 1 Custom Chatbot</li>
                    <li><i class="bi bi-check-circle-fill"></i> Basic AI Training</li>
                    <li><i class="bi bi-check-circle-fill"></i> Web Widget Embed</li>
                    <li><i class="bi bi-check-circle-fill"></i> Email Support</li>
                </ul>
                
                <a href="{{ route('register') }}" class="btn btn-outline">Get Started</a>
            </div>

            <!-- Pro Plan -->
            <div class="pricing-card popular">
                <div class="popular-badge">Most Popular</div>
                <div class="plan-name">Pro</div>
                <div class="trial-badge">15 Days Free Trial</div>
                <div class="plan-price"><span>$</span>30</div>
                <p style="color: rgba(255,255,255,0.6); margin-bottom: 2rem;">Per month, billed monthly</p>
                
                <ul class="plan-features">
                    <li><i class="bi bi-check-circle-fill"></i> 10,000 Messages/mo</li>
                    <li><i class="bi bi-check-circle-fill"></i> 5 Custom Chatbots</li>
                    <li><i class="bi bi-check-circle-fill"></i> Advanced GPT-4 Training</li>
                    <li><i class="bi bi-check-circle-fill"></i> Lead Generation Forms</li>
                    <li><i class="bi bi-check-circle-fill"></i> Priority Support</li>
                    <li><i class="bi bi-check-circle-fill"></i> CRM Integrations</li>
                </ul>
                
                <a href="{{ route('register') }}" class="btn btn-primary">Start Pro Trial</a>
            </div>

            <!-- Enterprise Plan -->
            <div class="pricing-card">
                <div class="plan-name">Enterprise</div>
                <div class="trial-badge">15 Days Free Trial</div>
                <div class="plan-price"><span>$</span>99</div>
                <p style="color: var(--gray); margin-bottom: 2rem;">Per month, billed monthly</p>
                
                <ul class="plan-features">
                    <li><i class="bi bi-check-circle-fill"></i> Unlimited Messages</li>
                    <li><i class="bi bi-check-circle-fill"></i> Unlimited Chatbots</li>
                    <li><i class="bi bi-check-circle-fill"></i> Custom AI Models</li>
                    <li><i class="bi bi-check-circle-fill"></i> Full API Access</li>
                    <li><i class="bi bi-check-circle-fill"></i> Dedicated Account Manager</li>
                    <li><i class="bi bi-check-circle-fill"></i> 24/7 Phone Support</li>
                </ul>
                
                <a href="{{ route('register') }}" class="btn btn-outline">Contact Sales</a>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials" id="testimonials">
        <div class="section-header">
            <span class="section-badge">💬 User Stories</span>
            <h2>Loved by Businesses Everywhere</h2>
            <p>Don't just take our word for it. Here's what our customers have to say about ChatBotGPT.</p>
        </div>

        <div class="testimonials-grid">
            <div class="testimonial-card">
                <i class="bi bi-quote quote-icon"></i>
                <div class="testimonial-content">
                    "ChatBotGPT has completely transformed our customer support. We've seen a 70% reduction in support tickets as the AI handles most queries instantly."
                </div>
                <div class="testimonial-user">
                    <img src="{{ asset('images/testimonial1.png') }}" alt="Sarah Johnson" class="user-img">
                    <div class="user-info">
                        <h4>Sarah Johnson</h4>
                        <span>SaaS Founder</span>
                    </div>
                </div>
            </div>

            <div class="testimonial-card">
                <i class="bi bi-quote quote-icon"></i>
                <div class="testimonial-content">
                    "The lead generation capabilities are incredible. We're capturing more qualified leads while we sleep than we did manually during office hours."
                </div>
                <div class="testimonial-user">
                    <img src="{{ asset('images/testimonial2.png') }}" alt="Michael Chen" class="user-img">
                    <div class="user-info">
                        <h4>Michael Chen</h4>
                        <span>Marketing Director</span>
                    </div>
                </div>
            </div>

            <div class="testimonial-card">
                <i class="bi bi-quote quote-icon"></i>
                <div class="testimonial-content">
                    "Implementation was surprisingly easy. One line of code and we had a multi-lingual support system ready to go. Simply amazing!"
                </div>
                <div class="testimonial-user">
                    <img src="{{ asset('images/testimonial3.png') }}" alt="Alex Rivera" class="user-img">
                    <div class="user-info">
                        <h4>Alex Rivera</h4>
                        <span>E-commerce Owner</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq" id="faq">
        <div class="section-header">
            <span class="section-badge">❓ Common Questions</span>
            <h2>Frequently Asked Questions</h2>
            <p>Everything you need to know about ChatBotGPT and how it can help your business.</p>
        </div>

        <div class="faq-container">
            <div class="faq-item">
                <div class="faq-question">
                    What is an AI chatbot and how does it work?
                    <i class="bi bi-chevron-down faq-icon"></i>
                </div>
                <div class="faq-answer">
                    An AI chatbot is a software application designed to simulate human conversation using artificial intelligence. It works by processing user input through NLP models like GPT-4 to understand intent and provide accurate, human-like responses based on the training data you provide.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    How do I train the chatbot on my own data?
                    <i class="bi bi-chevron-down faq-icon"></i>
                </div>
                <div class="faq-answer">
                    Training is simple. You can upload PDF documents, DOCX files, paste text, or simply provide your website URL. Our system will automatically learn from your content and build a knowledge base for your AI assistant in minutes.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    Which platforms can I embed ChatBotGPT on?
                    <i class="bi bi-chevron-down faq-icon"></i>
                </div>
                <div class="faq-answer">
                    You can embed ChatBotGPT on any website using a simple one-line JavaScript snippet. It works seamlessly with WordPress, Shopify, Wix, Squarespace, React, Vue, and custom HTML sites.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    Does ChatBotGPT support multiple languages?
                    <i class="bi bi-chevron-down faq-icon"></i>
                </div>
                <div class="faq-answer">
                    Yes, ChatBotGPT supports over 50 languages. It can automatically detect the user's language and respond accordingly, making it perfect for global businesses.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    Is there a free trial available?
                    <i class="bi bi-chevron-down faq-icon"></i>
                </div>
                <div class="faq-answer">
                    Yes! We offer a 15-day risk-free trial on all our plans (Starter, Pro, and Enterprise). No credit card is required to start your trial.
                </div>
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
        <div class="footer-container">
            <div class="footer-grid">
                <div class="footer-col">
                    <a href="{{ url('/') }}" class="logo" style="margin-bottom: 1.5rem;">
                        <i class="bi bi-robot"></i>
                        <span style="color: white; -webkit-text-fill-color: white;">ChatBotGPT</span>
                    </a>
                    <p>Building the future of customer interaction with advanced GPT-powered AI chatbots. Transform your visitor experience today.</p>
                    <div class="social-links">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>

                <div class="footer-col">
                    <h4>Product</h4>
                    <ul class="footer-links">
                        <li><a href="#features">Features</a></li>
                        <li><a href="#workflow">How It Works</a></li>
                        <li><a href="#pricing">Pricing</a></li>
                        <li><a href="#capabilities">Capabilities</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Company</h4>
                    <ul class="footer-links">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#faq">FAQ</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Stay Updated</h4>
                    <p>Subscribe to our newsletter for the latest AI insights and product updates.</p>
                    <form class="newsletter-form" onsubmit="event.preventDefault(); alert('Subscribed!');">
                        <input type="email" class="newsletter-input" placeholder="Your email address" required>
                        <button type="submit" class="newsletter-btn">
                            <i class="bi bi-send"></i>
                        </button>
                    </form>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} ChatBotGPT. All rights reserved. Built with ❤️ for better customer experiences.</p>
                <div class="footer-legal">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Service</a>
                    <a href="#">Cookie Policy</a>
                </div>
            </div>
        </div>
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

        document.querySelectorAll('.workflow-step, .feature-card, .pricing-card, .testimonial-card, .capability-pill, .faq-item').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'all 0.6s ease-out';
            observer.observe(el);
        });

        // FAQ Accordion
        document.querySelectorAll('.faq-question').forEach(question => {
            question.addEventListener('click', () => {
                const item = question.parentElement;
                const isActive = item.classList.contains('active');
                
                // Close all other items
                document.querySelectorAll('.faq-item').forEach(otherItem => {
                    otherItem.classList.remove('active');
                });
                
                // Toggle current item
                if (!isActive) {
                    item.classList.add('active');
                }
            });
        });

        // Mobile Menu Toggle
        const mobileToggle = document.getElementById('mobileToggle');
        const navLinks = document.getElementById('navLinks');
        const body = document.body;

        mobileToggle.addEventListener('click', () => {
            navLinks.classList.toggle('active');
            const icon = mobileToggle.querySelector('i');
            if (navLinks.classList.contains('active')) {
                icon.classList.replace('bi-list', 'bi-x-lg');
                body.style.overflow = 'hidden';
            } else {
                icon.classList.replace('bi-x-lg', 'bi-list');
                body.style.overflow = 'auto';
            }
        });

        // Close menu when clicking a link
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', () => {
                navLinks.classList.remove('active');
                mobileToggle.querySelector('i').classList.replace('bi-x-lg', 'bi-list');
                body.style.overflow = 'auto';
            });
        });
    </script>
</body>
</html>
