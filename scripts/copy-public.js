import { copyFileSync, existsSync, mkdirSync } from 'fs';
import { join } from 'path';
import { fileURLToPath } from 'url';
import { dirname } from 'path';

const __filename = fileURLToPath(import.meta.url);
const __dirname = dirname(__filename);
const rootDir = join(__dirname, '..');

// Copiar index.html de client para dist/public se não existir
const clientIndex = join(rootDir, 'client', 'index.html');
const distIndex = join(rootDir, 'dist', 'public', 'index.html');

if (existsSync(clientIndex) && !existsSync(distIndex)) {
  const distDir = join(rootDir, 'dist', 'public');
  if (!existsSync(distDir)) {
    mkdirSync(distDir, { recursive: true });
  }
  copyFileSync(clientIndex, distIndex);
  console.log('✅ Copiado index.html para dist/public');
}
