@extends('layouts.app')

@section('title', 'Manage Property')

@section('content')
    <h2 class="uk-text-center">{{ $hoa->name }}</h2>
    <h3 class="uk-text-center">{{ $property->full_address }}</h3>

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
@endsection