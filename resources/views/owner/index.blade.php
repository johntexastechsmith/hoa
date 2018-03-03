@extends('layouts.app')

@section('title', 'Owners')

@section('content')
    <h2 class="uk-text-center">{{ $hoa->name }}</h2>
    <div class="panel panel-default">
        <div class="panel-heading">
            Owners
            <a href="#" data-toggle="modal" data-target="#createModal"><span class="glyphicon glyphicon-plus"></span></a>
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Owner Name</th>
                    <th>Property Address</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($owners as $owner)
                    <tr>
                        <td>{{ $owner->name }}</td>
                        @foreach ($owner->properties as $property)
                            <td>{{ $property->street_address }}</td>
                        @endforeach
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
                    <form class="form-horizontal" method="POST" action="{{ route('owner.create') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="col-md-4 control-label">First Name</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus>

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autofocus>

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                            <label for="phone_number" class="col-md-4 control-label">Phone Number</label>

                            <div class="col-md-6">
                                <input id="phone_number" type="text" class="form-control" name="phone_number" value="{{ old('phone_number') }}" required autofocus>

                                @if ($errors->has('phone_number'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('phone_number') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email_address') ? ' has-error' : '' }}">
                            <label for="email_address" class="col-md-4 control-label">Email Address</label>

                            <div class="col-md-6">
                                <input id="email_address" type="text" class="form-control" name="email_address" value="{{ old('email_address') }}" required autofocus>

                                @if ($errors->has('email_address'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('email_address') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('active') ? ' has-error' : '' }}">
                            <label for="active" class="col-md-4 control-label">Is Active Owner</label>

                            <div class="col-md-6">
                                <input id="active" type="checkbox" class="form-control" name="active" value="{{ old('active') }}" required autofocus>

                                @if ($errors->has('active'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('active') }}</strong>
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