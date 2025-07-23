<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;

class SubscribeController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            'auth',
        ];
    }
    public function showPlans() {
        $plans = Plan::all();

        return view('subscribe.plans', compact('plans'));
    }

    public function checkoutPlan(Plan $plan) {
        $user = Auth::user();
        return view('subscribe.checkout', compact('plan', 'user'));
    }

    public function processCheckout(Request $request) {
        $plan = Plan::find($request->plan_id);
        $user = Auth::user();

        $user->memberships()->create([
            'plan_id' => $plan->id,
            'active' => true,
            'user_id' => $user->id,
            'start_date' => now(),
            'end_date' => now()->addDays($plan->duration)
        ]);

        return redirect()->route('subscribe.success');
    }


    public function showSuccess() {
        return view('subscribe.success');
    }
}
