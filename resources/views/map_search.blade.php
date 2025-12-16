@extends('common.base')
@push('js-header')
    @vite(['resources/js/pages/mapsearch.js'])
@endpush
@push('page-title')
    <title>Map Search</title>
@endpush
@section('content')
<main>
    <section id="map-section" class="pt-lg-4 pt-5 pb-3">
        <div class="container"> 
            <h1 class="mb-3 mb-lg-4">@lang('frontend.map_search')</h1>
            <div id="map-search">
                <map-search></map-search>
            </div>
        </div>
</main>
@endsection

