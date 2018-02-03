@extends('layouts.app')

@section('title', 'Quickbooks Integration')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Quickbooks Integration
        </div>
        <div class="panel-body">
            <form class="form-horizontal" method="POST" action="{{ route('quickbooks.authorize', ['id' => 1]) }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('client_id') ? ' has-error' : '' }}">
                    <label for="client_id" class="col-md-4 control-label">Client ID</label>

                    <div class="col-md-6">
                        <input id="client_id" type="text" class="form-control" name="client_id" value="{{ $clientId }}" required autofocus>

                        @if ($errors->has('client_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('client_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('client_secret') ? ' has-error' : '' }}">
                    <label for="client_secret" class="col-md-4 control-label">Client Secret</label>

                    <div class="col-md-6">
                        <input id="client_secret" type="text" class="form-control" name="client_secret" value="{{ $clientSecret }}" required autofocus>

                        @if ($errors->has('client_secret'))
                            <span class="help-block">
                                <strong>{{ $errors->first('client_secret') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('access_token') ? ' has-error' : '' }}">
                    <label for="access_token" class="col-md-4 control-label">Access Token</label>

                    <div class="col-md-6">
                        <input id="access_token" type="text" class="form-control" name="access_token" value="{{ $accessToken }}" required autofocus>

                        @if ($errors->has('access_token'))
                            <span class="help-block">
                                <strong>{{ $errors->first('access_token') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('refresh_token') ? ' has-error' : '' }}">
                    <label for="refresh_token" class="col-md-4 control-label">Refresh Token</label>

                    <div class="col-md-6">
                        <input id="refresh_token" type="text" class="form-control" name="refresh_token" value="{{ $refreshToken }}" required autofocus>

                        @if ($errors->has('refresh_token'))
                            <span class="help-block">
                                <strong>{{ $errors->first('refresh_token') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('realm_id') ? ' has-error' : '' }}">
                    <label for="realm_id" class="col-md-4 control-label">Realm Id</label>

                    <div class="col-md-6">
                        <input id="realm_id" type="text" class="form-control" name="realm_id" value="{{ $realmId }}" required autofocus>

                        @if ($errors->has('realm_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('realm_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <label for="current_status" class="col-md-4 control-label">Current Status</label>

                <div class="col-md-6">
                    @if ($isConnected)
                        <span>Connected</span>
                    @else
                        <span>Not Active</span>
                    @endif
                </div>

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Authorize
                        </button>
                    </div>
                </div>
            </form>
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
                    <form class="form-horizontal" method="POST" action="{{ route('hoa.create') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">HOA Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
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