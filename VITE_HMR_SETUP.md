# Vite Hot Module Reloading (HMR) Setup

## Summary
Hot Module Reloading allows CSS and JavaScript changes to appear instantly in the browser without rebuilding or refreshing.

## The Actual Fix

The key issues were:
1. Vite dev server was running on your **host machine**, but TYPO3 runs **inside DDEV container** - they couldn't communicate
2. Browser was trying to connect to `localhost:5173` which doesn't exist from the browser's perspective

### Solution: Run Vite INSIDE DDEV Container

**Required Changes:**

1. **`.ddev/config.yaml`** - Expose Vite port through DDEV router:
```yaml
web_extra_exposed_ports:
- name: vite
  container_port: 5173
  http_port: 5173
  https_port: 5174
```

2. **`config/system/settings.php`** - Configure Vite asset collector:
```php
'vite_asset_collector' => [
    'defaultManifest' => '_assets/vite/.vite/manifest.json',
    'devServerUri' => 'https://zeltlager-kleiner-odenwald.ddev.site:5174',
    'useDevServer' => '1',
],
```

3. **`vite.config.js`** - Make Vite listen on all interfaces (0.0.0.0):
```javascript
export default defineConfig({
    plugins: [
        typo3({
            input: [
                "packages/thurau_dev/Resources/Private/Scripts/Main.entry.js",
                "packages/thurau_dev/Resources/Private/Styles/Styles.entry.css",
            ],
        }),
    ],
    server: {
        port: 5173,
        strictPort: true,
        host: "0.0.0.0",  // Critical: allows access from DDEV router
        origin: "http://localhost:5173",
    },
});
```

4. **`.ddev/commands/web/vite-dev`** - Custom DDEV command:
```bash
#!/bin/bash
cd /var/www/html && pnpm run dev
```

## Usage

### Development (with HMR):
```bash
# Terminal 1: Start Vite dev server inside DDEV
ddev vite-dev

# Make changes to CSS/JS files - they auto-reload in browser!
```

### Production Build:
```bash
pnpm run build
```

## How It Works

1. Vite runs **inside** DDEV container on port 5173
2. DDEV router exposes this as `https://zeltlager-kleiner-odenwald.ddev.site:5174`
3. Browser loads assets from this URL (accessible from your computer)
4. TYPO3 (inside container) connects to `localhost:5173` (same container)
5. When you save a file, Vite sends update to browser via WebSocket → instant reload!

## Files Modified
- `.ddev/config.yaml` - Port exposure
- `.ddev/commands/web/vite-dev` - Custom command
- `config/system/settings.php` - Vite configuration
- `vite.config.js` - Server binding
- `package.json` - npm scripts

## Troubleshooting

**Assets still loading from `/_assets/vite/`?**
```bash
ddev typo3 cache:flush
# Hard refresh browser (Cmd+Shift+R)
```

**Port 5173 already in use?**
```bash
ddev exec "pkill -9 -f vite"
ddev vite-dev
```

**Changes not appearing?**
- Ensure `ddev vite-dev` is running and shows "VITE v7.3.1 ready"
- Check browser console for connection errors
- Verify assets load from `https://...ddev.site:5174/` not `/_assets/`
