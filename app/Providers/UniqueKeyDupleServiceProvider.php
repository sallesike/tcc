<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\Subscription;
class UniqueKeyDupleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
      \Validator::extend('uniquekeyduple', 
        function($attribute, $value, $parameters, $validator)
        {
            $value1 = (int)request()->get($parameters[0]);
            if (is_numeric($value) && is_numeric($value1))
            {
                return (!(Subscription::where($attribute, $value)
                    ->where($parameters[0], $value1)
                    ->count() > 0));
            }
            return false;
        });
  }
}
