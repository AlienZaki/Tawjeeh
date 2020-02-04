@extends('layouts.app')

@section('scripts')
    <script type="text/javascript" src="{{asset('js/jquery-2.2.4.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.printPage.js')}}"></script>
@endsection

@section('content')

        <br><br>
        <a class="btn btn-primary printbtn" href="{{ url('/qrcode') }}" role="button">Print Preview</a>

        <script type="text/javascript">
            $(document).ready(function(){
                $('.printbtn').printPage();
            });
        </script>


@endsection



