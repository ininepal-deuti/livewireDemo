<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

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
        $all_post = Post::paginate(8);
        return view('layouts.home',compact('all_post'));
    }

    public function sendEmail()
    {
        $user  = User::find(2)->toArray();
        SendEmail::dispatch($user)->delay(now()->addMinutes(1));
    }

    public function activityLogs() {
        $activityLogs  = Activity::all();
        return view('activitylog',compact('activityLogs'));
    }

    public function showPost(Post $post) {
        return view('livewire.posts.show',compact('post'));
    }
}
