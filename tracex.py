import os, sys, time, subprocess, threading, shutil, urllib.request, urllib.error, socket

# ── Colors ────────────────────────────────────────────────────────────
RED    = "\033[1;91m"; GREEN  = "\033[1;92m"; GREY   = "\033[1;96m"
YELLOW = "\033[1;93m"; BLUE   = "\033[1;94m"; WHITE  = "\033[1;37m"
ORANGE = "\033[1;33m"; PUR    = "\033[1;97m"; RESET  = "\033[0m"

TERMUX  = os.path.exists('/data/data/com.termux')
WINDOWS = sys.platform == 'win32'
LINUX   = not TERMUX and not WINDOWS
SCRIPT_DIR = os.path.dirname(os.path.abspath(__file__))

def _spin(msg, stop_event):
    frames = ["/", "-", "\\", "|"]
    i = 0
    while not stop_event.is_set():
        sys.stdout.write(f"\r  {YELLOW}[{frames[i % 4]}]{RESET} {msg}...   ")
        sys.stdout.flush()
        time.sleep(0.1)
        i += 1
    sys.stdout.write(f"\r{' ' * 60}\r")
    sys.stdout.flush()


# ── Helpers ───────────────────────────────────────────────────────────
def clear(): os.system('cls' if WINDOWS else 'clear')

def slow(text, delay=0.003):
    for ch in str(text):
        sys.stdout.write(ch); sys.stdout.flush(); time.sleep(delay)
    sys.stdout.write(RESET + '\n'); sys.stdout.flush()

def free_port():
    for p in range(8080, 8180):
        try:
            with socket.socket(socket.AF_INET, socket.SOCK_STREAM) as s:
                s.setsockopt(socket.SOL_SOCKET, socket.SO_REUSEADDR, 1)
                s.bind(('', p))
            return p
        except OSError:
            continue
    with socket.socket(socket.AF_INET, socket.SOCK_STREAM) as s:
        s.bind(('', 0))
        return s.getsockname()[1]

def _get_tw():
    """Terminal width safely — works on all platforms/screen sizes."""
    try:
        return shutil.get_terminal_size(fallback=(80, 24)).columns
    except Exception:
        return 80

# ── Banner ────────────────────────────────────────────────────────────
def baner():
    lines = r"""
████████╗██████╗  █████╗  ██████╗███████╗   ██╗  ██╗
╚══██╔══╝██╔══██╗██╔══██╗██╔════╝██╔════╝   ╚██╗██╔╝
   ██║   ██████╔╝███████║██║     █████╗█████╗╚███╔╝ 
   ██║   ██╔══██╗██╔══██║██║     ██╔══╝╚════╝██╔██╗ 
   ██║   ██║  ██║██║  ██║╚██████╗███████╗   ██╔╝ ██╗
   ╚═╝   ╚═╝  ╚═╝╚═╝  ╚═╝ ╚═════╝╚══════╝   ╚═╝  ╚═╝
""".splitlines()
    _tw   = _get_tw()
    _BLEN = 52  # banner line character width

    # ── Responsive layout ──
    # Narrow  (< 60)  : Termux/mobile — no indent, trimmed lines
    # Medium  (60-95) : small laptop/tablet — 1 tab indent
    # Wide    (>= 96) : full laptop/desktop — 2 tab indent
    if _tw < 60:
        _ind = ''; _sub = ''; _ver = ''; _sep = max(20, _tw - 2)
        lines = r"""
  __________  ___   ____________    _  __
 /_  __/ __ \/   | / ____/ ____/   | |/ /
  / / / /_/ / /| |/ /   / __/______|   / 
 / / / _, _/ ___ / /___/ /__/_____/   |  
/_/ /_/ |_/_/  |_\____/_____/    /_/|_|  
  """.splitlines()
    elif _tw < 96:
        _ind = '\t'; _sub = ''; _ver = '\t       '; _sep = min(60, _tw - 4)
    else:
        _ind = '\t\t'; _sub = '\t'; _ver = '\t\t       '; _sep = min(74, _tw - 4)
    print()
    for l in lines:
        # Trim banner line if screen too narrow — no ugly wrapping
        display = l if _tw >= (_BLEN + 4) else l[:max(_tw - 2, 20)]
        sys.stdout.write(RED + _ind)
        for ch in display:
            sys.stdout.write(ch); sys.stdout.flush(); time.sleep(0.001)
        sys.stdout.write(RESET + '\n'); sys.stdout.flush()

    for ch in f"{_ver}{WHITE} Version 3.4 By {BLUE}[Jay Joshi]{RESET} \n{RESET}  ":
        sys.stdout.write(ch); sys.stdout.flush(); time.sleep(0.001)
    for ch in f"{_sub} {GREEN}This Tool Is Built For Only Location Tracking{RESET}\n":
        sys.stdout.write(ch); sys.stdout.flush(); time.sleep(0.001)
    for ch in f"{_sub} {BLUE}{'='*_sep}{RESET}\n":
        sys.stdout.write(ch); sys.stdout.flush(); time.sleep(0.001)

# ══════════════════════════════════════════════════════════════════════
#  PHP — auto install / find
# ══════════════════════════════════════════════════════════════════════
_PHP_EXE = None

def find_php():
    global _PHP_EXE
    if _PHP_EXE:
        return _PHP_EXE
    try:
        r = subprocess.run(['php','--version'], capture_output=True, timeout=5)
        if r.returncode == 0:
            _PHP_EXE = 'php'; return _PHP_EXE
    except Exception: pass
    if WINDOWS:
        p = os.path.join(SCRIPT_DIR, 'php', 'php.exe')
        if os.path.isfile(p):
            _PHP_EXE = p; return _PHP_EXE
    return None

def install_php():
    global _PHP_EXE
    slow(f"  {YELLOW}[-]{RESET} PHP not found — installing...")

    if TERMUX:
        slow(f"  {GREEN}[-]{RESET} pkg install php -y")
        try:
            r = subprocess.run(['pkg','install','php','-y'], capture_output=True, timeout=180)
            if r.returncode == 0:
                slow(f"  {GREEN}✓  PHP installed!{RESET}"); _PHP_EXE='php'; return True
        except Exception as e:
            slow(f"  {RED}✗  {e}{RESET}")
        return False

    if LINUX:
        slow(f"  {GREEN}[-]{RESET} sudo apt install php -y")
        try:
            r = subprocess.run(['sudo','apt','install','php','-y'], capture_output=True, timeout=180)
            if r.returncode == 0:
                slow(f"  {GREEN}✓  PHP installed!{RESET}"); _PHP_EXE='php'; return True
        except Exception as e:
            slow(f"  {RED}✗  {e}{RESET}")
        return False

    if WINDOWS:
        import re, zipfile
        slow(f"  {GREEN}[-]{RESET} Finding latest PHP for Windows...")
        php_zip = os.path.join(SCRIPT_DIR, 'php_portable.zip')
        php_dir = os.path.join(SCRIPT_DIR, 'php')
        if os.path.exists(php_zip):
            try: os.remove(php_zip)
            except Exception: pass
        try:
            html = None
            for _mirror in [
                'https://windows.php.net/downloads/releases/',
                'https://windows.php.net/downloads/releases/archives/',
            ]:
                try:
                    req = urllib.request.Request(
                        _mirror,
                        headers={'User-Agent': 'Mozilla/5.0'}
                    )
                    with urllib.request.urlopen(req, timeout=30) as resp:
                        html = resp.read().decode('utf-8', errors='ignore')
                    if html:
                        break
                except Exception:
                    continue
            if not html:
                raise ValueError("Could not reach windows.php.net — check your internet connection")
            matches = re.findall(r'php-(\d+\.\d+\.\d+)-nts-Win32-vs\d+-x64\.zip', html)
            if not matches:
                raise ValueError("No PHP zip found on page")
            from functools import cmp_to_key
            def vcmp(a, b):
                aa = list(map(int, a.split('.'))); bb = list(map(int, b.split('.')))
                return (aa > bb) - (aa < bb)
            latest = sorted(set(matches), key=cmp_to_key(vcmp), reverse=True)[0]
            vs_match = re.search(rf'php-{re.escape(latest)}-nts-Win32-(vs\d+)-x64\.zip', html)
            vs = vs_match.group(1) if vs_match else 'vs16'
            fname = f'php-{latest}-nts-Win32-{vs}-x64.zip'
            url   = f'https://windows.php.net/downloads/releases/{fname}'
            slow(f"  {GREEN}[-]{RESET} Downloading: {fname}")
            _start    = [time.time()]
            _last_pct = [-1]
            def _hook(cnt, blk, total):
                if total <= 0: return
                done_b = min(cnt * blk, total)
                pct    = min(int(done_b * 100 / total), 100)
                if pct == _last_pct[0]: return
                _last_pct[0] = pct
                elapsed  = max(time.time() - _start[0], 0.001)
                speed_kb = done_b / elapsed / 1024
                bar_done = pct // 3
                bar = '█' * bar_done + '░' * (34 - bar_done)
                eta_s = int((total - done_b) / max(speed_kb * 1024, 1)) if speed_kb > 0 else 0
                eta   = f'{eta_s//60}m{eta_s%60:02d}s' if eta_s >= 60 else f'{eta_s}s'
                spd  = f'{speed_kb/1024:.1f}MB/s' if speed_kb >= 1024 else f'{speed_kb:.0f}KB/s'
                line = f'  [{bar}] {pct:3d}%  {spd:<9} ETA: {eta}'
                try:
                    w = max(_get_tw() - 2, len(line))
                except Exception:
                    w = 78
                sys.stdout.write('\r' + line.ljust(w)); sys.stdout.flush()
            for _attempt in range(3):
                try:
                    urllib.request.urlretrieve(url, php_zip, reporthook=_hook)
                    break
                except Exception as _e:
                    if _attempt == 2:
                        raise _e
                    sys.stdout.write('\r' + ' ' * 78 + '\r')
                    slow(f"  Retry {_attempt+2}/3...")
            sys.stdout.write('\r' + ' ' * _get_tw() + '\r'); sys.stdout.flush()
            slow(f"  {GREEN}[-]{RESET} Extracting...")
            os.makedirs(php_dir, exist_ok=True)
            with zipfile.ZipFile(php_zip,'r') as z:
                z.extractall(php_dir)
            os.remove(php_zip)
            exe = os.path.join(php_dir,'php.exe')
            if os.path.isfile(exe):
                _PHP_EXE = exe
                slow(f"  {GREEN}✓  PHP ready!{RESET}"); return True
            slow(f"  {RED}✗  php.exe not found after extract{RESET}")
        except Exception as e:
            slow(f"  {RED}✗  {e}{RESET}")
            slow(f"  {YELLOW}  Manual: https://windows.php.net/download/{RESET}")
            try:
                if os.path.exists(php_zip): os.remove(php_zip)
            except Exception: pass
        return False
    return False

def ensure_php():
    if find_php(): return True
    return install_php()

# ══════════════════════════════════════════════════════════════════════
#  CLOUDFLARED — find / install
# ══════════════════════════════════════════════════════════════════════
def find_cloudflared():
    if WINDOWS:
        for p in [
            'cloudflared.exe',
            os.path.join(SCRIPT_DIR, 'cloudflared.exe'),
            os.path.join(os.environ.get('USERPROFILE',''), 'cloudflared.exe'),
        ]:
            if os.path.isfile(p): return f'"{p}"' if ' ' in p else p
        try:
            r = subprocess.run('where cloudflared', capture_output=True, text=True, shell=True, timeout=5)
            if r.returncode==0: return r.stdout.strip().splitlines()[0].strip()
        except Exception: pass
        return None
    for p in [
        '/data/data/com.termux/files/usr/bin/cloudflared',
        '/usr/local/bin/cloudflared','/usr/bin/cloudflared',
        os.path.expanduser('~/cloudflared'),
        os.path.join(SCRIPT_DIR, 'cloudflared'),
    ]:
        if os.path.isfile(p) and os.access(p, os.X_OK): return p
    try:
        r = subprocess.run(['which','cloudflared'], capture_output=True, text=True, timeout=5)
        if r.returncode==0: return r.stdout.strip()
    except Exception: pass
    return None

def install_cloudflared():
    import json, tarfile
    slow(f"  {YELLOW}[-]{RESET} Cloudflared not found — installing...")
    if TERMUX:
        try:
            r = subprocess.run(['pkg','install','-y','cloudflared'], capture_output=True, timeout=120)
            if r.returncode==0:
                slow(f"  {GREEN}✓  cloudflared installed!{RESET}"); return True
        except Exception: pass
    try:
        req = urllib.request.Request(
            'https://api.github.com/repos/cloudflare/cloudflared/releases/latest',
            headers={'User-Agent':'Mozilla/5.0'}
        )
        with urllib.request.urlopen(req, timeout=10) as resp:
            assets = json.loads(resp.read())['assets']
    except Exception as e:
        slow(f"  {RED}✗  {e}{RESET}"); return False

    if WINDOWS:
        url = next((a['browser_download_url'] for a in assets if 'windows-amd64.exe' in a['name']), None)
        if url:
            dst = os.path.join(SCRIPT_DIR,'cloudflared.exe')
            try:
                slow(f"  {GREEN}[-]{RESET} Downloading cloudflared...")
                req2 = urllib.request.Request(url, headers={'User-Agent':'Mozilla/5.0'})
                with urllib.request.urlopen(req2, timeout=60) as resp2:
                    with open(dst, 'wb') as f2:
                        f2.write(resp2.read())
                slow(f"  {GREEN}✓  cloudflared installed!{RESET}"); return True
            except Exception as e: slow(f"  {RED}✗  {e}{RESET}")
    elif TERMUX:
        import platform
        machine = platform.machine().lower()
        kw = 'arm64' if 'aarch64' in machine or 'arm64' in machine else 'arm'
        url = next((a['browser_download_url'] for a in assets if f'linux-{kw}' in a['name'] and a['name'].endswith('.tar.gz')), None)
        if url:
            tmp = '/data/data/com.termux/files/usr/tmp/cf.tar.gz'
            binp = '/data/data/com.termux/files/usr/bin/cloudflared'
            try:
                os.makedirs(os.path.dirname(tmp), exist_ok=True)
                urllib.request.urlretrieve(url, tmp)
                with tarfile.open(tmp,'r:gz') as t:
                    for m in t.getmembers():
                        if 'cloudflared' in m.name and not m.name.endswith('/') and m.isfile():
                            m.name = 'cloudflared'
                            extracted = False
                            try:
                                t.extract(m, '/data/data/com.termux/files/usr/bin', filter='data')
                                extracted = True
                            except TypeError: pass
                            if not extracted:
                                try:
                                    t.extract(m, '/data/data/com.termux/files/usr/bin')
                                    extracted = True
                                except Exception: pass
                            if not extracted:
                                with t.extractfile(m) as src, open(binp, 'wb') as dst:
                                    dst.write(src.read())
                            break
                os.chmod(binp, 0o755)
                slow(f"  {GREEN}✓  cloudflared installed!{RESET}"); return True
            except Exception as e: slow(f"  {RED}✗  {e}{RESET}")
            finally:
                try: os.remove(tmp)
                except Exception: pass
    else:
        url = next((a['browser_download_url'] for a in assets if 'linux-amd64' in a['name'] and a['name'].endswith('.deb')), None)
        if url:
            tmp = '/tmp/cloudflared.deb'
            try:
                urllib.request.urlretrieve(url, tmp)
                subprocess.run(['sudo','dpkg','-i',tmp], check=True, stdout=subprocess.DEVNULL, stderr=subprocess.DEVNULL, timeout=60)
                slow(f"  {GREEN}✓  cloudflared installed!{RESET}"); return True
            except Exception as e: slow(f"  {RED}✗  {e}{RESET}")
    return False

def ensure_cloudflared():
    cf = find_cloudflared()
    if cf: return cf
    ok = install_cloudflared()
    return find_cloudflared() if ok else None

# ══════════════════════════════════════════════════════════════════════
#  TUNNEL — start & get URL
# ══════════════════════════════════════════════════════════════════════
def start_tunnel(cf_cmd, port):
    import re as _re
    url_box=[None]; proc_box=[None]
    def _t():
        try:
            p = subprocess.Popen(
                f'{cf_cmd} --protocol http2 tunnel --url http://127.0.0.1:{port}',
                shell=True, stdout=subprocess.PIPE, stderr=subprocess.STDOUT, text=True, bufsize=1
            )
            proc_box[0]=p
            for line in p.stdout:
                m = _re.search(r'https://[a-zA-Z0-9\-]+\.trycloudflare\.com', line)
                if m:
                    url_box[0]=m.group(0)
                    threading.Thread(target=lambda: [p.stdout.read()], daemon=True).start()
                    break
        except Exception as e: url_box[0]=f'ERR:{e}'
    threading.Thread(target=_t, daemon=True).start()
    for _ in range(40):
        if url_box[0]: break
        time.sleep(0.5)
    if not url_box[0]:
        try:
            if proc_box[0] and proc_box[0].poll() is None:
                proc_box[0].terminate()
                proc_box[0].wait(timeout=2)
        except Exception: pass
        return None, None
    return proc_box[0], url_box[0]

# ══════════════════════════════════════════════════════════════════════
#  QR LIBS — silent install
# ══════════════════════════════════════════════════════════════════════
def _ensure_libs():
    try:
        import qrcode; from PIL import Image, ImageDraw, ImageFont; return True
    except ImportError:
        sys.stdout.write(f"  {YELLOW}[-]{RESET} Installing qrcode + Pillow...\n"); sys.stdout.flush()
        if TERMUX:
            subprocess.run(['pkg', 'install', '-y', 'python-pillow'], timeout=120, stdout=subprocess.DEVNULL, stderr=subprocess.DEVNULL)
            subprocess.run([sys.executable, '-m', 'pip', 'install', 'qrcode', '-q', '--break-system-packages'], timeout=90, stdout=subprocess.DEVNULL, stderr=subprocess.DEVNULL)
        else:
            r = subprocess.run([sys.executable, '-m', 'pip', 'install', 'qrcode[pil]', 'Pillow', '-q'], timeout=90, stdout=subprocess.DEVNULL, stderr=subprocess.DEVNULL)
            if r.returncode != 0:
                subprocess.run([sys.executable, '-m', 'pip', 'install', 'qrcode[pil]', 'Pillow', '-q', '--break-system-packages'], timeout=90, stdout=subprocess.DEVNULL, stderr=subprocess.DEVNULL)
        try:
            import qrcode; from PIL import Image, ImageDraw, ImageFont; return True
        except ImportError:
            return False

# ══════════════════════════════════════════════════════════════════════
#  QR IMAGE GENERATOR
# ══════════════════════════════════════════════════════════════════════
def _hackdeva_generate_qr(url, save_path):
    if not _ensure_libs():
        return None
    try:
        import qrcode as _qr
        from PIL import Image, ImageDraw
        qr = _qr.QRCode(error_correction=_qr.constants.ERROR_CORRECT_H, box_size=10, border=4)
        qr.add_data(url)
        qr.make(fit=True)
        qr_img = qr.make_image(fill_color=(0, 0, 0), back_color=(255, 255, 255))
        _nearest = getattr(Image, 'Resampling', Image).NEAREST
        qr_img = qr_img.resize((500, 500), _nearest)
        qr_img.save(save_path, format="PNG", dpi=(150, 150))
        return save_path
    except Exception as e:
        print(f"  {YELLOW}[!]{RESET} QR generate error: {e}")
        return None

# ══════════════════════════════════════════════════════════════════════
#  AUTO CLIPBOARD COPY
# ══════════════════════════════════════════════════════════════════════
def _auto_copy_url(url):
    copied = False
    if WINDOWS:
        try:
            subprocess.run(['powershell', '-command', f'Set-Clipboard -Value "{url}"'], timeout=5, stdout=subprocess.DEVNULL, stderr=subprocess.DEVNULL)
            copied = True
        except Exception: pass
        if not copied:
            try:
                import win32clipboard
                win32clipboard.OpenClipboard(); win32clipboard.EmptyClipboard()
                win32clipboard.SetClipboardData(win32clipboard.CF_UNICODETEXT, url)
                win32clipboard.CloseClipboard(); copied = True
            except Exception: pass
    elif TERMUX:
        try:
            subprocess.run(['termux-clipboard-set', url], timeout=5, stdout=subprocess.DEVNULL, stderr=subprocess.DEVNULL)
            copied = True
        except Exception: pass
    else:
        for cmd in [['xclip', '-selection', 'clipboard'], ['xsel', '--clipboard', '--input'], ['wl-copy']]:
            try:
                p = subprocess.Popen(cmd, stdin=subprocess.PIPE, stdout=subprocess.DEVNULL, stderr=subprocess.DEVNULL)
                p.communicate(input=url.encode(), timeout=5)
                if p.returncode == 0: copied = True; break
            except Exception: continue
        if not copied:
            try:
                slow(f"  {YELLOW}[-]{RESET} Installing xclip for clipboard...")
                subprocess.run(['sudo','apt','install','-y','xclip'], capture_output=True, timeout=60)
                p = subprocess.Popen(['xclip', '-selection', 'clipboard'], stdin=subprocess.PIPE, stdout=subprocess.DEVNULL, stderr=subprocess.DEVNULL)
                p.communicate(input=url.encode(), timeout=5)
                if p.returncode == 0: copied = True
            except Exception: pass
    return copied

def _auto_copy_qr_image(qr_path):
    if not os.path.isfile(qr_path): return False
    if WINDOWS:
        try:
            import win32clipboard, io
            from PIL import Image as PI
            img2 = PI.open(qr_path).convert("RGB")
            buf2 = io.BytesIO(); img2.save(buf2, "BMP")
            bmp = buf2.getvalue()[14:]
            win32clipboard.OpenClipboard(); win32clipboard.EmptyClipboard()
            win32clipboard.SetClipboardData(win32clipboard.CF_DIB, bmp)
            win32clipboard.CloseClipboard(); return True
        except Exception: pass
        try:
            subprocess.run(['powershell', '-command', f'Set-Clipboard -Path "{qr_path}"'], timeout=5, stdout=subprocess.DEVNULL, stderr=subprocess.DEVNULL)
            return True
        except Exception: pass
    elif TERMUX:
        return False
    else:
        try:
            subprocess.run(['xclip', '-selection', 'clipboard', '-t', 'image/png', '-i', qr_path], timeout=5, stdout=subprocess.DEVNULL, stderr=subprocess.DEVNULL)
            return True
        except Exception: pass
    return False

# ══════════════════════════════════════════════════════════════════════
#  SHOW URL + QR
# ══════════════════════════════════════════════════════════════════════
def show_url_with_qr(full_url):
    print(f"  {GREEN}[-]{RESET} URL {WHITE}1{RESET} : {BLUE}{full_url}{RESET}")
    print()
    qr_path = os.path.join(SCRIPT_DIR, 'server_qr_code.png')
    result = _hackdeva_generate_qr(full_url, qr_path)
    sys.stdout.flush()
    sys.stdout.write(f"  {GREEN}[-]{RESET} QRCODE  :\n"); sys.stdout.flush()
    try:
        import qrcode as _qr, io
        qr = _qr.QRCode(border=1)
        qr.add_data(full_url); qr.make(fit=True)
        buf = io.StringIO(); qr.print_ascii(out=buf, invert=True)
        for line in buf.getvalue().splitlines(): print(f"  {line}")
    except Exception:
        try:
            _ensure_libs()
            import qrcode as _qr, io
            qr = _qr.QRCode(border=1)
            qr.add_data(full_url); qr.make(fit=True)
            buf = io.StringIO(); qr.print_ascii(out=buf, invert=True)
            for line in buf.getvalue().splitlines(): print(f"  {line}")
        except Exception as e:
            slow(f"  {RED}✗  QR: {e}{RESET}")
    print()
    _auto_copy_url(full_url)
    if result: _auto_copy_qr_image(qr_path)
    sys.stdout.write(f"  {GREEN}[-]{RESET} Auto copying QRcode to clipboard...\n"); sys.stdout.flush()
    print()

# ══════════════════════════════════════════════════════════════════════
#  FOLDER SCAN
# ══════════════════════════════════════════════════════════════════════
def scan_folder(folder_path):
    if not os.path.isdir(folder_path): return None, None
    try: files = [f for f in os.listdir(folder_path) if os.path.isfile(os.path.join(folder_path, f))]
    except Exception: return None, None
    php   = [f for f in files if f.endswith('.php')]
    html  = [f for f in files if f.endswith('.html') or f.endswith('.htm')]
    py    = [f for f in files if f.endswith('.py')]
    sh    = [f for f in files if f.endswith('.sh')]
    web = None
    for pref in ['index.php','main.php','tool.php']:
        if pref in php: web=os.path.join(folder_path,pref); break
    if not web and php: web=os.path.join(folder_path,sorted(php)[0])
    if not web:
        for pref in ['index.html','tool.html','main.html']:
            if pref in html: web=os.path.join(folder_path,pref); break
    if not web and html: web=os.path.join(folder_path,sorted(html)[0])
    pyf = None
    for pref in ['main.py','tool.py','run.py','start.py']:
        if pref in py: pyf=os.path.join(folder_path,pref); break
    if not pyf and py: pyf=os.path.join(folder_path,sorted(py)[0])
    if not web and not pyf:
        for pref in ['main.sh','run.sh','start.sh']:
            if pref in sh: return None, os.path.join(folder_path,pref)
        if sh: return None, os.path.join(folder_path,sorted(sh)[0])
    return web, pyf

# ══════════════════════════════════════════════════════════════════════
#  MAIN RUNNER
# ══════════════════════════════════════════════════════════════════════
def run_folder_tool(folder_name):
    folder_path = os.path.join(SCRIPT_DIR, folder_name)
    if not os.path.isdir(folder_path):
        clear(); baner(); print()
        slow(f"  {RED}✗  Folder not found: {folder_path}{RESET}")
        slow(f"  {YELLOW}  mkdir {folder_name.lstrip(chr(46))}{RESET}")
        print(); input(GREEN+"  Press Enter..."+RESET); return

    web_file, py_file = scan_folder(folder_path)
    if not web_file and not py_file:
        clear(); baner(); print()
        slow(f"  {YELLOW}[!]{RESET} Folder empty ya unsupported files.")
        slow(f"  {GREY}  Supported: .php  .html  .py  .sh{RESET}")
        print(); input(GREEN+"  Press Enter..."+RESET); return

    # ── Responsive info box ──
    _tw3  = _get_tw()
    _bw   = min(56, max(42, _tw3 - 4))
    _inn  = _bw - 4
    clear(); print()
    print(f"  {BLUE}╔{'═'*_bw}╗{RESET}")
    if web_file:
        _wn = os.path.basename(web_file)[:_inn - 8]
        print(f"  {BLUE}║{RESET}  {YELLOW}🌐  {WHITE}Web  :{_wn:<{_inn-8}}{BLUE}║{RESET}")
    if py_file:
        icon = '🐍' if py_file.endswith('.py') else '⚡'
        _tn = os.path.basename(py_file)[:_inn - 8]
        print(f"  {BLUE}║{RESET}  {YELLOW}{icon}  {WHITE}Tool :{_tn:<{_inn-8}}{BLUE}║{RESET}")
    _fn = folder_name.lstrip(".")[:_inn - 12]
    print(f"  {BLUE}║{RESET}  {GREY}    Folder :{_fn:<{_inn-10}}{BLUE}║{RESET}")
    print(f"  {BLUE}╚{'═'*_bw}╝{RESET}")
    print()

    php_proc = None; cf_proc = None

    if web_file:
        stop_s = threading.Event()
        t_s = threading.Thread(target=_spin, args=("Setting up server", stop_s), daemon=True)
        t_s.start()
        php_ready = ensure_php()
        stop_s.set(); t_s.join()
        if not php_ready:
            slow(f"  {RED}✗  PHP install failed.{RESET}")
            print(); input(GREEN+"  Press Enter..."+RESET); return

        port = free_port()
        stop_p = threading.Event()
        t_p = threading.Thread(target=_spin, args=(f"Starting PHP server on port {port}", stop_p), daemon=True)
        t_p.start()
        php_exe = find_php()
        try:
            php_proc = subprocess.Popen([php_exe, '-S', f'0.0.0.0:{port}', '-t', folder_path], stdout=subprocess.DEVNULL, stderr=subprocess.DEVNULL, cwd=folder_path)
            time.sleep(1.0)
            if php_proc.poll() is not None: raise RuntimeError("PHP exited immediately")
            php_ok = False
            for attempt in range(8):
                try:
                    urllib.request.urlopen(f'http://127.0.0.1:{port}', timeout=2); php_ok = True; break
                except urllib.error.HTTPError: php_ok = True; break
                except Exception: time.sleep(0.5)
            if not php_ok: raise RuntimeError("PHP not responding on port")
            stop_p.set(); t_p.join()
            slow(f"  {GREEN}✓  PHP running → http://127.0.0.1:{port}{RESET}")
        except Exception as e:
            stop_p.set(); t_p.join()
            slow(f"  {RED}✗  PHP failed: {e}{RESET}")
            if php_proc and php_proc.poll() is None: php_proc.terminate()
            print(); input(GREEN+"  Press Enter..."+RESET); return
        print()

        stop_c = threading.Event()
        t_c = threading.Thread(target=_spin, args=("Checking Cloudflared", stop_c), daemon=True)
        t_c.start()
        cf_cmd = ensure_cloudflared()
        stop_c.set(); t_c.join()
        if not cf_cmd:
            slow(f"  {RED}✗  Cloudflared install failed!{RESET}")
            if php_proc and php_proc.poll() is None: php_proc.terminate()
            print(); input(GREEN+"  Press Enter..."+RESET); return

        stop_t = threading.Event()
        t_t = threading.Thread(target=_spin, args=("Launching Cloudflared", stop_t), daemon=True)
        t_t.start()
        cf_proc, tunnel_url = start_tunnel(cf_cmd, port)
        stop_t.set(); t_t.join()

        if not tunnel_url or tunnel_url.startswith('ERR:'):
            slow(f"  {RED}✗  Tunnel failed: {tunnel_url or 'timeout'}{RESET}")
            if cf_proc and cf_proc.poll() is None: cf_proc.terminate()
            if php_proc and php_proc.poll() is None: php_proc.terminate()
            print(); input(GREEN+"  Press Enter..."+RESET); return

        fname    = os.path.basename(web_file)
        full_url = tunnel_url if fname in ('index.php','index.html','index.htm') else tunnel_url.rstrip('/')+'/'+fname
        show_url_with_qr(full_url)

    if py_file:
        time.sleep(0.3)
        is_shell = py_file.endswith('.sh')
        if is_shell:
            if WINDOWS:
                bash_candidates = ['bash', r'C:\Program Files\Git\bin\bash.exe', r'C:\Windows\System32\bash.exe']
                bash_exe = None
                for b in bash_candidates:
                    try:
                        r = subprocess.run([b, '--version'], capture_output=True, timeout=3)
                        if r.returncode == 0: bash_exe = b; break
                    except Exception: continue
                if not bash_exe:
                    slow(f"  {RED}✗  .sh files need Git Bash or WSL on Windows.{RESET}")
                    slow(f"  {YELLOW}  Install: https://git-scm.com/download/win{RESET}")
                    for _p in [cf_proc, php_proc]:
                        try:
                            if _p and _p.poll() is None: _p.terminate()
                        except Exception: pass
                    print(); input(GREEN+"  Press Enter..."+RESET); return
                cmd = [bash_exe, py_file]
            else:
                cmd = ['bash', py_file]
        else:
            cmd = [sys.executable, py_file]
        try:
            subprocess.run(cmd, cwd=folder_path)
        except KeyboardInterrupt: pass
        except Exception as e: slow(f"  {RED}✗  {e}{RESET}")
    else:
        try:
            while True:
                if php_proc and php_proc.poll() is not None: slow(f"\n  {RED}[!]{RESET} PHP server stopped!"); break
                if cf_proc and cf_proc.poll() is not None: slow(f"\n  {RED}[!]{RESET} Tunnel stopped!"); break
                time.sleep(1)
        except KeyboardInterrupt: pass

    print()
    slow(f"  {YELLOW}[-]{RESET} Stopping all...")
    for p in [cf_proc, php_proc]:
        try:
            if p and p.poll() is None: p.terminate(); p.wait(timeout=3)
        except Exception: pass
    slow(f"  {GREEN}✓  Done.{RESET}")
    print()
    input(GREEN+"  Press Enter to return to menu..."+RESET)

# ══════════════════════════════════════════════════════════════════════
#  FOLDER MENU
# ══════════════════════════════════════════════════════════════════════
# ── Fixed allowed folder names (dot-prefix = hidden on Linux/Termux) ────
ALLOWED_FOLDERS = [
    ".CLOUDE-PLUS",  ".DRIVE-TRACE",  ".EMAIL-TRACE",  ".GAME-TRACE",
    ".GPT-PLUS",  ".INSTA-TRACE",  ".IP-TRACE",  ".MEGA-TRACE",
    ".MOBILE-TRACE",  ".TELEGRAM-TRACE", ".URL-TRACE", ".ZOOM-TRACE"
]

def _load_folders():
    """Return only folders from ALLOWED_FOLDERS that exist on disk."""
    try:
        entries = [
            f for f in ALLOWED_FOLDERS
            if os.path.isdir(os.path.join(SCRIPT_DIR, f))
        ]
        return entries if entries else []
    except Exception:
        return []

FOLDER_ORDER = _load_folders()

def show_menu():
    _tw2  = _get_tw()
    n     = len(FOLDER_ORDER)
    # ── Responsive columns ──
    if n == 0:
        print()
        slow(f"  {YELLOW}[!]{RESET} No folders found. Create .folder1 to .folder12 directory first.")
        print()
        _mpre = '' if _tw2 < 80 else '\t'
    elif _tw2 < 50:   n_cols = 1
    elif _tw2 < 80: n_cols = 2
    else:           n_cols = 3 if n >= 3 else max(1, n)
    n_rows = (n + n_cols - 1) // n_cols if n > 0 else 0
    _mpre = '' if _tw2 < 80 else '\t'
    print()
    for row in range(n_rows):
        parts = []
        for col in range(n_cols):
            idx = col * n_rows + row
            if idx >= n: break
            parts.append(RED+'['+WHITE+f'{idx+1:02d}'+RED+']  '+ORANGE+f'{FOLDER_ORDER[idx].lstrip("."):<12}'+RESET)
        if parts:
            slow(_mpre+'   '.join(parts), delay=0.001)
            print()
    print()
    slow(_mpre+RED+'['+WHITE+'99'+RED+']  '+ORANGE+f'{"About":<12}'+RESET
         +'   '+RED+'['+WHITE+'00'+RED+']  '+ORANGE+'Exit'+RESET, delay=0.001)
    print()

def about_screen():
    clear(); baner(); print()
    _tw4 = _get_tw()
    _bw  = min(50, max(36, _tw4 - 4))
    _title = " About TRACE-X Tool "
    _pad = max(0, (_bw - len(_title) - 2) // 2)
    print(f"  {BLUE}╔{'═'*_bw}╗{RESET}")
    print(f"  {BLUE}║{WHITE}{' '*_pad}{_title}{' '*max(0, (_bw - _pad - len(_title) -1 ))}{BLUE} ║{RESET}")
    print(f"  {BLUE}╚{'═'*_bw}╝{RESET}")
    print()
    slow(f"  {WHITE}Version   :{RESET}  {YELLOW}Version 3.4 {RESET}")
    slow(f"  {WHITE}Author    :{RESET}  {GREY}Jay Joshi{RESET}")
    slow(f"  {WHITE}GitHub    :{RESET}  {GREEN}https://github.com/deva3047{RESET}")
    slow(f"  {WHITE}LinkdIn   :{RESET}  {GREEN}https://www.linkedin.com/in/jay-joshi-2686aa383{RESET}")
    slow(f"  {WHITE}Script Dir:{RESET}  {ORANGE}{SCRIPT_DIR}{RESET}")
    print()
    slow(f"  {WHITE}Clipboard :{RESET}  {GREEN}Auto copy (No button needed){RESET}")
    slow(f"  {WHITE}Platforms :{RESET}  {BLUE}Windows | Linux | Termux{RESET}")
    print()
    input(GREEN+"  Press Enter to go back..."+RESET)

def _run_with_spinner(msg, done_msg, fn):
    stop = threading.Event()
    t = threading.Thread(target=_spin, args=(msg, stop), daemon=True)
    t.start()
    fn()
    stop.set(); t.join()
    slow(f"  {GREEN}[-]{RESET} {done_msg}")
    print()

def startup_checks():
    print()
    def install_packages():
        try:
            import qrcode; from PIL import Image
        except ImportError:
            if TERMUX:
                subprocess.run(['pkg', 'install', '-y', 'python-pillow'], capture_output=True, timeout=120)
                subprocess.run([sys.executable, '-m', 'pip', 'install', 'qrcode', '-q', '--break-system-packages'], capture_output=True, timeout=120)
            else:
                r = subprocess.run([sys.executable, '-m', 'pip', 'install', 'qrcode[pil]', 'Pillow', '-q'], capture_output=True, timeout=120)
                if r.returncode != 0:
                    subprocess.run([sys.executable, '-m', 'pip', 'install', 'qrcode[pil]', 'Pillow', '-q', '--break-system-packages'], capture_output=True, timeout=120)
    _run_with_spinner("Installing required packages", "Packages ready", install_packages)

    stop = threading.Event()
    t = threading.Thread(target=_spin, args=("Checking internet", stop), daemon=True)
    t.start()
    try:
        urllib.request.urlopen('https://api.ipify.org', timeout=4)
        inet = GREEN+"Online"+RESET
    except Exception:
        inet = RED+"Offline"+RESET
    stop.set(); t.join()
    slow(f"  {GREEN}[-]{RESET} Internet Status : {inet}")
    print()

    _run_with_spinner("Checking for update", "Up to date", lambda: time.sleep(0.3))

    stop2 = threading.Event()
    t2 = threading.Thread(target=_spin, args=("Checking Cloudflared", stop2), daemon=True)
    t2.start()
    cf = find_cloudflared()
    stop2.set(); t2.join()

    if cf:
        slow(f"  {GREEN}[-]{RESET} Cloudflared : {GREEN}Already installed{RESET}")
    else:
        cf_result = [False]
        def do_install_cf():
            cf_result[0] = install_cloudflared()
        _run_with_spinner("Installing Cloudflared", "Cloudflared ready", do_install_cf)
        if not cf_result[0]:
            slow(f"  {YELLOW}[-]{RESET} Cloudflared install failed.")
    print()
    time.sleep(0.5)

# ══════════════════════════════════════════════════════════════════════
#  MAIN
# ══════════════════════════════════════════════════════════════════════
def main():
    clear(); baner()
    startup_checks()
    while True:
        global FOLDER_ORDER
        FOLDER_ORDER = _load_folders()
        clear(); baner()
        show_menu()
        try:
            ch = int(input(PUR+'Choose Your Choice: '+RESET).strip())
        except ValueError:
            slow(f"  {RED}Invalid choice.{RESET}"); time.sleep(1); continue
        except (KeyboardInterrupt, EOFError):
            slow(f"  {GREEN}Exiting...{RESET}"); sys.exit(0)

        if   ch == 0 : slow(f"  {GREEN}Exiting...{RESET}"); sys.exit(0)
        elif ch == 99: about_screen()
        elif 1 <= ch <= len(FOLDER_ORDER): run_folder_tool(FOLDER_ORDER[ch-1])
        else: slow(f"  {RED}Invalid choice.{RESET}"); time.sleep(1)

if __name__ == "__main__":
    main()