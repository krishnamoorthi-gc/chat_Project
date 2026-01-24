(function () {
    // 1. Get configuration
    const script = document.currentScript;
    const chatbotId = script.getAttribute('data-chatbot-id');
    const baseUrl = script.getAttribute('data-base-url') || window.location.origin;
    const primaryColor = script.getAttribute('data-primary-color') || '#6366f1';

    if (!chatbotId) {
        console.error('Chatbot ID is required for the embed script.');
        return;
    }

    // 2. Create Styles
    const style = document.createElement('style');
    style.innerHTML = `
        :root {
            --chatbot-primary: ${primaryColor};
        }
        #chatbot-bubble-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--chatbot-primary);
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
            cursor: pointer;
            z-index: 999999;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: none;
            outline: none;
        }
        #chatbot-bubble-button:hover { transform: scale(1.1); }
        #chatbot-bubble-button i { color: white; font-size: 24px; }
        
        #chatbot-iframe-container {
            position: fixed;
            bottom: 90px;
            right: 20px;
            width: 400px;
            height: 600px;
            max-width: 90vw;
            max-height: 80vh;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            z-index: 999999;
            overflow: hidden;
            display: none;
            flex-direction: column;
            border: 1px solid rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            opacity: 0;
            transform: translateY(20px);
        }
        
        #chatbot-iframe-container.active {
            display: flex;
            opacity: 1;
            transform: translateY(0);
        }
        
        @media (max-width: 480px) {
            #chatbot-iframe-container {
                width: 100vw;
                height: 100vh;
                max-width: none;
                max-height: none;
                bottom: 0;
                right: 0;
                border-radius: 0;
            }
        }
    `;
    document.head.appendChild(style);

    // 3. Create Elements
    const bubble = document.createElement('button');
    bubble.id = 'chatbot-bubble-button';
    bubble.innerHTML = '<svg style="width:28px;height:28px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C6.47715 2 2 6.47715 2 12C2 13.5997 2.37562 15.1116 3.04344 16.4525C2.22572 18.5153 2.01927 20.3547 2.00098 21.3843C1.99507 21.7161 2.26477 22.0001 2.59664 22.0001C3.62624 21.9818 5.46571 21.7753 7.52848 20.9576C8.86938 21.6254 10.3813 22 12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2Z" fill="white"/></svg>';
    document.body.appendChild(bubble);

    const container = document.createElement('div');
    container.id = 'chatbot-iframe-container';

    // Check if we need to close the widget (only for mobile full screen)
    const closeBtn = document.createElement('div');
    closeBtn.innerHTML = '×';
    closeBtn.style = "position:absolute; top:10px; right:15px; color:white; font-size:24px; cursor:pointer; z-index:10000; font-weight:bold; display:none;";
    closeBtn.onclick = () => { toggleChat(); };
    container.appendChild(closeBtn);

    const iframe = document.createElement('iframe');
    iframe.src = `${baseUrl}/chat/${chatbotId}/widget`;
    iframe.style.width = '100%';
    iframe.style.height = '100%';
    iframe.style.border = 'none';
    container.appendChild(iframe);

    document.body.appendChild(container);

    // 4. Logic
    let isOpen = false;
    function toggleChat() {
        isOpen = !isOpen;
        if (isOpen) {
            container.style.display = 'flex';
            setTimeout(() => container.classList.add('active'), 10);
            bubble.innerHTML = '<svg style="width:24px;height:24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18 6L6 18M6 6L18 18" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
            if (window.innerWidth <= 480) closeBtn.style.display = 'block';
        } else {
            container.classList.remove('active');
            setTimeout(() => container.style.display = 'none', 300);
            bubble.innerHTML = '<svg style="width:28px;height:28px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C6.47715 2 2 6.47715 2 12C2 13.5997 2.37562 15.1116 3.04344 16.4525C2.22572 18.5153 2.01927 20.3547 2.00098 21.3843C1.99507 21.7161 2.26477 22.0001 2.59664 22.0001C3.62624 21.9818 5.46571 21.7753 7.52848 20.9576C8.86938 21.6254 10.3813 22 12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2Z" fill="white"/></svg>';
            closeBtn.style.display = 'none';
        }
    }

    bubble.onclick = toggleChat;

})();
