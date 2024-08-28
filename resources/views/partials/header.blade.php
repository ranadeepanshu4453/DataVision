<div class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8">
    <button type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden">
        <span class="sr-only">Open sidebar</span>
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
    </button>

    <!-- Separator -->
    <div class="h-6 w-px bg-gray-900/10 lg:hidden" aria-hidden="true"></div>

    <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
        <!-- notification bell icon -->
        <div class="relative inline-block text-left group">
  <!-- Button to toggle the dropdown -->
  <button id="dropdownButton" type="button" class="absolute top-5 inline-flex items-center text-sm font-medium text-center text-indigo-500 hover:text-gray-900 focus:outline-none dark:hover:text-white dark:text-gray-400">
  <svg class="w-7 h-7" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 14 20">
    <path d="M12.133 10.632v-1.8A5.406 5.406 0 0 0 7.979 3.57.946.946 0 0 0 8 3.464V1.1a1 1 0 0 0-2 0v2.364a.946.946 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C1.867 13.018 0 13.614 0 14.807 0 15.4 0 16 .538 16h12.924C14 16 14 15.4 14 14.807c0-1.193-1.867-1.789-1.867-4.175ZM3.823 17a3.453 3.453 0 0 0 6.354 0H3.823Z"/>
</svg>

  </button>
  
  <!-- Dropdown menu -->
  <div id="dropdownMenu" style="width: 40rem; position:absolute; top:60%;" class="absolute right-50 mt-2 w-auto bg-white border border-gray-200 rounded-lg shadow-lg hidden group-hover:block">
    <div style="text-align:center; max-height: 300px; overflow-y: auto;" class="scrollable">
      <ul>
        @foreach (Auth::user()->unreadNotifications as $notification)
          <li class="relative px-4 py-2 border-b border-gray-200 dark:border-gray-700 text-indigo-500">
            <div class="flex justify-between">
              <div>
                <strong>{{ $notification->data['title'] }}</strong>
                <p>{{ $notification->data['message'] }}</p>
              </div>
              <span class="absolute top-2 right-2 text-sm text-indigo-500 dark:text-gray-400">
                {{ $notification->created_at->format('M d, Y H:i') }}
              </span>
            </div>
          </li>
        @endforeach
      </ul>
    </div>
  </div>
</div>

<style>
  /* Show the dropdown on hover */
  .relative:hover #dropdownMenu {
    display: block;
  }

  /* Custom scrollbar styling */
  .scrollable {
    scrollbar-width: thin; /* For Firefox */
    scrollbar-color: #4f46e5 #e5e7eb; /* For Firefox */
  }
</style>



<!--  -->
    <!-- <div>hi</div>
    <div>hi</div>
    <div>hi</div>
    <div>hi</div>
    <div>hi</div> -->

        <div class="flex items-center gap-x-4 lg:gap-x-6 ml-auto">
            <!-- Profile dropdown -->
            <div class="relative bg-indigo-600 px-7 py-2 rounded-lg text-white" x-data="{ open : false }">
                <button type="button" @click="open = !open" class="-m-1.5 flex items-center p-1.5" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                    <span class="sr-only">Open user menu</span>
                    
                    <span class="hidden lg:flex lg:items-center">
                        <!-- user icon -->
                        <svg class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
    <circle cx="12" cy="7" r="4" />
</svg>    
                    <!--  -->
                        <span class="ml-4 text-sm font-semibold leading-6 text-white" aria-hidden="true"><b>{{ Auth::user()->name }}</b></span> 
                        <svg class="ml-2 h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </button>
                <div x-show="open" class="absolute right-0 z-10 mt-2.5 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                    <!-- Active: "bg-gray-50", Not Active: "" -->
                    <a href="{{route('profile.edit')}}" class="block px-3 py-1 text-sm leading-6 text-gray-900" role="menuitem" tabindex="-1" id="user-menu-item-0">Your profile</a>
                    <a href="{{route('logout')}}" class="block px-3 py-1 text-sm leading-6 text-gray-900" role="menuitem" tabindex="-1" id="user-menu-item-1">Sign out</a>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
  document.addEventListener('DOMContentLoaded', function () {
    const dropdownButton = document.getElementById('dropdownButton');
    const dropdownMenu = document.getElementById('dropdownMenu');

    dropdownButton.addEventListener('click', function () {
      dropdownMenu.classList.toggle('hidden');
    });

    document.addEventListener('click', function (event) {
      if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
        dropdownMenu.classList.add('hidden');
      }
    });
  });
</script>
