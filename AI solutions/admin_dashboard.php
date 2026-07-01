<?php
// admin_dashboard.php
// Password-protected administration panel with CMS & review moderation

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Security Check
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}

require_once 'config/db.php';

$message = "";
$messageClass = "";

// 1. Process Actions (Add / Delete Content)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    // Handle Add Event
    if ($action === 'add_event') {
        $title = isset($_POST['title']) ? trim($_POST['title']) : '';
        $description = isset($_POST['description']) ? trim($_POST['description']) : '';
        $event_date = isset($_POST['event_date']) ? trim($_POST['event_date']) : '';
        $location = isset($_POST['location']) ? trim($_POST['location']) : '';
        
        $image_path = 'assets/images/event1.jpg'; // default fallback
        
        if (isset($_FILES['event_image']) && $_FILES['event_image']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['event_image']['tmp_name'];
            $fileName = $_FILES['event_image']['name'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));
            
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            if (in_array($fileExtension, $allowedExtensions)) {
                $newFileName = 'ev_' . md5(time() . $fileName) . '.' . $fileExtension;
                $uploadFileDir = './uploads/';
                $dest_path = $uploadFileDir . $newFileName;
                
                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $image_path = 'uploads/' . $newFileName;
                }
            } else {
                $message = "Upload failed: Allowed file types are JPG, PNG, GIF, and WEBP.";
                $messageClass = "alert-danger";
            }
        }

        if (empty($message) && !empty($title) && !empty($description) && !empty($event_date) && !empty($location)) {
            try {
                $stmt = $pdo->prepare("INSERT INTO events (title, description, event_date, location, image_path) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$title, $description, $event_date, $location, $image_path]);
                $message = "Event added successfully!";
                $messageClass = "alert-success";
            } catch (Exception $e) {
                $message = "Error inserting event: " . $e->getMessage();
                $messageClass = "alert-danger";
            }
        }
    }

    // Handle Delete Event
    elseif ($action === 'delete_event') {
        $event_id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        if ($event_id > 0) {
            try {
                $imgStmt = $pdo->prepare("SELECT image_path FROM events WHERE id = ?");
                $imgStmt->execute([$event_id]);
                $imgPath = $imgStmt->fetchColumn();
                
                if ($imgPath && strpos($imgPath, 'uploads/') === 0 && file_exists('./' . $imgPath)) {
                    unlink('./' . $imgPath);
                }

                $stmt = $pdo->prepare("DELETE FROM events WHERE id = ?");
                $stmt->execute([$event_id]);
                $message = "Event deleted successfully!";
                $messageClass = "alert-success";
            } catch (Exception $e) {
                $message = "Error deleting event: " . $e->getMessage();
                $messageClass = "alert-danger";
            }
        }
    }

    // Handle Add Gallery Item
    elseif ($action === 'add_gallery') {
        $title = isset($_POST['title']) ? trim($_POST['title']) : '';
        $description = isset($_POST['description']) ? trim($_POST['description']) : '';
        $category = isset($_POST['category']) ? trim($_POST['category']) : '';
        
        $image_path = 'assets/images/gallery1.jpg'; // default fallback
        
        if (isset($_FILES['gallery_image']) && $_FILES['gallery_image']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['gallery_image']['tmp_name'];
            $fileName = $_FILES['gallery_image']['name'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));
            
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            if (in_array($fileExtension, $allowedExtensions)) {
                $newFileName = 'gal_' . md5(time() . $fileName) . '.' . $fileExtension;
                $uploadFileDir = './uploads/';
                $dest_path = $uploadFileDir . $newFileName;
                
                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $image_path = 'uploads/' . $newFileName;
                }
            } else {
                $message = "Upload failed: Allowed file types are JPG, PNG, GIF, and WEBP.";
                $messageClass = "alert-danger";
            }
        }

        if (empty($message) && !empty($title) && !empty($category)) {
            try {
                $stmt = $pdo->prepare("INSERT INTO gallery (title, description, image_path, category) VALUES (?, ?, ?, ?)");
                $stmt->execute([$title, $description, $image_path, $category]);
                $message = "Gallery photo added successfully!";
                $messageClass = "alert-success";
            } catch (Exception $e) {
                $message = "Error inserting gallery: " . $e->getMessage();
                $messageClass = "alert-danger";
            }
        }
    }

    // Handle Delete Gallery Item
    elseif ($action === 'delete_gallery') {
        $gal_id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        if ($gal_id > 0) {
            try {
                $imgStmt = $pdo->prepare("SELECT image_path FROM gallery WHERE id = ?");
                $imgStmt->execute([$gal_id]);
                $imgPath = $imgStmt->fetchColumn();
                
                if ($imgPath && strpos($imgPath, 'uploads/') === 0 && file_exists('./' . $imgPath)) {
                    unlink('./' . $imgPath);
                }

                $stmt = $pdo->prepare("DELETE FROM gallery WHERE id = ?");
                $stmt->execute([$gal_id]);
                $message = "Gallery photo deleted successfully!";
                $messageClass = "alert-success";
            } catch (Exception $e) {
                $message = "Error deleting gallery photo: " . $e->getMessage();
                $messageClass = "alert-danger";
            }
        }
    }

    // Handle Delete Feedback Review
    elseif ($action === 'delete_feedback') {
        $fb_id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        if ($fb_id > 0) {
            try {
                $stmt = $pdo->prepare("DELETE FROM feedback WHERE id = ?");
                $stmt->execute([$fb_id]);
                $message = "Feedback review deleted successfully!";
                $messageClass = "alert-success";
            } catch (Exception $e) {
                $message = "Error deleting feedback: " . $e->getMessage();
                $messageClass = "alert-danger";
            }
        }
    }
}

// 2. Fetch Data for Dashboard Metrics
try {
    $inqCount = $pdo->query("SELECT COUNT(*) FROM inquiries")->fetchColumn();
    $eventCount = $pdo->query("SELECT COUNT(*) FROM events")->fetchColumn();
    $galleryCount = $pdo->query("SELECT COUNT(*) FROM gallery")->fetchColumn();
    $feedbackCount = $pdo->query("SELECT COUNT(*) FROM feedback")->fetchColumn();

    // Data lists
    $inquiries = $pdo->query("SELECT * FROM inquiries ORDER BY id DESC")->fetchAll();
    $eventsList = $pdo->query("SELECT * FROM events ORDER BY event_date ASC")->fetchAll();
    $galleryList = $pdo->query("SELECT * FROM gallery ORDER BY id DESC")->fetchAll();
    $feedbackList = $pdo->query("SELECT * FROM feedback ORDER BY id DESC")->fetchAll();
} catch (Exception $e) {
    die("Error loading dashboard data: " . $e->getMessage());
}

include 'includes/header.php';
?>

<section class="section" style="padding-top: 140px;">
    <div class="container">
        
        <!-- Header & Session Profile -->
        <div class="admin-header">
            <div class="admin-profile">
                <div class="admin-avatar">A</div>
                <div>
                    <h2 style="font-size: 1.5rem; margin: 0;">System Dashboard</h2>
                    <p style="color: var(--accent); font-size: 0.85rem; margin: 0;"><?php echo htmlspecialchars($_SESSION['admin_email']); ?></p>
                </div>
            </div>
            
            <ul class="admin-nav glass-panel" style="padding: 6px;">
                <li class="admin-nav-btn active" data-tab="inquiries">Inquiries</li>
                <li class="admin-nav-btn" data-tab="feedback">Manage Reviews</li>
                <li class="admin-nav-btn" data-tab="events">Manage Events</li>
                <li class="admin-nav-btn" data-tab="gallery">Manage Gallery</li>
            </ul>
        </div>
        
        <!-- Display Feedback Messages -->
        <?php if (!empty($message)): ?>
            <div class="alert-banner <?php echo $messageClass; ?>" style="margin-bottom: 30px;">
                <i class="fa-solid fa-bell"></i>
                <div><?php echo htmlspecialchars($message); ?></div>
            </div>
        <?php endif; ?>

        <!-- Stat Cards Grid -->
        <div class="stats-grid" style="grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));">
            <div class="stat-card glass-panel">
                <div class="stat-icon stat-icon-purple">
                    <i class="fa-solid fa-envelope-open-text"></i>
                </div>
                <div>
                    <div class="stat-number"><?php echo $inqCount; ?></div>
                    <div class="stat-label">Inquiries</div>
                </div>
            </div>

            <div class="stat-card glass-panel">
                <div class="stat-icon stat-icon-pink">
                    <i class="fa-solid fa-star"></i>
                </div>
                <div>
                    <div class="stat-number"><?php echo $feedbackCount; ?></div>
                    <div class="stat-label">Reviews</div>
                </div>
            </div>
            
            <div class="stat-card glass-panel">
                <div class="stat-icon stat-icon-cyan">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
                <div>
                    <div class="stat-number"><?php echo $eventCount; ?></div>
                    <div class="stat-label">Events</div>
                </div>
            </div>
            
            <div class="stat-card glass-panel">
                <div class="stat-icon stat-icon-cyan" style="color: var(--pink); background: rgba(253, 121, 168, 0.1); border-color: rgba(253, 121, 168, 0.2);">
                    <i class="fa-solid fa-images"></i>
                </div>
                <div>
                    <div class="stat-number"><?php echo $galleryCount; ?></div>
                    <div class="stat-label">Gallery</div>
                </div>
            </div>
        </div>

        <!-- ---------------- TABS SECTIONS ---------------- -->

        <!-- TAB 1: Inquiries Listing -->
        <div id="tab-inquiries" class="admin-section active">
            <h3 style="font-size: 1.4rem; margin-bottom: 20px;">Customer Inquiries (No Account Mode)</h3>
            
            <div class="table-container glass-panel">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Received Date</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Company</th>
                            <th>Country</th>
                            <th>Job Title</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($inquiries)): ?>
                            <?php foreach ($inquiries as $inq): ?>
                                <tr>
                                    <td><?php echo date('Y-M-d H:i', strtotime($inq['created_at'])); ?></td>
                                    <td style="font-weight: 600;"><?php echo htmlspecialchars($inq['name']); ?></td>
                                    <td><?php echo htmlspecialchars($inq['email']); ?></td>
                                    <td><?php echo htmlspecialchars($inq['company']); ?></td>
                                    <td><?php echo htmlspecialchars($inq['country']); ?></td>
                                    <td><?php echo htmlspecialchars($inq['job_title']); ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-accent view-inquiry-btn" 
                                                data-name="<?php echo htmlspecialchars($inq['name']); ?>"
                                                data-email="<?php echo htmlspecialchars($inq['email']); ?>"
                                                data-phone="<?php echo htmlspecialchars($inq['phone']); ?>"
                                                data-company="<?php echo htmlspecialchars($inq['company']); ?>"
                                                data-country="<?php echo htmlspecialchars($inq['country']); ?>"
                                                data-job-title="<?php echo htmlspecialchars($inq['job_title']); ?>"
                                                data-details="<?php echo htmlspecialchars($inq['job_details']); ?>"
                                                data-date="<?php echo date('F j, Y, g:i a', strtotime($inq['created_at'])); ?>">
                                            View Details
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" style="text-align: center; color: var(--text-muted);">No inquiries logged in the system.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- TAB 2: Manage Feedback/Reviews -->
        <div id="tab-feedback" class="admin-section">
            <h3 style="font-size: 1.4rem; margin-bottom: 20px;">Moderate Customer Reviews &amp; Ratings</h3>
            
            <div class="table-container glass-panel">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Client Name</th>
                            <th>Company</th>
                            <th>Rating</th>
                            <th>Review Comment</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($feedbackList)): ?>
                            <?php foreach ($feedbackList as $fb): ?>
                                <tr>
                                    <td><?php echo date('Y-M-d', strtotime($fb['created_at'])); ?></td>
                                    <td style="font-weight: 600;"><?php echo htmlspecialchars($fb['client_name']); ?></td>
                                    <td><?php echo htmlspecialchars($fb['company']); ?></td>
                                    <td style="color: #F59E0B; font-weight: bold;">
                                        <?php echo str_repeat('★', $fb['rating']) . str_repeat('☆', 5 - $fb['rating']); ?>
                                    </td>
                                    <td style="max-width: 350px; color: var(--text-muted); font-style: italic;">
                                        "<?php echo htmlspecialchars($fb['comment']); ?>"
                                    </td>
                                    <td>
                                        <form method="POST" action="admin_dashboard.php" onsubmit="return confirm('Permanently delete this review?');">
                                            <input type="hidden" name="action" value="delete_feedback">
                                            <input type="hidden" name="id" value="<?php echo $fb['id']; ?>">
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" style="text-align: center; color: var(--text-muted);">No feedback reviews found in database.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- TAB 3: Manage Events -->
        <div id="tab-events" class="admin-section">
            <div class="admin-form-grid">
                <!-- Left: Form to Add -->
                <div class="glass-panel" style="padding: 30px;">
                    <h3 style="font-size: 1.3rem; margin-bottom: 20px;">Add New Event</h3>
                    
                    <form method="POST" action="admin_dashboard.php" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="add_event">
                        
                        <div class="form-group" style="margin-bottom: 16px;">
                            <label for="ev-title">Event Title</label>
                            <input type="text" name="title" id="ev-title" class="form-input" required>
                        </div>
                        
                        <div class="form-group" style="margin-bottom: 16px;">
                            <label for="ev-date">Event Date</label>
                            <input type="date" name="event_date" id="ev-date" class="form-input" required>
                        </div>
                        
                        <div class="form-group" style="margin-bottom: 16px;">
                            <label for="ev-loc">Location</label>
                            <input type="text" name="location" id="ev-loc" class="form-input" placeholder="e.g. Sunderland Software Centre" required>
                        </div>
                        
                        <div class="form-group" style="margin-bottom: 16px;">
                            <label for="ev-img">Upload Thumbnail Photo (JPG / PNG)</label>
                            <input type="file" name="event_image" id="ev-img" class="form-input" accept="image/*">
                        </div>
                        
                        <div class="form-group" style="margin-bottom: 24px;">
                            <label for="ev-desc">Description</label>
                            <textarea name="description" id="ev-desc" class="form-input" style="min-height: 80px;" required></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary" style="width: 100%;">Create Event</button>
                    </form>
                </div>
                
                <!-- Right: List and Delete -->
                <div class="table-container glass-panel">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Title</th>
                                <th>Location</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($eventsList)): ?>
                                <?php foreach ($eventsList as $ev): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($ev['event_date']); ?></td>
                                        <td style="font-weight:600;"><?php echo htmlspecialchars($ev['title']); ?></td>
                                        <td><?php echo htmlspecialchars($ev['location']); ?></td>
                                        <td>
                                            <form method="POST" action="admin_dashboard.php" onsubmit="return confirm('Delete this event?');">
                                                <input type="hidden" name="action" value="delete_event">
                                                <input type="hidden" name="id" value="<?php echo $ev['id']; ?>">
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" style="text-align: center; color: var(--text-muted);">No events found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- TAB 4: Manage Gallery -->
        <div id="tab-gallery" class="admin-section">
            <div class="admin-form-grid">
                <!-- Left: Form to Add -->
                <div class="glass-panel" style="padding: 30px;">
                    <h3 style="font-size: 1.3rem; margin-bottom: 20px;">Upload Photo to Gallery</h3>
                    
                    <form method="POST" action="admin_dashboard.php" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="add_gallery">
                        
                        <div class="form-group" style="margin-bottom: 16px;">
                            <label for="gal-title">Photo Title</label>
                            <input type="text" name="title" id="gal-title" class="form-input" required>
                        </div>
                        
                        <div class="form-group" style="margin-bottom: 16px;">
                            <label for="gal-cat">Category (Filter tag)</label>
                            <select name="category" id="gal-cat" class="form-input" required style="background: var(--bg-dark);">
                                <option value="Launch">Launch</option>
                                <option value="Workshop">Workshop</option>
                                <option value="Expo">Expo</option>
                            </select>
                        </div>
                        
                        <div class="form-group" style="margin-bottom: 16px;">
                            <label for="gal-img">Upload Image File (JPG / PNG)</label>
                            <input type="file" name="gallery_image" id="gal-img" class="form-input" accept="image/*" required>
                        </div>
                        
                        <div class="form-group" style="margin-bottom: 24px;">
                            <label for="gal-desc">Short Description</label>
                            <input type="text" name="description" id="gal-desc" class="form-input">
                        </div>
                        
                        <button type="submit" class="btn btn-primary" style="width: 100%;">Upload to Gallery</button>
                    </form>
                </div>
                
                <!-- Right: List and Delete -->
                <div class="table-container glass-panel">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($galleryList)): ?>
                                <?php foreach ($galleryList as $gal): ?>
                                    <tr>
                                        <td>
                                            <img src="<?php echo htmlspecialchars($gal['image_path']); ?>" alt="img" 
                                                 style="width: 50px; height: 35px; object-fit: cover; border-radius: 4px;"
                                                 onerror="this.src='https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=50&q=80'">
                                        </td>
                                        <td style="font-weight:600;"><?php echo htmlspecialchars($gal['title']); ?></td>
                                        <td><span class="gallery-tag"><?php echo htmlspecialchars($gal['category']); ?></span></td>
                                        <td>
                                            <form method="POST" action="admin_dashboard.php" onsubmit="return confirm('Delete this gallery photo?');">
                                                <input type="hidden" name="action" value="delete_gallery">
                                                <input type="hidden" name="id" value="<?php echo $gal['id']; ?>">
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" style="text-align: center; color: var(--text-muted);">No photos found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- Inquiry Detail Modal -->
<div id="inquiryModal" class="modal">
    <div class="modal-card glass-panel">
        <span class="modal-close">&times;</span>
        <div class="modal-header">
            <h3 id="modalName" style="font-size: 1.5rem; color: #FFF; margin: 0 0 4px 0;"></h3>
            <p id="modalDate" style="color: var(--text-muted); font-size: 0.85rem; margin: 0;"></p>
        </div>
        <div class="modal-body">
            <div>
                <div class="modal-label">Job Title</div>
                <div id="modalJobTitle" class="modal-value"></div>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div>
                    <div class="modal-label">Email Address</div>
                    <div id="modalEmail" class="modal-value"></div>
                </div>
                <div>
                    <div class="modal-label">Phone Number</div>
                    <div id="modalPhone" class="modal-value"></div>
                </div>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div>
                    <div class="modal-label">Company</div>
                    <div id="modalCompany" class="modal-value"></div>
                </div>
                <div>
                    <div class="modal-label">Country</div>
                    <div id="modalCountry" class="modal-value"></div>
                </div>
            </div>
            
            <div>
                <div class="modal-label">Job Details &amp; Specifications</div>
                <div id="modalDetails" class="modal-value" style="white-space: pre-wrap; min-height: 100px;"></div>
            </div>
        </div>
    </div>
</div>

<!-- Inline JavaScript for admin tab switching and view detail modal -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Admin Tab Switcher
    const tabs = document.querySelectorAll('.admin-nav-btn');
    const sections = document.querySelectorAll('.admin-section');
    
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('active'));
            sections.forEach(s => s.classList.remove('active'));
            
            tab.classList.add('active');
            const target = tab.getAttribute('data-tab');
            document.getElementById(`tab-${target}`).classList.add('active');
        });
    });

    // Inquiry View Modal
    const modal = document.getElementById('inquiryModal');
    const modalClose = document.querySelector('.modal-close');
    const viewButtons = document.querySelectorAll('.view-inquiry-btn');
    
    // Modal Elements
    const mName = document.getElementById('modalName');
    const mDate = document.getElementById('modalDate');
    const mJobTitle = document.getElementById('modalJobTitle');
    const mEmail = document.getElementById('modalEmail');
    const mPhone = document.getElementById('modalPhone');
    const mCompany = document.getElementById('modalCompany');
    const mCountry = document.getElementById('modalCountry');
    const mDetails = document.getElementById('modalDetails');

    viewButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            mName.textContent = btn.getAttribute('data-name');
            mDate.textContent = 'Received on ' + btn.getAttribute('data-date');
            mJobTitle.textContent = btn.getAttribute('data-job-title');
            mEmail.textContent = btn.getAttribute('data-email');
            mPhone.textContent = btn.getAttribute('data-phone');
            mCompany.textContent = btn.getAttribute('data-company');
            mCountry.textContent = btn.getAttribute('data-country');
            mDetails.textContent = btn.getAttribute('data-details');
            
            modal.classList.add('active');
        });
    });

    modalClose.addEventListener('click', () => {
        modal.classList.remove('active');
    });

    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.remove('active');
        }
    });
});
</script>

<!-- Footer inclusion -->
<?php include 'includes/footer.php'; ?>
