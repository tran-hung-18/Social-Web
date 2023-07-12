<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Service\Admin\HomeService;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    protected HomeService $homeService;

    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    public function viewDashboard()
    {
        $this->authorize('isAdmin', User::class);

        return view('admin.index', [
            'dataTotal' => $this->homeService->getTotalRecord(),
        ]);
    }
}
