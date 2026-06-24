import time
import os
import sys
import threading

# ANSI Colors
GREEN  = "\033[92m"
CYAN   = "\033[96m"
YELLOW = "\033[93m"
RESET  = "\033[0m"
BOLD   = "\033[1m"

# ── Platform Check ─────────────────────────────────────────────────────
IS_TERMUX = "com.termux" in os.environ.get("PREFIX", "") or \
            os.path.exists("/data/data/com.termux")
IS_WINDOWS = sys.platform == "win32"

# ── ROOT = script jis folder mein hai, wahi folder watch karo ──────────
ROOT = os.path.dirname(os.path.abspath(__file__))

files_to_watch = [
    os.path.join(ROOT, "ip.txt"),
    os.path.join(ROOT, "locations.txt"),
]

# ── Spinner Animation ──────────────────────────────────────────────────
_stop_spinner = threading.Event()

def spinner(message="Waiting for data"):
    frames = ["/", "-", "\\", "|"]
    i = 0
    while not _stop_spinner.is_set():
        sys.stdout.write(f"\r{CYAN}[{frames[i % 4]}] {message}...{RESET}  ")
        sys.stdout.flush()
        time.sleep(0.1)
        i += 1
    sys.stdout.write(f"\r{' ' * 40}\r")
    sys.stdout.flush()

# ── Banner ─────────────────────────────────────────────────────────────
print(f"{CYAN}{BOLD}Live File Monitor (Ctrl + C to stop){RESET}")
print()

# ── Files exist nahi hain to create karo (empty) ──────────────────────
for file in files_to_watch:
    if not os.path.exists(file):
        open(file, 'w').close()

# ── Initial sizes ──────────────────────────────────────────────────────
last_sizes = {f: os.path.getsize(f) for f in files_to_watch}

# ── Spinner start karo ────────────────────────────────────────────────
spin_thread = threading.Thread(target=spinner, daemon=True)
spin_thread.start()

# ── Watch loop ─────────────────────────────────────────────────────────
try:
    while True:
        for file in files_to_watch:
            try:
                size = os.path.getsize(file)
                if size > last_sizes[file]:
                    with open(file, "r", encoding="utf-8", errors="ignore") as f:
                        f.seek(last_sizes[file])
                        new_data = f.read()

                    # Spinner rok do
                    _stop_spinner.set()
                    spin_thread.join()

                    print(f"\n{YELLOW}" + "="*50 + f"{RESET}")
                    print(f"{GREEN}[+] FILE UPDATED : {os.path.basename(file)}{RESET}")
                    print(f"{YELLOW}" + "="*50 + f"{RESET}")
                    print(f"{CYAN}{new_data}{RESET}", end="", flush=True)

                    last_sizes[file] = size

                    # Spinner dobara chalu
                    _stop_spinner.clear()
                    spin_thread = threading.Thread(target=spinner, daemon=True)
                    spin_thread.start()

                elif size < last_sizes[file]:
                    last_sizes[file] = size

            except FileNotFoundError:
                open(file, 'w').close()
                last_sizes[file] = 0
            except Exception:
                pass

        time.sleep(1)

except KeyboardInterrupt:
    _stop_spinner.set()
    spin_thread.join()
    print(f"\n{YELLOW}[!] Monitor stopped.{RESET}")
    sys.exit(0)
