@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Message Detail') }}</div>

                <div class="card-body" style="width:100%!important;">
                    <div class="alert">
                    </div>
                    <div class="alert alert-success" style="display:none;">
                        <strong>Success!</strong> Your message has been sent
                    </div>

                    <table class="table-striped" border="1" style="width:100%;">
                        @if($status == 'fail')
                            <div class="alert alert-danger">
                                <strong>Error!</strong> Message does not exist
                            </div>
                        @else


                        <tr>
                            <td>From</td>
                            <td>{{ $messages[0]->email }}</td>
                        </tr>
                        <tr>
                            <td>Message</td>
                            <td>{{ $messages[0]->message }}</td>
                        </tr>
                        <tr>
                            <td>Date</td>
                            <td>{{date('F j, Y, g:i a', strtotime($messages[0]->created_at))}}</td>
                        </tr>
@endif
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
