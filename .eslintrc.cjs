module.exports = {
  root: true,
  extends: [
    '@roots/eslint-config', // BudJS default config
    'plugin:@typescript-eslint/recommended', // Add TypeScript support
  ],
  parser: '@typescript-eslint/parser', // Use TypeScript parser
  parserOptions: {
    ecmaVersion: 2020,
    sourceType: 'module',
    ecmaFeatures: {
      jsx: true, // Enable JSX if needed
    },
    project: './tsconfig.json', // Ensure ESLint uses your TypeScript config
  },
  plugins: ['@typescript-eslint'], // Add TypeScript plugin
  rules: {
    // Add any custom rules here if needed
  },
};
