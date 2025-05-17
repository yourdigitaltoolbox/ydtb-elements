import type { Bud } from '@roots/bud';
import { promises as fs } from 'fs';
import path from 'path';

/**
 * Resolve module entries from a given directory.
 */
const resolveModuleEntries = async (
  modulesDir: string,
  possibleEntryPoints: string[]
): Promise<Record<string, string[]>> => {
  const entries: Record<string, string[]> = {};

  try {
    const moduleFolders = await fs.readdir(modulesDir, { withFileTypes: true });

    for (const folder of moduleFolders) {
      if (folder.isDirectory()) {
        const clientDir = path.join(modulesDir, folder.name, 'client');

        try {
          const clientFiles = await fs.readdir(clientDir, { withFileTypes: true });

          const entryFile = clientFiles.find(
            (file) => file.isFile() && possibleEntryPoints.includes(file.name)
          );

          const styleFiles: string[] = [];
          for (const file of clientFiles) {
            if (file.isFile() && file.name.endsWith('.css')) {
              styleFiles.push(path.resolve(clientDir, file.name));
            } else if (file.isDirectory() && file.name === 'style') {
              const styleDir = path.join(clientDir, 'style');
              const styleDirFiles = await fs.readdir(styleDir);
              styleDirFiles
                .filter((file) => file.endsWith('.css'))
                .forEach((file) =>
                  styleFiles.push(path.resolve(styleDir, file))
                );
            }
          }

          if (entryFile) {
            const entryKey = folder.name.toLowerCase();
            entries[entryKey] = [
              path.resolve(clientDir, entryFile.name),
              ...styleFiles,
            ];
          }
        } catch {
          continue;
        }
      }
    }
  } catch (error) {
    console.error('Error resolving module entries:', error);
  }

  return entries;
};

/**
 * bud.js configuration
 */
export default async (bud: Bud) => {

  // Resolve module entries
  const entries = await resolveModuleEntries(path.resolve(__dirname, 'src/Widgets'), ['main.ts', 'index.ts', 'index.tsx']);

  // Register entries with Bud.js
  for (const [entryName, files] of Object.entries(entries)) {
    bud.entry(entryName, files).html();
  }
};
