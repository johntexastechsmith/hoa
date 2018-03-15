@extends('layouts.app')

@section('title', 'Board Member')

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Owner Name</th>
                    <th>Account Number</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($owners as $owner)
                    <tr>
                        <td>
                            <a href={{ route('owner.show', ['hoaId' => $hoa->id, 'ownerId' => $owner->id]) }}>
                            {{ $owner->name }} </a> </td>
                        <td>{{ $owner->account_name }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection