@extends('layouts.app')

@section('content')

<header class="mb-6 relative">

    <div class="relative ">
        <img
            src="/images/default-profile-banner.jpg"
            alt=""
            class="mb-2"
        >
        <img
            src={{ $user->avatar ?? '' }}"
            alt=""
            class="rounded-full mr-2 absolute bottom-0 transform -translate-x-1/2 translate-y-1/2"
            width="150"
            style="left: 50%"
        >
    </div>



    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="font-bold text-2xl nb-2">{{ $user->name }}</h2>
            <p>Joined {{ $user->created_at->diffForHumans() }}</p>
        </div>

        <div class="flex">
            @can('edit', $user)
               <a
                href="{{ $user->path('edit') }}"
                class="rounded-full borde border-gray-380 py-2 px-4 text-black text-xs"
                >
                Edit Profile
                </a>
            @endcan
            <x-follow-button :user="$user"></x-follow-button>
        </div>
    </div>

    <p class="text-sm">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed felis arcu, laoreet eu tincidunt sit amet, sagittis sed odio. Fusce non nunc ut ex volutpat auctor. Vestibulum quis dui a metus sagittis fringilla. Donec suscipit dui et commodo dignissim. Fusce et nibh vel libero mattis ultrices. Nunc vitae condimentum urna. Aliquam auctor sed turpis quis dictum. Integer hendrerit egestas enim at egestas. Suspendisse eros augue, laoreet quis enim et, hendrerit pulvinar risus. Ut mollis eros et sem semper, a gravida tortor aliquam. Aenean blandit hendrerit tristique. Cras purus tellus, ultrices non augue sit amet, faucibus porta justo. Duis lorem diam, dictum et elit cursus, tempor vestibulum purus.
    </p>


</header>

@include ('_timeline', [
        'tweets' => $user->tweets
    ])

@endsection
