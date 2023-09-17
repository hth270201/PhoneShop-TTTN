@extends('index')

@section('contents')
    @livewire('checkout', ['cart' => $cart])
@endsection
