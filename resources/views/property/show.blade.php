@extends('layouts.app')

@section('title', 'Property')

@section('content')

    <tr>
        <td>Street Number: {{ $property->street_number }}<br></td>
        <td>Street Name: {{ $property->street_name }}<br></td>
        @forelse ($tickets as $ticket)
               <td>Ticket Id: {{ $ticket->id }}</td>  
               <td>Ticket Description: {{ $ticket->description }}</td>        
        @empty
            <td>No ticket history</td>
        @endforelse

    </tr>

@endsection