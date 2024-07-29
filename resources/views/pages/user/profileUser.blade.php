@extends('layouts.app')

@section('contents')
    <main class="profile overflow-scroll h-screen no-scrollbar">
        @include('includes.navbar')
        <section class="mx-2 sm:mx-10 md:mx-20 -mt-8">
            @include('includes.profile')
        </section>
    </main>
@endsection
