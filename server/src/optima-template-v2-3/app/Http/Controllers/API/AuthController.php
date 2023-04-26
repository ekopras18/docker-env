<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use App\Models\User;
use App\Models\Company;
use Session;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
         ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json([
                'status' => true,
                'message' => 'Success',
                'code' => 200,
                'data' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);

    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password')))
        {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        Session::put('compId',$user->compId);

        $data = [
            'message' => 'Hi ' . $user->name . ', welcome to home',
            'company_Id' => $user->compId,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ];

        return response()
            ->json([
                'status' => true,
                'message' => 'Success',
                'code' => 200,
                'data' => $data,
            ]);
    }

    public function loginweb(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password')))
        {
            $wallidx=rand(1,7);
            $data = array(
                    'wallidx' => $wallidx,
                    'message' => 'E-mail & Password Tidak Sesuai',
                    ); 
            return view('login',$data);
        }

        $user = User::where('email', $request['email'])->firstOrFail();
        // $token = $user->createToken('auth_token')->plainTextToken;
        // $user->dashboard = 1 dashboard, 2 apiopnicare
        if($user->dashboard == 0){
            $company = Company::where('compId', $user->compId)->firstOrFail();

            Session::put('compId',$user->compId);
            Session::put('compNama',$company->compNama);
            Session::put('compStatus',$company->compStatus);
            Session::put('name',$user->name);
            Session::put('username',$user->username);
            Session::put('compLogo',$company->compLogo);
            Session::put('compLokasi',$company->compLokasi);
            Session::put('compDetail',$company->compDetail);
            Session::put('compBpjsId',$company->compBpjsId);
            Session::put('email',$user->email);
            Session::put('role',$user->role);
            Session::put('dokterId',$user->dokter);
            Session::put('kdpelayanan',$user->kdpelayanan);
        }else{
            $wallidx=rand(1,7);
            $data = array(
                    'wallidx' => $wallidx,
                    'message' => 'Maaf, Anda Tidak Memiliki Akses ke Aplikasi',
                    ); 
            return view('login',$data);
        }

        $url = str_replace(url('/'), '',url()->previous());

        if($url == '/api/logout'){
            return redirect('/');
        }else{
            return redirect(url()->previous());
        }
        
    }

    // method for user logout and delete token
    public function logout()
    {
        Session::put('name','');
        Session::put('username','');
        Session::put('email','');
        Session::put('compId','');
        Session::put('compNama','');
        Session::put('compStatus','');
        Session::put('compLogo','');
        Session::put('compLokasi','');
        Session::put('compDetail','');
        Session::put('compBpjsId','');
        Session::put('role','');
        Session::put('dokterId','');
        Session::put('kdpelayanan','');



        auth()->user()->tokens()->delete();

            $wallidx=rand(1,7);
            $data = array(
                    'wallidx' => $wallidx,
                    'message' => 'Anda telah logout dari system.',
                    ); 
                    
            return view('login',$data);


    }
}