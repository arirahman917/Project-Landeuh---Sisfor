@extends('layouts.app')
@section('content')
    @include('landing.sections.hero')
    @include('landing.sections.tentang')
    @include('landing.sections.populer-akomodasi')
    @include('landing.sections.fasilitas')
    @include('landing.sections.jelajahi')
    @include('landing.sections.faq')
    @include('landing.sections.partner-pembayaran')

    @include('components.modal-login')
    @include('components.modal-register')
@endsection
