<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\AdminFilterService;
use Illuminate\Http\Request;

class AdminClientController extends Controller
{
    public function index(Request $request, AdminFilterService $filterService){

        $query = User::query();
        $query = $filterService->apply($query);
        $users = $query->get()->paginate(12);

        return view('admin.clients.index', ['users' => $users]);
    }

    public function show(User $user){

        return view('admin.clients.show', ['user' => $user]);
    }
}
