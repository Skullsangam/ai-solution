/* assets/js/main.js */
/* Core JavaScript for AI-Solutions Website */

document.addEventListener('DOMContentLoaded', () => {
    
    // 1. Header scroll effect
    const header = document.querySelector('header');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });

    // 2. Mobile Nav Toggle
    const navToggle = document.querySelector('.nav-toggle');
    const navLinks = document.querySelector('.nav-links');
    if (navToggle && navLinks) {
        navToggle.addEventListener('click', () => {
            navLinks.classList.toggle('active');
            // Toggle hamburger animation if desired
            const spans = navToggle.querySelectorAll('span');
            spans.forEach(span => span.classList.toggle('active'));
        });
    }

    // 3. Gallery Category Filter
    const filterButtons = document.querySelectorAll('.filter-btn');
    const galleryCards = document.querySelectorAll('.gallery-card');
    if (filterButtons.length > 0 && galleryCards.length > 0) {
        filterButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                filterButtons.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                
                const filter = btn.getAttribute('data-filter');
                galleryCards.forEach(card => {
                    if (filter === 'all' || card.getAttribute('data-category') === filter) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    }

    // 4. Lightbox
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    const lightboxClose = document.querySelector('.lightbox-close');
    if (lightbox && lightboxImg && galleryCards.length > 0) {
        galleryCards.forEach(card => {
            card.addEventListener('click', () => {
                const img = card.querySelector('img');
                if (img) {
                    lightboxImg.src = img.src;
                    lightbox.classList.add('active');
                }
            });
        });
        
        lightboxClose.addEventListener('click', () => {
            lightbox.classList.remove('active');
        });
        
        lightbox.addEventListener('click', (e) => {
            if (e.target === lightbox) {
                lightbox.classList.remove('active');
            }
        });
    }

    // 5. Contact Form Validation
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', (e) => {
            let valid = true;
            const name = document.getElementById('name');
            const email = document.getElementById('email');
            const phone = document.getElementById('phone');
            const company = document.getElementById('company');
            const country = document.getElementById('country');
            const jobTitle = document.getElementById('job_title');
            const jobDetails = document.getElementById('job_details');
            
            // Remove previous error warnings
            document.querySelectorAll('.form-input').forEach(input => {
                input.style.borderColor = '';
            });

            // Helper to flag errors
            const flagError = (field) => {
                field.style.borderColor = '#FF7675';
                valid = false;
            };

            if (!name.value.trim()) flagError(name);
            if (!email.value.trim() || !validateEmail(email.value.trim())) flagError(email);
            if (!phone.value.trim()) flagError(phone);
            if (!company.value.trim()) flagError(company);
            if (!country.value.trim()) flagError(country);
            if (!jobTitle.value.trim()) flagError(jobTitle);
            if (!jobDetails.value.trim()) flagError(jobDetails);

            if (!valid) {
                e.preventDefault();
                alert('Please fill out all fields with valid information.');
            }
        });
    }

    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    // 6. Chatbot Functionality
    const chatbotBubble = document.getElementById('chatbotBubble');
    const chatbotWidget = document.getElementById('chatbotWidget');
    const chatCloseBtn = document.getElementById('chatCloseBtn');
    const chatInputBox = document.getElementById('chatInputBox');
    const chatSendBtn = document.getElementById('chatSendBtn');
    const chatBody = document.getElementById('chatBody');
    const typingIndicator = document.getElementById('typingIndicator');

    if (chatbotBubble && chatbotWidget) {
        // Toggle Chat Window
        chatbotBubble.addEventListener('click', () => {
            chatbotWidget.classList.add('active');
            chatbotBubble.classList.add('hidden');
            scrollToBottom();
        });

        chatCloseBtn.addEventListener('click', () => {
            chatbotWidget.classList.remove('active');
            chatbotBubble.classList.remove('hidden');
        });

        // Send message event
        chatSendBtn.addEventListener('click', handleSendMessage);
        chatInputBox.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                handleSendMessage();
            }
        });

        // Quick Reply clicks
        chatBody.addEventListener('click', (e) => {
            if (e.target.classList.contains('quick-reply-pill')) {
                const message = e.target.getAttribute('data-msg');
                chatInputBox.value = message;
                handleSendMessage();
            }
        });
    }

    function handleSendMessage() {
        const text = chatInputBox.value.trim();
        if (!text) return;

        // Render user bubble
        renderMessage(text, 'user');
        chatInputBox.value = '';
        scrollToBottom();

        // Show typing indicator
        showTyping(true);

        // AJAX to chatbot_helper.php
        fetch('chatbot_helper.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'message=' + encodeURIComponent(text)
        })
        .then(response => response.json())
        .then(data => {
            showTyping(false);
            renderMessage(data.reply, 'bot', data.quick_replies);
            scrollToBottom();
        })
        .catch(err => {
            console.error('Chatbot error:', err);
            showTyping(false);
            renderMessage("I'm sorry, I encountered a connection issue. Please try again.", 'bot');
            scrollToBottom();
        });
    }

    function renderMessage(text, sender, quickReplies = []) {
        const msgDiv = document.createElement('div');
        msgDiv.className = `chat-msg chat-msg-${sender}`;
        msgDiv.innerHTML = text; // allow markup for links

        // If bot and contains quick replies
        if (sender === 'bot' && quickReplies && quickReplies.length > 0) {
            const repliesDiv = document.createElement('div');
            repliesDiv.className = 'chat-quick-replies';
            quickReplies.forEach(qr => {
                const pill = document.createElement('span');
                pill.className = 'quick-reply-pill';
                pill.setAttribute('data-msg', qr);
                pill.textContent = qr;
                repliesDiv.appendChild(pill);
            });
            msgDiv.appendChild(repliesDiv);
        }

        // Insert before typing indicator
        chatBody.insertBefore(msgDiv, typingIndicator);
    }

    function showTyping(show) {
        if (show) {
            typingIndicator.style.display = 'flex';
        } else {
            typingIndicator.style.display = 'none';
        }
    }

    function scrollToBottom() {
        chatBody.scrollTop = chatBody.scrollHeight;
    }
});
