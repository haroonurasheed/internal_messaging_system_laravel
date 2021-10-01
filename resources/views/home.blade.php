@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <strong>Welcome {{Auth::user()->name}}</strong><br/>
                    Current Time: {{ date("F j, Y, g:i a")}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
