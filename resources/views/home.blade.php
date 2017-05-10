@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                    @if( Auth::user()->esAdmin )
                        @include('admin.welcomeAdmin')
                    @else
                        @include('welcomeStudent')
                    @endif

            
            </div>
        </div>
    </div>
</div>
@endsection
