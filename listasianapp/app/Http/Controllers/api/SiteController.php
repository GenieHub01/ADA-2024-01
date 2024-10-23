<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactFormRequest;
use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterFormRequest;
use App\Http\Requests\RestorePasswordRequest;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Stripe\Event;
use Stripe\Stripe;

class SiteController extends Controller
{
    // public function index()
    // {
    //     return view('welcome');
    // }

    // public function error()
    // {
    //     $error = session('error');
    //     return view('error', compact('error'));
    // }

    // public function contact(ContactFormRequest $request)
    // {
    //     $validated = $request->validated();

    //     Mail::send('emails.contact', $validated, function ($message) use ($validated) {
    //         $message->to('support@example.com')
    //                 ->subject($validated['subject']);
    //     });

    //     return back()->with('success', 'Your message has been sent!');
    // }

    // public function showContactForm()
    // {
    //     return view('contact');
    // }

    // public function login(LoginFormRequest $request)
    // {
    //     $credentials = $request->only('username', 'password');
    //     $remember = $request->filled('rememberMe');

    //     if (Auth::attempt($credentials, $remember)) {
    //         return redirect()->intended('/dashboard');
    //     } else {
    //         return back()->withErrors([
    //             'password' => 'Incorrect username or password.',
    //         ]);
    //     }
    // }

    // public function showLoginForm()
    // {
    //     return view('login');
    // }

    // public function logout()
    // {
    //     Auth::logout();
    //     return redirect('/')->with('success', 'Logged out successfully');
    // }

    // public function restorePassword(RestorePasswordRequest $request)
    // {
    //     $email = $request->input('email');
    //     $response = Password::sendResetLink(['email' => $email]);

    //     if ($response == Password::RESET_LINK_SENT) {
    //         return back()->with('status', trans($response));
    //     } else {
    //         return back()->withErrors(['email' => trans($response)]);
    //     }
    // }

    // public function showRestorePasswordForm()
    // {
    //     return view('restore_password');
    // }

    // public function register(RegisterFormRequest $request)
    // {
    //     if (Auth::check()) {
    //         return back()->with('error', 'Already registered and logged in');
    //     }

    //     $user = User::create([
    //         'email'      => $request->email,
    //         'password'   => Hash::make($request->password),
    //         'create_time'=> now(),
    //         'role'       => 2,
    //         'f_name'     => $request->f_name,
    //         'l_name'     => $request->l_name,
    //         'phone'      => $request->phone,
    //     ]);

    //     Auth::login($user);

    //     return redirect('/dashboard')->with('success', 'Registration Successful');
    // }

    // public function showRegisterForm()
    // {
    //     return view('register');
    // }

    // public function hook(Request $request)
    // {
    //     Stripe::setApiKey(config('services.stripe.secret'));

    //     $event_json = $request->getContent();
    //     $event = json_decode($event_json);

    //     if (empty($event->id)) {
    //         return response()->json(['message' => 'Event ID not found'], 400);
    //     }

    //     $event = Event::retrieve($event->id);

    //     if ($event->type === 'invoice.payment_succeeded') {
    //         $subscription = Subscription::where('stripe_subscription_id', $event->data->object->subscription)
    //             ->with(['advert', 'plan'])
    //             ->first();

    //         if ($subscription) {
    //             $advert = $subscription->advert;
    //             $plan = $subscription->plan;
    //             $advert->setPaid($plan->intervalList[$plan->interval]);
    //         }
    //     } else {
    //         Log::info('Unhandled event type: '. $event->type);
    //     }

    //     return response()->json(['status' => 'success']);
    // }
}
