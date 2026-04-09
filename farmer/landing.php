<?php 
session_start();

// If user is logged in, redirect to home
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
    header('Location: home.php');
    exit;
}
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CropMaster - Farm Inventory Management</title>
    <link rel="icon" type="image/png" href="../images/cropmaster_logo.png?v=3">
    <link rel="stylesheet" href="../css/landing.styles.css">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <span class="logo-text">Agr<span class="logo-i">i</span>Track</span>
                </div>

```
            <nav class="nav">
                <a href="#home" class="nav-link">Home</a>
                <a href="#features" class="nav-link">Features</a>
                <a href="#about" class="nav-link">About</a>
            </nav>

            <div class="header-buttons">
                <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
                    <span style="color: #64748b; font-size: 0.875rem;">Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                    <a href="logout.php" class="btn btn-ghost">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-ghost">Login</a>
                    <a href="register.php" class="btn btn-primary">Sign Up</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>

<main>
    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text animate-on-scroll" data-animate="left">
                    <div class="hero-badge">Smart Farm Operations</div>
                    
                    <div class="hero-heading">
                        <h1>Track Inventory. <span class="gradient-text">Plan Harvests.</span></h1>
                        <p>Keep inputs and outputs organized, schedule harvests with confidence, and use clear insights to reduce waste and grow profitability.</p>
                    </div>

                    <!-- BUTTON -->
                    <div class="hero-buttons">
                        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
                            <a href="home.php" class="btn btn-primary btn-large">Go to Home</a>

                            <button onclick="getRecommendation()" class="btn btn-large" style="margin-left:10px; background:#16a34a; color:white;">
                                🌱 Crop Recommendation
                            </button>
                        <?php else: ?>
                            <a href="register.php" class="btn btn-primary btn-large">Sign Up</a>
                        <?php endif; ?>
                    </div>

                    <!-- HEADING -->
                    <h3 style="margin-top:20px; color:#16a34a;">
                        🌾 Smart Crop Recommendation
                    </h3>

                    <!-- RESULT BOX -->
                    <div id="result" style="
                        margin-top:10px;
                        padding:15px;
                        border-radius:10px;
                        background:linear-gradient(135deg, #f0fdf4, #dcfce7);
                        border:1px solid #bbf7d0;
                        width:320px;
                        box-shadow:0 4px 10px rgba(0,0,0,0.1);
                        font-size:15px;
                    "></div>
                </div>

                <div class="hero-image animate-on-scroll" data-animate="right">
                    <div class="image-container">
                        <img src="../images/landing.jpg" alt="Modern farmer using CropMaster">
                        <div class="image-overlay"></div>
                    </div>

                    <div class="floating-stat floating-stat-left">
                        <div class="stat-number">99.9%</div>
                        <div class="stat-label">Stock Accuracy</div>
                    </div>

                    <div class="floating-stat floating-stat-right">
                        <div class="stat-number">2×</div>
                        <div class="stat-label">Faster Planning</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- SCRIPT -->
<script>
async function getRecommendation() {
    try {
        const weatherRes = await fetch('/CropMaster/farmer/weather.php');
        const weather = await weatherRes.json();

        const recRes = await fetch(`/CropMaster/api/recommend.php?temp=${weather.temp}&humidity=${weather.humidity}&rainfall=${weather.rainfall}`);
        const data = await recRes.json();

        document.getElementById("result").innerHTML = `
            🌡 <b>Temp:</b> ${weather.temp}°C <br>
            💧 <b>Humidity:</b> ${weather.humidity}% <br>
            🌧 <b>Rainfall:</b> ${weather.rainfall} <br><br>

            🌱 <b style="color:#15803d; font-size:18px;">
                ${data.crop}
            </b>
        `;
    } catch (error) {
        document.getElementById("result").innerHTML = "❌ Error loading recommendation";
    }
}

(function() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
            }
        });
    }, { rootMargin: '0px 0px -10% 0px', threshold: 0.1 });

    document.querySelectorAll('.animate-on-scroll').forEach((el) => observer.observe(el));
})();
</script>
```

</body>
</html>
