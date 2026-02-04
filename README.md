# Zeltlager Kleiner Odenwald

TYPO3 14 website for Zeltlager Kleiner Odenwald with custom theme and Vite hot module reloading.

## Tech Stack

- **TYPO3 CMS:** 14.x
- **PHP:** 8.3
- **Node.js:** via pnpm
- **Build Tool:** Vite with HMR support
- **Development:** DDEV local environment

## Prerequisites

- [DDEV](https://ddev.readthedocs.io/) installed
- [pnpm](https://pnpm.io/) (installed automatically via DDEV)

## Getting Started

### 1. Clone and Setup

```bash
git clone git@github.com:DominikThurau/zeltlager_kleiner_odenwald.git
cd zeltlager_kleiner_odenwald
ddev start
ddev composer install
```

### 2. Database Setup

Import your database or set up a fresh installation:

```bash
ddev typo3 setup
```

### 3. Start Development

With the ddev-vite-sidecar addon, Vite runs automatically when you start DDEV:

```bash
ddev start
```

Your site will be available at `https://zeltlager-kleiner-odenwald.ddev.site` with hot module reloading automatically enabled!

### 4. Production Build

When ready to deploy, build the production assets:

```bash
pnpm run build
```

## Project Structure

```
├── .ddev/                    # DDEV configuration
├── config/                   # TYPO3 configuration
│   ├── sites/               # Site configuration
│   └── system/              # System settings
├── packages/                 # Custom extensions
│   └── thurau_dev/          # Main theme extension
│       ├── Configuration/   # TypoScript, TCA, etc.
│       └── Resources/
│           ├── Private/     # Templates, Vite entry files
│           └── Public/      # Compiled assets
├── public/                  # Web root
├── vite.config.js          # Vite configuration
└── composer.json           # PHP dependencies
```

## Custom Extension: thurau_dev

The main theme extension located in `packages/thurau_dev/` includes:

- **PageView Templates:** Fluid templates for page layouts
- **Vite Integration:** Hot module reloading during development
- **Entry Points:**
  - `Resources/Private/Scripts/Main.entry.js`
  - `Resources/Private/Styles/Styles.entry.css`

## Available Commands

```bash
# Start DDEV
ddev start

# Stop DDEV
ddev stop

# Restart DDEV (needed after config changes)
ddev restart

# Clear TYPO3 caches
ddev typo3 cache:flush

# Install Composer dependencies
ddev composer install

# Build for production
pnpm run build

# Run any pnpm command
ddev pnpm <command>
```

## Development Workflow

1. **Start your environment:**

## Development Workflow

1. **Start your environment:**

   ```bash
   ddev start
   ```

   Vite runs automatically in the background with HMR enabled.

2. **Make changes** to files in:
3. **See instant updates** in your browser at `https://zeltlager-kleiner-odenwald.ddev.site`

4. **Clear TYPO3 cache** if template changes don't appear:
   ```bash
   ddev typo3 cache:flush
   ```

## Troubleshooting

### HMR Not Working?

1. Ensure DDEV is running: `ddev start`
2. Clear TYPO3 cache: `ddev typo3 cache:flush`
3. Hard refresh browser: `Cmd+Shift+R` (Mac) or `Ctrl+Shift+R` (Windows)
4. Check assets load from `https://vite.zeltlager-kleiner-odenwald.ddev.site/` not `/_assets/`

### Port 5173 Already in Use?

The ddev-vite-sidecar handles this automatically. If you have issues:

```bash
ddev restart
```

Restart the Vite service:

```bash
ddev restart
```

### Port 5173 Already in Use?

The ddev-vite-sidecar handles this automatically. If you have issues:

```bash
ddev exec "pkill -9 -f vite"
ddev vite-dev
```

### Assets Not Loading?

Make sure you've built them at least once:

```bash
pnpm run build
```

## Documentation

See [VITE_HMR_SETUP.md](./VITE_HMR_SETUP.md) for detailed Vite HMR configuration.

## License

See [LICENSE](./LICENSE) file.
