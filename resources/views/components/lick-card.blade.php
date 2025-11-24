@props(['lick'])

<div class="card w-full bg-base-100 shadow-md">
    <div class="card-body">
        <div class="flex justify-between">
            <h2 class="card-title">{{ $lick->name }} </h2>
            <x-profit class="card-title" :profit="$lick->profit"></x-profit>
        </div>
        <div class="flex justify-between text-nowrap">
            <div class="grid grid-cols-[min-content_1fr] gap-x-4">
                <p>Licked at:</p>
                <p>{{ $lick->date }}</p>

                <p>Spat at:</p>
                <p>
                    @if($lick->spit)
                        {{ $lick->spit->date }}
                    @else
                        -
                    @endif
                </p>
            </div>

            <div class="grid grid-cols-[min-content_1fr] gap-x-4">
                <p>Licked:</p>
                <span class="text-error text-end">&pound; -{{ $lick->cost }}</span>

                <p>Spat:</p>
                @if($lick->spit)
                    <span class="text-success text-end">&pound; +{{ $lick->spit->revenue }}</span>
                @else
                    <span class="text-end">-</span>
                @endif
            </div>
        </div>
        @if ($lick->images->isNotEmpty())
            <div class="flex flex-col justify-center items-center h-34 mx-auto">
                <x-image-carousel :lick="$lick"></x-image-carousel>
            </div>
        @endif
        <div class="flex justify-between items-center card-actions">
            <div>
                @if(!$lick->spit)
                    <div class="badge badge-soft badge-warning md:badge-lg">Not Spat</div>
                @else
                    @if($lick->profit > 0)
                        <div class="badge badge-soft badge-success md:badge-lg">Profit</div>
                    @else
                        <div class="badge badge-soft badge-error md:badge-lg">Loss</div>
                    @endif
                @endif
            </div>
            <div>
                @if(!$lick->spit)
                    <a class="btn btn-secondary" href="{{ route('spits.create', $lick) }}">Spit !</a>
                @endif
                <a href="{{ route('licks.show', $lick) }}" class="btn btn-primary">View</a>
            </div>
        </div>
    </div>
</div>