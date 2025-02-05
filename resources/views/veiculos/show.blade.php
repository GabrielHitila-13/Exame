@extends('layouts.app')

@section('content')
    
@if (isset($qrCodePath))
    <img src="{{ $qrCodePath }}" alt="QR Code" />
@endif

@endsection
