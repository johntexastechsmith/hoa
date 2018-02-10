@extends('layouts.app')

@section('title', 'HOA Management')

@section('content')
    <h1>{{ $hoa->name }}</h1>
    <h3>{{ $hoa->street_address_line_1 }}</h3>
    <h3>{{ $hoa->city . ', ' . $hoa->state . ' ' . $hoa->zip }}</h3>
@endsection