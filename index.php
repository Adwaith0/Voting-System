<?php
session_start();

// Redirect if already logged in
if (isset($_SESSION['SESS_NAME']) && $_SESSION['SESS_NAME'] != "") {
    header("Location: voter.php");
    exit();
}

// Include the modernized header
include "header.php";

// Display messages if any
global $msg;
?>

<main class="container my-5">
    <!-- Hero Section with Animation -->
    <section class="hero-section text-center animate__animated animate__fadeIn">
        <div class="hero-content bg-white p-5 rounded-4 shadow-lg" style="max-width: 800px; margin: 0 auto;">
            <div class="hero-icon mb-4">
                <i class="fas fa-vote-yea text-primary" style="font-size: 4rem;"></i>
            </div>
            <h1 class="display-4 fw-bold text-gradient mb-3">Welcome to SecureVote</h1>
            <p class="lead text-muted mb-4">
                Your trusted online voting platform for fair and transparent elections
            </p>
            
            <?php if (!empty($msg)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo htmlspecialchars($msg); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>
            
            <div class="d-flex justify-content-center gap-3 mt-4">
                <a href="login.php" class="btn btn-primary btn-lg px-4">
                    <i class="fas fa-sign-in-alt me-2"></i> Login
                </a>
                <a href="register.php" class="btn btn-outline-primary btn-lg px-4">
                    <i class="fas fa-user-plus me-2"></i> Register
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section mt-5 animate__animated animate__fadeInUp">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon bg-primary bg-opacity-10 text-primary rounded-circle p-3 mb-3 mx-auto" style="width: 60px; height: 60px;">
                            <i class="fas fa-shield-alt fs-4"></i>
                        </div>
                        <h3 class="h5">Secure Voting</h3>
                        <p class="text-muted">Military-grade encryption ensures your vote remains confidential and tamper-proof.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon bg-primary bg-opacity-10 text-primary rounded-circle p-3 mb-3 mx-auto" style="width: 60px; height: 60px;">
                            <i class="fas fa-user-check fs-4"></i>
                        </div>
                        <h3 class="h5">Verified Identity</h3>
                        <p class="text-muted">Robust authentication prevents duplicate voting and ensures one person, one vote.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon bg-primary bg-opacity-10 text-primary rounded-circle p-3 mb-3 mx-auto" style="width: 60px; height: 60px;">
                            <i class="fas fa-chart-bar fs-4"></i>
                        </div>
                        <h3 class="h5">Real-time Results</h3>
                        <p class="text-muted">View live election results with beautiful visualizations after polls close.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Countdown Timer (Example for upcoming election) -->
    <section class="countdown-section mt-5 text-center animate__animated animate__fadeIn">
        <div class="bg-primary text-white p-4 rounded-3">
            <h2 class="h4 mb-3">Next Election Countdown</h2>
            <div id="countdown" class="d-flex justify-content-center gap-3 fs-1 fw-bold">
                <div><span id="days">00</span><span class="fs-6 d-block">Days</span></div>
                <div><span id="hours">00</span><span class="fs-6 d-block">Hours</span></div>
                <div><span id="minutes">00</span><span class="fs-6 d-block">Minutes</span></div>
                <div><span id="seconds">00</span><span class="fs-6 d-block">Seconds</span></div>
            </div>
        </div>
    </section>
</main>

<!-- Custom JavaScript for animations and countdown -->
<script>
// Simple countdown timer for demo (set to 7 days from now)
document.addEventListener('DOMContentLoaded', function() {
    const countdown = () => {
        const now = new Date();
        const electionDate = new Date(now.getTime() + 7 * 24 * 60 * 60 * 1000); // 7 days from now
        
        const diff = electionDate - now;
        
        const days = Math.floor(diff / (1000 * 60 * 60 * 24));
        const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((diff % (1000 * 60)) / 1000);
        
        document.getElementById('days').textContent = days.toString().padStart(2, '0');
        document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
        document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
        document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
    };
    
    countdown();
    setInterval(countdown, 1000);
    
    // Add animation to cards on hover
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.classList.add('shadow', 'translate-middle-y');
        });
        card.addEventListener('mouseleave', () => {
            card.classList.remove('shadow', 'translate-middle-y');
        });
    });
});
</script>

<?php include "footer.php"; ?>