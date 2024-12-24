@extends('layouts.app')

@section('content')
<div class="text-center mt-12 font-bold text-base md:text-xl lg:text-2xl">
    <h1>{{ $country }}</h1>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 md:gap-x-14 lg:gap-x-20 gap-y-10 mt-10 px-14 lg:px-28 pb-5 text-xs md:text-sm lg:text-base">
    <div>
        <table class="table-fixed w-full border-collapse border-[3px] border-gray-300 text-center">
            <thead>
                <tr>
                <th colspan="2" class="border-b border-gray-400 p-2">Aquaculture Data (Metric Tons)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($aquacultureData as $data)
                <tr>
                    <td class="border-[3px] border-gray-300 p-2">2020</td>
                    <td class="border-[3px] border-gray-300 p-2">
                        {{ $data->aquaculture_production_2020 !== null ? number_format($data->aquaculture_production_2020) : "Data Unavailable" }}
                    </td>
                </tr>
                <tr>
                    <td class="border-[3px] border-gray-300 p-2">2021</td>
                    <td class="border-b-[3px] border-gray-300 p-2">
                        {{ $data->aquaculture_production_2021 !== null ? number_format($data->aquaculture_production_2021) : "Data Unavailable" }}
                    </td>
                </tr>
                <tr>
                    <td class="border-[3px] border-gray-300 p-2">2022</td>
                    <td class="border-b-[3px] border-gray-300 p-2">
                        {{ $data->aquaculture_production_2022 !== null ? number_format($data->aquaculture_production_2022) : "Data Unavailable"}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    

    <div>
        <table class="table-fixed w-full border-collapse border-[3px] border-gray-300 text-center">
            <thead>
                <tr>
                <th colspan="2" class="border-b border-gray-400 p-2">Capture Fisheries Data (Metric Tons)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($captureFisheriesData as $data)
                <tr>
                    <td class="border-[3px] border-gray-300 p-2">2020</td>
                    <td class="border-[3px] border-gray-300 p-2">
                        {{ $data->capture_fisheries_production_2020 !== null ? number_format($data->capture_fisheries_production_2020) : "Data Unavailable" }}
                    </td>
                </tr>
                <tr>
                    <td class="border-[3px] border-gray-300 p-2">2021</td>
                    <td class="border-b-[3px] border-gray-300 p-2">
                        {{ $data->capture_fisheries_production_2021 !== null ? number_format($data->capture_fisheries_production_2021) : "Data Unavailable" }}
                    </td>
                </tr>
                <tr>
                    <td class="border-[3px] border-gray-300 p-2">2022</td>
                    <td class="border-b-[3px] border-gray-300 p-2">
                        {{ $data->capture_fisheries_production_2022 !== null ? number_format($data->capture_fisheries_production_2022) : "Data Unavailable" }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div>
        <table class="table-fixed w-full border-collapse border-[3px] border-gray-300 text-center">
            <thead>
                <tr>
                <th colspan="2" class="border-b border-gray-400 p-2">Marine Protected Areas (% of Territorial Waters)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($marineProtectedData as $data)
                <tr>
                    <td class="border-[3px] border-gray-300 p-2">2020</td>
                    <td class="border-[3px] border-gray-300 p-2">
                        {{ $data->marine_protected_areas_2020 !== null ? number_format($data->marine_protected_areas_2020 * 100, 1) . '%' : "Data Unavailable" }}
                    </td>
                </tr>
                <tr>
                    <td class="border-[3px] border-gray-300 p-2">2021</td>
                    <td class="border-b-[3px] border-gray-300 p-2">
                        {{ $data->marine_protected_areas_2021 !== null ? number_format($data->marine_protected_areas_2021 * 100, 1) . '%' : "Data Unavailable" }}
                    </td>
                </tr>
                <tr>
                    <td class="border-[3px] border-gray-300 p-2">2022</td>
                    <td class="border-b-[3px] border-gray-300 p-2">
                        {{ $data->marine_protected_areas_2022 !== null ? number_format($data->marine_protected_areas_2022 * 100, 1) . '%' : "Data Unavailable" }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div>
        <table class="table-fixed w-full border-collapse border-[3px] border-gray-300 text-center">
            <thead>
                <tr>
                <th colspan="2" class="border-b border-gray-400 p-2">Total Fisheries Production (Metric Tons)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($totalFisheriesData as $data)
                <tr>
                    <td class="border-[3px] border-gray-300 p-2">2020</td>
                    <td class="border-[3px] border-gray-300 p-2">
                        {{ $data->total_fisheries_production_2020 !== null ? number_format($data->total_fisheries_production_2020) : "Data Unavailable" }}
                    </td>
                </tr>
                <tr>
                    <td class="border-[3px] border-gray-300 p-2">2021</td>
                    <td class="border-b-[3px] border-gray-300 p-2">
                        {{ $data->total_fisheries_production_2021 !== null ? number_format($data->total_fisheries_production_2021) : "Data Unavailable" }}
                    </td>
                </tr>
                <tr>
                    <td class="border-[3px] border-gray-300 p-2">2022</td>
                    <td class="border-b-[3px] border-gray-300 p-2">
                        {{ $data->total_fisheries_production_2022 !== null ? number_format($data->total_fisheries_production_2022) : "Data Unavailable" }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="text-right text-[8px] md:text-xs px-28 pb-7 ">
    <p>Source of data: The World Bank Group</p>
</div>

@if ($marineProtectedData->contains(function ($data) { return $data->polygon_data !== null; }))
<div class="text-center">
    <button onclick="window.location='{{ route('mpa.country', ['country' => $country]) }}'" class="bg-[#0F6FFF] mb-7 p-4 text-xs md:text-sm lg:text-base rounded-xl text-white">
        View Marine Protected Area
    </button>
</div>
@endif
@endsection