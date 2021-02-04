<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class AuthController extends Controller
{
    use SendsPasswordResetEmails;
    /**
     * Registration
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'type' => 'required',
        ]);

        if(User::where('email',$request->email)->exists()){
            return response()->json(['payload' => [], 'message' => 'Email already exixts'], 401);
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'add_line_1' => $request->add_line_1,
            'add_line_2' => $request->add_line_2,
            'add_line_3' => $request->add_line_3,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'vehicle_type_id' => $request->vehicle_type_id,
            'district_id' => $request->district_id,
            'type' => $request->type
        ]);

        $token = $user->createToken('LaravelAuthApp')->accessToken;
        $user = User::find($user->id);
        $user['token'] = $token->token;

        return response()->json(['payload' => [$user],'message'=>'Registered'], 200);
    }

    /**
     * Login
     */
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            $user = User::find(auth()->user()->id);
            $user['token'] = $token->token;
            return response()->json(['payload' => [$user], 'message' => 'Login'], 200);
        } else {
            return response()->json(['payload' => [], 'message' => 'Unauthorised'], 401);
        }
    }

    /**
     * profile update
     */
    public function profileUpdate(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
        ]);
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->add_line_1 = $request->add_line_1;
        $user->add_line_2 = $request->add_line_2;
        $user->add_line_3 = $request->add_line_3;
        $user->latitude = $request->latitude;
        $user->longitude = $request->longitude;
        $user->vehicle_type_id = $request->vehicle_type_id;
        $user->district_id = $request->district_id;
        $user->save();

        return response()->json(['payload' => [$user],'message' => 'Updated'], 200);
    }

	public function checkRequest(Request $request)
	{

		return $this->sendResetLinkEmail($request);
	}

	/**
	 * Get the response for a successful password reset link.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string  $response
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
	 */
	protected function sendResetLinkResponse(Request $request, $response)
	{
		return response()->json(['payload' => [], 'message' => 'A password reset email will be sent to you in a moment.'],200);
	}

	/**
	 * Get the response for a failed password reset link.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string  $response
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
	 */
	protected function sendResetLinkFailedResponse(Request $request, $response)
	{
        return response()->json(['payload' => [], 'message' => 'Failed to send password reset email. Ensure your email is correct and try again.'],422);
    }

    /**
     * profile get
     */
    public function profile(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
        ]);

        $user = User::find($request->id);

        return response()->json(['payload' => [$user],'message' => 'User Profile'], 200);
    }

    /**
     * profile get
     */
    public function logout(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
        ]);

        return response()->json(['payload' => [],'message' => 'Logout'], 200);
    }
}
