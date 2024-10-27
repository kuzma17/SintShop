<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\DeliveryResource;
use App\Http\Resources\PaymentResource;
use App\Models\Delivery;
use App\Models\Payment;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rules = [
            'name' => ['required', 'string'],
            'phone' => ['required'],
            //'email' => ['nullable','email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];

        if (isset($data['delivery_id']) && $data['delivery_id'] == 2){

            $rules['delivery_address'] = ['required', 'string'];
        }

        return Validator::make($data, $rules);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => cleanPhone($data['phone']),
            //'password' => Hash::make($data['password']),
            'password' => $data['password'],
            'delivery_id' => isset($data['delivery_id'])? $data['delivery_id']: 1,
            'payment_id' => $data['payment_id'],
            'delivery_address' => isset($data['delivery_address'])? $data['delivery_address']: '',
        ]);
    }

    public function showRegistrationForm()
    {
        $deliveries = Delivery::active()
            ->sort()
            ->get();
        $payments = Payment::active()
            ->sort()
            ->get();

        return view('auth.register', [
            'deliveries' => DeliveryResource::collection($deliveries),
            'payments' => PaymentResource::collection($payments)
        ]);
    }

}
