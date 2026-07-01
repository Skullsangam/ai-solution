<?php
// chatbot_helper.php
// Processes chat requests from main.js and outputs simulated NLP responses

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['reply' => 'Invalid request method.', 'quick_replies' => []]);
    exit;
}

$userMessage = isset($_POST['message']) ? trim($_POST['message']) : '';

if (empty($userMessage)) {
    echo json_encode(['reply' => 'Please type something!', 'quick_replies' => []]);
    exit;
}

$lowerMsg = strtolower($userMessage);

// Response matching logic
$reply = "";
$quickReplies = [];

if (preg_match('/\b(hi|hello|hey|greetings|hola|yo)\b/', $lowerMsg)) {
    $reply = "Hello there! I'm the AI-Solutions digital assistant. How can I help you improve your digital employee experience today?";
    $quickReplies = ["What solutions do you offer?", "Where are you based?", "Request a prototype"];
} 
elseif (preg_match('/\b(solution|software|services|product|offer|system|do you do)\b/', $lowerMsg)) {
    $reply = "AI-Solutions offers advanced digital workspace diagnostics. Our solutions include:<br>"
           . "• <strong>Proactive IT Monitoring:</strong> Diagnosing digital experience issues before employees complain.<br>"
           . "• <strong>Custom Software Development:</strong> Built specifically to accelerate workplace innovation.<br>"
           . "• <strong>AI Virtual Assistants:</strong> Powering automated, interactive customer and staff interfaces.";
    $quickReplies = ["Request a prototype", "Customer feedback", "Tell me more about AI assistants"];
} 
elseif (preg_match('/\b(sunderland|office|based|located|where|address|location|place)\b/', $lowerMsg)) {
    $reply = "We are proudly based in <strong>Sunderland, UK</strong>, operating from the Sunderland Software Centre. This location acts as our core engineering hub, helping us support digital workplaces globally.";
    $quickReplies = ["Contact details", "Upcoming events", "Our mission"];
} 
elseif (preg_match('/\b(prototype|prototyping|rapid|affordable|cost|price|pricing|cheap)\b/', $lowerMsg)) {
    $reply = "Our unique selling point is delivering <strong>affordable, rapid prototyping solutions</strong>. We draft, design, and code proof-of-concepts fast so you can test features and show value without a massive upfront investment.<br>"
           . "You can request a prototype draft by filling out our <a href='contact.php' style='color:#00CEC9;text-decoration:underline;'>Contact Us form</a>.";
    $quickReplies = ["Submit requirements", "How long does it take?"];
} 
elseif (preg_match('/\b(how long|timeframe|duration|days|weeks)\b/', $lowerMsg)) {
    $reply = "For most prototyping projects, we deliver a fully functional interactive demo within <strong>2 to 4 weeks</strong> depending on complexity. Our agile engineering sprint cycles keep you updated weekly.";
    $quickReplies = ["Submit requirements", "Proactive IT monitoring"];
} 
elseif (preg_match('/\b(contact|reach|email|phone|phone number|address|write|touch)\b/', $lowerMsg)) {
    $reply = "You can reach us through multiple channels:<br>"
           . "• <strong>Contact Form:</strong> Head over to our <a href='contact.php' style='color:#00CEC9;text-decoration:underline;'>Contact page</a> (no registration needed).<br>"
           . "• <strong>Email:</strong> contact@ai-solutions.co.uk<br>"
           . "• <strong>Phone:</strong> +44 (0) 191 555 0199";
    $quickReplies = ["Request a prototype", "Where are you based?"];
} 
elseif (preg_match('/\b(admin|dashboard|login|skullsangam|password|credentials)\b/', $lowerMsg)) {
    $reply = "The secure administrator dashboard allows authorized personnel to manage event logs and view client inquiries.<br>"
           . "• Login page: <a href='admin_login.php' style='color:#00CEC9;text-decoration:underline;'>admin_login.php</a><br>"
           . "• Default login email: skullsangam@gmail.com";
    $quickReplies = ["Where are you based?", "What solutions do you offer?"];
} 
elseif (preg_match('/\b(mission|vision|startup|aim|goals|start-up)\b/', $lowerMsg)) {
    $reply = "Our mission is to <strong>innovate, promote, and deliver the future of the digital employee experience (DEX)</strong>, with a strong focus on supporting people at work. This commitment fuels our global expansion goals.";
    $quickReplies = ["What solutions do you offer?", "Upcoming events"];
} 
elseif (preg_match('/\b(event|events|expo|workshop|seminar|upcoming)\b/', $lowerMsg)) {
    $reply = "We host regular promotional events, educational workshops, and tech expos! Check out our dynamic <a href='gallery.php' style='color:#00CEC9;text-decoration:underline;'>Events and Gallery page</a> to see what is coming up next in Sunderland.";
    $quickReplies = ["See the gallery", "Where are you based?"];
} 
elseif (preg_match('/\b(feedback|rating|reviews|testimonials|customer|rating)\b/', $lowerMsg)) {
    $reply = "Our clients consistently rate us 4.8/5.0 stars! Some of our customers say: 'AI-Solutions completely changed how our IT support operates' and 'The virtual assistant prototyping was incredibly affordable and fast.'";
    $quickReplies = ["See upcoming events", "What solutions do you offer?"];
} 
else {
    $reply = "Interesting query! As the AI-Solutions Virtual Assistant, I can help you with details about our Sunderland headquarters, dynamic prototyping, or software solutions. Which of these interests you?";
    $quickReplies = ["What solutions do you offer?", "Where are you based?", "Request a prototype", "Contact details"];
}

echo json_encode([
    'reply' => $reply,
    'quick_replies' => $quickReplies
]);
exit;
?>
