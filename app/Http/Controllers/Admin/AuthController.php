<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Repositories\AdminRepository;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $repository;

    public function __construct(AdminRepository $adminRepository) {
        $this->repository = $adminRepository;
    }

    function login(Request $request){

        if($request->getMethod() == 'GET'){
            if(Auth::guard('admin')->check()){
                return redirect()->route('admin.dashboard');
            }
            return view('backend.pages.auth.login');
        }

        $validator = Validator::make($request->all(),[
            'email' => 'required|min:3|max:255',
            'password' => 'required|min:6|max:32',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect()->route('admin.dashboard');
        }
        return redirect()->back()->with('error','Login error.');

    }

    function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function register(Request $request){
        if($request->getMethod() == 'GET'){
            if(Auth::guard('admin')->check()){
                return redirect()->route('admin.dashboard');
            }
            return view('backend.pages.auth.register');
        }
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:255',
            'email' => 'required|min:3|max:255|unique:admins',
            'password' => 'required|min:6|max:32',
            'gender' => ['required', Rule::in(array_values(config('constants.GENDER')))],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        } else {
            try {
                $request['password'] = bcrypt(trim($request['password']));
                $this->repository->store($request->all());
                return redirect()->route('admin.login')->with('notice', 'Register successfully.');
            } catch (Exception $th) {
                return redirect()->back()->with('error', 'Register error.' . $th->getMessage());
            }
        }
    }
}
