(function () {
    // 1. Get configuration
    const script = document.getElementById('chatbot-script');
    const chatbotId = script.getAttribute('data-id');
    const baseUrl = window.location.origin; // Or hardcode if needed

    // 2. Create Styles
    const style = document.createElement('style');
    style.innerHTML = `
        #chatbot-bubble {
            position: fixed;
            bottom: 25px;
            right: 25px;
            width: 60px;
            height: 60px;
            background: #6c5dd3;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            z-index: 999999;
        }
        #chatbot-bubble:hover { transform: scale(1.1); }
        #chatbot-bubble i { color: white; font-size: 1.8rem; }
        
        #chatbot-iframe-container {
            position: fixed;
            bottom: 100px;
            right: 25px;
            width: 400px;
            height: 600px;
            max-height: calc(100vh - 120px);
            max-width: calc(100vw - 50px);
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            display: none;
            overflow: hidden;
            z-index: 999999;
            border: 1px solid #e2e8f0;
        }
        #chatbot-iframe-container.active { display: block; animation: chatbot-slideIn 0.3s ease; }
        
        @keyframes chatbot-slideIn {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
    `;
    document.head.appendChild(style);

    // 3. Create Elements
    const bubble = document.createElement('div');
    bubble.id = 'chatbot-bubble';
    bubble.innerHTML = '<svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>';
    document.body.appendChild(bubble);

    const container = document.createElement('div');
    container.id = 'chatbot-iframe-container';

    const iframe = document.createElement('iframe');
    iframe.src = baseUrl + '/chat/' + chatbotId + '/widget';
    iframe.style.width = '100%';
    iframe.style.height = '100%';
    iframe.style.border = 'none';

    container.appendChild(iframe);
    document.body.appendChild(container);

    // 4. Toggle Logic
    bubble.onclick = () => {
        container.classList.toggle('active');
        if (container.classList.contains('active')) {
            bubble.innerHTML = '<svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>';
        } else {
            bubble.innerHTML = '<svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>';
        }
    };
})();
