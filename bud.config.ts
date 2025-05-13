import type { Bud } from '@roots/bud';

/**
 * bud.js configuration
 */
export default async (bud: Bud) => {
  bud.entry('ai-chat', ['client/ai-chat/index.ts', 'client/ai-chat/index.css']).html();

};
