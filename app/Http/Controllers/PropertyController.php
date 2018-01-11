<?php
namespace App\Http\Controllers;

use App\Hoa;
use App\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $hoa = Hoa::findOrFail($request->session()->get('hoa_id'));
        $properties = $hoa->properties()->get()->sortBy('street_number');

        return view('property.index', ['properties' => $properties, 'hoa' => $hoa]);
    }

    public function create(Request $request)
    {
        $hoa = Hoa::findOrFail($request->session()->get('hoa_id'));

        $property = new Property();
        $property->street_number = $request->street_number;
        $property->street_name = $request->street_name;
        $property->city = $request->city;
        $property->state = $request->state;
        $property->zip = $request->zip;

        $geocoding = \GoogleMaps::load('geocoding')
            ->setParam ([
                'address'    => $property->street_number . ' ' . $property->street_name . ', ' . $property->city . ', ' . $property->state . ' ' . $property->zip,
                'components' => [
                    'country'              => 'US',
                ]

            ])
            ->get();
        $geocoding = json_decode($geocoding);

        $property->lat = $geocoding->results[0]->geometry->location->lat;
        $property->lng = $geocoding->results[0]->geometry->location->lng;
        $hoa->properties()->save($property);

        return redirect()->route('property.index');
    }

    public function delete($id)
    {
        Property::destroy($id);

        return redirect()->route('property.index');
    }

    public function manage(Request $request, $id)
    {
        $hoa = Hoa::findOrFail($request->session()->get('hoa_id'));
        $property = Property::findOrFail($id);
        $tickets = $property->tickets()->get();

        return view('property.manage', ['property' => $property, 'hoa' => $hoa, 'tickets' => $tickets]);
    }
}