@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if(request()->routeIs('permisos'))
            @livewire('permisos.permisos')
        @endif

        @if(request()->routeIs('roles'))
            @livewire('roles.roles')
        @endif

        @if(request()->routeIs('home'))
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif   
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>
@endsection
