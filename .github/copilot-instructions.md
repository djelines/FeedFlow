# Project instructions for GitHub Copilot

This file contains basic guidelines for Copilot while helping in this Laravel project.

General guidance
- Use Laravel and PHP idioms (Laravel 12, PHP 8.2).
- Use Eloquent models in the App\Models namespace. The app uses PSR-4 autoloading with App namespace.
- Prefer short, expressive methods and guard clauses.

File-specific guidance
- For Policy classes, prefer returning booleans or using Laravel's Response when relevant.
- For model methods that check ownership or roles, prefer explicit checks against `organization_user` relations.

Formatting and style
- Use 4-space indentation and follow PSR-12.
- Add PHPDoc for complex public methods to improve autocompletion and type inference.

Make suggestions that are compatible with the repo's test suite and avoid adding external packages without a corresponding composer change.
