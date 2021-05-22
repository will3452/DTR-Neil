@extends('layouts.app')

@section('content')
<div class="container">
    @can('view-admin-dashboard')
                <div class="card">
                    <div class="card-header">
                        Admin Dashboard
                    </div>
                    <div class="card-body">
                        <a href="{{ route('admin-accounts.index') }}" class="btn btn-primary">Accounts</a>
                    </div>
                </div>
            @endcan
            @cannot('view-admin-dashboard')
                <div class="card">
                    <div class="card-header">{{ __('Menu') }}</div>
                    <div class="card-body">
                        <a href="{{ route('dtr.create') }}" class="btn btn-primary">
                            <i class="fa fa-upload"></i> SUBMIT DTR
                        </a>
                        <a href="{{ route('dtr.index') }}" class="btn btn-primary">
                            <i class="fa fa-eye"></i> SHOW FILED DTR
                        </a>
                        <a href="{{ route('messages.index') }}" class="btn btn-primary">
                            <i class="fa fa-envelope"></i> CHAT TO ADMIN
                        </a>
                    </div>
            </div>
            @endcannot
            <div class="card mt-2">
                <div class="card-header">{{ __('Account Information') }}</div>
                <div class="card-body">
                    <form method="POST" action="/update-account" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ auth()->user()->name }}" required autocomplete="name">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_number" class="col-md-4 col-form-label text-md-right">{{ __('ID number') }}</label>
                            <div class="col-md-6">
                                <input id="id_number" type="text" class="form-control @error('id_number') is-invalid @enderror" name="id_number" value="{{ auth()->user()->id_number }}" required autocomplete="id_number">

                                @error('id_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control @error('username') is-invalid @enderror" name="" disabled value="{{ auth()->user()->username }}" required autocomplete="username">
                                <small class="text-helper text-info">
                                    You're not allowed to update this field.
                                </small>
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                                <select name="gender" id="" class="custom-select">
                                    <option value="male" @if(auth()->user()->gender == 'male') selected @endif>Male</option>
                                    <option value="female" @if(auth()->user()->gender == 'female') selected @endif>Female</option>
                                </select>
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

                            <div class="col-md-6">
                                <select name="status" id="" class="custom-select">
                                    <option value="regular" @if(auth()->user()->status == 'regular') selected @endif>Regular </option>
                                    <option value="probation" @if(auth()->user()->status == 'probation') selected @endif>Probation</option>
                                </select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Change Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update Account') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
</div>
@endsection
