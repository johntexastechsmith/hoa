@extends('layouts.app')

@section('title', 'Owner')

@section('content')

    <tr>
        <td>Owner Name: {{ $owner->name }}<br></td>
        <td>Account Number: {{ $owner->account_name }}</td>
    </tr>

@endsection