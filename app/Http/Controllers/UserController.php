<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    private UserRepository $userRepository;

    //registration
    /**
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->userRepository = $repository;
    }

    public function registrationForm()
    {
        return view('user.create');
    }

    public function register(RegistrationRequest $request)
    {
        $user = $this->userRepository->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        session()->flash('success', 'Registration completed');
        Auth::login($user);
        return redirect()->route('transactions.index');
    }

    //login
    public function loginForm()
    {
        return view('user.login');
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password])) {
            session()->flash('success', 'You are logged in');
            return redirect()->route('transactions.index');
        }
        return redirect()->route('login')->with(['error' => 'error']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
