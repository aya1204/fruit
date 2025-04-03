<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthorRequest;

class AuthController extends Controller
{
    //データ一覧ページの表示
    public function index ()
    {
        return view('index');
    }
    
    public function register ()
    {
        return view('auth/register');
    }
}
