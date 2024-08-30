<form action="{{ route('dashboard') }}" method="get" class="flex items-center space-x-2">
                <input
                    type="text"
                    name="search"
                    value="{{ request()->get('search') }}"
                    placeholder="Search..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600 bg-indigo-50" 
                />
                <button
                    type="submit"
                    class="px-4 py-2  text-white rounded-lg hover:scale-110  focus:outline-none focus:ring-2 focus:ring-indigo-600 transition duration-150 ease-in-out"
                    aria-label="Search"
                >
                <svg class="h-8 w-8 text-indigo-600"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <circle cx="11" cy="11" r="8" />  <line x1="21" y1="21" x2="16.65" y2="16.65" /></svg>
                </button>
            </form>