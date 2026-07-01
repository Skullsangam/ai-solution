<?php
// index.php
// Refactored Multi-page Landing Hub for AI-Solutions
require_once 'config/db.php';
include 'includes/header.php';

// Fetch latest customer feedback (only 2 for the homepage snippet)
try {
    $feedbackStmt = $pdo->query("SELECT * FROM feedback ORDER BY id DESC LIMIT 2");
    $feedbacks = $feedbackStmt->fetchAll();
} catch (Exception $e) {
    $feedbacks = [];
}

// Fetch closest upcoming event
try {
    $eventStmt = $pdo->query("SELECT * FROM events WHERE event_date >= CURDATE() ORDER BY event_date ASC LIMIT 1");
    $latestEvent = $eventStmt->fetch();
} catch (Exception $e) {
    $latestEvent = null;
}
?>

<!-- 1. Hero Section -->
<section class="hero">
    <div class="container">
        <div class="hero-content">
            <div class="hero-badge">
                <span></span> Sunderland Tech Start-Up
            </div>
            <h1 class="hero-title">Elevate the <span>Digital Employee Experience</span> with AI</h1>
            <p class="hero-desc">We build rapid, proactive software solutions that monitor network health and deploy intelligent virtual assistants. Speed up your design, engineering, and innovation workflows today.</p>
            <div class="hero-btns">
                <a href="solutions.php" class="btn btn-primary">Explore Solutions</a>
                <a href="contact.php" class="btn btn-outline">Request A Prototype</a>
            </div>
        </div>
    </div>
    
    <!-- Hero Graphic -->
    <div class="hero-image-container">
        <div class="hero-graphic">
            <div class="circle-glow"></div>
            <div class="node-grid">
                <div class="node node-1"></div>
                <div class="node node-2"></div>
                <div class="node node-3"></div>
                <div class="node node-4"></div>
            </div>
        </div>
    </div>
</section>

<!-- 2. Brief Corporate Mission Summary -->
<section class="section" id="mission-summary">
    <div class="container">
        <div class="glass-panel" style="display: grid; grid-template-columns: 1fr 1.5fr; gap: 40px; padding: 48px; align-items: center;">
            <div>
                <span style="color: var(--accent); font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; font-size: 0.85rem;">Who We Are</span>
                <h2 style="font-size: 2.2rem; margin: 8px 0 16px 0;">Our Corporate Mission</h2>
                <a href="about.php" class="btn btn-primary btn-sm">Read Our Full Story</a>
            </div>
            <div>
                <p style="color: var(--text-muted); font-size: 1.05rem; line-height: 1.8; margin-bottom: 20px;">
                    Our mission is to innovate, promote, and deliver the future of the digital employee experience, with a strong focus on supporting people at work in Sunderland and worldwide.
                </p>
                <div style="display: flex; gap: 20px;">
                    <div style="display: flex; align-items: center; gap: 8px; font-weight: 600; font-size: 0.95rem; color: #FFF;">
                        <i class="fa-solid fa-lightbulb" style="color: var(--primary);"></i> Innovate
                    </div>
                    <div style="display: flex; align-items: center; gap: 8px; font-weight: 600; font-size: 0.95rem; color: #FFF;">
                        <i class="fa-solid fa-bullhorn" style="color: var(--accent);"></i> Promote
                    </div>
                    <div style="display: flex; align-items: center; gap: 8px; font-weight: 600; font-size: 0.95rem; color: #FFF;">
                        <i class="fa-solid fa-truck-ramp-box" style="color: var(--pink);"></i> Deliver
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 3. Solutions Highlights Grid -->
<section class="section" id="solutions-highlights" style="background: rgba(255,255,255,0.01);">
    <div class="container">
        <h2 class="section-title">Software Solutions</h2>
        <p class="section-subtitle">DEX Systems Engineering</p>
        
        <div class="features-grid">
            <div class="feature-card glass-panel">
                <div class="feature-icon"><i class="fa-solid fa-chart-line"></i></div>
                <h3 class="feature-title">Proactive IT Diagnostics</h3>
                <p class="feature-desc">Automatic bandwidth monitoring, CPU leak warnings, and workspace analytics integrations.</p>
                <a href="solutions.php#proactive-dex" style="color: var(--accent); font-size: 0.85rem; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; margin-top: 16px;">Learn More <i class="fa-solid fa-chevron-right"></i></a>
            </div>
            
            <div class="feature-card glass-panel">
                <div class="feature-icon"><i class="fa-solid fa-robot"></i></div>
                <h3 class="feature-title">AI Virtual Assistants</h3>
                <p class="feature-desc">Conversational chat widgets that resolve routine workspace configurations instantly.</p>
                <a href="solutions.php#virtual-assistants" style="color: var(--accent); font-size: 0.85rem; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; margin-top: 16px;">Learn More <i class="fa-solid fa-chevron-right"></i></a>
            </div>
            
            <div class="feature-card glass-panel">
                <div class="feature-icon"><i class="fa-solid fa-cubes"></i></div>
                <h3 class="feature-title">Affordable Prototyping</h3>
                <p class="feature-desc">Fully coded sandbox mockups delivered in 2 to 4 weeks to validate startup architectures.</p>
                <a href="solutions.php#rapid-prototypes" style="color: var(--accent); font-size: 0.85rem; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; margin-top: 16px;">Learn More <i class="fa-solid fa-chevron-right"></i></a>
            </div>
        </div>
        
        <div style="text-align: center; margin-top: 40px;">
            <a href="solutions.php" class="btn btn-outline">Explore All Services</a>
        </div>
    </div>
</section>

<!-- 4. Latest Customer Feedback Snippet -->
<section class="section" id="feedback-highlights">
    <div class="container">
        <h2 class="section-title">Client Satisfaction</h2>
        <p class="section-subtitle">Read Reviews From Our Partners</p>
        
        <div class="feedback-grid">
            <?php if (!empty($feedbacks)): ?>
                <?php foreach ($feedbacks as $fb): ?>
                    <div class="feedback-card glass-panel">
                        <div class="rating-stars">
                            <?php 
                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $fb['rating']) {
                                    echo '<i class="fa-solid fa-star"></i>';
                                } else {
                                    echo '<i class="fa-regular fa-star"></i>';
                                }
                            }
                            ?>
                        </div>
                        <p class="feedback-text">"<?php echo htmlspecialchars($fb['comment']); ?>"</p>
                        <div class="feedback-client">
                            <div class="client-avatar"><?php echo strtoupper(substr($fb['client_name'], 0, 1)); ?></div>
                            <div class="client-details">
                                <h4><?php echo htmlspecialchars($fb['client_name']); ?></h4>
                                <p><?php echo htmlspecialchars($fb['company']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="text-align: center; color: var(--text-muted);">No reviews posted yet.</p>
            <?php endif; ?>
        </div>
        
        <div style="text-align: center; margin-top: 40px; display: flex; justify-content: center; gap: 16px;">
            <a href="feedback.php" class="btn btn-primary">See All Reviews</a>
            <a href="feedback.php#submit-form" class="btn btn-outline">Leave a Review</a>
        </div>
    </div>
</section>

<!-- 5. Latest Article Snippet -->
<section class="section" id="articles-highlights" style="background: rgba(255,255,255,0.01);">
    <div class="container">
        <h2 class="section-title">Company Articles</h2>
        <p class="section-subtitle">DEX &amp; Engineering Library</p>
        
        <div class="articles-grid">
            <!-- Show main highlight article -->
            <article class="article-card glass-panel">
                <div class="article-image">
                    <img src="assets/images/gallery3.jpg" alt="DEX monitoring" onerror="this.src='https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=600&q=80'">
                </div>
                <div class="article-content">
                    <div class="article-meta">
                        <span><i class="fa-solid fa-calendar"></i> June 18, 2026</span>
                        <span><i class="fa-solid fa-tag"></i> Technology</span>
                    </div>
                    <h3 class="article-title">Why Proactive Monitoring is Essential for DEX</h3>
                    <p class="article-desc">Rather than waiting for employees to submit tickets, learn how AI-Solutions automatically catches system latencies and fixes them invisibly.</p>
                    <a href="article_detail.php?id=1" class="article-link">Read Full Insight <i class="fa-solid fa-arrow-right-long"></i></a>
                </div>
            </article>
            
            <article class="article-card glass-panel">
                <div class="article-image">
                    <img src="assets/images/gallery2.jpg" alt="AI Workspace" onerror="this.src='https://images.unsplash.com/photo-1531747118685-ca8fa6e08806?auto=format&fit=crop&w=600&q=80'">
                </div>
                <div class="article-content">
                    <div class="article-meta">
                        <span><i class="fa-solid fa-calendar"></i> May 29, 2026</span>
                        <span><i class="fa-solid fa-tag"></i> AI &amp; Chatbots</span>
                    </div>
                    <h3 class="article-title">Designing Natural AI Assistants for Work</h3>
                    <p class="article-desc">How integrating intuitive chatbots into employee communication hubs increases work focus, speeds up training, and promotes transparency.</p>
                    <a href="article_detail.php?id=2" class="article-link">Read Full Insight <i class="fa-solid fa-arrow-right-long"></i></a>
                </div>
            </article>
        </div>
        
        <div style="text-align: center; margin-top: 40px;">
            <a href="articles.php" class="btn btn-outline">Browse All Articles</a>
        </div>
    </div>
</section>

<!-- 6. Next Upcoming Event Preview -->
<?php if ($latestEvent): ?>
    <section class="section" id="events-highlight">
        <div class="container">
            <h2 class="section-title">Next Promotional Event</h2>
            <p class="section-subtitle">Meet Our Engineers Live</p>
            
            <div class="event-row glass-panel">
                <div class="event-date-badge">
                    <span class="event-date-day"><?php echo date('d', strtotime($latestEvent['event_date'])); ?></span>
                    <span class="event-date-month"><?php echo date('M', strtotime($latestEvent['event_date'])); ?></span>
                </div>
                <div class="event-details-col">
                    <h3><?php echo htmlspecialchars($latestEvent['title']); ?></h3>
                    <p><?php echo htmlspecialchars($latestEvent['description']); ?></p>
                    <div class="event-meta-info">
                        <span><i class="fa-solid fa-location-dot"></i> <?php echo htmlspecialchars($latestEvent['location']); ?></span>
                        <span><i class="fa-solid fa-clock"></i> 10:00 AM - 4:00 PM</span>
                    </div>
                </div>
                <div>
                    <a href="gallery.php" class="btn btn-primary btn-sm">Join Event</a>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<!-- AI Assistant floating widget -->
<?php include 'includes/chatbot.php'; ?>

<!-- Footer inclusion -->
<?php include 'includes/footer.php'; ?>
