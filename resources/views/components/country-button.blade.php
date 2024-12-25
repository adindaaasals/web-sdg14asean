<button onclick="window.location.href='{{ route('pages.report-country', ['country' => $countryName]) }}'"
    type="button"
    class="flex flex-col items-center justify-center border border-[#079D75] p-5 hover:bg-neutral-400 hover:text-white focus:z-10 rounded-lg text-xs md:text-sm lg:text-base">
    <img src="{{ (($countryFlag ?? 'default_flag.png')) }}" alt="{{ $countryName }}" class="h-10 w-auto mb-2">
    <p>{{ $countryName }}</p>
</button>
