<template>
    <div class="container">
        <div class="map-card">
            <div class="row">
                <div class="col-12">
                    {{$t('random_restaurant')}}
                </div>
                <div class="col-12">
                    <button @click="getCurrentLocationInfo"></button>
                </div>
                <div class="col-12">
                    {{ $t('your_location') }} 
                </div>
                <div class="col-12">
                    <div id="map"></div>
                </div>
            </div>
        </div>

    </div>


</template>

<script setup>
import { useI18n } from 'vue-i18n'
const { t } = useI18n()
import { onMounted, ref } from 'vue';
import { initMap, getCurrentLocationInfo } from '../mixins/initMap';


// initMap;
</script>

<style>
.map-card {
    text-align: center;
    max-width: 90%;
    margin: 0 auto;
    padding: 20px 10px 10px 10px;
    border: solid 1px;
    border-radius: 5px;
    box-shadow: 0 3px 9px #777;
}

#map {
    height: 500px;
}
</style>