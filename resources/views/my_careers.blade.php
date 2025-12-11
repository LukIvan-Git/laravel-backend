@extends('common.base')
@push('js-header')
    @vite(['resources/js/pages/carrerindex.js'])
@endpush
@push('page-title')
    <title>My Careers</title>
@endpush
@section('content')
<main>
    <section id="career-section" class="py-5">
        <div class="container"> 
            <h1 class="mb-2 mb-lg-4">@lang('frontend.my_career')</h1>
            <div id="carrer-index">
                <carrer-index></carrer-index>
            </div>
        </div>
</main>
@endsection
