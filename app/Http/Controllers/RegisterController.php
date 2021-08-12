<?php

namespace App\Http\Controllers;

use App\Models\PaymentType;
use App\Models\Role;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Fortify\Rules\Password;

class RegisterController extends Controller
{
    protected $model;
    protected $wallet;

    public function __construct(User $user, Wallet $wallet)
    {
        $this->model = $user;
        $this->wallet = $wallet;
    }

    public function registerPage()
    {
        return view('auth.user-register', [
            'payment_types' => PaymentType::query()->pluck('name', 'id'),
        ]);
    }

    public function processedRegister(Request $request)
    {
        $this->validateUser($request);

        DB::transaction(function () use ($request){

            $this->store($request)
                ->addWallet($request);
        });

        return redirect()->back()->with('success', 'Your Registration successful, Admin will confirm you .');
    }

    private function validateUser($request): RegisterController
    {
        $request->validate([
            'sponsor_number' => 'nullable|numeric|exists:users,phone',
            'name' => 'required|string',
            'phone_number' => 'required|numeric|unique:users,phone',
            'email' => 'nullable|email|unique:users,email',
            'address' => 'nullable|string',
            'payment_type' => 'required|exists:payment_types,id',
            'payment_amount' => 'required|numeric|min:1000',
            'password' => ['required', 'string', new Password, 'confirmed'],
            'password_confirmation' => 'required',
            'terms_and_condition' => 'required|numeric',
        ]);

        return $this;
    }

    private function store($request)
    {
        $this->model = $this->model
            ->newQuery()
            ->create([
                'role_id' => Role::query()->where('slug', 'user')->first()->id,
                'sponsor_user_id' => $this->getSponsorUser($request->sponsor_number),
                'name' => $request->name,
                'user_generated_id' => $this->generatedId(),
                'email' => $request->email,
                'phone' => $request->phone_number,
                'password' => bcrypt($request->password),
                'address' => $request->address,
                'terms_and_condition' => $request->terms_and_condition,
                'status' => false
            ]);

        return $this;
    }

    private function addWallet($request)
    {
        $this->wallet
            ->newQuery()
            ->create([
               'user_id' => $this->model->id,
//               'receiver_user_id' => $this->model->newQuery()->first()->id,
               'payment_type_id' => $request->payment_type,
               'amount' => $request->payment_amount,
               'type' => 'registration_fee',
            ]);
    }

    private function getSponsorUser($sponsorNumber)
    {
        if ($sponsorNumber) {
            $sponsorUser = $this->model->newQuery()->where('phone', $sponsorNumber)->first();

            if ($sponsorUser) {

                return $sponsorUser->id;

            } else {

                return $this->model->newQuery()->first()->id;

            }

        } else {

            return $this->model->newQuery()->first()->id;
        }
    }

    private function generatedId()
    {
        $user_id = $this->model->newQuery()->max('id');

        return str_pad(($user_id + 1), 4, '0000', STR_PAD_LEFT);
    }


    public function processedLogin(Request $request)
    {
        $this->validate($request,[

            'email_or_phone' => 'required',
            'password' => 'required',

        ]);

        $email_or_phone = $request->email_or_phone;
        $password = $request->password;

        $checkConfirmUser = $this->model->newQuery()
                            ->where('email', $email_or_phone)
                            ->orWhere('phone', $email_or_phone)
                            ->where('status', true)
                            ->first();

        if ($checkConfirmUser){

            if (auth()->guard('web')->attempt(['phone' => $checkConfirmUser->phone, 'password' => $password])){

                return redirect()->route('home');

            }else{
                return redirect()->back()->with('error', 'Invalid Credentials');

            }

        }else{

            return redirect()->back()->with('error', 'Admin not confirm your request yet.');
        }
    }
}
