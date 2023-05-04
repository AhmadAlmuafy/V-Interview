<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

// Models
use App\Models\Developer;
use App\Models\Company;

class AuthController extends Controller {
    use HttpResponses;

    public function login(Request $request) {

        $AuthType = $request -> input("AuthType");
        $rules = [
            'email' => 'required|email|max:150|exists:' . $AuthType . ',email',
            'password' => 'required|string|min:6',
        ];

        $valid = Validator::make($request -> all(), $rules, [
            "email.exists" => "Invalid email or password",
        ]);
        $credentials = $request -> only('email', 'password');

        if(!$valid -> fails()) {

            switch($AuthType) {

                case "developer":

                    $guard = 'DeveloperApi';
                    break;

                case "company":

                    $guard = 'CompanyApi';
                    break;

            }

            $token = Auth::guard($guard) -> attempt($credentials);

            if (!$token) {
                return response() -> json([
                    'status' => 'error',
                    'messages' => ['email' => ['Invalid email or password']],
                ]);
            }

            return response() -> json([
                'status' => 'success',
                'message' => 'Loign successfully',
                'user' => Auth::user(),
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ],
                'AuthType' => $AuthType,
            ]);

        }

        return response() -> json([
            'status' => 'error',
            'messages' => $valid -> errors()
        ], 401);

    }

    public function register(Request $request) {

        $AuthType = $request -> input("AuthType");
        $rules = [
            'full_name' => 'required|max:100|string',
            'email' => 'required|email|max:150|unique:' . $AuthType,
            'password' => 'required|min:6|string',
            'AuthType' => 'required|string',
            'location' => 'required|string',
            'phone' => 'required|string|max:15',
        ];
        $request['password'] = Hash::make($request -> input("password"));
        
        $valid = Validator::make($request -> all(), $rules);
        if(!$valid -> fails()) {

            switch($AuthType) {

                case "developer":

                    $user = Developer::create($request -> except("AuthType"));
                    $guard = 'DeveloperApi';
                    break;

                case "company":

                    $user = Company::create($request -> except("AuthType"));
                    $guard = 'CompanyApi';
                    break;

            }

            $token = Auth::guard($guard) -> login($user);
            return response() -> json([
                'status' => 'success',
                'message' => 'Account created successfully',
                'user' => $user,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ],
                'AuthType' => $AuthType,
            ]);

        }

        return response() -> json([
            'status' => 'error',
            'messages' => $valid -> errors()
        ]);

    }

    public function logout() {

        Auth::logout();
        return response() -> json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);

    }

    // public function login(LoginUserRequest $request) {

    //     $request -> validated($request -> all());

    //     if(!Auth::attempt($request->only('email','password'))) {
    //         return $this->error('', 'Credentials do not match', 401);
    //     }

    //     $user = User::where('email', $request->email)->first();

    //     return $this -> succes([
    //         'user' => $user,
    //         'token' => $user->createToken('Api Token of' . $user->name)->plainTextToken
    //     ]);

    // }

    // public function register(StoreUserRequest $request) {

    //     $request->validated($request->all());

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //     ]);
        

    //     return $this->succes(
    //         [
    //             'user' => $user,
    //             'token' => $user->createToken('API Token of' . $user->name)->plainTextToken
    //         ]
    //     );

    // }

    // public function logout() {

    //     Auth::user()->currentAccessToken()->delete();

    //     return $this->succes([
    //         'message' => 'You have successfuly been loged out'
    //     ]);

    // }
}
