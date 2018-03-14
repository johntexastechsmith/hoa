@extends('layouts.app')

@section('title', 'Owner')

@section('content')

    <tr>
        <td>Welcome {{ $owner->name }}<br></td>
        <td>Account Number: {{ $owner->account_name }}</td>
    </tr>

@endsection