<?php
// includes/chatbot.php
?>
<!-- AI-Solutions Chatbot Float -->
<div id="chatbotBubble" class="chatbot-bubble">
    <i class="fa-solid fa-comments"></i>
</div>

<div id="chatbotWidget" class="chatbot-widget glass-panel">
    <div class="chat-header">
        <div class="chat-header-info">
            <div class="chat-avatar-status">
                <i class="fa-solid fa-robot"></i>
                <div class="status-indicator"></div>
            </div>
            <div class="chat-header-text">
                <h3>DEX Assistant</h3>
                <p>AI-Solutions Virtual Bot</p>
            </div>
        </div>
        <div id="chatCloseBtn" class="chat-close-btn">
            <i class="fa-solid fa-xmark"></i>
        </div>
    </div>
    
    <div id="chatBody" class="chat-body">
        <!-- Initial Message from Bot -->
        <div class="chat-msg chat-msg-bot">
            Hello! I am your AI-Solutions Virtual Assistant. I am here to help you learn about our software solutions, Sunderland-based team, pricing, and rapid prototyping options.
            <br><br>
            What would you like to explore today?
            <div class="chat-quick-replies">
                <span class="quick-reply-pill" data-msg="What solutions do you offer?">Our Solutions</span>
                <span class="quick-reply-pill" data-msg="Where are you located?">Location</span>
                <span class="quick-reply-pill" data-msg="How can I request a prototype?">Request Prototype</span>
                <span class="quick-reply-pill" data-msg="How can I contact admin?">Contact Admin</span>
            </div>
        </div>
        
        <!-- Typing Indicator (hidden by default) -->
        <div id="typingIndicator" class="typing-indicator">
            <div class="typing-dot"></div>
            <div class="typing-dot"></div>
            <div class="typing-dot"></div>
        </div>
    </div>
    
    <div class="chat-footer">
        <input type="text" id="chatInputBox" class="chat-input-box" placeholder="Ask about AI-Solutions..." autocomplete="off">
        <button id="chatSendBtn" class="chat-send-btn">
            <i class="fa-solid fa-paper-plane"></i>
        </button>
    </div>
</div>
