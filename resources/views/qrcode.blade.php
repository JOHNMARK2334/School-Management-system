@extends('layouts.app')

@section('content')
<div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h2>Simple QR Code</h2>
            </div>
            <div class="card-body">
               
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h2>Color QR Code</h2>
            </div>
            <div class="card-body">
                {!! QrCode::size(300)->backgroundColor(0,0,0)->generate('https://github.com/JOHNMARK2334/School-Management-system') !!}
            </div>
        </div>
    </div>

@endsection