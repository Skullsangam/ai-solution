<?php
// article_detail.php
// Dynamic detail rendering page for promotional articles
require_once 'config/db.php';

$articles = [
    1 => [
        'title' => 'Why Proactive Monitoring is Essential for DEX',
        'category' => 'Technology',
        'date' => 'June 18, 2026',
        'image' => 'assets/images/event1.jpg',
        'fallback_image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=800&q=80',
        'content' => 'Digital Employee Experience (DEX) has become a primary benchmark for corporate IT operations. In many traditional environments, technical diagnostics only fire after an employee files an active helpdesk ticket. By then, valuable focus time has already been lost.<br><br>AI-Solutions addresses this bottleneck by deploying background diagnostics widgets. These lightweight processes monitor telemetry indicators like JVM garbage collector pauses, RAM leaks, network packet drops, and background driver overheads. When a degradation anomaly is identified, our automation engine applies targeted hotfixes (like clearing local DNS caches, releasing hung background tasks, or allocating heap RAM limits) without user intervention.<br><br>Proactive DEX guarantees a focused workspace and speeds up engineering innovation by eliminating routine computer frustrations. Our Sunderland hub is actively building next-generation telemetry engines to refine these diagnostics protocols.'
    ],
    2 => [
        'title' => 'Designing Natural AI Assistants for Work',
        'category' => 'AI & Chatbots',
        'date' => 'May 29, 2026',
        'image' => 'assets/images/gallery2.jpg',
        'fallback_image' => 'https://images.unsplash.com/photo-1531747118685-ca8fa6e08806?auto=format&fit=crop&w=800&q=80',
        'content' => 'Conversational software assistants are transforming how corporate workers interact with information assets. Instead of querying dense internal knowledge pages or filing tickets for simple configuration items, employees can message the AI-Solutions DEX chatbot.<br><br>To design an assistant that workers trust, developers must prioritize prompt speed, conversational clarity, and secure permission boundaries. Our virtual assistant bridges corporate systems with human conversation streams. Key capabilities include guiding users through hardware setups, querying standard operational specs, and escalating to human engineers when complex tasks require manual review.<br><br>By automating these routines, engineers spend less time resolving minor tasks and more time building code. In our studies, workplaces that implemented our natural assistant models saw a 30% increase in developer satisfaction ratings.'
    ],
    3 => [
        'title' => 'Affordable Prototyping: Testing Ideas Quickly',
        'category' => 'Engineering',
        'date' => 'April 14, 2026',
        'image' => 'assets/images/gallery4.jpg',
        'fallback_image' => 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&w=800&q=80',
        'content' => 'Startups and corporate units face the constant challenge of validating software ideas before incurring substantial engineering costs. Rapid prototyping offers a path to build interactive mockups and functional databases in weeks rather than months.<br><br>At AI-Solutions, we leverage optimized PHP/MySQL starter blocks and pre-designed CSS libraries to deliver working prototypes within 2 to 4 weeks. These rapid mocks allow business leaders to run live click-throughs, capture telemetry, and present functional prototypes to investors.<br><br>Prototyping mitigates the risk of architectural failure, secures funding early, and saves substantial budget during full-scale development cycles. By validating requirements in sandbox environments, development speeds up tenfold, allowing Sunderland innovators to launch software prototypes in standard formats seamlessly.'
    ]
];

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if (!isset($articles[$id])) {
    header("Location: articles.php");
    exit;
}

$article = $articles[$id];
include 'includes/header.php';
?>

<section class="section" style="padding-top: 140px;">
    <div class="container" style="max-width: 900px;">
        
        <a href="articles.php" style="color: var(--accent); display: inline-flex; align-items: center; gap: 8px; margin-bottom: 24px; font-weight: 500;">
            <i class="fa-solid fa-arrow-left"></i> Back to Articles
        </a>
        
        <!-- Main Article Panel -->
        <div class="glass-panel" style="padding: 40px; overflow: hidden;">
            <div style="height: 380px; width: 100%; border-radius: 12px; overflow: hidden; border: 1px solid var(--border-glass); margin-bottom: 32px;">
                <img src="<?php echo htmlspecialchars($article['image']); ?>" 
                     alt="<?php echo htmlspecialchars($article['title']); ?>" 
                     style="width: 100%; height: 100%; object-fit: cover;"
                     onerror="this.src='<?php echo $article['fallback_image']; ?>'">
            </div>
            
            <div class="article-meta" style="font-size: 0.9rem; margin-bottom: 16px;">
                <span><i class="fa-solid fa-calendar"></i> <?php echo htmlspecialchars($article['date']); ?></span>
                <span style="margin-left: 20px;"><i class="fa-solid fa-tag"></i> <?php echo htmlspecialchars($article['category']); ?></span>
            </div>
            
            <h1 style="font-size: 2.5rem; line-height: 1.2; margin-bottom: 24px; color: #FFF;">
                <?php echo htmlspecialchars($article['title']); ?>
            </h1>
            
            <div style="color: var(--text-muted); font-size: 1.1rem; line-height: 1.8; text-align: justify;">
                <?php echo $article['content']; ?>
            </div>
        </div>
        
    </div>
</section>

<!-- AI Assistant floating widget -->
<?php include 'includes/chatbot.php'; ?>

<!-- Footer inclusion -->
<?php include 'includes/footer.php'; ?>
