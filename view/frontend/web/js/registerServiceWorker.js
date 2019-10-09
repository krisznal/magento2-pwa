function registerServiceWorker() {
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function() {
            return navigator.serviceWorker.register('/serviceWorker.js');
        });
    }
}

registerServiceWorker();