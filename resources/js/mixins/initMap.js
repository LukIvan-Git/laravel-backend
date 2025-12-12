import { setOptions, importLibrary } from "@googlemaps/js-api-loader";
const center = { lat: 22.320884216498047, lng: 114.14622503268241 };
const defaultMapOptions = {
    center: center,
    zoom: 10,
    mapId: "DEMO_MAP_ID",
};

class MapService {
    /**
     * @param {HTMLElement|string} mapElementOrId - DOM element or id of the element
     * @param {google.maps.MapOptions} options
     */
    constructor(mapElementOrId, options = {}) {
        this.mapEl =
            typeof mapElementOrId === "string"
                ? document.getElementById(mapElementOrId)
                : mapElementOrId;
        this.options = Object.assign({}, defaultMapOptions, options);
        this.map = null;
        this.marker = null;
    }

    /** Initialize the Google Maps API and create the map instance. */
    async init({ apiKey = import.meta.env.VITE_GOOGLE_MAP_KEY, version = "weekly" } = {}) {
        if (!this.mapEl) {
            throw new Error("Map element not found. Pass an element or valid element id.");
        }

        setOptions({ key: apiKey, v: version });

        const { Map, InfoWindow } = await importLibrary("maps");
        const { AdvancedMarkerElement } = await importLibrary("marker");
        this.map = new Map(this.mapEl, this.options);
        this.infoWindow = new InfoWindow();
        return this.map;
    }

    /**
     * Add a marker
     * @param {{lat:number,lng:number}} position
     * @param {string} [content]
     */
    async setMarker(position, content) {
        if (!this.map) throw new Error("Map not initialized. Call init() first.");

        const { AdvancedMarkerElement } = await importLibrary("marker");
        if (this.marker) {
            this.marker.map = null;
            this.marker = null;
        }
        this.marker = new AdvancedMarkerElement({
            position,
            map: this.map,
            zIndex:999
        });
        this.map.setCenter(position);
        this.map.setZoom(18.5);
    }

    /** Return the underlying map instance. */
    getMap() {
        return this.map;
    }

    /**
     * Get current position as a Promise that resolves to {lat,lng} or rejects with an error.
     * @param {PositionOptions} [geolocationOptions]
     * @returns {Promise<{lat:number,lng:number}>}
     */
    getCurrentLocation(geolocationOptions = { enableHighAccuracy: false, timeout: 5000, maximumAge: 0 }) {
        return new Promise((resolve, reject) => {
            if (!navigator || !navigator.geolocation) {
                return reject(new Error("Geolocation not supported by this browser."));
            }

            navigator.geolocation.getCurrentPosition(
                (position) => {
                    resolve({ lat: position.coords.latitude, lng: position.coords.longitude });
                },
                (err) => reject(err),
                geolocationOptions
            );
        });
    }

    async blindClickEvent(){
        this.map.addListener("click", async (e) => {
            const latLng = { lat: e.latLng.lat(), lng: e.latLng.lng() };
            await this.setMarker(latLng, 'Clicked location');
        });
    }

    async searchNearBy(position){
        const { Place, SearchNearbyRankPreference } = await importLibrary('places');

        const radius = 200;

        const request = {
            // required parameters
            fields: [
                'displayName',
                'location',
                'googleMapsURI',
            ],
            locationRestriction: {
                center: position,
                radius: radius,
            },
            includedPrimaryTypes: ['restaurant'],
            maxResultCount: 10,
        };

        const { places } = await Place.searchNearby(request);
        if (places.length) {
            console.log(places);
            return places;
        }
    }
}

export default MapService;
export { MapService };