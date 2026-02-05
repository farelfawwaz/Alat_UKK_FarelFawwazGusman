<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Activitylog;

class ActivitylogController extends Controller
{
    public function index()
    {
        $logs = ActivityLog::with('user')
            ->latest()
            ->paginate(15);

        return view('admin.aktivity.index', compact('logs'));
    }
}

