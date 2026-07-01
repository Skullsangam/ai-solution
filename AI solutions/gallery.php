<?php
// gallery.php
// Dynamic photo gallery and promotional events
require_once 'config/db.php';
include 'includes/header.php';

// Fetch all events
try {
    $eventStmt = $pdo->query("SELECT * FROM events ORDER BY event_date ASC");
    $events = $eventStmt->fetchAll();
} catch (Exception $e) {
    $events = [];
}

// Fetch all gallery items
try {
    $galleryStmt = $pdo->query("SELECT * FROM gallery ORDER BY id DESC");
    $gallery = $galleryStmt->fetchAll();
    
    // Get unique categories for filters
    $catStmt = $pdo->query("SELECT DISTINCT category FROM gallery WHERE category != ''");
    $categories = $catStmt->fetchAll(PDO::FETCH_COLUMN);
} catch (Exception $e) {
    $gallery = [];
    $categories = [];
}
?>

<!-- 1. Upcoming Events Section (Dynamic) -->
<section class="section" style="padding-top: 140px;">
    <div class="container event-section">
        <h2 class="section-title">Promotional &amp; Corporate Events</h2>
        <p class="section-subtitle">Connect with AI-Solutions</p>
        
        <div class="event-list">
            <?php if (!empty($events)): ?>
                <?php foreach ($events as $ev): ?>
                    <div class="event-row glass-panel">
                        <div class="event-date-badge">
                            <span class="event-date-day"><?php echo date('d', strtotime($ev['event_date'])); ?></span>
                            <span class="event-date-month"><?php echo date('M', strtotime($ev['event_date'])); ?></span>
                        </div>
                        <div class="event-details-col">
                            <h3><?php echo htmlspecialchars($ev['title']); ?></h3>
                            <p><?php echo htmlspecialchars($ev['description']); ?></p>
                            <div class="event-meta-info">
                                <span><i class="fa-solid fa-location-dot"></i> <?php echo htmlspecialchars($ev['location']); ?></span>
                                <span><i class="fa-solid fa-calendar-days"></i> <?php echo date('F j, Y', strtotime($ev['event_date'])); ?></span>
                            </div>
                        </div>
                        <div style="max-width: 150px; text-align: center;">
                            <?php if (!empty($ev['image_path'])): ?>
                                <img src="<?php echo htmlspecialchars($ev['image_path']); ?>" alt="Event Thumbnail" 
                                     style="width: 100%; border-radius: 8px; border: 1px solid var(--border-glass);"
                                     onerror="this.src='https://images.unsplash.com/photo-1511578314322-379afb476865?auto=format&fit=crop&w=150&q=80'">
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="text-align: center; color: var(--text-muted);">No upcoming promotional events at the moment. Keep checking back!</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- 2. Dynamic Photo Gallery Section -->
<section class="section" style="background: rgba(255,255,255,0.01);">
    <div class="container">
        <h2 class="section-title">Promotional Photo Gallery</h2>
        <p class="section-subtitle">Snapshots of Innovation at Work</p>
        
        <!-- Filter Tabs -->
        <?php if (!empty($gallery)): ?>
            <div class="gallery-filters">
                <button class="filter-btn active" data-filter="all">All Photos</button>
                <?php foreach ($categories as $cat): ?>
                    <button class="filter-btn" data-filter="<?php echo htmlspecialchars($cat); ?>"><?php echo htmlspecialchars($cat); ?></button>
                <?php endforeach; ?>
            </div>
            
            <!-- Gallery Grid -->
            <div class="gallery-grid">
                <?php foreach ($gallery as $item): ?>
                    <div class="gallery-card glass-panel" data-category="<?php echo htmlspecialchars($item['category']); ?>">
                        <img src="<?php echo htmlspecialchars($item['image_path']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>"
                             onerror="this.src='https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=600&q=80'">
                        <div class="gallery-overlay">
                            <h4><?php echo htmlspecialchars($item['title']); ?></h4>
                            <p><?php echo htmlspecialchars($item['description']); ?></p>
                            <span class="gallery-tag"><?php echo htmlspecialchars($item['category']); ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p style="text-align: center; color: var(--text-muted);">The photo gallery is currently empty. Check back later!</p>
        <?php endif; ?>
    </div>
</section>

<!-- Lightbox Modal container -->
<div id="lightbox" class="lightbox">
    <div class="lightbox-content">
        <span class="lightbox-close">&times;</span>
        <img id="lightbox-img" src="" alt="Large View">
    </div>
</div>

<!-- AI Assistant floating widget -->
<?php include 'includes/chatbot.php'; ?>

<!-- Footer inclusion -->
<?php include 'includes/footer.php'; ?>
