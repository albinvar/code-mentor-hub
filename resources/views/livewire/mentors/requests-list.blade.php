
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">

    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="p-4">
                <div class="flex items-center">
                    <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="checkbox-all-search" class="sr-only">checkbox</label>
                </div>
            </th>
            <th scope="col" class="px-6 py-3">
                Name
            </th>
            <th scope="col" class="px-6 py-3">
                Intrests
            </th>
            <th scope="col" class="px-6 py-3">
                Status
            </th>
            <th scope="col" class="px-6 py-3">
                Action
            </th>
        </tr>
        </thead>
        <tbody>

        @foreach($requests as $req)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="w-4 p-4">
                    <div class="flex items-center">
                        <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                    </div>
                </td>
                <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <img class="h-10 w-10 rounded-full object-cover mr-2" src="{{ $req->user->profile_photo_url }}" alt="{{ $req->user->name }}" />
                    @endif
                    <div class="pl-3">
                        <div class="text-base font-semibold">{{ $req->user->name }}</div>
                        <div class="font-normal text-gray-500">{{ $req->user->email }}</div>
                    </div>
                </th>
                <td class="px-6 py-4">
                    @forelse($req->user->profile->tags->pluck('name') as $tag)
                        <span class="inline-flex items-center rounded-md bg-blue-100 dark:bg-blue-200 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10"> {{ $tag }}</span>
                    @empty
                    @endforelse
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center">
                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2"></div> Online
                    </div>
                </td>
                <td class="px-6 py-4">
                    <a href="#" wire:click="approve({{ $req->id }})" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" >Approve</a>
                    <a href="#" wire:click="reject({{ $req->id }})" class="ml-4 font-medium text-red-600 dark:text-red-500 hover:underline" >Reject</a>

                    @if($req->status == 2)
                        <span class="ml-4 bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300" >Currently Rejected</span>
                    @elseif($req->status == 1)
                        <span class="ml-4 bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300" >Currently Approved, Google Meet Link Generated</span>
                        <a href="{{ $req->url }}" class="mt-4 block w-full rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Open Google meet</a>
                    @elseif($req->status == 0)
                        <span class="ml-4 bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300" >Pending</span>
                    @endif

                </td>
            </tr>
        @endforeach


        </tbody>
    </table>
</div>
