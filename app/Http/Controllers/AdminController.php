<?php

namespace App\Http\Controllers;

use App\Exports\IncidentRequestExport;
use App\Models\IncidentRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use PDF;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function index(): View
    {
        return view('admin.create_user');
    }

    public function dashboard(): View
    {
        $users = User::all();
        $admin = User::whereRole(1)->get();
        $personnel = User::whereRole(2)->get();
        $employees = User::whereRole(3)->get();
        $requests = IncidentRequest::all();
        $resolved = count(IncidentRequest::whereIncidentState('Resolved')->get());
        $pending = count(IncidentRequest::whereIncidentState('Pending')->get());
        $inProgress = count(IncidentRequest::whereIncidentState('Work In Progress')->get());
        $application = count(IncidentRequest::whereCategory('Application')->get());
        $hardware = count(IncidentRequest::whereCategory('Hardware')->get());
        $mobileDevice = count(IncidentRequest::whereCategory('Mobile Device')->get());
        $meetingRoom = count(IncidentRequest::whereCategory('Meeting Room')->get());
        $infrastructure = count(IncidentRequest::whereCategory('Infrastructure')->get());
//
        return view('dashboard', compact(
            'users',
            'personnel',
            'employees',
            'requests',
            'admin',
            'resolved',
            'pending',
            'inProgress',
            'application',
            'hardware',
            'mobileDevice',
            'meetingRoom',
            'infrastructure'
        ));
    }
    public function adduser(Request $request): RedirectResponse
    {
        User::create($request->all());
        return redirect(route('dashboard'));
    }

    public function allUsers(): View
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function incidentsReport(): View
    {
        $incidents = IncidentRequest::all();
        return view('admin.report', compact('incidents'));
    }

    public function generatePDF()
    {
        $incidents = IncidentRequest::all();

        $data = ['incidents' => $incidents];

        $pdf = PDF::loadView('admin.export-report', $data);

        return $pdf->download('incident_report_'.date('Y-m-d').'_.pdf');
    }

    public function generateExcel(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return Excel::download(new IncidentRequestExport(), 'incident_report_'.date('Y-m-d').'_.xlsx');
    }

}
