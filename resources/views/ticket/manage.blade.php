@extends('layouts.app')

@section('title', 'Manage Ticket')

@section('content')
    <h2 class="uk-text-center">{{ $hoa->name }}</h2>
    <div class="panel panel-default">
        <div class="panel-heading">
            Ticket Details
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <tbody>
                    <tr>
                        <td>Property</td>
                        <td>{{ $property->street_address }}</td>
                    </tr>
                    <tr>
                        <td>Type:</td>
                        <td>{{ $ticket->type }}</td>
                    </tr>
                    <tr>
                        <td>Status:</td>
                        <td>{{ $ticket->status }}</td>
                    </tr>
                    <tr>
                        <td>Description:</td>
                        <td>{{ $ticket->description }}</td>
                    </tr>
                    <tr>
                        <td>Opened Date:</td>
                        <td>{{ $ticket->opened_at->toFormattedDateString() }}</td>
                    </tr>
                    <tr>
                        <td>Opened By:</td>
                        <td>{{ $ticket->opener->name }}</td>
                    </tr>
                    <tr>
                        <td>Closed Date:</td>
                        <td>{{ $ticket->closer->name }}</td>
                    </tr>
                    <tr>
                        <td>Closed By:</td>
                        <td>{{ $ticket->closed_by }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            Notes
            <a href="#" data-toggle="modal" data-target="#createModal"><span class="glyphicon glyphicon-plus"></span></a>
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Created At</th>
                    <th>Created By</th>
                    <th>Note</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($notes as $note)
                    <tr>
                        <td>{{ $note->created_at }}</td>
                        <td>{{ $note->user->name }}</td>
                        <td>{{ $note->note }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div id="createModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="{{ route('ticket.note.create') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                        <div class="form-group{{ $errors->has('note') ? ' has-error' : '' }}">
                            <label for="property_id" class="col-md-4 control-label">Note</label>

                            <div class="col-md-6">
                                <textarea id="note" name="note" class="form-control" rows="3"></textarea>
                                @if ($errors->has('note'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('note') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Create
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection