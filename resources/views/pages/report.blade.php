@extends('layouts.app')

@section('content')
<div class="text-center mt-12 font-bold text-base md:text-xl lg:text-2xl">
    <h1>COUNTRY REPORTS</h1>
</div>

<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-10 md:gap-x-20 lg:gap-x-30 xl:gap-x-40 gap-y-10 px-20 lg:px-28 py-10 lg:py-14 text-center">
    @foreach ($allCountries as $country)
        <x-country-button 
            :countryID="$country->id" 
            :countryName="$country->country_name" 
            :countryFlag="$country->country_flag ? asset('storage/' . $country->country_flag) : asset('images/logo.png')" />
    @endforeach
</div>
@endsection