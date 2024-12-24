@extends('layouts.app')

@section('content')
<div class="relative w-full h-screen">
    <img src="{{ asset('images/banner.png') }}" alt="SDG 14 Logo" class="absolute top-0 left-0 w-full h-screen object-cover z-[-10]">
    <div class="pt-40 md:pt-10 lg:pt-0 md:absolute md:inset-0 flex flex-col items-center justify-center">
        <p class="font-bold text-white text-base md:text-xl lg:text-2xl">SUSTAINABLE DEVELOPMENT GOAL 14</p>
        <h1 class="font-bold text-white text-lg md:text-4xl lg:text-[60px]">LIFE BELOW WATER</h1> 
        <div class="bg-[#D9D9D9] py-3 px-3 md:px-5 lg:px-10 items-center justify-center mt-3 md:mt-0 lg:mt-5 mx-20 md:mx-52 rounded-lg text-justify lg:text-center text-[10px] md:text-sm lg:text-base font-semibold">
            <p>This website provides an interactive exploration of Sustainable Development Goal (SDG) 14 indicators, focusing exclusively on <span class="text-[#0BAE75] font-bold">ASEAN countries</span>. Here, you can discover vital statistics and trends, visualized on a regional map, to understand each country's contributions and challenges in protecting life below water.</p>
        </div>
        <button onclick="window.location='{{ route('pages.maps') }}'" class="bg-[#0F6FFF] my-7 p-2 lg:p-4 rounded-lg md:rounded-xl text-[10px] md:text-sm lg:text-base text-white">
            Explore Data Map
        </button>
    </div>
</div>
<div class="bg-[#FFF5E4] py-8 md:py-12">
    <h1 class="font-bold text-[#2A3663] text-sm md:text-lg lg:text-xl mx-8 md:mx-16 lg:mx-40 text-center">
        CONSERVE AND SUSTAINABLY USE THE OCEANS, SEA, AND MARINE RESOURCES FOR SUISTAINABLE DEVELOPMENT
    </h1>
    <p class="text-justify text-xs md:text-base lg:text-lg my-6 mx-12 md:mx-28 lg:mx-32">
        This goal encompasses a variety of key areas, including reducing marine pollution, protecting coastal ecosystems, and promoting sustainable fishing. Each indicator under SDG 14 represents measurable progress toward the preservation and restoration of our marine environments, a critical component of global biodiversity and climate stability. Source: United Nations Department of Economic and Social Affairs (UN DESA)78.
    </p>
    <div class="bg-[#39655A] py-4 md:py-8 lg:py-12 lg:px-8 mx-10 md:mx-20 lg:mx-36 xl:mx-40 my-10 rounded-xl md:rounded-3xl">
        <h1 class="text-base md:text-xl lg:text-2xl font-bold text-white text-center">Key Focus Areas of SDG 14</h1>
        <div class="mt-3 md:mt-8 text-white mx-4 md:mx-10 text-justify">
            <h2 class="font-bold text-sm md:text-lg lg:text-xl">1. Aquaculture Production</h2>
            <p class="text-[10px] md:text-base lg:text-lg">Aquaculture production refers to the farming of aquatic organisms, including fish, mollusks, and seaweed, in controlled environments. In ASEAN, aquaculture plays a pivotal role in supporting food security, economic development, and employment. However, sustainable practices are essential to minimize environmental impacts and ensure ecosystem balance. Source: Food and Agriculture Organization (FAO) Aquaculture Report.</p>
        </div>
        <div class="mt-3 md:mt-8 text-white mx-4 md:mx-10 text-justify">
            <h2 class="font-bold text-sm md:text-lg lg:text-xl">2. Capture Fisheries Production</h2>
            <p class="text-[10px] md:text-base lg:text-lg">Capture fisheries production is the process of harvesting wild fish from natural habitats. This industry contributes significantly to food security and livelihood in ASEAN, yet overfishing and habitat destruction threaten long-term sustainability. Monitoring production levels helps in setting sustainable limits and conservation strategies. Source: ASEAN Regional Study on Fisheries and Marine Resources.</p>
        </div>
        <div class="mt-3 md:mt-8 text-white mx-4 md:mx-10 text-justify">
            <h2 class="font-bold text-sm md:text-lg lg:text-xl">3. Marine Protected Areas (MPAs)</h2>
            <p class="text-[10px] md:text-base lg:text-lg">Marine Protected Areas are designated zones where human activities are regulated to protect marine ecosystems and biodiversity. ASEAN’s MPAs aim to safeguard habitats for endangered species, promote biodiversity, and support resilience against climate change. Expanding and effectively managing these areas is key to conserving life below water. Source: United Nations Environment Programme (UNEP).</p>
        </div>
        <div class="mt-3 md:mt-8 text-white mx-4 md:mx-10 text-justify">
            <h2 class="font-bold text-sm md:text-lg lg:text-xl">4. Total Fisheries Production</h2>
            <p class="text-[10px] md:text-base lg:text-lg">Total fisheries production encompasses both aquaculture and capture fisheries, representing the overall fish and seafood supply in ASEAN. Tracking total production allows policymakers to assess the balance between resource demand and environmental sustainability, providing insights into resource management and economic planning. Source: World Bank Fisheries and Aquaculture Data.</p>
        </div>
    </div>
</div>
@endsection