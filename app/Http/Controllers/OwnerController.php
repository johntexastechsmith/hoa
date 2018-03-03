<?php
namespace App\Http\Controllers;

use App\Hoa;
use App\Property;
use App\Owner;
use App\OwnerAddress;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OwnerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $hoa = Hoa::findOrFail($request->session()->get('hoa_id'));
        $owners = $hoa->owners()->get();

        return view('owner.index', ['hoa' => $hoa, 'owners' => $owners]);
    }

    public function add(Request $request)
    {
        $property = Property::where('id', '=', 1)->firstOrFail();

        $owner = new Owner();
        $owner->account_name = $property->street_address . ' (' . Carbon::now()->toDateString() . ')';
        $owner->first_name = $request->first_name;
        $owner->last_name = $request->last_name;
        $owner->phone_number = $request->phone_number;
        $owner->email_address = $request->email_address;
        $owner->active = $request->active;
        $owner->hoa()->associate($property->hoa);
        $owner->save();

        return redirect()->route('owner.index');
    }

    public function delete($id)
    {
        Owner::destroy($id);

        return redirect()->route('owner.index');
    }

    public function manage(Request $request, $id)
    {
        $hoa = Hoa::findOrFail($request->session()->get('hoa_id'));
        $owner = Owner::findOrFail($id);
        $property = $owner->property;

        return view('owner.manage', ['owner' => $owner, 'hoa' => $hoa, 'property' => $property]);
    }

    public function createAddress(Request $request)
    {
        /*
        $owner = Owner::findOrFail($request->owner_id);

        $note = new OwnerAddress();
        $note->note = $request->note;
        $note->created_by = Auth::id();
        $note->ticket()->associate($ticket);
        $note->save();

        return back();
        */
    }
}