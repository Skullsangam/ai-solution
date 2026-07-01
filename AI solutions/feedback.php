<?php
// feedback.php
// Dedicated Customer Reviews and dynamic rating submission page
require_once 'config/db.php';

$success = false;
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'submit_feedback') {
    $client_name = isset($_POST['client_name']) ? trim($_POST['client_name']) : '';
    $company = isset($_POST['company']) ? trim($_POST['company']) : '';
    $rating = isset($_POST['rating']) ? intval($_POST['rating']) : 5;
    $comment = isset($_POST['comment']) ? trim($_POST['comment']) : '';

    if (empty($client_name) || empty($company) || empty($comment)) {
        $error = "All fields are required to submit feedback.";
    } elseif ($rating < 1 || $rating > 5) {
        $error = "Invalid rating selected.";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO feedback (client_name, company, rating, comment) VALUES (?, ?, ?, ?)");
            $stmt->execute([$client_name, $company, $rating, $comment]);
            $success = true;
        } catch (Exception $e) {
            $error = "Failed to submit review: " . $e->getMessage();
        }
    }
}

// Fetch all reviews from DB
try {
    $stmt = $pdo->query("SELECT * FROM feedback ORDER BY id DESC");
    $feedbacks = $stmt->fetchAll();
} catch (Exception $e) {
    $feedbacks = [];
}

include 'includes/header.php';
?>

<section class="section" style="padding-top: 140px;">
    <div class="container">
        <h2 class="section-title">Customer Feedback &amp; Ratings</h2>
        <p class="section-subtitle">What organizations think of AI-Solutions</p>
        
        <div class="contact-grid">
            <!-- Left Pane: Feedbacks List -->
            <div>
                <h3 style="font-size: 1.5rem; margin-bottom: 24px; color: #FFF;">Recent Reviews</h3>
                <div style="display: flex; flex-direction: column; gap: 24px;">
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
                                    <div class="client-avatar">
                                        <?php echo strtoupper(substr($fb['client_name'], 0, 1)); ?>
                                    </div>
                                    <div class="client-details">
                                        <h4><?php echo htmlspecialchars($fb['client_name']); ?></h4>
                                        <p><?php echo htmlspecialchars($fb['company']); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p style="color: var(--text-muted); text-align: center; padding: 40px;" class="glass-panel">No client reviews registered yet. Be the first to share your experience!</p>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Right Pane: Submit Review Form -->
            <div class="contact-form-pane glass-panel">
                <h3 style="font-size: 1.5rem; margin-bottom: 8px; color: #FFF;">Share Your Experience</h3>
                <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 24px;">Submit a review and rate our software prototyping and digital employee experience systems.</p>
                
                <?php if ($success): ?>
                    <div class="alert-banner alert-success">
                        <i class="fa-solid fa-circle-check" style="font-size: 1.5rem;"></i>
                        <div>
                            <strong>Review Logged!</strong><br>
                            Thank you for rating us. Your feedback is visible below and helps us build better workplace software.
                        </div>
                    </div>
                <?php elseif (!empty($error)): ?>
                    <div class="alert-banner alert-danger">
                        <i class="fa-solid fa-triangle-exclamation" style="font-size: 1.5rem;"></i>
                        <div>
                            <strong>Failed to submit</strong><br>
                            <?php echo htmlspecialchars($error); ?>
                        </div>
                    </div>
                <?php endif; ?>
                
                <form method="POST" action="feedback.php">
                    <input type="hidden" name="action" value="submit_feedback">
                    
                    <div class="form-group" style="margin-bottom: 16px;">
                        <label for="client_name">Your Name</label>
                        <input type="text" name="client_name" id="client_name" class="form-input" placeholder="e.g. Liam Sterling" required>
                    </div>
                    
                    <div class="form-group" style="margin-bottom: 16px;">
                        <label for="company">Company / Organization</label>
                        <input type="text" name="company" id="company" class="form-input" placeholder="e.g. Sunderland Tech Hub" required>
                    </div>
                    
                    <div class="form-group" style="margin-bottom: 16px;">
                        <label for="rating">Star Rating</label>
                        <select name="rating" id="rating" class="form-input" style="background: var(--bg-dark); cursor: pointer;" required>
                            <option value="5">★★★★★ (5 Stars - Excellent)</option>
                            <option value="4">★★★★☆ (4 Stars - Good)</option>
                            <option value="3">★★★☆☆ (3 Stars - Average)</option>
                            <option value="2">★★☆☆☆ (2 Stars - Poor)</option>
                            <option value="1">★☆☆☆☆ (1 Star - Bad)</option>
                        </select>
                    </div>
                    
                    <div class="form-group" style="margin-bottom: 24px;">
                        <label for="comment">Your Review / Comments</label>
                        <textarea name="comment" id="comment" class="form-input" placeholder="Describe the software solution we provided and the impact it made on your team..." required></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary" style="width: 100%;">Submit Feedback &amp; Rating</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- AI Assistant floating widget -->
<?php include 'includes/chatbot.php'; ?>

<!-- Footer inclusion -->
<?php include 'includes/footer.php'; ?>
