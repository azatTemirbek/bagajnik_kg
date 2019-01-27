<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResources\UserFullResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpRequest;
use App\User;


class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'signup','redirectToProvider','handleProviderCallback']]);
    }

    public function  redirectToProvider($provider){
        return Socialite::driver($provider)->redirect();
    }
    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }else{
            $authUser =  User::create([
                'name'     => $user->name,
                'email'    => $user->email,
                'provider' => $provider,
                'provider_id' => $user->id
            ]);
        }
        //      name' => 'required',
        //     'surname' => 'required',
        //     'phone' => 'required|numeric|phone_number|size:11',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|confirmed
        // JWTAuth::fromUser($user);
        if (!auth()->login($authUser)) {
            return response()->json(['error' => 'Эл. Почта или пароль недействительны!'], 401);
        }
        $token = JWTAuth::fromUser($authUser);
        return $this->respondWithToken($token);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);
        // dd($credentials);
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Эл. Почта или пароль недействительны!'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function signup(SignUpRequest $request)
    {
        if($request->hasFile('photo')){
            $file = $request->photo;
            $path = $request->photo->store('public');
            error_log('Some message here.'.$path );
            $request->photo = $path;
        }
        User::create($request->all());
        return $this->login($request);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Успешно вышла из системы']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()->name,
            'user_data' => auth()->user()
        ]);
    }

    /**
     * will get all the info of the user
     * @param Request $request
     * @return UserFullResource
     */
    public function info(Request $request)
    {
        $user = User::findOrFail(auth()->user()->id);
        return new UserFullResource($user);
    }
}
