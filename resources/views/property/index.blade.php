@extends('layouts.app')

@section('title', 'Properties')

@section('content')
    <h2 class="uk-text-center">{{ $hoa->name }}</h2>
    <div class="panel panel-default">
        <div class="panel-heading">
            Properties
            <a href="#" data-toggle="modal" data-target="#createModal"><span class="glyphicon glyphicon-plus"></span></a>
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Street Address</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($properties as $property)
                    <tr>
                        <td>{{ $property->street_address }}</td>
                        <td>
                            <a href="{{ route('property.manage', ['id' => $property->id]) }}"><span class="glyphicon glyphicon-pencil"></span></a>
                            <a href="{{ route('property.delete', ['id' => $property->id]) }}"><span class="glyphicon glyphicon-trash"></span></a>
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
                    <form class="form-horizontal" method="POST" action="{{ route('property.create') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('street_number') ? ' has-error' : '' }}">
                            <label for="street_number" class="col-md-4 control-label">Street Number</label>

                            <div class="col-md-6">
                                <input id="street_number" type="text" class="form-control" name="street_number" value="{{ old('street_number') }}" required autofocus>

                                @if ($errors->has('street_number'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('street_number') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('street_name') ? ' has-error' : '' }}">
                            <label for="street_name" class="col-md-4 control-label">Street Name</label>

                            <div class="col-md-6">
                                <input id="street_name" type="text" class="form-control" name="street_name" value="{{ old('street_name') }}" required autofocus>

                                @if ($errors->has('street_name'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('street_name') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <label for="city" class="col-md-4 control-label">City</label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}" required autofocus>

                                @if ($errors->has('city'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('city') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                            <label for="state" class="col-md-4 control-label">State</label>

                            <div class="col-md-6">
                                <input id="state" type="text" class="form-control" name="state" value="{{ old('state') }}" required autofocus>

                                @if ($errors->has('state'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('state') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('zip') ? ' has-error' : '' }}">
                            <label for="zip" class="col-md-4 control-label">Zip</label>

                            <div class="col-md-6">
                                <input id="zip" type="text" class="form-control" name="zip" value="{{ old('zip') }}" required autofocus>

                                @if ($errors->has('zip'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('zip') }}</strong>
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