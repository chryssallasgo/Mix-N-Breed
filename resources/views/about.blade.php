@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<div class="max-w-full mx-auto px-4 py-12">
        <div class="max-w-3xl mx-auto text-center">
            <div class="image object-center">
                <img src="/images/team.svg" height="500" width="600" alt="Our Team Illustration" class="mx-auto rounded-lg">
            </div>
            <div class="text-center"> 
                <span class=" text-gray-500 border-b-2 border-orange-400 uppercase">About us</span>
                <h2 class="my-4 font-bold text-3xl  sm:text-4xl dark:text-white ">About <span class="text-orange-400">Our Company</span>
                </h2>
                <p class="text-gray-700 dark:text-gray-400">
            MixNBreed is an innovative AI-powered platform that helps dog enthusiasts explore breed combinations, 
            manage their pet profiles, and connect with fellow dog lovers through our comprehensive marketplace 
            and educational resources. We're dedicated to promoting responsible breeding practices while 
            celebrating the unique bond between humans and their canine companions.
                </p>
            </div>
        </div>
    <div class="sm:flex items-center bg-white dark:bg-gray-900 mt-10 p-6 rounded-lg shadow-md">
        <div class="sm:w-1/2 p-5">
            <div>
                <span class="text-gray-500 dark:text-gray-400 border-b-2 border-orange-400 uppercase">Our Story</span>
                <h2 class="my-4 font-bold text-3xl  sm:text-4xl dark:text-white">Our <span class="text-orange-400">Story</span>
                </h2>
                <p class="text-gray-700 dark:text-gray-400">
        Founded by passionate dog enthusiasts and tech lovers, DogMatch combines the love for dogs with the power of technology.
        Our team believes every dog has a unique story, and we want to help you tell it.
                </p>
            </div>
        </div>
               <div class="sm:w-1/2 p-10">
            <div class="image object-center text-center">
                <img src="/images/story.svg" height="500" width="600" alt="Our Story" class="mx-auto rounded-lg">
            </div>
        </div>
    </div>
    
    <div class="relative px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-full md:px-24 lg:px-8 lg:py-20 bg-white dark:bg-gray-900 mt-10 rounded-lg shadow-md">
        <div class="text-right p-6">
        <span class="text-gray-500 dark:text-gray-400 border-b-2 border-orange-400 uppercase">Our Values</span>
        <h2 class="my-4 font-bold text-3xl  sm:text-4xl text-right dark:text-white">Our <span class="text-orange-400">Values</span></h2>
    </div>
    <div class="relative">
        <div class="grid gap-12 row-gap-8 lg:grid-cols-2">
                <div>
                    <img class="object-cover w-full h-56 sm:h-96" src="/images/values.svg" alt="" />
                </div>
            <div class="grid gap-12 row-gap-5 md:grid-cols-2">
                    <div class="relative">
                        <div class="relative">
                            <div class="flex items-center justify-center w-10 h-10 mb-3 rounded-full">
                            <img src="/images/comm.svg" alt="Communication" class="w-8 h-8">
                            </div>
                            <h6 class="mb-2 font-semibold leading-5 dark:text-white">
                            Community
                            </h6>
                            <p class="text-sm text-gray-900 dark:text-gray-400">
                            Building a friendly space for dog lovers to share and learn.
                            </p>
                        </div>
                    </div>
            <div>
            <div class="flex items-center justify-center w-10 h-10 mb-3 rounded-full">
                <img src="/images/innov.svg" alt="Innovation" class="w-8 h-8">
            </div>
            <h6 class="mb-2 font-semibold leading-5 dark:text-white">
                Innovation
            </h6>
            <p class="text-sm text-gray-900 dark:text-gray-400">
                Using AI and smart tools to bring new experiences.
            </p>
            </div>
            <div>
            <div class="flex items-center justify-center w-10 h-10 mb-3 rounded-full">
                <img src="/images/comm.svg" alt="Communication" class="w-8 h-8">
            </div>
            <h6 class="mb-2 font-semibold leading-5 dark:text-white">
                Privacy
            </h6>
            <p class="text-sm text-gray-900 dark:text-gray-400">
                Your dog profiles are always yours and secure.
            </p>
            </div>
            <div>
            <div class="flex items-center justify-center w-10 h-10 mb-3 rounded-full bg-teal-accent-400">
                <img src="/images/hpy.svg" alt="Communication" class="w-8 h-8">
            </div>
            <h6 class="mb-2 font-semibold leading-5 dark:text-white">
                Fun
            </h6>
            <p class="text-sm text-gray-900 dark:text-gray-400">
                Making dog care and discovery enjoyable for everyone.
            </p>
            </div>
         </div>

        </div>
    </div>
    </div>

    <div class="bg-white dark:bg-gray-900 py-24 sm:py-32 mt-10 rounded-lg shadow-md">
    <div class="mx-auto grid max-w-7xl gap-20 px-6 lg:px-8 xl:grid-cols-3">
        <div class="max-w-xl">
        <h2 class="text-3xl font-semibold tracking-tight text-pretty dark:text-gray-100 text-gray-900 sm:text-4xl">Meet our leadership</h2>
        <p class="mt-6 text-lg/8 text-gray-600 dark:text-gray-400">We’re a dynamic group of individuals who are passionate about what we do and dedicated to delivering the best results for our dog lovers.</p>
        </div>
        <ul role="list" class="grid gap-x-8 gap-y-12 sm:grid-cols-2 sm:gap-y-16 xl:col-span-2">
        <li>
            <div class="flex items-center gap-x-6">
            <img src="/images/Man.svg" alt="" class="size-16 rounded-full outline-1 -outline-offset-1 outline-black/5" />
            <div>
                <h3 class="text-base/7 font-semibold tracking-tight dark:text-gray-100">Marte, Ares Daniel</h3>
                <p class="text-sm/6 font-semibold text-amber-600">Project Manager</p>
            </div>
            </div> 
        </li>
        <li>
            <div class="flex items-center gap-x-6">
            <img src="/images/Human.svg" alt="" class="size-16 rounded-full outline-1 -outline-offset-1 outline-black/5" />
            <div>
                <h3 class="text-base/7 font-semibold tracking-tight dark:text-gray-100 text-gray-900">Lumapas, Nina Regene</h3>
                <p class="text-sm/6 font-semibold text-amber-600">Hustler</p>
            </div>
            </div>
        </li>
        <li>
            <div class="flex items-center gap-x-6">
            <img src="/images/User2.svg" alt="" class="size-16 rounded-full outline-1 -outline-offset-1 outline-black/5" />
            <div>
                <h3 class="text-base/7 font-semibold tracking-tight dark:text-gray-100">Manog, Daniel</h3>
                <p class="text-sm/6 font-semibold text-amber-600">Documentation Assistant</p>
            </div>
            </div>
        </li>
        <li>
            <div class="flex items-center gap-x-6">
            <img src="/images/Profile.svg" alt="" class="size-16 rounded-full outline-1 -outline-offset-1 outline-black/5" />
            <div>
                <h3 class="text-base/7 font-semibold tracking-tight dark:text-gray-100">Ferrer, Irene</h3>
                <p class="text-sm/6 font-semibold text-amber-600">Documentation Assistant</p>
            </div>
            </div>
        </li>
        <li>
            <div class="flex items-center gap-x-6">
            <img src="/images/User.svg" alt="" class="size-16 rounded-full outline-1 -outline-offset-1 outline-black/5" />
            <div>
                <h3 class="text-base/7 font-semibold tracking-tight dark:text-gray-100">Allasgo, Chryssdale Heart</h3>
                <p class="text-sm/6 font-semibold text-amber-600">Hacker & Hipster</p>
            </div>
            </div>
        </li>
        </ul>
    </div>
    </div>


    <h2 class="text-2xl font-semibold text-orange-500 mt-10 mb-4">Get in Touch</h2>
    <p class="text-gray-700 mb-4">
        We’d love to hear from you! Whether you have questions, feedback, or just want to share a cute dog photo, reach out at
        <a href="mailto:contact@dogmatch.com" class="text-orange-600 underline">contact@dogmatch.com</a>.
    </p>
</div>
@endsection
