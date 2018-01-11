@extends('layouts.app')

@section('title', 'HOA Management')

@section('content')
    <h2 class="uk-text-center">{{ $hoa->name }}</h2>
    <div class="row">
        <div class="col-xs-4">
            <a href="/properties">
                <span class="glyphicon glyphicon-home"> Properties</span>
            </a>
        </div>
        <div class="col-xs-4">
            <a href="/owners">
                <span class="glyphicon glyphicon-user"> Owners</span>
            </a>
        </div>
        <div class="col-xs-4">
            <a href="/tickets">
                <span class="glyphicon glyphicon-list-alt"> Tickets</span>
            </a>
        </div>
    </div>
        </div>
    </div>

@endsection