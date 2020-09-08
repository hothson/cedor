<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AuthController extends Controller
{
    /**
     * @SWG\Post(
     *     path="/api/auth/signup",
     *     description="Return Successful Message",
     *     @SWG\Parameter(
     *         name="name",
     *         in="query",
     *         type="string",
     *         description="name",
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         name="email",
     *         in="query",
     *         type="string",
     *         description="Your email",
     *         required=true,
     *     ),
     *      @SWG\Parameter(
     *         name="password",
     *         in="query",
     *         type="string",
     *         description="Your password",
     *         required=true,
     *     ),
     *      @SWG\Parameter(
     *         name="password_confirmation",
     *         in="query",
     *         type="string",
     *         description="Your password",
     *         required=true,
     *     ),
     *     @SWG\Response(
     *         response="200",
     *         description="OK",
     *     )
     * )
     */
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ]);
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        $user->save();
        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }
  
/**
* @SWG\Post(
*     path="/api/auth/login",
*     description="Return access_token",
*      @SWG\Parameter(
*         name="Content-Type",
*         description="application/json",
*         in="header",
*         type="string",
*         required=true,
*     ),
*      @SWG\Parameter(
*         name="X-Requested-With",
*         description="X-XMLHttpRequest",
*         in="header",
*         type="string",
*         required=true,
*     ),
*     @SWG\Parameter(
*         name="email",
*         in="query",
*         type="string",
*         required=true,
*     ),
*      @SWG\Parameter(
*         name="password",
*         in="query",
*         type="string",
*         required=true,
*     ),
*      @SWG\Parameter(
*         name="remember_me",
*         in="query",
*         type="boolean",
*         required=false,
*     ),
*		@SWG\Parameter(
*         name="Auto Login",
*         in="query",
*         type="boolean",
*         required=false,
*     ),
*     @SWG\Response(
*         response=201,
*         description="OK",
*         examples={
*     		"application/json": {
*       		"access_token"="string",
*       		"token_type"="Bearer",
*       		"expires_at"="string",
*     		}
*		 }
*     ),
*		@SWG\Response(
*         response=401,
*         description="Unauthorized",
*     ),
* )
*/
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
		$token->save();
        $accessToken = $tokenResult->accessToken;
        
        return response()->json([
            'access_token' => $accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }
  
/**
* @SWG\Get(
*     path="/api/auth/logout",
*     description="Return Message",
*     @SWG\Parameter(
*         name="Authorization",
*         in="header",
*         type="string",
*         required=true,
*     ),
*     @SWG\Response(
*         response=200,
*         description="OK",
*     ),
* )
*/
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
  
    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
