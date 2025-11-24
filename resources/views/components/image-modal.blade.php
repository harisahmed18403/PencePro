<div x-data="{ open:false, images:[], index:0 }"
    x-on:open-fullscreen.window="images=$event.detail.images; index=$event.detail.index; open=true" x-show="open"
    x-transition class="fixed inset-0 bg-black/90 flex items-center justify-center z-[9999]">

    <div class="absolute inset-0" x-on:click="open=false"></div>

    <button x-on:click="open=false" class="absolute top-4 right-4 text-white text-3xl z-20">✕</button>

    <div class="relative flex items-center justify-center">

        <button x-on:click="index=(index-1+images.length)%images.length"
            class="text-white text-4xl px-4 z-20">‹</button>

        <img :src="images[index]" class="max-w-full max-h-full object-contain mx-4 z-10">

        <button x-on:click="index=(index+1)%images.length" class="text-white text-4xl px-4 z-20">›</button>
    </div>
</div>