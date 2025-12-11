import { setOptions, importLibrary } from "@googlemaps/js-api-loader";


async function getCurrentLocationInfo() {



    // const { Map, InfoWindow,  } = (await importLibrary('maps'));
    
    // const {ControlPosition} = (await importLibrary('core'));
    // const infowindow = new InfoWindow;
    // const locationButton = document.createElement("button");

    // locationButton.textContent = "Pan to Current Location";
    // locationButton.classList.add("custom-map-control-button");
    // map.controls[ControlPosition.TOP_CENTER].push(locationButton);
    // locationButton.addEventListener("click", () => {
    //     //HTML5 geolocation.
        
    // });
if (navigator && navigator.geolocation) {

            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude,
                    };
                    return pos;
                },
                () => {
                    return 0;
                    // handleLocationError(true, infowindow, map.getCenter());
                },
               {enableHighAccuracy: true, timeout: 20000, maximumAge: 0}
            );
        } else {
            return 0;
            // Browser doesn't support Geolocation
            // handleLocationError(false, infowindow, map.getCenter());
        }
}


async function initMap(Lat, Lng) {
    // Set loader options.
    setOptions({
        key: import.meta.env.VITE_GOOGLE_MAP_KEY,
        v: 'weekly',
    });
    // Load the Maps library.
    const { Map } = (await importLibrary('maps'));
    // Set map options.
    const mapOptions = {
        center: { lat: 22.320884216498047, lng: 114.14622503268241 },
        zoom: 10,
    };
    // Declare the map.
    const mapObj = new Map(document.getElementById('map'), mapOptions);

}

export {
    initMap , 
    getCurrentLocationInfo
}