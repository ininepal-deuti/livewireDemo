<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function sendEmail()
    {
        $user  = User::find(2);
        try{
            SendEmail::dispatch($user)->delay(now()->addMinutes(1));
            return response()->json(['message'=>'Mail Send Successfully!!']);
        }catch (Exception $exception){
            echo $exception->getMessage();
        }
    }
}
