<nav class="bg-[#FFF5E4]">
  <div class="container mx-auto flex items-center justify-between p-2 md:p-5 lg:py-5">
    <!-- Logo -->
    <a class="flex flex-row gap-3 font-poppins text-left text-sm md:text-xl font-semibold text-[#2A3663]" href="/">
      <img src="{{ asset('images/logo.png') }}" alt="SDG 14 Logo" class="h-7 md:h-10 w-auto">
      <span class="mt-[6px] md:mt-2 md:my-2">SDG 14 FOR ASEAN</span>
    </a>
    <!-- Toggle Button -->
    <button
      id="navbar-toggle"
      class="block focus:outline-none text-[#2A3663] lg:hidden"
      aria-label="Toggle navigation"
    >
      <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
      </svg>
    </button>
    <!-- Navigation Items -->
    <div id="navbarSupportedContent" class="hidden lg:flex lg:items-center lg:w-auto">
      <ul class="flex flex-col gap-4 lg:ml-auto lg:flex-row" id="nav-items">
        <li class="nav-item">
          <a href="{{ route('pages.home') }}" class="text-[#2A3663] text-xs md:text-sm lg:text-base font-medium">Home</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('pages.maps') }}" class="text-[#685C4F] text-xs md:text-sm lg:text-base font-medium">Visualization</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('pages.report') }}" class="text-[#2A3663] text-xs md:text-sm lg:text-base font-medium">Report</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const navbarToggle = document.getElementById('navbar-toggle');
    const navItems = document.getElementById('navbarSupportedContent');

    // Toggle visibility of nav items
    navbarToggle.addEventListener('click', function () {
      navItems.classList.toggle('hidden');
      navbarToggle.classList.add('hidden');
      navItems.classList.toggle('flex');
      navItems.classList.toggle('flex-col');
      navItems.classList.toggle('lg:flex-row');
    });
  });
</script>
