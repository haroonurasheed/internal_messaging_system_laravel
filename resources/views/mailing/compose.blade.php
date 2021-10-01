@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Compose Message') }}</div>

                <div class="card-body">
                    <div class="alert">
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('To') }}</label>

                            <div class="col-md-6">
                                <select id="name"  class="form-control" name="to" required>
                                    <option value="">Select User</option>
                                    @foreach($users as $user)
                                        @if(auth()->user()->id != $user->id)
                                            <option value="{{ $user->id }}">{{ $user->email }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Message') }}</label>

                            <div class="col-md-6">
                                <textarea class="form-control" id="message" name="message" required></textarea>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="button" class="btn btn-primary" id="sendMsg">
                                    {{ __('Send') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
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
                    url: '/compose',

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
</div>
@endsection
