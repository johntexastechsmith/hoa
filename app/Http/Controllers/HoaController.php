<?php
namespace App\Http\Controllers;

use App\Hoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HoaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {     
        if (Auth::user()->isBoardMember()) {
            return redirect()->route('boardmember.index');
        } elseif (Auth::user()->isComplianceOfficer()) {
            return redirect()->route('compliance.index');
        } elseif (Auth::user()->isOwner())  {
            return redirect()->route('owner.index');
        }

        $hoas = Hoa::all()->sortBy('name');

        return view('hoa.index', ['hoas' => $hoas]);
    }

    public function create(Request $request)
    {
        $hoa = new Hoa();
        $hoa->name = $request->name;
        $hoa->save();

        return redirect()->route('hoa.index');
    }

    public function delete($id)
    {
        Hoa::destroy($id);

        return redirect()->route('hoa.index');
    }

    public function manage(Request $request, $id)
    {
        // $boardmember = BoardMember::where('id', '=', Auth::user()->id)->first();
        // dd(Auth::user()->boardmember(),$boardmember);

        $hoa = Hoa::where('id', '=', $id)->firstOrFail();

        $request->session()->put('hoa_id', $id);
        $request->session()->put('hoa_name', $hoa->name);

        return view('hoa.manage', ['hoa' => $hoa]);
    }
}