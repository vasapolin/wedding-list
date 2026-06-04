<laravel-boost-guidelines>
=== foundation rules ===

# Laravel Boost Guidelines

The Laravel Boost guidelines are specifically curated by Laravel maintainers for this application. These guidelines should be followed closely to ensure the best experience when building Laravel applications.

## Foundational Context

This application is a Laravel application and its main Laravel ecosystems package & versions are below. You are an expert with them all. Ensure you abide by these specific packages & versions.

- php - 8.2.29
- laravel/framework (LARAVEL) - v12
- laravel/prompts (PROMPTS) - v0
- laravel/boost (BOOST) - v2
- laravel/mcp (MCP) - v0
- laravel/pail (PAIL) - v1
- laravel/pint (PINT) - v1
- laravel/sail (SAIL) - v1
- phpunit/phpunit (PHPUNIT) - v11
- alpinejs (ALPINEJS) - v3
- tailwindcss (TAILWINDCSS) - v4

## Skills Activation

This project has domain-specific skills available. You MUST activate the relevant skill whenever you work in that domain—don't wait until you're stuck.

- `tailwindcss-development` — Styles applications using Tailwind CSS v4 utilities. Activates when adding styles, restyling components, working with gradients, spacing, layout, flex, grid, responsive design, dark mode, colors, typography, or borders; or when the user mentions CSS, styling, classes, Tailwind, restyle, hero section, cards, buttons, or any visual/UI changes.

## Conventions

- You must follow all existing code conventions used in this application. When creating or editing a file, check sibling files for the correct structure, approach, and naming.
- Use descriptive names for variables and methods. For example, `isRegisteredForDiscounts`, not `discount()`.
- Check for existing components to reuse before writing a new one.

## Verification Scripts

- Do not create verification scripts or tinker when tests cover that functionality and prove they work. Unit and feature tests are more important.

## Application Structure & Architecture

- Stick to existing directory structure; don't create new base folders without approval.
- Do not change the application's dependencies without approval.

## Frontend Bundling

- If the user doesn't see a frontend change reflected in the UI, it could mean they need to run `npm run build`, `npm run dev`, or `composer run dev`. Ask them.

## Documentation Files

- You must only create documentation files if explicitly requested by the user.

## Replies

- Be concise in your explanations - focus on what's important rather than explaining obvious details.

=== boost rules ===

# Laravel Boost

- Laravel Boost is an MCP server that comes with powerful tools designed specifically for this application. Use them.

## Artisan

- Use the `list-artisan-commands` tool when you need to call an Artisan command to double-check the available parameters.

## URLs

- Whenever you share a project URL with the user, you should use the `get-absolute-url` tool to ensure you're using the correct scheme, domain/IP, and port.

## Tinker / Debugging

- You should use the `tinker` tool when you need to execute PHP to debug code or query Eloquent models directly.
- Use the `database-query` tool when you only need to read from the database.
- Use the `database-schema` tool to inspect table structure before writing migrations or models.

## Reading Browser Logs With the `browser-logs` Tool

- You can read browser logs, errors, and exceptions using the `browser-logs` tool from Boost.
- Only recent browser logs will be useful - ignore old logs.

## Searching Documentation (Critically Important)

- Boost comes with a powerful `search-docs` tool you should use before trying other approaches when working with Laravel or Laravel ecosystem packages. This tool automatically passes a list of installed packages and their versions to the remote Boost API, so it returns only version-specific documentation for the user's circumstance. You should pass an array of packages to filter on if you know you need docs for particular packages.
- Search the documentation before making code changes to ensure we are taking the correct approach.
- Use multiple, broad, simple, topic-based queries at once. For example: `['rate limiting', 'routing rate limiting', 'routing']`. The most relevant results will be returned first.
- Do not add package names to queries; package information is already shared. For example, use `test resource table`, not `filament 4 test resource table`.

### Available Search Syntax

1. Simple Word Searches with auto-stemming - query=authentication - finds 'authenticate' and 'auth'.
2. Multiple Words (AND Logic) - query=rate limit - finds knowledge containing both "rate" AND "limit".
3. Quoted Phrases (Exact Position) - query="infinite scroll" - words must be adjacent and in that order.
4. Mixed Queries - query=middleware "rate limit" - "middleware" AND exact phrase "rate limit".
5. Multiple Queries - queries=["authentication", "middleware"] - ANY of these terms.

=== php rules ===

# PHP

- Always use curly braces for control structures, even for single-line bodies.

## Constructors

- Use PHP 8 constructor property promotion in `__construct()`.
    - `public function __construct(public GitHub $github) { }`
- Do not allow empty `__construct()` methods with zero parameters unless the constructor is private.

## Type Declarations

- Always use explicit return type declarations for methods and functions.
- Use appropriate PHP type hints for method parameters.

<!-- Explicit Return Types and Method Params -->
```php
protected function isAccessible(User $user, ?string $path = null): bool
{
    ...
}
```

## Enums

- Typically, keys in an Enum should be TitleCase. For example: `FavoritePerson`, `BestLake`, `Monthly`.

## Comments

- Prefer PHPDoc blocks over inline comments. Never use comments within the code itself unless the logic is exceptionally complex.

## PHPDoc Blocks

- Add useful array shape type definitions when appropriate.

=== laravel/core rules ===

# Do Things the Laravel Way

- Use `php artisan make:` commands to create new files (i.e. migrations, controllers, models, etc.). You can list available Artisan commands using the `list-artisan-commands` tool.
- If you're creating a generic PHP class, use `php artisan make:class`.
- Pass `--no-interaction` to all Artisan commands to ensure they work without user input. You should also pass the correct `--options` to ensure correct behavior.

## Database

- Always use proper Eloquent relationship methods with return type hints. Prefer relationship methods over raw queries or manual joins.
- Use Eloquent models and relationships before suggesting raw database queries.
- Avoid `DB::`; prefer `Model::query()`. Generate code that leverages Laravel's ORM capabilities rather than bypassing them.
- Generate code that prevents N+1 query problems by using eager loading.
- Use Laravel's query builder for very complex database operations.

### Model Creation

- When creating new models, create useful factories and seeders for them too. Ask the user if they need any other things, using `list-artisan-commands` to check the available options to `php artisan make:model`.

### APIs & Eloquent Resources

- For APIs, default to using Eloquent API Resources and API versioning unless existing API routes do not, then you should follow existing application convention.

## Controllers & Validation

- Always create Form Request classes for validation rather than inline validation in controllers. Include both validation rules and custom error messages.
- Check sibling Form Requests to see if the application uses array or string based validation rules.

## Authentication & Authorization

- Use Laravel's built-in authentication and authorization features (gates, policies, Sanctum, etc.).

## URL Generation

- When generating links to other pages, prefer named routes and the `route()` function.

## Queues

- Use queued jobs for time-consuming operations with the `ShouldQueue` interface.

## Configuration

- Use environment variables only in configuration files - never use the `env()` function directly outside of config files. Always use `config('app.name')`, not `env('APP_NAME')`.

## Testing

- When creating models for tests, use the factories for the models. Check if the factory has custom states that can be used before manually setting up the model.
- Faker: Use methods such as `$this->faker->word()` or `fake()->randomDigit()`. Follow existing conventions whether to use `$this->faker` or `fake()`.
- When creating tests, make use of `php artisan make:test [options] {name}` to create a feature test, and pass `--unit` to create a unit test. Most tests should be feature tests.

## Vite Error

- If you receive an "Illuminate\Foundation\ViteException: Unable to locate file in Vite manifest" error, you can run `npm run build` or ask the user to run `npm run dev` or `composer run dev`.

=== laravel/v12 rules ===

# Laravel 12

- CRITICAL: ALWAYS use `search-docs` tool for version-specific Laravel documentation and updated code examples.
- Since Laravel 11, Laravel has a new streamlined file structure which this project uses.

## Laravel 12 Structure

- In Laravel 12, middleware are no longer registered in `app/Http/Kernel.php`.
- Middleware are configured declaratively in `bootstrap/app.php` using `Application::configure()->withMiddleware()`.
- `bootstrap/app.php` is the file to register middleware, exceptions, and routing files.
- `bootstrap/providers.php` contains application specific service providers.
- The `app\Console\Kernel.php` file no longer exists; use `bootstrap/app.php` or `routes/console.php` for console configuration.
- Console commands in `app/Console/Commands/` are automatically available and do not require manual registration.

## Database

- When modifying a column, the migration must include all of the attributes that were previously defined on the column. Otherwise, they will be dropped and lost.
- Laravel 12 allows limiting eagerly loaded records natively, without external packages: `$query->latest()->limit(10);`.

### Models

- Casts can and likely should be set in a `casts()` method on a model rather than the `$casts` property. Follow existing conventions from other models.

=== pint/core rules ===

# Laravel Pint Code Formatter

- You must run `vendor/bin/pint --dirty --format agent` before finalizing changes to ensure your code matches the project's expected style.
- Do not run `vendor/bin/pint --test --format agent`, simply run `vendor/bin/pint --format agent` to fix any formatting issues.

=== phpunit/core rules ===

# PHPUnit

- This application uses PHPUnit for testing. All tests must be written as PHPUnit classes. Use `php artisan make:test --phpunit {name}` to create a new test.
- If you see a test using "Pest", convert it to PHPUnit.
- Every time a test has been updated, run that singular test.
- When the tests relating to your feature are passing, ask the user if they would like to also run the entire test suite to make sure everything is still passing.
- Tests should cover all happy paths, failure paths, and edge cases.
- You must not remove any tests or test files from the tests directory without approval. These are not temporary or helper files; these are core to the application.

## Running Tests

- Run the minimal number of tests, using an appropriate filter, before finalizing.
- To run all tests: `php artisan test --compact`.
- To run all tests in a file: `php artisan test --compact tests/Feature/ExampleTest.php`.
- To filter on a particular test name: `php artisan test --compact --filter=testName` (recommended after making a change to a related file).

=== tailwindcss/core rules ===

# Tailwind CSS

- Always use existing Tailwind conventions; check project patterns before adding new ones.
- IMPORTANT: Always use `search-docs` tool for version-specific Tailwind CSS documentation and updated code examples. Never rely on training data.
- IMPORTANT: Activate `tailwindcss-development` every time you're working with a Tailwind CSS or styling-related task.

</laravel-boost-guidelines>

## Deployment

This app targets **Coolify** (self-hosted PaaS, Docker-based). The GitHub Actions auto-deploy workflow was removed on purpose; do not re-add it without asking. The previous Fly.io setup was abandoned (2026-06-04).

### Production

- **Public URL**: https://wedding.vasapolin.com (custom domain; SSL via Coolify's Traefik + Let's Encrypt)
- **Runtime**: FrankenPHP (`dunglas/frankenphp:1-php8.2`) — single-binary, Caddy + PHP, no nginx/fpm/s6. Listens on port **8080**.
- **Database**: SQLite on a Coolify persistent volume mounted at `/data`, file at `/data/database.sqlite`
- **Sessions / cache**: cookie-based (no DB session table needed for sessions); cache uses `database` driver

### Coolify setup (when creating the resource)

- Build pack: **Dockerfile** (repo root `Dockerfile`).
- Persistent Storage: add a volume mounted at **`/data`** (holds SQLite DB + uploads). Without it, data is wiped on every deploy.
- Port: expose **8080** (`SERVER_NAME=:8080` is baked into the image).
- Healthcheck: `GET /up` on port 8080.
- Replicas: keep at **1** — SQLite + single volume cannot serve multiple containers.
- Environment variables (set in the Coolify UI; the old `fly.toml` `[env]` block carried these):

```
APP_ENV=production
APP_DEBUG=false
APP_KEY=<secret>
APP_URL=https://wedding.vasapolin.com
APP_LOCALE=pt_BR
APP_FALLBACK_LOCALE=en
DB_CONNECTION=sqlite
DB_DATABASE=/data/database.sqlite
CACHE_STORE=database
SESSION_DRIVER=cookie
SESSION_SECURE_COOKIE=true
QUEUE_CONNECTION=sync
LOG_CHANNEL=stderr
LOG_LEVEL=info
ASAAS_API_KEY=<secret>
ASAAS_WEBHOOK_TOKEN=<secret>
ASAAS_ENV=production
```

### Key deployment files

- `Dockerfile` — 3-stage build (composer deps → vite build → FrankenPHP runtime). Composer binary copied from the `composer:2` image into the runtime stage so `dump-autoload` works post-build.
- `docker/entrypoint.sh` — runs at every container boot, ordered: ensure `/data/database.sqlite` exists and is `www-data`-owned → symlink uploads to `/data/uploads` → `php artisan migrate --force` → cache config/routes/views → `exec` into FrankenPHP.
- `bootstrap/app.php` has `trustProxies(at: '*')` — required so Laravel respects Traefik's proxy headers and generates `https://` URLs.

### Env vars / secrets

- All runtime env (including secrets) is managed in the **Coolify UI** for the resource.
- **Never** commit a `.env` for production.

### Gotchas

- Single container only — SQLite + a single volume cannot be shared across replicas. Don't scale past 1.
- Cache files written by `php artisan *:cache` at boot live in the container's ephemeral FS, not on the volume — they rebuild every container restart, which is fine.
- The `docker/entrypoint.sh` runs as **root** so it can `chown /data`. FrankenPHP itself drops to `www-data` for request handling per the Caddyfile.
- If Cloudflare fronts the domain, either use **DNS only** (gray cloud) or, if Proxied, set SSL mode to **Full (strict)** so Traefik's Let's Encrypt HTTP-01 challenge still works (DNS only is the simpler, known-good option).

### Admin panel (Filament v5)

- URL: `/admin` (login at `/admin/login`).
- Default seeded login: `victor.vencedor2005@gmail.com` / `laura-victor-2026`. Configurable via `WEDDING_ADMIN_EMAIL` / `WEDDING_ADMIN_PASSWORD` env vars (only used on first seed; later password changes via the admin UI persist on the volume's SQLite).
- Resources live in `app/Filament/Resources/{Gifts,Donations,SiteAssets}` (one folder per Resource per Filament v5 convention).
- `Gift::booted()` auto-generates a unique slug if missing. The `WithoutModelEvents` trait on `DatabaseSeeder` bypasses this — seeders set `slug` explicitly.
- Image uploads write to `storage/app/public/{gifts,site}/` which the entrypoint symlinks to `/data/uploads` so they survive deploys.

### Asaas integration

- `App\Services\AsaasClient` is a thin wrapper around `Http::baseUrl(...)`. If `ASAAS_API_KEY` is empty, all methods no-op so dev/staging keep working.
- `createCharge()` handles both Pix (QR code fetched and stored in `asaas_payload`) and credit card (donor is redirected to the Asaas-hosted `invoiceUrl`). Charges send a `callback.successUrl`; if the Asaas account has no registered domain the API rejects it and the client automatically retries without the callback.
- Donors must provide CPF/CNPJ (`donor_document`, validated by `App\Rules\CpfOuCnpj`, stored digits-only) — Asaas requires `cpfCnpj` on customers.
- Set `ASAAS_API_KEY` (and `ASAAS_WEBHOOK_TOKEN`) as env vars in Coolify, plus `ASAAS_ENV=production` when going live (defaults to `sandbox`).
- Webhook endpoint: `POST /api/asaas-webhook` (already excluded from CSRF in `bootstrap/app.php`). Configure this URL in the Asaas dashboard. If `ASAAS_WEBHOOK_TOKEN` is set, requests must send the `asaas-access-token` header matching it.
- The webhook handler increments `gifts.raised_cents` only on first transition to PAID (idempotent) and decrements it when a paid donation is refunded. The donation status page also polls Asaas (`syncStatus`) as a webhook fallback.
- Tests never hit the network: `phpunit.xml` blanks `ASAAS_API_KEY` and `tests/TestCase.php` calls `Http::preventStrayRequests()`.

### Domain model

- `gifts` — wedding gifts; price/raised stored in cents; `is_active` + `sort_order` control public listing.
- `donations` — pending → paid lifecycle driven by Asaas webhook. `gift_id` is nullable (cart/free donations aren't tied to a single gift).
- `messages` — public mural; `is_approved` defaults to true (no moderation v1).
- `site_assets` — keyed CMS images (e.g. `home.hero`, `home.gallery.1`); `SiteAsset::url($key, $default)` reads the upload or `fallback_url`.

### Cart

- `App\Services\Cart` reads/writes session under `wedding_cart`. Globally injected into Blade views as `$cart` via `View::composer('*')` in `AppServiceProvider`.

