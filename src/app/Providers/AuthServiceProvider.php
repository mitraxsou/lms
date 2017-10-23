<?php

namespace App\Providers;

use Auth;
use App\Course;
use App\Policies\CoursePolicy;
use App\User;
use App\Admin;
use Illuminate\Support\Facades\Gate;  
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        // 'App\Course' => 'App\Policies\CoursePolicy',
        Course::class => CoursePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerCoursePolicies();

       
    }

    public function registerCoursePolicies()
    {
        Gate::define('view-course', function(User $user, Course $course){
            return $user->courses->contains($course);
        });
    }
}
