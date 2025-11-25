// public/service-worker.js
const CACHE_VERSION = 'v1'; // change this when you update

self.addEventListener('install', event => {
    event.waitUntil(
    caches.open('app-cache').then(async cache => {
      const response = await fetch('/build/manifest.json')
      const manifest = await response.json()

      const files = Object.values(manifest).map(item => '/build/' + item.file)

      return cache.addAll(files)
    })
  )
});

self.addEventListener('activate', event => {
    // Take control of all clients immediately
    event.waitUntil(self.clients.claim());

    // Optionally, delete old caches if you ever add caching
    event.waitUntil(
        caches.keys().then(keys => 
            Promise.all(keys.map(key => {
                if (key !== CACHE_VERSION) return caches.delete(key);
            }))
        )
    );
});

self.addEventListener('fetch', event => {
    // Minimal SW: just pass through
    event.respondWith(fetch(event.request));
});
