<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use Illuminate\Support\Facades\Session;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'dob' => ['required', 'date', 'max:10'],
            'city' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\UserDetail
     */
    protected function create(array $data)
    {
      

        $UserDetail = new UserDetail();
        $otp = mt_rand(1000,9999);

        
        require __DIR__.'/../../../../vendor/autoload.php';
        //require __DIR__.'/../../../vendor/PHPMailer/PHPMailerAutoload.php';													// load Composer's autoloader
  
        $mail = new PHPMailer(true);                            // Passing `true` enables exceptions

        try {
            // Server settings
            $mail->SMTPDebug = 0;
            $mail->CharSet = 'utf-8';                                	// Enable verbose debug output
            $mail->isSMTP();                                     	// Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';												// Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                              	// Enable SMTP authentication
            $mail->Username = 'aromalkm982@gmail.com';             // SMTP username
            $mail->Password = '9656809435';              // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('aromalkm982@gmail.com', 'Mailer');
            $mail->addAddress($data['email'], 'Optional name');	// Add a recipient, Name is optional
            $mail->addReplyTo('aromalkm982@gmail.com', 'Mailer');
            $mail->addCC($data['email']);
            $mail->addBCC($data['email']);

            //Attachments (optional)
            // $mail->addAttachment('/var/tmp/file.tar.gz');			// Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');	// Optional name

            //Content
            $mail->isHTML(true); 																	// Set email format to HTML
            $mail->Subject = "OTP Generated";//Request::input('subject');
            $mail->Body    = $otp;//Request::input('message');						// message

            $mail->send();
            
        } catch (Exception $e) {
            return back()->with('error','Message could not be sent.');
        }

        
        $UserDetail->email = $data['email'];
        $UserDetail->dob = $data['dob'];
        $UserDetail->city = $data['city'];
        $UserDetail->otp = $otp;
        $UserDetail->save();

        return User::create([
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ]);

        
       
    }
}
