<template>
    <div class="container">
        <div class="map-card">
            <div class="row" v-show="step == 1">
                <div class="col-12 title-row">
                    <span class="main-title">{{ $t('random_restaurant') }}</span>
                </div>
                <div class="col-12 btn-row d-flex justify-content-center">
                    <button type="button" class="main-btn" @click="getUserLocation">
                        <span class="search-icon">📍</span> {{ $t('where_am_i') }}
                    </button>
                    <button type="button" class="main-btn outline" @click="pinself">
                        <span class="search-icon">📌</span> {{ $t('pin_my_self') }}
                    </button>
                </div>
                <div class="col-12 text-center mb-3">
                    <span v-if="markerPos" class="marker-label">Lat: <b>{{ markerLat }}</b>, Lng: <b>{{ markerLng
                    }}</b></span>
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
                                <div v-for="(item, idx) in resultArray" :key="idx" class="result-card position-relative">
                                    <div class="result-title">{{ item.displayName || $t('no_name') }}</div>
                                    <div class="result-field">
                                        <div class="result-label">{{ $t('address') }}</div>
                                        <div class="result-value">{{ item.address || '-' }}</div>
                                    </div>
                                    <div class="result-field ">
                                        <div class="result-label">{{ $t('rating') }}</div>
                                        <div class="result-value position-relative">
                                            {{ item.rating ?? '-' }}<span class="filled">&#9733;</span>
                                        </div>
                                    </div>
                                    <div class="result-field">
                                        <div class="result-label">{{ $t('price') }}</div>
                                        <div class="result-value">
                                            <span v-if="item.price">{{ item.price}}</span>
                                        </div>
                                    </div>
                                    <div class="result-field">
                                        <div class="result-label">{{ $t('url') }}</div>
                                        <div class="result-value">
                                            <a v-if="item.url" :href="item.url" target="_blank"
                                                class="result-link">{{ $t('open_in_maps') }}</a>
                                            <span v-else>-</span>
                                        </div>
                                    </div>
                                    <span v-if="item.highest" class="translate-middle badge rounded-pill bg-info text-dark best-badge">Best</span>
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
import { onMounted, ref, shallowRef, computed } from 'vue';
import MapService from '../mixins/initMap';
const mapSvc = shallowRef(null);
const markerPos = ref(null);
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

async function getUserLocation() {
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


const step = ref(1);

function nextStep() {
    step.value++;
}
function backStep() {
    step.value--;
}

const searchResultShow = ref(false);
const searchLoading = ref(false);
const resultArray = ref([]);
async function search() {
    try {
        searchLoading.value = true;
        const response = await mapSvc.value.searchNearBy(markerPos.value);
        searchResultShow.value = true;
        if (response != []) {
            // 計算最高評分
    const ratings = response.map(p => p.rating || 0).filter(r => !isNaN(r));
    const maxRating = ratings.length > 0 ? Math.max(...ratings) : 0;
    
    // 創建新的 resultArray
    resultArray.value = response.map(p => {
        // 提取需要的基本屬性
        const newObj = {
            displayName: p.displayName,
            address: p.formattedAddress,
            price: (p.priceRange?.startPrice?.currencyCode)+': '+(p.priceRange?.startPrice ?? '') +' - '+(p.priceRange?.endPrice ?? '')  ,
            rating: p.rating,
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

<style>
.map-card {
    text-align: center;
    max-width: 90%;
    margin: 0 auto;
    padding: 28px 20px 10px 20px;
    border-radius: 5px;
    background: #fff;
    box-shadow: 0 4px 24px #4da6ff22, 0 1.5px 6px #0001;
    border: 1.5px solid #e3eefe;
}

#map {
    height: 500px;
}

.main-title {
    font-weight: bold;
    color: var(--primary-color);
}

.btn-row {
    gap: 12px;
    margin-top: 18px;
    margin-bottom: 8px;
}

.main-btn {
    background: var(--primary-color);
    color: #fff;
    border: none;
    border-radius: 6px;
    padding: 8px 20px;
    font-size: 1rem;
    font-weight: 500;
    cursor: pointer;
    transition: background 0.18s, box-shadow 0.18s;
    box-shadow: 0 2px 8px #4da6ff22;
    outline: none;
}

.main-btn:hover,
.search-btn:hover {
    background: var(--hover-color);
    color: #fff;
    box-shadow: 0 4px 16px #4da6ff33;
}

.main-btn.outline {
    background: #fff;
    color: var(--primary-color);
    border: 1.5px solid var(--primary-color);
    box-shadow: none;
}

.main-btn.outline:hover {
    background: var(--primary-color);
    color: #fff;
}

.marker-label {
    color: var(--secondary-color);
    font-size: 1rem;
}


.search-btn {
    background: var(--primary-color);
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 8px 18px 8px 14px;
    font-size: 1rem;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    transition: background 0.2s, box-shadow 0.2s;
    box-shadow: 0 2px 6px #4da6ff22;
    margin-top: 16px;
    margin-bottom: 2px;
}

.search-btn:hover {
    background: var(--hover-color);
    color: #fff;
    box-shadow: 0 4px 12px #4da6ff33;
}

.search-icon {
    margin-right: 6px;
    display: inline-block;
    line-height: 1;
}


.search-result-box {

    margin-top: 18px;
    background: #f8faff;
    border-radius: 8px;
    padding: 12px 10px 10px 10px;
    min-height: 48px;
    box-shadow: 0 1px 4px #4da6ff11;
}

.result-list-box {
    display: flex;
    flex-wrap: wrap;
    text-align: left;
    gap: 16px;
    justify-content: center;
}

.result-card {
    background: #fff;
    border: 1.5px solid #e3eefe;
    border-radius: 5px;
    box-shadow: 0 2px 8px #4da6ff11;
    padding: 0.7rem 1rem 0.5rem 1rem;
    min-width: 11rem;
    max-width: 16rem;
    margin-bottom: 0.4rem;
    display: flex;
    flex-direction: column;
    gap: 0.15rem;
    align-items: flex-start;
    font-size: 0.95rem;
}

.result-title {
    text-align: justify;
    font-weight: bold;
    color: var(--primary-color);
    font-size: 1.05rem;
    margin-bottom: 0.1rem;
}

.result-field {
    font-size: 1rem;
    margin-bottom: 0.15rem;
    word-break: break-all;
}

.result-list-box {
    display: flex;
    flex-wrap: wrap;
    gap: 10px 12px;
    justify-content: center;
}

.result-link {
    color: var(--secondary-color);
    font-size: 0.98em;
    text-decoration: underline;
    margin-left: 2px;
}

.result-label {
    color: #333;
    font-weight: bold;
}

.no-result {
    color: #888;
    font-size: 1em;
    text-align: center;
    padding: 10px 0;
}

.search-result-wait-box {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 60px;
    margin-top: 18px;
}

.wait-text {
    color: var(--primary-color);
    font-size: 1.05em;
    font-weight: 500;
}
.best-badge{
    position: absolute;
    top: 0;
    left: 94%;
}
</style>