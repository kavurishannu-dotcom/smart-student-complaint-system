
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Smart Student Complaint Management System - Welcome</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:Poppins,sans-serif}
body{background:linear-gradient(135deg,#0b4f9c,#4ea3ff);color:#fff}
nav{display:flex;justify-content:space-between;align-items:center;padding:18px 8%;background:rgba(255,255,255,.08)}
nav h2{font-size:28px}
nav a{color:#fff;text-decoration:none;margin-left:18px}
.hero{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;padding:70px 8%}
.left{max-width:560px}
.left h1{font-size:52px;line-height:1.2}
.left p{margin:20px 0;font-size:18px}
.btn{display:inline-block;padding:14px 28px;background:#fff;color:#0b4f9c;text-decoration:none;border-radius:30px;margin:8px;font-weight:600}
.right img{width:420px;max-width:100%}
.sec{padding:50px 8%;background:#f5f9ff;color:#222}
.cards{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:20px}
.card{background:#fff;padding:22px;border-radius:12px;box-shadow:0 5px 15px rgba(0,0,0,.12);text-align:center}
footer{text-align:center;padding:20px;background:#08376d}
.welcome-title{
    text-align:center;
    padding:30px 0 10px;
}

.welcome-title h1{
    font-size:65px;
    font-weight:700;
    letter-spacing:6px;
    text-transform:uppercase;

    background:linear-gradient(90deg,#FFD700,#FFA500,#FF6B00);
    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;
    background-clip:text;
    color:transparent;

    text-shadow:2px 2px 8px rgba(0,0,0,0.25);

    animation:glow 2s ease-in-out infinite alternate;
}

.welcome-title h1{
    font-size:75px;
    font-weight:900;
    color:#00BFFF;
    letter-spacing:5px;
    text-transform:uppercase;
    text-shadow:3px 3px 8px rgba(0,0,0,0.4);
}
@keyframes glow{
    from{
        filter:drop-shadow(0 0 5px #FFD700);
    }
    to{
        filter:drop-shadow(0 0 20px #FFA500);
    }
}
</style>
</head>
<body>
<div class="welcome-title">
    <h1>WELCOME</h1>
</div>

<section class="hero">
    <div class="left">
        <h1>Smart Student Complaint Management System</h1>

        <p>
            Submit complaints, track complaint status, and communicate
            with departments quickly and securely.
        </p>

        <a class="btn" href="../index.php">🚀 Get Started</a>

    </div>

    <div class="right">
        <img src="../images/college-logo.png" alt="Banner">
    </div>
</section>

<section class="sec">
<h2 style="text-align:center;margin-bottom:30px">Departments</h2>
<div class="cards">
<div class="card"><h3>💻 CME</h3><p>Computer Engineering</p></div>
<div class="card"><h3>📡 ECE</h3><p>Electronics & Communication Engineering</p></div>
<div class="card"><h3>⚙️ Mechanical</h3><p>Mechanical Engineering</p></div>
</div>
</section>

<section class="sec">
<h2 style="text-align:center;margin-bottom:30px">Features</h2>
<div class="cards">
<div class="card"><h3>📝 Submit Complaint</h3></div>
<div class="card"><h3>📊 Track Status</h3></div>
<div class="card"><h3>🔔 Notifications</h3></div>
<div class="card"><h3>🔒 Secure Login</h3></div>
</div>
</section>

<footer>
&copy; 2026 Smart Student Complaint Management System
</footer>
</body>
</html>
