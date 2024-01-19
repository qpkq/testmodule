<?php

namespace AdminDatabaseProvider\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class DatabaseController extends Controller
{
    public function index()
    {
        return DB::table('users')->find(1);
    }
}