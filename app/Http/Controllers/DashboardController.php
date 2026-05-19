<?php

// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $accessService = app(\App\Services\PortalAccessService::class);

        if ($user->hasRole('admin') && $accessService->canViewPage('admin.dashboard')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('hod') && $accessService->canViewPage('hod.dashboard')) {
            return redirect()->route('hod.dashboard');
        } elseif ($user->hasRole('teacher') && $accessService->canViewPage('teacher.dashboard')) {
            return redirect()->route('teacher.dashboard');
        } elseif ($user->hasRole('student') && $accessService->canViewPage('student.dashboard')) {
            return redirect()->route('student.dashboard');
        } elseif ($user->hasRole('accountant') && $accessService->canViewPage('accountant.dashboard')) {
            return redirect()->route('accountant.dashboard');
        } elseif ($user->hasRole('librarian') && $accessService->canViewPage('librarian.dashboard')) {
            return redirect()->route('librarian.dashboard');
        }

        return view('dashboard');
    }
}
