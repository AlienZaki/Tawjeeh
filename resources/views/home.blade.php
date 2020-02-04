@extends('layouts.app')

@section('scripts')
    <script type="text/javascript" src="{{asset('js/jquery-2.2.4.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.printPage.js')}}"></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                        <br><br>
                        <a class="btn btn-primary printbtn" href="{{ url('/qrcode/123') }}" role="button">Print QRCode</a>
                        <script type="text/javascript">
                            $(document).ready(function(){
                                $('.printbtn').printPage();
                            });
                        </script>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
