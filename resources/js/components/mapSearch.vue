<template>
    <div class="container">
        <div class="map-card">
            <div class="row">
                <div class="col-12">
                    {{$t('random_restaurant')}}
                </div>
                <div class="col-12">
                    <button type="button" @click="getUserLocation">Detect</button>
                </div>
                <div class="col-12">
                    <button type="button" @click="pinself">Pin Myself</button>
                </div>
                <div class="col-12">
                    <span v-if="markerPos">Lat: {{ markerLat }}, Lng: {{ markerLng }}</span>
                    <span v-else>Lat/Lng: --</span>
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
import { onMounted, ref, shallowRef, computed } from 'vue';
import MapService from '../mixins/initMap';
const mapSvc = shallowRef(null);
const markerPos = ref(null);
const markerLat = computed(() => markerPos.value ? markerPos.value.lat : '--');
const markerLng = computed(() => markerPos.value ? markerPos.value.lng : '--');

onMounted(async () => {
    mapSvc.value = new MapService('map');
    try {
        await mapSvc.value.init();
        // Patch setMarker to update markerPos
        const origSetMarker = mapSvc.value.setMarker.bind(mapSvc.value);
        mapSvc.value.setMarker = async (position, content) => {
            markerPos.value = position;
            await origSetMarker(position, content);
        };
    } catch (e) {
        console.error('Failed to initialize map', e);
    }
});

async function pinself(){
    await mapSvc.value.blindClickEvent();
}

async function getUserLocation () {
    if (!mapSvc.value) {
        console.warn('MapService not initialized');
        return;
    }

    try {
        const pos = await mapSvc.value.getCurrentLocation();
        await mapSvc.value.setMarker(pos, 'Location found');
    } catch (err) {
        console.error('Could not get location', err);
    }
};

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