@extends('layouts.app')

@section('content')
<div class="text-center mt-12 font-bold text-base md:text-xl lg:text-2xl">
    <h1>COUNTRY REPORTS</h1>
</div>

<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-10 md:gap-x-20 lg:gap-x-30 xl:gap-x-40 gap-y-10 px-20 lg:px-28 py-10 lg:py-14 text-center">
    {{-- Contoh untuk beberapa negara --}}
    <button onclick="window.location.href='{{ route('pages.report-country', ['country' => 'Brunei Darussalam']) }}'"
        type="button"
        class="flex flex-col items-center justify-center border border-[#079D75] p-5 hover:bg-neutral-400 hover:text-white focus:z-10 rounded-lg text-xs md:text-sm lg:text-base">
        <img src="{{ asset('images/BRN.png') }}" alt="Brunei Darussalam" class="h-7 lg:h-10 w-auto mb-2">
        <p>Brunei Darussalam</p>
    </button>
    <button onclick="window.location.href='{{ route('pages.report-country', ['country' => 'Indonesia']) }}'"
        type="button"
        class="flex flex-col items-center justify-center border border-[#079D75] p-5 hover:bg-neutral-400 hover:text-white focus:z-10 rounded-lg text-xs md:text-sm lg:text-base">
        <img src="{{ asset('images/IDN.png') }}" alt="Indonesia" class="h-10 w-auto mb-2">
        <p>Indonesia</p>
    </button>
    <button onclick="window.location.href='{{ route('pages.report-country', ['country' => 'Cambodia']) }}'"
        type="button"
        class="flex flex-col items-center justify-center border border-[#079D75] p-5 hover:bg-neutral-400 hover:text-white focus:z-10 rounded-lg text-xs md:text-sm lg:text-base">
        <img src="{{ asset('images/KHM.png') }}" alt="Cambodia" class="h-10 w-auto mb-2">
        <p>Cambodia</p>
    </button>
    <button onclick="window.location.href='{{ route('pages.report-country', ['country' => 'Lao PDR']) }}'"
        type="button"
        class="flex flex-col items-center justify-center border border-[#079D75] p-5 hover:bg-neutral-400 hover:text-white focus:z-10 rounded-lg text-xs md:text-sm lg:text-base">
        <img src="{{ asset('images/LAO.png') }}" alt="Lao PDR" class="h-10 w-auto mb-2">
        <p>Lao PDR</p>
    </button>
    <button onclick="window.location.href='{{ route('pages.report-country', ['country' => 'Myanmar']) }}'"
        type="button"
        class="flex flex-col items-center justify-center border border-[#079D75] p-5 hover:bg-neutral-400 hover:text-white focus:z-10 rounded-lg text-xs md:text-sm lg:text-base">
        <img src="{{ asset('images/MMR.png') }}" alt="Myanmar" class="h-10 w-auto mb-2">
        <p>Myanmar</p>
    </button>
    <button onclick="window.location.href='{{ route('pages.report-country', ['country' => 'Malaysia']) }}'"
        type="button"
        class="flex flex-col items-center justify-center border border-[#079D75] p-5 hover:bg-neutral-400 hover:text-white focus:z-10 rounded-lg text-xs md:text-sm lg:text-base">
        <img src="{{ asset('images/MYS.png') }}" alt="Malaysia" class="h-10 w-auto mb-2">
        <p>Malaysia</p>
    </button>
    <button onclick="window.location.href='{{ route('pages.report-country', ['country' => 'Philippines']) }}'"
        type="button"
        class="flex flex-col items-center justify-center border border-[#079D75] p-5 hover:bg-neutral-400 hover:text-white focus:z-10 rounded-lg text-xs md:text-sm lg:text-base">
        <img src="{{ asset('images/PHL.png') }}" alt="Philippines" class="h-10 w-auto mb-2">
        <p>Philippines</p>
    </button>
    <button onclick="window.location.href='{{ route('pages.report-country', ['country' => 'Singapore']) }}'"
        type="button"
        class="flex flex-col items-center justify-center border border-[#079D75] p-5 hover:bg-neutral-400 hover:text-white focus:z-10 rounded-lg text-xs md:text-sm lg:text-base">
        <img src="{{ asset('images/SGP.png') }}" alt="Singapore" class="h-10 w-auto mb-2">
        <p>Singapore</p>
    </button>
    <button onclick="window.location.href='{{ route('pages.report-country', ['country' => 'Thailand']) }}'"
        type="button"
        class="flex flex-col items-center justify-center border border-[#079D75] p-5 hover:bg-neutral-400 hover:text-white focus:z-10 rounded-lg text-xs md:text-sm lg:text-base">
        <img src="{{ asset('images/THA.png') }}" alt="Thailand" class="h-10 w-auto mb-2">
        <p>Thailand</p>
    </button>
    <button onclick="window.location.href='{{ route('pages.report-country', ['country' => 'Viet Nam']) }}'"
        type="button"
        class="flex flex-col items-center justify-center border border-[#079D75] p-5 hover:bg-neutral-400 hover:text-white focus:z-10 rounded-lg text-xs md:text-sm lg:text-base">
        <img src="{{ asset('images/VNM.png') }}" alt="Viet Nam" class="h-10 w-auto mb-2">
        <p>Viet Nam</p>
    </button>
  
</div>
@endsection