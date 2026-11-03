# AGENTS.md

Laravel 7.30 fraud-detection dashboard (Blade + AdminLTE 3, MySQL database `fraud_detection`). This is a legacy app: no API usage, no CI, no lint runner.

## Run commands with PHP 7.4 (critical)

The default `php` on this machine is 8.3, and Laravel 7 crashes immediately with `ArrayAccess` deprecation errors under it. Use Laragon's PHP 7.4 binary explicitly:

```powershell
$php = 'C:\laragon\bin\php\php-7.4.33-Win32-vc15-x64\php.exe'
& $php artisan route:list
& $php artisan migrate:status
& $php artisan serve
```

## Tests

- Full suite: `& $php artisan test` (or `& $php vendor\bin\phpunit`)
- Single test/file: `& $php artisan test --filter ExampleTest` / `& $php vendor\bin\phpunit tests/Feature/ExampleTest.php`
- Only stock example tests exist. `phpunit.xml` does not redirect the DB to sqlite (those lines are commented out), so tests that touch the DB use the real `.env` MySQL database.

## Setup

- `composer install` is enough; `vendor/` is already present.
- `.env` must exist with an `APP_KEY`. The reliable data source is `database/fraud_detection.sql`: import it into MySQL database `fraud_detection` (the dump itself names `u827858342_fraud_det`; import into the DB `.env` points at). It has the schema plus one `admin@gmail.com` user, but no `data`/`scoring` rows, so the dashboard is empty until you upload a spreadsheet.
- `php artisan migrate` alone creates empty tables and no usable login account. Don't run `migrate:fresh` on a populated DB unless intentionally wiping it.
- `npm install`/`npm run dev` are not needed for normal UI work (see below).

## Architecture

- Web entrypoints: `routes/web.php` -> controllers in `app/Http/Controllers/`. Models are `App\Data`, `App\Scoring`, and `App\User`.
- Data flow: upload -> `DataController::import_data` -> `App\Imports\DataImport` -> `data` table. `DataImport` is positional: starts at row 2, uses numeric indexes 1..61, and skips index 60, so a format change must update it. Re-uploading does not deduplicate rows.
- Uploads are validated as `csv,xls,xlsx`, but `import_data` hardcodes `\Maatwebsite\Excel\Excel::XLSX`; CSV/XLS may fail or parse wrong. The date-formatting `beforeSheet` array is the 5th argument to `Excel::import`, whose signature only takes 4 args, so it is silently ignored.
- `ScoringController::scoring` recomputes all aggregates from `data` on every request (many repeated queries, no caching). The `scoring` table/model exists but nothing writes to it. With zero rows the page redirects to `/404`.
- `GET /scoring` is declared twice in `routes/web.php`; the second (`scoring`) always wins.
- Views are flat in `resources/views/` (`user.blade.php`, `user_edit.blade.php`, etc.) plus `dashboard/`, `tables/`, `layouts/admin.blade.php`. Uploaded imports go to `public/file_data/`; user photos to `public/gambar/user/`.

## Gotchas

- Auth is hand-written (`Auth\LoginController`/`RegisterController`), not Laravel's default scaffolding. The `users` table requires non-null `level` and `foto`, but registration inserts neither, and `User::$fillable` omits both, so `UserController::user_aksi` silently drops `level`/`foto`. Use the dump's existing users or assign these attributes directly.
- `DataController::delete_data` calls `$data->delete()` again outside the loop, so it errors when `data` is empty and redundantly deletes the last row otherwise.
- Admin-only UI is cosmetic: `/user*` routes are protected by `auth` only. The `level == "admin"` check exists only in the Blade sidebar; there is no admin middleware.
- The UI loads AdminLTE from `public/AdminLTE/` via `asset()` plus CDN scripts. Custom styling lives in `public/css/theme.css` (loaded after AdminLTE in `layouts/admin.blade.php`); edit that rather than the vendored AdminLTE files. `resources/js/app.js` and `resources/sass/app.scss` are not referenced by the layouts, so webpack builds do not affect the app. Scoring charts use Highcharts from a CDN, so they need network access.
- `revolution/laravel-google-sheets` and `config/google.php` are installed but unused; don't assume Google Sheets integration is active.
- Follow `.editorconfig` (4 spaces, LF). StyleCI uses the Laravel preset; there is no local formatter/linter script.
