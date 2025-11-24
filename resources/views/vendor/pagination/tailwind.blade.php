@if ($paginator->hasPages())
    <div class="join flex w-full bg-base-300">
        {{-- First Page Link --}}
        <a href="{{ $paginator->url(1) }}"
            class="join-item flex-1 btn btn-soft {{ $paginator->onFirstPage() ? 'btn-disabled' : '' }}">««</a>

        {{-- Previous Page Link --}}
        <a href="{{ $paginator->previousPageUrl() }}"
            class="join-item flex-5 btn btn-soft {{ $paginator->onFirstPage() ? 'btn-disabled' : '' }}">«</a>

        {{-- Current Page Info --}}
        <form method="GET" action="{{ route('licks.index') }}" class="btn btn-soft join-item flex-2">
            <input type="number" name="page" min="1" max="{{ $paginator->lastPage() }}"
                value="{{ $paginator->currentPage() }}" class="w-auto max-w-1/3 md:w-14 text-center"
                onchange="this.form.submit()" />
            <span>of {{ $paginator->lastPage() }}</span>
        </form>

        {{-- Next Page Link --}}
        <a href="{{ $paginator->nextPageUrl() }}"
            class="join-item flex-5 btn btn-soft {{ $paginator->currentPage() == $paginator->lastPage() ? 'btn-disabled' : '' }}">»</a>

        {{-- Last Page Link --}}
        <a href="{{ $paginator->url($paginator->lastPage()) }}"
            class="join-item flex-1 btn btn-soft {{ $paginator->currentPage() == $paginator->lastPage() ? 'btn-disabled' : '' }}">»»</a>
    </div>
@endif