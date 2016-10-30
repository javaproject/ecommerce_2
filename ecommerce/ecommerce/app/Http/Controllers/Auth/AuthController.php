<?php
namespace App\Http\Controllers\Auth;

use Validator;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    protected $username = 'username', $redirectTo = '/';

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }
    public function authenticate(Request $request){
        // grab credentials from the request
        $credentials = $request->only('username', 'password');
        //return $credentials;
        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        // all good so return the token
        return response()->json(compact('token'));
    }

    // Get Authentivated User from token
    public function getAuthenticatedUser(){
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
        // the token is valid and we have found the user via the sub claim
        return response()->json(compact('user'));
    }
    public function getUserToken(){
        // this will set the token on the object
        JWTAuth::parseToken();

        // and you can continue to chain methods
        $user = JWTAuth::parseToken()->authenticate();
        $token = JWTAuth::getToken();
        return $token;
    }

    public function logout(Request $request) {
        JWTAuth::invalidate($request->input('token'));
        return response()->json(['status' => true, 'response' => "you are logout"]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username'=>'required|regex:/^[\pL\s\-]+$/u|min:4|max:50|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:7|confirmed',
        ]);
    }
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
