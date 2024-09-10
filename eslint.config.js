import js from '@eslint/js'
import eslintPluginVue from 'eslint-plugin-vue'
import ts from 'typescript-eslint'

export default ts.config(
  js.configs.recommended,
  ...ts.configs.recommended,
  ...eslintPluginVue.configs['flat/recommended'],
  {
    ignores: ['public/build/**/*', 'vendor/**/*'],
    files: ['*.vue', '**/*.vue'],
    languageOptions: {
      globals: {
        route: 'readonly',
      },
      parserOptions: {
        parser: '@typescript-eslint/parser',
      },
    },
  },
)
