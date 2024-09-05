<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\CryptomusService;
use Unicodeveloper\Paystack\Facades\Paystack;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    protected $cryptomusService;

    public function __construct(CryptomusService $cryptomusService)
    {
        $this->cryptomusService = $cryptomusService;
    }

    public function createCryptomusPayment(Request $request)
    {
        $amount = 100; // Example amount, adjust according to your pricing
        $currency = 'USD'; // Adjust the currency as needed

        $paymentData = $this->cryptomusService->createPayment($amount, $currency);

        if (isset($paymentData['result']['url'])) {
            return redirect($paymentData['result']['url']);
        }

        return redirect()->back()->with('error', 'Unable to create Cryptomus payment');
    }

    public function handleCryptomusCallback(Request $request)
    {
        $paymentId = $request->input('payment_id');

        $paymentData = $this->cryptomusService->verifyPayment($paymentId);

        if ($paymentData['status'] == 'success') {
            $user = User::where('id', auth()->id())->firstOrFail();
            $user->role = 'premium';
            $user->subscription_end_date = Carbon::now()->addMonth();
            $user->save();

            return redirect()->route('dashboard')->with('success', 'Subscription successful. You are now a premium user.');
        }

        return redirect()->route('dashboard')->with('error', 'Payment verification failed.');
    }


    public function index()
    {
        $user = auth()->id();
        $subscriptions = Subscription::where('user_id', $user)->latest()->get();

        return view('subscription.index', compact('subscriptions'));
    }

    public function redirectToGateway(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'amount' => 'required|integer|min:1000',
        ]);

        $paystack = Paystack::getAuthorizationUrl()->redirectNow();

        return $paystack;
    }

    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        if ($paymentDetails['status']) {
            // Payment was successful
            // Auth
            $user = User::where('id', auth()->id());
            $user->role = 'premium';

            // Set the subscription end date to 1 month from now
            $user->subscription_end_date = Carbon::now()->addMonth();
            $user->save();

            return redirect()->route('dashboard')->with('success', 'Subscription successful. You are now a premium user.');
        }

        return redirect()->route('subscription.index')->with('error', 'Payment failed. Please try again.');
    }

    public function startTrial()
    {
        $user = User::where('id', auth()->id())->firstOrFail();
        if (!$user->eligible_for_trial) {
            return redirect()->route('subscription.index')->with('error', 'You are not eligible for a trial.');
        }

        // $subscription = $this->createSubscription($request->input('plan_name', 'Trial'), 1, $user->id);
        $subscription = $this->createSubscription('Trial', 1, $user->id);

        if (!$subscription) {
            return redirect()->route('subscription.index')->with('error', 'You already have an active subscription.');
        }
        $user->eligible_for_trial = false; 
        $user->save();
        return redirect()->route('subscription.index')->with('success', 'Subscription created successfully.');
    }

    public function startPremium()
    {
        $user = User::where('id', auth()->id())->firstOrFail();
        $subscription = $this->createSubscription('Premium', 12, $user->id);

        if (!$subscription) {
            return redirect()->route('subscription.index')->with('error', 'You already have an active subscription.');
        }
        $user->eligible_for_trial = false; 
        $user->save();
        return redirect()->route('subscription.index')->with('success', 'Subscription created successfully.');
    }

    public function cancel(Subscription $subscription)
    {
        // $this->authorize('cancel', $subscription);

        $subscription->update([
            'ends_at' => now(),
        ]);

        return redirect()->route('subscription.index')->with('success', 'Subscription cancelled successfully.');
    }

    public function pricing()
    {
        return view('pricing');
    }

    public function createSubscription(string $planName, int $durationInMonths, string $userId)
    {
        // Allowed plans
        $allowedPlans = ['trial', 'premium'];

        // Allowed durations in months
        $allowedDurations = [1, 2, 3, 5, 7, 12];

        // Check if the plan and duration are valid
        if (!in_array(strtolower($planName), $allowedPlans) || !in_array($durationInMonths, $allowedDurations)) {
            return null;
        }

        // Check if the user already has an active subscription
        $existingSubscription = Subscription::where('user_id', $userId)
            ->where('ends_at', '>', now())
            ->first();


        if ($existingSubscription) {
            return null; // Or throw an exception if preferred
        }

        // Create and return the new subscription
        return Subscription::create([
            'user_id' => $userId,
            'plan_name' => ucfirst($planName),
            'amount' => strtolower($planName) === 'trial' ? 0 : $this->calculateAmount(strtolower($planName), $durationInMonths),
            'starts_at' => now(),
            'ends_at' => now()->addMonths($durationInMonths),
        ]);
    }

    protected function calculateAmount(string $planName, int $durationInMonths)
    {
        // Example pricing logic, modify as needed
        $basePrice = $planName === 'premium' ? 100000 : 0; // Base price in kobo for one month

        return $basePrice * $durationInMonths;
    }
}
