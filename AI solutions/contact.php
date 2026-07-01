<?php
// contact.php
// Dynamic Contact Us form handler
require_once 'config/db.php';

$success = false;
$errorMsg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and sanitize input
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $company = isset($_POST['company']) ? trim($_POST['company']) : '';
    $country = isset($_POST['country']) ? trim($_POST['country']) : '';
    $job_title = isset($_POST['job_title']) ? trim($_POST['job_title']) : '';
    $job_details = isset($_POST['job_details']) ? trim($_POST['job_details']) : '';

    // Validate input server-side
    if (empty($name) || empty($email) || empty($phone) || empty($company) || empty($country) || empty($job_title) || empty($job_details)) {
        $errorMsg = "All fields are required. Please fill in all the details.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMsg = "Please enter a valid email address.";
    } else {
        try {
            // SQL insertion
            $stmt = $pdo->prepare("INSERT INTO inquiries (name, email, phone, company, country, job_title, job_details) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$name, $email, $phone, $company, $country, $job_title, $job_details]);
            $success = true;
        } catch (Exception $e) {
            $errorMsg = "We encountered a system error processing your request. Please try again. Info: " . $e->getMessage();
        }
    }
}

include 'includes/header.php';
?>

<section class="section" style="padding-top: 140px;">
    <div class="container">
        <h2 class="section-title">Request a Prototyping Solution</h2>
        <p class="section-subtitle">No Account Needed &bull; Instant Software Response</p>
        
        <div class="contact-grid">
            <!-- Contact Info Panel -->
            <div class="contact-info-card glass-panel">
                <h3>Let's Innovate Together</h3>
                <p>Have a custom workspace automation requirement? Want to integrate real-time telemetry diagnostics? Tell us your specifications and we'll draft a prototype.</p>
                
                <ul class="contact-methods">
                    <li>
                        <div class="contact-method-icon">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div class="contact-method-text">
                            <h4>Headquarters</h4>
                            <p>Sunderland Software Centre, Sunderland, SR1 1PB, UK</p>
                        </div>
                    </li>
                    <li>
                        <div class="contact-method-icon">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div class="contact-method-text">
                            <h4>Email Enquiries</h4>
                            <p>contact@ai-solutions.co.uk</p>
                        </div>
                    </li>
                    <li>
                        <div class="contact-method-icon">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div class="contact-method-text">
                            <h4>Call Us</h4>
                            <p>+44 (0) 191 555 0199</p>
                        </div>
                    </li>
                </ul>
            </div>
            
            <!-- Contact Form Panel -->
            <div class="contact-form-pane glass-panel">
                <?php if ($success): ?>
                    <div class="alert-banner alert-success">
                        <i class="fa-solid fa-circle-check" style="font-size: 1.5rem;"></i>
                        <div>
                            <strong>Submission Successful!</strong><br>
                            Thank you, <?php echo htmlspecialchars($name); ?>. Your request was logged. Our tech team in Sunderland will email you shortly!
                        </div>
                    </div>
                <?php elseif (!empty($errorMsg)): ?>
                    <div class="alert-banner alert-danger">
                        <i class="fa-solid fa-circle-exclamation" style="font-size: 1.5rem;"></i>
                        <div>
                            <strong>Submission Failed</strong><br>
                            <?php echo htmlspecialchars($errorMsg); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <form id="contactForm" method="POST" action="contact.php">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="name">Your Full Name</label>
                            <input type="text" name="name" id="name" class="form-input" placeholder="e.g. John Smith" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Work Email Address</label>
                            <input type="email" name="email" id="email" class="form-input" placeholder="e.g. john@company.com" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" name="phone" id="phone" class="form-input" placeholder="e.g. +44 7700 900077" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="company">Company Name</label>
                            <input type="text" name="company" id="company" class="form-input" placeholder="e.g. Sunderland Tech Group" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" name="country" id="country" class="form-input" placeholder="e.g. United Kingdom" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="job_title">Your Job Title</label>
                            <input type="text" name="job_title" id="job_title" class="form-input" placeholder="e.g. Director of IT" required>
                        </div>
                        
                        <div class="form-group form-group-full">
                            <label for="job_details">Job Specifications / Software Requirements</label>
                            <textarea name="job_details" id="job_details" class="form-input" placeholder="Briefly describe what issue you are experiencing, what integrations you require, or what software prototype you need designed..." required></textarea>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary" style="width: 100%;">Submit Proposal Requirement</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- AI Assistant floating widget -->
<?php include 'includes/chatbot.php'; ?>

<!-- Footer inclusion -->
<?php include 'includes/footer.php'; ?>
