@props(['lick'])

<div class="card w-full bg-base-100 card-xs md:card-md shadow-lg">
    <div class="card-body">
        <div class="flex justify-between">
            <h2 class="card-title">{{ $lick->name }} </h2>
            <x-profit class="card-title" :profit="$lick->profit"></x-profit>
        </div>
        <div class="flex justify-between">
            <div>
                <p>licked <span class="text-error">&pound; -{{ $lick->cost }}</span></p>
                @if($lick->spit)
                    <p>spat <span class="text-success">&pound; +{{ $lick->spit->revenue }}</span></p>
                @else
                    <span>-</span>
                @endif
            </div>

            <div class="flex text-xs w-1/3 max-w-30 text-end">
                <p>Updated: <span class="text-info">{{ $lick->updated_at->format('d-m-y') }}</span></p>
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
                    <div class="badge badge-soft badge-warning badge-sm md:badge-lg">Not Spat</div>
                @else
                    @if($lick->profit > 0)
                        <div class="badge badge-soft badge-success badge-sm md:badge-lg">Profit</div>
                    @else
                        <div class="badge badge-soft badge-error badge-sm md:badge-lg">Loss</div>
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