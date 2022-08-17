<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\Rule;

class UserController extends Controller {

    public function index(): Factory|View|Application {
        return view( 'users.register' );
    }

    public function create() {
        //
    }

    public function store( Request $request ): Redirector|RedirectResponse|Application {
        $formFields = $request->validate( [
            'name' => [ 'required', 'min:3' ],
            'email' => [ 'required', 'email', Rule::unique( 'users', 'email' ) ],
            'password' => [ 'required', 'confirmed', 'min:6' ],
        ] );

        // hash password
        $formFields[ 'password' ] = bcrypt( $formFields[ 'password' ] );

        // create user
        $user = User::create( $formFields );

        auth()->login( $user );

        return redirect( '/' )->with( 'message', 'User created and logged in successfully!' );
    }

    public function show( $id ) {
        //
    }

    public function edit( $id ) {
        //
    }


    public function update( Request $request, $id ) {

    }

    public function destroy( $id ) {
        //
    }

    public function logout( Request $request ): Redirector|Application|RedirectResponse {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect( '/' )->with( 'message', 'You have been logout!' );
    }

    public function login(): Factory|View|Application {
        return view( 'users.login' );
    }

    public function authenticate( Request $request ): Redirector|Application|RedirectResponse {
        $formFields = $request->validate( [
            'email' => [ 'required', 'email' ],
            'password' => 'required'
        ] );

        if( auth()->attempt( $formFields ) ) {
            $request->session()->regenerate();

            return redirect( '/' )->with( 'message', 'You are logged in' );
        }

        return back()->withErrors( [ 'email' => 'Invalid Credentials' ] )->onlyInput( 'email' );
    }
}
