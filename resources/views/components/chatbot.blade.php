<div id="chatbot-container" class="chatbot-hidden" style="position: fixed; bottom: 20px; right: 20px; width: 350px; background: white; border-radius: 12px; box-shadow: 0 10px 40px rgba(0,0,0,0.15); z-index: 9999; display: flex; flex-direction: column; overflow: hidden; font-family: 'Plus Jakarta Sans', sans-serif; transition: all 0.3s ease;">
    <!-- Chat Header -->
    <div style="background: #3b82f6; color: white; padding: 15px; display: flex; align-items: center; justify-content: space-between; cursor: pointer;" onclick="toggleChat()">
        <div style="display: flex; align-items: center; gap: 10px;">
            <div style="width: 35px; height: 35px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 20px;">🤖</div>
            <div>
                <h6 style="margin: 0; color: white; font-weight: 700; font-size: 15px;">Smart Assistant</h6>
                <small style="opacity: 0.8; font-size: 11px;">Chercheur d'offres en ligne</small>
            </div>
        </div>
        <button style="background: none; border: none; color: white; cursor: pointer; font-size: 20px; line-height: 1;">&times;</button>
    </div>

    <!-- Chat Body -->
    <div id="chatbot-messages" style="height: 350px; overflow-y: auto; padding: 15px; background: #f8fafc; display: flex; flex-direction: column; gap: 12px; font-size: 14px;">
        <!-- Initial Message -->
        <div class="bot-msg" style="align-self: flex-start; background: white; border: 1px solid #e2e8f0; border-radius: 12px; border-bottom-left-radius: 2px; padding: 10px 14px; max-width: 85%; color: #334155; line-height: 1.4;">
            Bonjour ! 👋 Je suis l'assistant IA de Global Jobs.<br><br>Vous cherchez un domaine précis ? (Ex: "Je cherche un poste de dev à Paris" ou "Avez-vous des emplois en Marketing ?")
        </div>
    </div>

    <!-- Chat Input -->
    <div style="padding: 12px; background: white; border-top: 1px solid #e2e8f0; display: flex; gap: 8px;">
        <input type="text" id="chatbot-input" placeholder="Je cherche..." style="flex: 1; border: 1px solid #cbd5e1; border-radius: 20px; padding: 8px 15px; outline: none; font-size: 13px;">
        <button id="chatbot-send" style="background: #3b82f6; color: white; border: none; border-radius: 50%; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: background 0.2s;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
        </button>
    </div>
</div>

<!-- Floating Button (Triggers Chat) -->
<button id="chatbot-trigger" onclick="toggleChat()" style="position: fixed; bottom: 20px; right: 20px; width: 60px; height: 60px; background: #3b82f6; border-radius: 50%; box-shadow: 0 4px 20px rgba(59, 130, 246, 0.4); border: none; color: white; font-size: 28px; cursor: pointer; z-index: 9998; transition: transform 0.2s; display: flex; align-items: center; justify-content: center;">
    💬
</button>

<style>
    .chatbot-hidden {
        opacity: 0;
        pointer-events: none;
        transform: translateY(20px) scale(0.95);
    }
    .chatbot-visible {
        opacity: 1;
        pointer-events: auto;
        transform: translateY(0) scale(1);
    }
    #chatbot-messages::-webkit-scrollbar { width: 6px; }
    #chatbot-messages::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
</style>

<script>
    const csrfToken = "{{ csrf_token() }}";
    
    function toggleChat() {
        const chatContainer = document.getElementById('chatbot-container');
        const trigger = document.getElementById('chatbot-trigger');
        
        if (chatContainer.classList.contains('chatbot-hidden')) {
            chatContainer.classList.remove('chatbot-hidden');
            chatContainer.classList.add('chatbot-visible');
            trigger.style.transform = 'scale(0)';
            document.getElementById('chatbot-input').focus();
        } else {
            chatContainer.classList.add('chatbot-hidden');
            chatContainer.classList.remove('chatbot-visible');
            trigger.style.transform = 'scale(1)';
        }
    }

    function addMessage(text, isUser = false) {
        const msgs = document.getElementById('chatbot-messages');
        const div = document.createElement('div');
        div.style.alignSelf = isUser ? 'flex-end' : 'flex-start';
        div.style.background = isUser ? '#3b82f6' : 'white';
        div.style.color = isUser ? 'white' : '#334155';
        div.style.border = isUser ? 'none' : '1px solid #e2e8f0';
        div.style.borderRadius = '12px';
        div.style.borderBottomRightRadius = isUser ? '2px' : '12px';
        div.style.borderBottomLeftRadius = isUser ? '12px' : '2px';
        div.style.padding = '10px 14px';
        div.style.maxWidth = '85%';
        div.style.lineHeight = '1.4';
        div.innerHTML = text; // Permet aux liens HTML du backend de s'afficher
        
        msgs.appendChild(div);
        msgs.scrollTop = msgs.scrollHeight;
    }

    async function sendChatbotMessage() {
        const input = document.getElementById('chatbot-input');
        const msg = input.value.trim();
        if (!msg) return;

        // Ajouter message User
        addMessage(msg, true);
        input.value = '';

        // Indicateur de frappe
        const typingId = 'typing-' + Date.now();
        const msgs = document.getElementById('chatbot-messages');
        const typingDiv = document.createElement('div');
        typingDiv.id = typingId;
        typingDiv.style.alignSelf = 'flex-start';
        typingDiv.style.background = 'white';
        typingDiv.style.border = '1px solid #e2e8f0';
        typingDiv.style.borderRadius = '12px';
        typingDiv.style.padding = '8px 14px';
        typingDiv.style.color = '#94a3b8';
        typingDiv.innerHTML = '🤖 Recherche en cours...';
        msgs.appendChild(typingDiv);
        msgs.scrollTop = msgs.scrollHeight;

        try {
            const req = await fetch("{{ route('bot.chat') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken
                },
                body: JSON.stringify({ message: msg })
            });
            const res = await req.json();
            
            // Supprimer le statut "recherche"
            document.getElementById(typingId).remove();
            
            // Envoyer la réponse du bot
            addMessage(res.reply, false);
        } catch (error) {
            document.getElementById(typingId).remove();
            addMessage("Oups, mon serveur est momentanément injoignable. 😟", false);
        }
    }

    // Gestion du clic bouton "Envoyer"
    document.getElementById('chatbot-send').addEventListener('click', sendChatbotMessage);
    
    // Gestion de la touche Entrée
    document.getElementById('chatbot-input').addEventListener('keypress', function (e) {
        if (e.key === 'Enter') { sendChatbotMessage(); }
    });
</script>
