@extends('layouts.app')

@section('content')
<div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h2>Simple QR Code</h2>
            </div>
            <div class="card-body">
                @foreach($students as $student)
                {!! QrCode::size(300)->generate($student->student_id) !!}
                @endforeach
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h2>Color QR Code</h2>
            </div>
            <div class="card-body">
                {!! QrCode::size(300)->backgroundColor(255,90,0)->generate('https://github.com/JOHNMARK2334/School-Management-system') !!}
            </div>
        </div>
    </div>

@endsection