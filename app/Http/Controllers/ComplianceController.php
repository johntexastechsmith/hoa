<?php
namespace App\Http\Controllers;

use App\Hoa;
use Illuminate\Http\Request;

class ComplianceController extends Controller
{
    public function index()
    {
        return view('compliance.index');
    }
}