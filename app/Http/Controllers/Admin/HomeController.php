<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Carbon\Carbon;


use App\User;
class HomeController extends Controller
{
    public function index(){
        // return view('admin.dashboard');
         return redirect('admin/gallary');
    }
}
?>