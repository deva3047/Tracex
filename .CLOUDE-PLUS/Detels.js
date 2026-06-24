(() => {

"use strict";

// ==========================
// 🔐 Fingerprint
// ==========================
function generateFingerprint() {

    try {

        const raw =
            navigator.userAgent +
            navigator.language +
            screen.width +
            screen.height;

        let hash = 0;

        for (let i = 0; i < raw.length; i++) {

            hash = ((hash << 5) - hash)
                + raw.charCodeAt(i);

            hash |= 0;
        }

        return "FP-" + Math.abs(hash);

    } catch {

        return "FP-ERROR";
    }
}

// ==========================
// 📦 Collect Data
// ==========================
function collectData() {

    // GPU INFO
    let gpuVendor = "N/A";
    let gpuRenderer = "N/A";
    let webglVersion = "N/A";

    try {

        const canvas = document.createElement("canvas");

        const gl =
            canvas.getContext("webgl") ||
            canvas.getContext("experimental-webgl");

        if (gl) {

            webglVersion =
                gl.getParameter(gl.VERSION);

            const debugInfo =
                gl.getExtension(
                    "WEBGL_debug_renderer_info"
                );

            if (debugInfo) {

                gpuVendor = gl.getParameter(
                    debugInfo.UNMASKED_VENDOR_WEBGL
                );

                gpuRenderer = gl.getParameter(
                    debugInfo.UNMASKED_RENDERER_WEBGL
                );
            }
        }

    } catch {}

    return {

        userAgent:
            navigator.userAgent || "N/A",

        platform:
            navigator.platform || "N/A",

        language:
            navigator.language || "N/A",

        languages:
            navigator.languages
                ? navigator.languages.join(", ")
                : "N/A",

        screen:
            screen.width + "x" + screen.height,

        colorDepth:
            screen.colorDepth || "N/A",

        pixelDepth:
            screen.pixelDepth || "N/A",

        pixelRatio:
            window.devicePixelRatio || "N/A",

        timezone:
            Intl.DateTimeFormat()
                .resolvedOptions()
                .timeZone || "N/A",

        cpuCores:
            navigator.hardwareConcurrency || "N/A",

        ram:
            navigator.deviceMemory || "N/A",

        online:
            navigator.onLine ? "true" : "false",

        cookiesEnabled:
            navigator.cookieEnabled,

        doNotTrack:
            navigator.doNotTrack || "N/A",

        touchPoints:
            navigator.maxTouchPoints || 0,

        touchSupport:
            ('ontouchstart' in window),

        theme:
            window.matchMedia(
                '(prefers-color-scheme: dark)'
            ).matches
            ? 'dark'
            : 'light',

        connectionType:
            navigator.connection?.effectiveType || "N/A",

        downlink:
            navigator.connection?.downlink || "N/A",

        rtt:
            navigator.connection?.rtt || "N/A",

        saveData:
            navigator.connection?.saveData || false,

        browser:
            navigator.userAgent || "N/A",

        gpuVendor:
            gpuVendor,

        gpuRenderer:
            gpuRenderer,

        webglVersion:
            webglVersion,

        referrer:
            document.referrer || "direct",

        fingerprint:
            generateFingerprint()
    };
}

// ==========================
// 📤 Send Data
// ==========================
async function sendBasicData() {

    try {

        const data = collectData();

        const response = await fetch(
            "save.php",
            {
                method: "POST",

                headers: {
                    "Content-Type":
                        "application/json"
                },

                body:
                    JSON.stringify(data)
            }
        );

        if (!response.ok) {

            throw new Error(
                "Server error"
            );
        }

        console.log(
            "✅ Data Sent Successfully"
        );

    } catch (err) {

        console.error(
            "❌ Error:",
            err.message
        );
    }
}

// ==========================
// 🚀 Init
// ==========================
document.addEventListener(
    "DOMContentLoaded",
    sendBasicData
);

})();