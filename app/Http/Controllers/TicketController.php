<?php
namespace App\Http\Controllers;

use App\Hoa;
use App\Property;
use App\Ticket;
use App\TicketNote;
use App\TicketStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $hoa = Hoa::findOrFail($request->session()->get('hoa_id'));
        $properties = $hoa->properties()->get();
        $tickets = $hoa->tickets()->get();

        return view('ticket.index', ['tickets' => $tickets, 'hoa' => $hoa, 'properties' => $properties]);
    }

    public function create(Request $request)
    {
        $property = Property::where('id', '=', $request->property_id)->firstOrFail();

        $ticket = new Ticket();
        $ticket->type = $request->type;
        $ticket->opened_at = Carbon::now();
        $ticket->opened_by = Auth::id();
        $ticket->status = TicketStatus::OPEN;
        $ticket->description = $request->description;
        $ticket->hoa()->associate($property->hoa);
        $ticket->property()->associate($property);
        $ticket->save();

        return redirect()->route('ticket.index');
    }

    public function delete($id)
    {
        Ticket::destroy($id);

        return redirect()->route('ticket.index');
    }

    public function manage(Request $request, $id)
    {
        $hoa = Hoa::findOrFail($request->session()->get('hoa_id'));
        $ticket = Ticket::findOrFail($id);
        $notes = $ticket->notes()->get();
        $property = $ticket->property;

        return view('ticket.manage', ['ticket' => $ticket, 'hoa' => $hoa, 'notes' => $notes, 'property' => $property]);
    }

    public function createNote(Request $request)
    {
        $ticket = Ticket::findOrFail($request->ticket_id);

        $note = new TicketNote();
        $note->note = $request->note;
        $note->created_by = Auth::id();
        $note->ticket()->associate($ticket);
        $note->save();

        return back();
    }
}