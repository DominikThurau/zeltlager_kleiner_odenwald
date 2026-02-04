import { defineConfig } from "vite";
import typo3 from "vite-plugin-typo3";

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
    host: "0.0.0.0",
    origin: "http://localhost:5173",
  },
});
