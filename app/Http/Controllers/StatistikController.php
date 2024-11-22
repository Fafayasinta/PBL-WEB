<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatistikController extends Controller
{
    public function index()
    {
        $activeMenu = 'statistik';
        $breadcrumb = (object) [
            'title' => 'Data Statistik',
            'list' => ['Home', 'statistik']
        ];

        return view('admin.statistik.index', [
            'activeMenu' => $activeMenu,
            'breadcrumb' => $breadcrumb,
        ]);
    }
}
