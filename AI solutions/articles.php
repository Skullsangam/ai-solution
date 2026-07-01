<?php
// articles.php
// Dedicated blog and articles listing index
require_once 'config/db.php';

// Define static list of articles for multi-page rendering
$articles = [
    1 => [
        'title' => 'Why Proactive Monitoring is Essential for DEX',
        'category' => 'Technology',
        'date' => 'June 18, 2026',
        'image' => 'assets/images/gallery3.jpg',
        'fallback_image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=600&q=80',
        'snippet' => 'Rather than waiting for employees to submit tickets, learn how AI-Solutions automatically catches system latencies and fixes them invisibly.'
    ],
    2 => [
        'title' => 'Designing Natural AI Assistants for Work',
        'category' => 'AI & Chatbots',
        'date' => 'May 29, 2026',
        'image' => 'assets/images/gallery2.jpg',
        'fallback_image' => 'https://images.unsplash.com/photo-1531747118685-ca8fa6e08806?auto=format&fit=crop&w=600&q=80',
        'snippet' => 'How integrating intuitive chatbots into employee communication hubs increases work focus, speeds up training, and promotes transparency.'
    ],
    3 => [
        'title' => 'Affordable Prototyping: Testing Ideas Quickly',
        'category' => 'Engineering',
        'date' => 'April 14, 2026',
        'image' => 'assets/images/gallery4.jpg',
        'fallback_image' => 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&w=600&q=80',
        'snippet' => 'Why rapid code mocks set start-ups apart. Learn about our proprietary agile coding pipeline designed to deliver software demos in weeks.'
    ]
];

include 'includes/header.php';
?>

<section class="section" style="padding-top: 140px;">
    <div class="container">
        <h2 class="section-title">Articles &amp; Industry Insights</h2>
        <p class="section-subtitle">DEX, Prototyping &amp; AI Intelligence</p>
        
        <div class="articles-grid">
            <?php foreach ($articles as $id => $article): ?>
                <article class="article-card glass-panel">
                    <div class="article-image">
                        <img src="<?php echo htmlspecialchars($article['image']); ?>" 
                             alt="<?php echo htmlspecialchars($article['title']); ?>" 
                             onerror="this.src='<?php echo $article['fallback_image']; ?>'">
                    </div>
                    <div class="article-content">
                        <div class="article-meta">
                            <span><i class="fa-solid fa-calendar"></i> <?php echo htmlspecialchars($article['date']); ?></span>
                            <span><i class="fa-solid fa-tag"></i> <?php echo htmlspecialchars($article['category']); ?></span>
                        </div>
                        <h3 class="article-title"><?php echo htmlspecialchars($article['title']); ?></h3>
                        <p class="article-desc"><?php echo htmlspecialchars($article['snippet']); ?></p>
                        <a href="article_detail.php?id=<?php echo $id; ?>" class="article-link">Read Full Article <i class="fa-solid fa-arrow-right-long"></i></a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- AI Assistant floating widget -->
<?php include 'includes/chatbot.php'; ?>

<!-- Footer inclusion -->
<?php include 'includes/footer.php'; ?>
