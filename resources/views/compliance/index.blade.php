@extends('layouts.app')

@section('title', 'Compliance Officer')

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Property</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($properties as $property)
                    <tr>
                        <td>
                            <a href={{ route('property.show', ['hoaId' => $hoa->id, 'propertyId' => $property->id]) }}>
                            {{ $property->street_number}} {{ $property->street_name }}
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection