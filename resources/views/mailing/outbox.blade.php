@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Outbox (sent items)') }}</div>

                    <div class="card-body" style="width:100%!important;">
                        <div class="alert">
                        </div>
                        <div class="alert alert-success" style="display:none;">
                            <strong>Success!</strong> Your message has been sent
                        </div>

                        <table class="table-striped" border="1" style="width:100%;">
                            <tr>
                                <th>To</th>
                                <th>Message</th>
                                <th>Date</th>
                            </tr>
                            @foreach($messages as $msg)
                                <tr @if($msg->read == 0) style="background-color:#F0B27A;font-weight: bold;"@endif>
                                    <td>{{ $msg->email }}</td>
                                    <td><a href="/msgsentdetail/{{ $msg->id }}">{{ Str::limit($msg->message, 50) }}</a></td>
                                    <td>{{date('F j, Y, g:i a', strtotime($msg->created_at))}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>

            <style>
                td{padding:10px;}
                th{padding:10px;}
            </style>
        </div>
@endsection
