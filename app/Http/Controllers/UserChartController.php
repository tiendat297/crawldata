<?php

namespace App\Http\Controllers;
use App\Charts\UserChart;
use Illuminate\Http\Request;
use Symfony\Component\Routing\Route;
class UserChartController extends Controller
{
    public function index()
    {
        $usersChart = new UserChart;
        $usersChart->labels(['Jan', 'Feb', 'Mar']);
        $usersChart->dataset('Users by trimester', 'line', [10, 25, 13]);
        return view('users', [ 'usersChart' => $usersChart ] );
    }
    public function dat(){
        echo " xin chào";
    }
}
