<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
					'status'	=> FALSE,
					'error' 	=> 'invalid_credentials'
				], 400);
            }
        } catch (JWTException $e) {
            return response()->json([
				'status'	=> FALSE,
				'error' 	=> 'could_not_create_token'
			], 500);
        }

		$user = User::where('email', $request->email)->first();

		$returnDataUser = [
			'address' => $user->address,
			'birthdate' => $user->birthdate,
			'department_id' => $user->department_id,
			'email' => $user->email,
			'employee_code' => $user->employee_code,
			'name' => $user->name,
			'phone' => $user->phone
		];

		foreach ($user->permission as $p) {
			$nameArr = explode('-', $p->name);
			$subject = $nameArr[0];
			$action = $nameArr[1];
			$returnDataUser['ability'][] = [
				'action' => $action,
				'subject' => $subject
			];
		}

        return response()->json([
			'status'	=> TRUE,
			'userData'		=> $returnDataUser,
			'token'		=> $token
		], 200);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user','token'),201);
    }

    public function getAuthenticatedUser()
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        return response()->json(compact('user'));
    }
}