<?php
// solutions.php
// Solutions overview and prototyping highlights
require_once 'config/db.php';
include 'includes/header.php';
?>

<section class="section" style="padding-top: 140px;">
    <div class="container">
        <h2 class="section-title">Our Software Solutions</h2>
        <p class="section-subtitle">Intelligent Digital Workplace Engineering</p>
        
        <div class="solutions-list-grid">
            
            <!-- Solution 1 -->
            <div class="solutions-detail-card glass-panel" id="proactive-dex">
                <div class="solution-info-pane">
                    <h3>Proactive IT Diagnostics</h3>
                    <p>We deploy lightweight network and local system agents that monitor key performance indexes (KPIs). Instead of relying on manual complaints, our AI system identifies anomalies automatically, reducing workspace disruption.</p>
                    <ul class="solution-info-features">
                        <li><i class="fa-solid fa-circle-check"></i> Real-time memory &amp; CPU leak detection</li>
                        <li><i class="fa-solid fa-circle-check"></i> Automatic network bandwidth bottlenecks alerts</li>
                        <li><i class="fa-solid fa-circle-check"></i> Integrated diagnostics dashboard for IT admins</li>
                    </ul>
                    <a href="contact.php" class="btn btn-accent">Request Integration Demo</a>
                </div>
                <div class="solution-preview-pane">
                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=600&q=80" alt="Diagnostics Dashboard">
                </div>
            </div>

            <!-- Solution 2 -->
            <div class="solutions-detail-card glass-panel" id="virtual-assistants">
                <div class="solution-info-pane">
                    <h3>AI-Powered Virtual Assistants</h3>
                    <p>Integrate conversational virtual assistants directly into your business communications (Slack, Teams, or web portals). Our AI agents understand specialized internal terminology, helping workers troubleshoot local system faults or access corporate information files instantly.</p>
                    <ul class="solution-info-features">
                        <li><i class="fa-solid fa-circle-check"></i> Natural language query processor</li>
                        <li><i class="fa-solid fa-circle-check"></i> Automated local hardware diagnostics procedures</li>
                        <li><i class="fa-solid fa-circle-check"></i> Seamless human-in-the-loop handovers</li>
                    </ul>
                    <a href="contact.php" class="btn btn-accent">Get Assistant Blueprint</a>
                </div>
                <div class="solution-preview-pane">
                    <img src="https://images.unsplash.com/photo-1531747118685-ca8fa6e08806?auto=format&fit=crop&w=600&q=80" alt="AI Agent Interface">
                </div>
            </div>

            <!-- Solution 3 -->
            <div class="solutions-detail-card glass-panel" id="rapid-prototypes">
                <div class="solution-info-pane">
                    <h3>Affordable Rapid Prototyping</h3>
                    <p>Testing software assumptions should not break the bank. AI-Solutions excels at fast prototyping pipelines. We deliver fully styled web applications, interactive mockups, and database wireframes in a matter of weeks so you can pitching to stakeholders with confidence.</p>
                    <ul class="solution-info-features">
                        <li><i class="fa-solid fa-circle-check"></i> 2-4 week delivery commitments</li>
                        <li><i class="fa-solid fa-circle-check"></i> Fully interactive design specs &amp; code</li>
                        <li><i class="fa-solid fa-circle-check"></i> Scalable PHP/MySQL standard tech stacks</li>
                    </ul>
                    <a href="contact.php" class="btn btn-primary">Start Your Prototype</a>
                </div>
                <div class="solution-preview-pane">
                    <img src="https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&w=600&q=80" alt="Software Prototyping">
                </div>
            </div>

            <!-- Solution 4 -->
            <div class="solutions-detail-card glass-panel" id="feedback-insights">
                <div class="solution-info-pane">
                    <h3>Workplace Sentiment Tracking</h3>
                    <p>Gather real-time digital satisfaction ratings from your staff. Our dynamic telemetry rating plugins fit neatly into desktop toolbars, matching system diagnostics logs with user emotional response patterns.</p>
                    <ul class="solution-info-features">
                        <li><i class="fa-solid fa-circle-check"></i> Discrete micro-survey modules</li>
                        <li><i class="fa-solid fa-circle-check"></i> Multi-factor satisfaction dashboard</li>
                        <li><i class="fa-solid fa-circle-check"></i> Anomaly correlation mapping</li>
                    </ul>
                    <a href="contact.php" class="btn btn-accent">Request Sentiment Modules</a>
                </div>
                <div class="solution-preview-pane">
                    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=600&q=80" alt="Workplace feedback logs">
                </div>
            </div>

        </div>
    </div>
</section>

<!-- AI Assistant floating widget -->
<?php include 'includes/chatbot.php'; ?>

<!-- Footer inclusion -->
<?php include 'includes/footer.php'; ?>
