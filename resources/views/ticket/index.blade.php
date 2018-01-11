@extends('layouts.app')

@section('title', 'Tickets')

@section('content')
    <h2 class="uk-text-center">{{ $hoa->name }}</h2>
    <div class="panel panel-default">
        <div class="panel-heading">
            Tickets
            <a href="#" data-toggle="modal" data-target="#createModal"><span class="glyphicon glyphicon-plus"></span></a>
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Description</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->id }}</td>
                        <td>{{ $ticket->type }}</td>
                        <td>{{ $ticket->status }}</td>
                        <td>{{ $ticket->description }}</td>
                        <td>
                            <a href="{{ route('ticket.manage', ['id' => $ticket->id]) }}"><span class="glyphicon glyphicon-pencil"></span></a>
                            <a href="{{ route('ticket.delete', ['id' => $ticket->id]) }}"><span class="glyphicon glyphicon-trash"></span></a>
                        </td>
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
                    <form class="form-horizontal" method="POST" action="{{ route('ticket.create') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('property_id') ? ' has-error' : '' }}">
                            <label for="property_id" class="col-md-4 control-label">Property</label>

                            <div class="col-md-6">
                                <select id="property_id" name="property_id" class="form-control" required autofocus>
                                    <option value="">Select Property...</option>
                                    @foreach ($properties as $property)
                                        <option value="{{ $property->id }}">{{ $property->street_address }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('property_id'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('property_id') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">Type</label>

                            <div class="col-md-6">
                                <select id="type" class="form-control" name="type" required autofocus>
                                    <option value="">Select Type...</option>
                                    <option value="Yard">Yard</option>
                                    <option value="Structure">Structure</option>
                                </select>
                                @if ($errors->has('type'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" required autofocus>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
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