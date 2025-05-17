import type { Bud } from '@roots/bud';
import { promises as fs } from 'fs';
import path from 'path';

/**
 * bud.js configuration
 */
export default async (bud: Bud) => {
  const modulesDir = path.resolve(__dirname, 'src/Modules');
  const possibleEntryPoints = ['main.ts', 'index.ts', 'index.tsx']; // Define possible entry point file names
  const entries: Record<string, string[]> = {};

  try {
    // Read all module directories
    const moduleFolders = await fs.readdir(modulesDir, { withFileTypes: true });

    for (const folder of moduleFolders) {
      if (folder.isDirectory()) {
        const clientDir = path.join(modulesDir, folder.name, 'client');

        // Check if the client folder exists
        try {
          const clientFiles = await fs.readdir(clientDir, { withFileTypes: true });

          // Find the first matching entry point file
          const entryFile = clientFiles.find(
            (file) => file.isFile() && possibleEntryPoints.includes(file.name)
          );

          // Collect all .css files in the root or in the style subfolder
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

          // Add entry if a valid entry point file is found
          if (entryFile) {
            const entryKey = folder.name.toLowerCase(); // Convert folder name to lowercase
            entries[entryKey] = [
              path.resolve(clientDir, entryFile.name),
              ...styleFiles,
            ];
          }
        } catch {
          // Skip if the client folder doesn't exist
          continue;
        }
      }
    }

    // Register entries with Bud.js
    for (const [entryName, files] of Object.entries(entries)) {
      bud.entry(entryName, files).html();
    }
  } catch (error) {
    console.error('Error generating Bud.js config:', error);
  }
};
