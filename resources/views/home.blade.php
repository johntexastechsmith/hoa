@extends('layouts.app')

@section('title', 'HOA Management')

@section('content')
    <div class = "container-fluid">
    	<h4> {{ 'Welcome to the website for '. $hoa->name }}</h4>
    	<p>
    		Please register to receive up-to-date information on your account and information on upcoming meetings and events for your neighborhood.
    	</p>
    	<p>
            For your convenience, this website contains Architectural Change Request and Resale Certificate Request forms with instructions as well as other important governing documents.
        </p>

        <p>
            The mailing address for the HOA is: <br>
            {{ $hoa->name }}<br>
            {{ $hoa->street_address_line_1 }}<br>
            {{ $hoa->city . ', ' . $hoa->state . ' ' . $hoa->zip }}
        </p>
    </div>
@endsection