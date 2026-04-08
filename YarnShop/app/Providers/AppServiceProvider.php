<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {

            $replies = collect();
            $replyCount = 0;

            if (session()->has('customer')) {
                $customer = session('customer');

                $replies = Contact::where('customer_id', $customer['id'])
                    ->where('status', 2)
                    ->orderBy('replied_at', 'desc')
                    ->take(5)
                    ->get();

                $replyCount = Contact::where('customer_id', $customer['id'])
                    ->where('status', 2)
                    ->count();
            }

            $view->with(compact('replies', 'replyCount'));
        });
    }
}