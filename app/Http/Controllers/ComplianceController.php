<?php
namespace App\Http\Controllers;

// use App\Hoa;
// use App\ComplianceOfficer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ComplianceController extends Controller
{
    public function index()
    {
        $complianceOfficer = Auth::user()->complianceOfficer;
        $hoa = $complianceOfficer->hoa;

        $properties = DB::table('properties')->where('hoa_id', $hoa->id)->get();

        return view('compliance.index', ['hoa' => $hoa, 'properties' => $properties]); 
    }
}