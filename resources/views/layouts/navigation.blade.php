  <nav class="bg-gray-800">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
      <div class="relative flex items-center justify-between h-16">
        <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
          <!-- Mobile menu button-->
          <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <!--
              Icon when menu is closed.

              Heroicon name: outline/menu

              Menu open: "hidden", Menu closed: "block"
            -->
            <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <!--
              Icon when menu is open.

              Heroicon name: outline/x

              Menu open: "block", Menu closed: "hidden"
            -->
            <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
          <div class="flex-shrink-0 flex items-center text-white font-bold text-3xl">
              Forum
          </div>
          <div class="hidden sm:block sm:ml-6">
            <div class="flex space-x-4">
              <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
              <a href="{{route('threads.index')}}" class="text-lg text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">All Threads</a>
              <x-dropdown>
            <div class="ml-3 relative" >
                <div class=" space-x-4">
                      <button type="button" class="text-lg text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium" id="user-menu" aria-expanded="false" aria-haspopup="true" @click="showDropdown=!showDropdown">
                        Browse Threads
                      </button>
                </div>
                <div v-show="showDropdown" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                      @auth
                        <x-dropdown-link class="text-center" href="/threads?by={{auth()->user()->name}}">MY Questions</x-dropdown-link>
                      @endauth
                        <x-dropdown-link href="/threads?popular=1" class="text-center">Popular Threads</x-dropdown-link>
                        <x-dropdown-link href="/threads?unanswered=1" class="text-center">Unanswered Threads</x-dropdown-link>
                </div>
            </div>
          </x-dropdown>
            @auth
              <a href="{{route('threads.create')}}" class="text-lg text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">New Thread</a>
            @endauth
            </div>
          </div>
        </div>
        <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
          <!-- <button class="bg-gray-800 p-1 rounded-full text-gray-400 mt-2 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
            <span class="sr-only">View notifications</span>
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
          </button> -->

          <!-- Profile dropdown -->
         @auth
         <Notibell></Notibell>
          <x-dropdown>
            <div class="ml-3 relative" >
                <div class="mt-2 space-x-4">
                      <button type="button" class="bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" id="user-menu" aria-expanded="false" aria-haspopup="true" @click="showDropdown=!showDropdown">
                        <span class="sr-only">Open user menu</span>
                        <img class="h-10 w-10 rounded-full" src="{{asset(auth()->user()->avator())}}" alt="">
                        </button>
                </div>
                <div v-show="showDropdown" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                        <x-dropdown-link class="text-center" href="{{route('profiles.show',auth()->user()->name)}}">{{auth()->user()->name}}</x-dropdown-link>
                      <form action="{{route('logout')}}" method="POST">
                          @csrf
                          <button type="submit" class="w-full block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sign Out</button>
                      </form>
                </div>
            </div>
          </x-dropdown>
         @endauth
         @guest
         <a href="{{ route('login') }}" class="text-sm text-white underline">Log in</a>
         <a href="{{ route('register') }}" class="text-sm text-white underline ml-5">Create New Account</a>

         @endguest
        </div>
      </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="sm:hidden" id="mobile-menu">
      <div class="px-2 pt-2 pb-3 space-y-1">
        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
        <a href="#" class="bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium">All Threads</a>
        <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">New Thread</a>
        <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Browse Threads</a>
      </div>
    </div>
  </nav>
