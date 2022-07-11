<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('admin.transaksi', 'App\Policies\UserPolicy@Transaksi');
        Gate::define('admin.crud-vendor-client', 'App\Policies\UserPolicy@CRUD_Vendor_Client');
        Gate::define('admin.cetakinv', 'App\Policies\UserPolicy@Cetak_INV');
        Gate::define('admin.hakakses', 'App\Policies\UserPolicy@Hak_Akses');
        //
    }
}
