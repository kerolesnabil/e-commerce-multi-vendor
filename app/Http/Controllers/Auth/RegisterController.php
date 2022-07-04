<?php

namespace App\Http\Controllers\Auth;

use App\Adpaters\ISMSGateway;
use App\Http\Controllers\Controller;
use App\Http\Services\SMSGateWayServices;
use App\Http\Services\VerificationServices;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public $verificationServices;

    /**
     * @var ISMSGateway
     *
     */
    public $smsAdapter;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(VerificationServices $verificationServices)
    {
        $this->middleware('guest');
        $this->verificationServices = $verificationServices;
        $this->smsAdapter= (SMSGateWayServices::getServiceAdapter("egypt"));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return  \App\Models\User
     */

    protected function create(array $data)
    {
        try{

            $verification = [];
            $user=User::create([
                'name' => $data['name'],
                'mobile' => $data['mobile'],
                'password' => Hash::make($data['password']),
            ]);
            $verification['user_id']=$user->id;
            $verification_data =  $this->verificationServices->setVerificationCode($verification);
            $message = $this->verificationServices->getSMSVerifyMessageByAppName($verification_data->code );

            $this->smsAdapter->sendSms($user->mobile , $message);

            # app(VictoryLinkSms::class) -> sendSms($user -> mobile,$message);

            return $user;

        }catch(\Exception $ex){
             DB::rollback();
        }
    }
}
