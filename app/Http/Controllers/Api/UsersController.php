<?php

namespace SeshSource\Http\Controllers\Api;

use SeshSource\User;
use Illuminate\Http\Request;
use SeshSource\Http\Controllers\Controller;
use Auth;

class UsersController extends Controller
{

    /**
     * Generates a JWT token for user
     * Faster than making a client app and logging in there
     *
     * @param Request $request
     * @return void
     */
    public function token(Request $request)
    {

        $params = $request->only('email', 'password');

        $username = $params['email'];
        $password = $params['password'];

        if(Auth::attempt(['email' => $username, 'password' => $password])){
            return Auth::user()->createToken('my_user', []);
        }

        return response()->json(['error' => 'Invalid username or Password']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
