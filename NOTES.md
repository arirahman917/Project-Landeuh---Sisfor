# Project Notes & Rules

**CRITICAL RULE: DO NOT RUN DATABASE SEEDERS ON THE LOCAL DATABASE**
- The MySQL database on Railway (production/remote) has different contents from the local MySQL database.
- **NEVER** run any DB seeder commands (like `php artisan db:seed` or `php artisan migrate:fresh --seed`) that would modify or overwrite the contents of the local database.
