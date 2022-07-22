<?php
namespace PCB\TimeZones;

use Carbon\Carbon;
use App\Http\Controllers\Controller;

class TimezonesController extends Controller
{
    public function index($timezone)
    {
        echo Carbon::now($timezone)->toDateTimeString();
    }
}
