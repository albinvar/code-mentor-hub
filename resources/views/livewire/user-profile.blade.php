<div>
    <div class="min-h-screen bg-gray-100 bg-white shadow">
        <!-- Page header -->
        <div class="">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold leading-tight text-gray-900">Profile</h1>
            </div>
        </div>

        <!-- Main content -->
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 sm:px-0">
                <div class="sm:flex sm:items-center sm:justify-between">
                    <!-- Profile image -->
                    <div class="mb-4 sm:mb-0 sm:mr-4 flex-shrink-0">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <img class="mx-auto h-24 w-24 rounded-full object-cover" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" />
                        @endif
                        </div>

                    <!-- Profile information -->
                    <div>
                        <h2 class="text-xl font-bold leading-tight text-gray-900"></h2>
                        @if($user->hasRole('Mentor'))
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">Mentor</span>
                        @endif
                        <p class="text-gray-700">{{ '@'.$user->username }}</p>
                        <p class="text-gray-700">{{ $user->profile->location }}</p>
                    </div>
                </div>

                <!-- Profile bio -->
                <div class="mt-6">
                    <h3 class="text-lg font-bold leading-tight text-gray-900 mb-2">Bio</h3>
                    <p class="text-gray-700">{{ $user->profile->bio }}</p>
                </div>

                <!-- Profile stats -->
                <div class="mt-6 border-t border-gray-300 pt-6 flex justify-between">
                    <div class="flex flex-col items-center">
                        <span class="text-lg font-bold text-gray-900">@if($user->hasRole('Mentor')) {{ $user->solutions()->count() }} @else {{ $user->questions()->count() }}  @endif</span>
                        <span class="text-sm text-gray-700">@if($user->hasRole('Mentor')) Problems Solved @else Problems Created @endif</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <span class="text-lg font-bold text-gray-900">85</span>
                        <span class="text-sm text-gray-700">Following</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <span class="text-lg font-bold text-gray-900">24</span>
                        <span class="text-sm text-gray-700">Posts</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
