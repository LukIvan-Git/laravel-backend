@extends('common.base')
@push('js-header')
    @vite(['resources/js/pages/mapsearch.js'])
@endpush
@push('page-title')
    <title>Map Search</title>
@endpush
@section('content')
<main>
    <section id="map-section" class="py-5">
        <div class="container"> 
            <h1 class="mb-2 mb-lg-4">@lang('frontend.map_search')</h1>
            <div id="map-search">
                <map-search></map-search>
            </div>
        </div>
</main>
@endsection

