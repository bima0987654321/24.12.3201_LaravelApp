# CODE REFERENCE - MIDDLEWARE IMPLEMENTATION

## 1. IsAdmin Middleware (Complete)

**File:** `app/Http/Middleware/IsAdmin.php`

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     * Double Protection Layer:
     * Layer 1: Cek apakah user sudah login (jika belum, redirect ke halaman login admin)
     * Layer 2: Cek apakah role user adalah 'admin' (jika bukan, return 403 Forbidden)
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Layer 1: Pastikan user sudah login (authenticated)
        if (!auth()->check()) {
            return redirect()->route('admin.login');
        }

        // Layer 2: Periksa apakah role user adalah 'admin'
        if (auth()->user()->role !== 'admin') {
            return response()->json([
                'message' => 'Forbidden. Only administrators are allowed to access this resource.'
            ], 403);
        }

        return $next($request);
    }
}
```

---

## 2. Middleware Group Registration

**File:** `bootstrap/app.php`

```php
<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Mendaftarkan middleware grup 'admin' untuk double protection layer secara permanen
        // Layer 1: Cek Authentication (User sudah login)
        // Layer 2: Cek Authorization (User adalah admin)
        $middleware->group('admin', [
            \App\Http\Middleware\IsAdmin::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
```

---

## 3. Route Protection

**File:** `routes/web.php` (Admin Routes Section)

```php
Route::prefix('admin')->name('admin.')->group(function () {
    // Rute Login bebas akses (tidak perlu middleware)
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Mengamankan Route Administrasi dengan Middleware Grup 'admin' (double protection: auth + isAdmin)
    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('events', AdminEventController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('transactions', AdminTransactionsController::class);
        Route::resource('partners', PartnerController::class);
    });
});
```

---

## 4. User Model

**File:** `app/Models/User.php`

```php
<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
```

---

## 5. Migration - Users Table

**File:** `database/migrations/0001_01_01_000000_create_users_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'user'])->default('user'); // ← ROLE FIELD
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
```

---

## 6. Seeder - Test Data

**File:** `database/seeders/DatabaseSeeder.php` (User Creation Section)

```php
public function run(): void
{
    // Akun Admin
    \App\Models\User::create([
        'name' => 'Admin Amikom',
        'email' => 'admin@amikom.ac.id',
        'password' => bcrypt('password'),
        'role' => 'admin',
    ]);

    // Akun User Biasa (untuk testing non-admin access)
    \App\Models\User::create([
        'name' => 'Budi User',
        'email' => 'user@amikom.ac.id',
        'password' => bcrypt('password'),
        'role' => 'user',
    ]);
    
    // ... rest of seeder ...
}
```

---

## 7. Auth Controller (Login/Logout)

**File:** `app/Http/Controllers/Admin/AuthController.php` (Relevant Methods)

```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 1. Menampilkan halaman view formulir login
    public function showLogin() {
        return view('auth.login');
    }

    // 2. Memproses validasi dan login
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau Password yang Anda berikan tidak terdaftar di rekaman kami.',
        ]);
    }

    // 3. Memproses logout (keluar)
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
```

---

## 8. HTTP Middleware Stack (Default Laravel)

**File:** `app/Http/Kernel.php` (for reference - Laravel 11 uses bootstrap/app.php)

In modern Laravel (11+), middleware is configured in `bootstrap/app.php` instead of `Kernel.php`.

---

## 9. Protected Routes List

```
Protected by 'admin' middleware group:

1. /admin/dashboard (GET)
   - Route: admin.dashboard
   - Controller: DashboardController@index

2. /admin/events (Multiple methods)
   - Routes: admin.events.*
   - Controller: AdminEventController@*
   - Methods: index, create, store, show, edit, update, destroy

3. /admin/categories (Multiple methods)
   - Routes: admin.categories.*
   - Controller: CategoryController@*
   - Methods: index, create, store, show, edit, update, destroy

4. /admin/transactions (Multiple methods)
   - Routes: admin.transactions.*
   - Controller: AdminTransactionsController@*
   - Methods: index, create, store, show, edit, update, destroy

5. /admin/partners (Multiple methods)
   - Routes: admin.partners.*
   - Controller: PartnerController@*
   - Methods: index, create, store, show, edit, update, destroy
```

---

## 10. Testing Commands

```bash
# Reset database and seed
php artisan migrate:fresh --seed

# Start development server
php artisan serve

# Test route without authentication
curl -i http://127.0.0.1:8000/admin/dashboard

# Tinker console
php artisan tinker

# In tinker, check users:
> App\Models\User::all();
> App\Models\User::where('role', 'admin')->first();
> App\Models\User::where('role', 'user')->first();
```

---

## 11. Configuration Files Status

| File | Configuration | Status |
|------|---------------|--------|
| config/auth.php | Guard: web | ✅ Default (no changes needed) |
| config/session.php | Driver: file | ✅ Default (no changes needed) |
| bootstrap/app.php | Middleware group | ✅ Configured for 'admin' |
| routes/web.php | Route protection | ✅ Configured |
| app/Http/Middleware/IsAdmin.php | Double protection | ✅ Implemented |
| app/Models/User.php | Role attribute | ✅ Fillable |

---

## SUMMARY

All code components for middleware protection are properly implemented:
- ✅ IsAdmin middleware with dual protection layers
- ✅ Middleware group registration
- ✅ Route protection
- ✅ User model configuration
- ✅ Database schema with role field
- ✅ Test data seeding
- ✅ Authentication controller

**Ready for production deployment.** 🚀
