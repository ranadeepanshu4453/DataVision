<div class="flex flex-wrap justify-center items-center italic">
    <div class="relative space-x-2 p-3 bg-indigo-100 border border-indigo-300 rounded-lg shadow-md w-48 h-24 m-4 transition-transform duration-200 hover:scale-110 text-center flex flex-col justify-center">
        <strong class="text-lg">Files Imported</strong>
        <p class="absolute top-0 right-3 m-2 text-xl font-semibold">{{$countCompany}}</p>
    </div>
    <div class="relative space-x-2 p-3 bg-indigo-100 border border-indigo-300 rounded-lg shadow-md w-48 h-24 m-4 transition-transform duration-200 hover:scale-110 text-center flex flex-col justify-center">
        <strong class="text-lg">Files Updated</strong>
        <p class="absolute top-0 right-3 m-2 text-xl font-semibold">{{$fileupdated}}</p>
    </div>
    <div class="relative space-x-2 p-3 bg-indigo-100 border border-indigo-300 rounded-lg shadow-md w-48 h-24 m-4 transition-transform duration-200 hover:scale-110 text-center flex flex-col justify-center">
        <strong class="text-lg">Total Visits</strong>
        <p class="absolute top-0 right-3 m-2 text-xl font-semibold">{{ $userVisit ? $userVisit : 0 }}</p>
    </div>
    <div class="relative space-x-2 p-3 bg-indigo-100 border border-indigo-300 rounded-lg shadow-md w-48 h-24 m-4 transition-transform duration-200 hover:scale-110 text-center flex flex-col justify-center">
        <strong class="text-lg">Total Users</strong>
        <p class="absolute top-0 right-3 m-2 text-xl font-semibold">{{$totalUser}}</p>
    </div>
    <div class="relative space-x-2 p-3 bg-indigo-100 border border-indigo-300 rounded-lg shadow-md w-48 h-24 m-4 transition-transform duration-200 hover:scale-110 text-center flex flex-col justify-center">
        <strong class="text-lg">Unread Notifications</strong>
        <p class="absolute top-0 right-3 m-2 text-xl font-semibold">{{$notifications}}</p>
    </div>
</div>
