module.exports = {
  bracketSpacing: false,
  tabWidth: 2,
  printWidth: 75,
  singleQuote: true,
  useTabs: false,
  trailingComma: 'all',
  overrides: [
    {
      files: '*.d.ts',
      options: {
        parser: 'typescript',
      },
    },
  ],
};
