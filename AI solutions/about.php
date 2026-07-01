<?php
// about.php
// Dedicated Company Mission and About Us Page
require_once 'config/db.php';
include 'includes/header.php';
?>

<section class="section" style="padding-top: 140px;">
    <div class="container">
        <h2 class="section-title">About AI-Solutions</h2>
        <p class="section-subtitle">Innovating the Digital Employee Experience</p>
        
        <!-- Story Card -->
        <div class="glass-panel" style="padding: 48px; margin-bottom: 48px;">
            <div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 40px; align-items: center;">
                <div>
                    <h3 style="font-size: 2rem; margin-bottom: 16px; color: var(--accent);">Our Origin &amp; Vision</h3>
                    <p style="color: var(--text-muted); margin-bottom: 16px; font-size: 1.05rem; line-height: 1.8;">
                        AI-Solutions is a forward-thinking start-up based in Sunderland, UK. We specialize in software solutions designed to rapidly and proactively address issues that can impact the digital employee experience (DEX), thus speeding up design, engineering, and innovation.
                    </p>
                    <p style="color: var(--text-muted); margin-bottom: 16px; font-size: 1.05rem; line-height: 1.8;">
                        What sets us apart is our integration of a responsive, virtual AI assistant that acts as a primary troubleshooting responder, providing companies with affordable, rapid prototyping tools to validate workflow designs before committing to heavy engineering budgets.
                    </p>
                </div>
                <div style="border-radius: 12px; overflow: hidden; border: 1px solid var(--border-glass); height: 280px;">
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=600&q=80" 
                         alt="Our Team in Sunderland" style="width:100%; height:100%; object-fit:cover;">
                </div>
            </div>
        </div>

        <!-- Corporate Mission Details -->
        <h3 style="font-size: 1.8rem; text-align: center; margin-bottom: 30px; color: #FFF;">Our Corporate Mission</h3>
        <div class="features-grid" style="margin-bottom: 60px;">
            <div class="feature-card glass-panel">
                <div class="feature-icon" style="color: var(--primary);"><i class="fa-solid fa-lightbulb"></i></div>
                <h4 class="feature-title">1. Innovate</h4>
                <p class="feature-desc" style="line-height: 1.6;">We build intelligent software monitors that run in background loops, detecting system slowdowns, network faults, and software stalls before the employee is impacted.</p>
            </div>
            
            <div class="feature-card glass-panel">
                <div class="feature-icon" style="color: var(--accent);"><i class="fa-solid fa-bullhorn"></i></div>
                <h4 class="feature-title">2. Promote</h4>
                <p class="feature-desc" style="line-height: 1.6;">We educate industries on the benefits of proactive IT. By hosting local tech events at Sunderland, we foster collaboration and promote modern workplace diagnostics.</p>
            </div>
            
            <div class="feature-card glass-panel">
                <div class="feature-icon" style="color: var(--pink);"><i class="fa-solid fa-truck-ramp-box"></i></div>
                <h4 class="feature-title">3. Deliver</h4>
                <p class="feature-desc" style="line-height: 1.6;">We deliver highly scalable, affordable software templates and digital assistants, helping startups and enterprises launch prototypes to globally expand their footprint.</p>
            </div>
        </div>

        <!-- Timeline / Milestones -->
        <h3 style="font-size: 1.8rem; text-align: center; margin-bottom: 40px; color: #FFF;">Journey Milestones</h3>
        <div style="display: flex; flex-direction: column; gap: 24px; max-width: 800px; margin: 0 auto;">
            
            <div class="glass-panel" style="display: flex; gap: 24px; padding: 24px;">
                <div style="font-family: var(--font-heading); font-size: 1.8rem; font-weight: 700; color: var(--accent); min-width: 80px;">2024</div>
                <div>
                    <h4 style="font-size: 1.15rem; margin-bottom: 4px;">Company Formed in Sunderland</h4>
                    <p style="color: var(--text-muted); font-size: 0.95rem;">AI-Solutions founded at the Sunderland Software Centre with a small team of software and computer systems engineers.</p>
                </div>
            </div>
            
            <div class="glass-panel" style="display: flex; gap: 24px; padding: 24px;">
                <div style="font-family: var(--font-heading); font-size: 1.8rem; font-weight: 700; color: var(--primary); min-width: 80px;">2025</div>
                <div>
                    <h4 style="font-size: 1.15rem; margin-bottom: 4px;">Launch of Proactive DEX Engine</h4>
                    <p style="color: var(--text-muted); font-size: 0.95rem;">Successfully deployed our first proactive monitoring tools to regional engineering hubs, lowering software downtime rates by 35%.</p>
                </div>
            </div>
            
            <div class="glass-panel" style="display: flex; gap: 24px; padding: 24px;">
                <div style="font-family: var(--font-heading); font-size: 1.8rem; font-weight: 700; color: var(--pink); min-width: 80px;">2026</div>
                <div>
                    <h4 style="font-size: 1.15rem; margin-bottom: 4px;">Global Expansion Sprint</h4>
                    <p style="color: var(--text-muted); font-size: 0.95rem;">Initiating our global expansion roadmap, making our virtual assistants and prototyping toolkits accessible to partners worldwide.</p>
                </div>
            </div>
            
        </div>

    </div>
</section>

<!-- AI Assistant floating widget -->
<?php include 'includes/chatbot.php'; ?>

<!-- Footer inclusion -->
<?php include 'includes/footer.php'; ?>
