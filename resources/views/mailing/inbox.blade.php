@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Inbox') }}</div>

                <div class="card-body" style="width:100%!important;">
                    <div class="alert">
                    </div>
                    <div class="alert alert-success" style="display:none;">
                        <strong>Success!</strong> Your message has been sent
                    </div>

                    <table class="table-striped" border="1" style="width:100%;">
                        <tr>
                            <th>From</th>
                            <th>Message</th>
                            <th>Date</th>
                        </tr>
                        @foreach($messages as $msg)
                            <tr @if($msg->read == 0) style="background-color:#F0B27A;font-weight: bold;"@endif>
                                <td>{{ $msg->email }}</td>
                                <td><a href="/msgdetail/{{ $msg->id }}">{{ Str::limit($msg->message, 50) }}</a></td>
                                <td> {{date('F j, Y, g:i a', strtotime($msg->created_at))}}</td>
                            </tr>
                        @endforeach
                    </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function (){
            $('#sendMsg').click(function(){
                $('.alert').removeClass('alert-danger');
                $('.alert').html('');
                if($('#name').val() == ""){
                    $('.alert').addClass('alert-danger');
                    $('.alert').html('<strong>Error!</strong> Must select user');
                }
                if($('#message').val() == ""){
                    $('.alert').addClass('alert-danger');
                    $('.alert').html('<strong>Error!</strong> Must fill message');
                }
                $.ajax({
                    type:'POST',
                    url: '/outbox',

                    data: {
                        'user': $('#name').val(),
                        'message': $('#message').val(),
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(html){
                        $('.alert').addClass('alert-success');
                        $('.alert').html('<strong>Success!</strong> Your message has been sent');
                    }
                });
        });

        });
    </script>
        <style>
            td{padding:10px;}
            th{padding:10px;}
        </style>
</div>
@endsection
