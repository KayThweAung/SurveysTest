<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Validator;

class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();

        try {
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['name'] =  $user->name;
            $success['redirect'] = route('login');
        } catch (Exception $e) {
            Log::channel('error')->error('Fail to register user.');
            return $this->sendError('Fail to register user.', $e);
        }

        return $this->sendResponse($success, 'User register successfully.');
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        try {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();
                $success['token'] =  $user->createToken('MyApp')->plainTextToken;
                $success['name'] =  $user->name;
                $success['redirect'] = url('/create');

                return $this->sendResponse($success, 'User login successfully.');
            }
        } catch (Exception $e) {
            Log::channel('error')->error('Fail to Login user.');
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }
}
