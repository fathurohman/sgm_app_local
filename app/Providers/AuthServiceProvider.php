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
        Gate::define('admin.job-order', 'App\Policies\UserPolicy@Job_Order');
        Gate::define('admin.crud-vendor-client', 'App\Policies\UserPolicy@CRUD_Vendor_Client');
        Gate::define('admin.cetakinv', 'App\Policies\UserPolicy@Cetak_INV');
        Gate::define('admin.hakakses', 'App\Policies\UserPolicy@Hak_Akses');
        Gate::define('admin.history', 'App\Policies\UserPolicy@History');
        Gate::define('admin.report', 'App\Policies\UserPolicy@Report');
        Gate::define('admin.sales-order-data', 'App\Policies\UserPolicy@Sales_Order_Data');
        Gate::define('admin.history-sales-data', 'App\Policies\UserPolicy@History_Sales_Data');
        Gate::define('admin.pickup-job', 'App\Policies\UserPolicy@Pickup_Job');
        Gate::define('admin.report-profit', 'App\Policies\UserPolicy@Report_Profit');
        //
    }
}
