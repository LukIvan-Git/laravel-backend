<template>
    <div class="container">
        <div class="map-card">
            <div class="row" v-show="step == 1">
                <div class="col-12 title-row">
                    <span class="main-title">{{ $t('random_restaurant') }}</span>
                </div>
                <div class="col-12 title-row">
                    <span class="title-note">{{ $t('random_restaurant_note') }}</span>
                </div>
                <div class="col-12 btn-row d-flex justify-content-center">
                    <button type="button" class="main-btn" @click="getUserLocation">
                        <span class="search-icon">📍</span> {{ $t('where_am_i') }}
                    </button>
                    <button type="button" class="main-btn outline" @click="pinself">
                        <span class="search-icon">📌</span> {{ $t('pin_my_self') }}
                    </button>
                </div>
                <div class="col-12 text-center mb-3 d-inline-block">
                    <div class="search-result-wait-box" v-if="markerPosLoading">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                    <span v-if="mapErr" class="">{{ mapErr.message }} {{ $t('try_again') }}</span>
                    <span v-if="markerPos" class="marker-label">Lat: <b>{{ markerLat }}</b>, Lng: <b>{{ markerLng }}</b>
                    </span>
                    <span v-else class="marker-label">Lat/Lng: --</span>
                </div>
                <div class="col-12 mb-3">
                    <div id="map"></div>
                </div>
                <div class="col-12 text-right" v-if="markerPos && step == 1">
                    <button type="button" class="main-btn next-btn my-3" @click="nextStep">{{ $t('next_step')
                    }}</button>
                </div>
            </div>
            <div class="row" v-show="step == 2">
                <div class="col-12">
                    <div class="step2-box">
                        <strong>Step 2:</strong> Marker location detected.<br>
                        <span class="marker-label">Lat: <b>{{ markerLat }}</b>, Lng: <b>{{ markerLng }}</b></span>
                    </div>
                </div>
                <div class="col-12">
                    <button type="button" class="search-btn" @click="search">
                        <span class="search-icon">🔍</span> {{ $t('search') }}
                    </button>
                    <div class="search-result-wait-box" v-if="searchLoading">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                    <div v-if="searchResultShow">
                        <div class="search-result-box">
                            <div v-if="resultArray.length" class="result-list-box">
                                <div v-for="(item, idx) in resultArray" :key="idx"
                                    class="result-card position-relative">
                                    <div class="result-title">{{ item.displayName || $t('no_name') }}</div>
                                    <div class="result-field">
                                        <div class="result-label">{{ $t('address') }}</div>
                                        <div class="result-value">{{ item.address || '-' }}</div>
                                    </div>
                                    <div class="result-field ">
                                        <div class="result-label">{{ $t('rating') }}</div>
                                        <div class="result-value position-relative">
                                            {{ item.rating ?? '- ' }}<span class="filled">&#9733;</span>
                                        </div>
                                    </div>
                                    <div class="result-field">
                                        <div class="result-label">{{ $t('price') }}</div>
                                        <div class="result-value">
                                            <span v-if="item.price">{{ item.price }}</span>
                                        </div>
                                    </div>
                                    <div class="result-field">
                                        <div class="result-label">{{ $t('url') }}</div>
                                        <div class="result-value">
                                            <a v-if="item.url" :href="item.url" target="_blank" class="result-link">{{
                                                $t('open_in_maps') }}</a>
                                            <span v-else>-</span>
                                        </div>
                                    </div>
                                    <span v-if="item.highest"
                                        class="translate-middle badge rounded-pill bg-info text-dark best-badge">Best</span>
                                </div>
                            </div>
                            <div v-else class="no-result">{{ $t('no_result_found') }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-left mt-3">
                    <button type="button" class="main-btn outline" v-if="step > 1" @click="backStep">{{ $t('back_step')
                    }}</button>
                </div>
            </div>
        </div>
    </div>


</template>

<script setup>
import { useI18n } from 'vue-i18n'
const { t } = useI18n()
import { onMounted, ref, shallowRef, computed, watch } from 'vue';
import MapService from '../mixins/initMap';
const mapSvc = shallowRef(null);
const markerPos = ref(null);
const markerPosLoading = ref(false);
const markerLat = computed(() => markerPos.value ? markerPos.value.lat : '--');
const markerLng = computed(() => markerPos.value ? markerPos.value.lng : '--');

const locale = window.locale;

function formatLocale(localeString) {
    if (!localeString) return null;
    let formatted = localeString.replace(/_/g, '-');
    const parts = formatted.split('-');
    if (parts.length === 2) {
        return `${parts[0].toLowerCase()}-${parts[1].toUpperCase()}`;
    } else if (parts.length === 1) {
        return parts[0].toLowerCase();
    }

    return formatted;
}

const formattedLocale = formatLocale(locale);

onMounted(async () => {
    mapSvc.value = new MapService('map', formattedLocale);
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

async function pinself() {
    await mapSvc.value.blindClickEvent();
}


function clearErr(){
    mapErr.value = null;
};

const mapErr = ref('');
async function getUserLocation() {
    if (!mapSvc.value) {
        console.warn('MapService not initialized');
        return;
    }
    
    try {
        markerPosLoading.value = true;
        clearErr();
        const pos = await mapSvc.value.getCurrentLocation();
        await mapSvc.value.setMarker(pos, 'Location found');
        markerPosLoading.value = false;
    } catch (err) {
        markerPosLoading.value = false;
        mapErr.value = err;
        console.error('Could not get location', err);
    }finally{
        markerPosLoading.value = false;
    }
};


const step = ref(1);

function nextStep() {
    step.value++;
}
function backStep() {
    step.value--;
}


//step2
watch(markerPos, (newValue, oldValue) => {
    if (newValue != oldValue) {
        resultArray.value = [];
        searchResultShow.value = false;
        searchLoading.value = false;
    }
});

const searchResultShow = ref(false);
const searchLoading = ref(false);
const resultArray = ref([]);
async function search() {
    try {
        searchLoading.value = true;
        const response = await mapSvc.value.searchNearBy(markerPos.value);
        searchResultShow.value = true;
        if (response != []) {

            const ratings = response.map(p => p.rating || 0).filter(r => !isNaN(r));
            const maxRating = ratings.length > 0 ? Math.max(...ratings) : 0;

            resultArray.value = response.map(p => {
                const newObj = {
                    displayName: p.displayName,
                    address: p.formattedAddress,
                    price: p.priceRange ? (p.priceRange?.startPrice?.currencyCode) + ': ' + (p.priceRange?.startPrice ?? '') + ' - ' + (p.priceRange?.endPrice ?? '') : '/',
                    rating: p.rating ?? null,
                    highest: p.rating === maxRating,
                    url: p.googleMapsURI
                };

                return newObj;
            });
        }
        searchLoading.value = false;
    } catch (e) {
        console.error(e);
        searchLoading.value = false;
    } finally {
        searchLoading.value = false;
    }

}
</script>

<style></style>