<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        DB::listen(function ($query) {
            $sql = strtolower($query->sql); // convertimos a minúsculas para comparar

            // Solo registrar INSERT, UPDATE o DELETE
            if (str_starts_with($sql, 'insert') || str_starts_with($sql, 'update') || str_starts_with($sql, 'delete')) {
                Log::info('SQL de escritura ejecutada', [
                    'sql' => $query->sql,
                    'bindings' => $query->bindings,
                    'tiempo_ms' => $query->time,
                ]);
            }
        });
    }
}