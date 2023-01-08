<?php

namespace App\Providers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define(
            'change-statuses', // full CRUD
            function ($user) {
                return \Auth::check();
            }
        );

        Gate::define(
            'customize-tasks', // without Delete
            function ($user) {
                return \Auth::check();
            }
        );

        Gate::define(
            'delete-tasks', // only creator can delete
            function (User $user, Task $task) {
                return $task->author->is($user);
            }
        );
    }
}
