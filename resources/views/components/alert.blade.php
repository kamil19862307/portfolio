<div class="mb-4 p-3">
    {{-- Success --}}
    @if (session('success'))
        <div class="mb-4 p-3 rounded-lg bg-green-500 text-white shadow">
            {{ session('success') }}
        </div>
    @endif

    {{-- Error --}}
    @if (session('error'))
        <div class="mb-4 p-3 rounded-lg bg-red-500 text-white shadow">
            {{ session('error') }}
        </div>
    @endif

    {{-- Info --}}
    @if (session('info'))
        <div class="mb-4 p-3 rounded-lg bg-blue-500 text-white shadow">
            {{ session('info') }}
        </div>
    @endif

    {{-- Warning --}}
    @if (session('warning'))
        <div class="mb-4 p-3 rounded-lg bg-yellow-500 text-black shadow">
            {{ session('warning') }}
        </div>
    @endif
</div>