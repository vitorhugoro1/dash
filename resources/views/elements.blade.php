@extends('layouts.app')

@section('body')
    <div class="flex flex-col">
        <div class="flex mb-6 h-16">
            <div class="w-1/5 flex items-center content-center pl-6">
                <img src="https://upload.wikimedia.org/wikipedia/pt/thumb/c/cc/Logotipo_Vale.svg/594px-Logotipo_Vale.svg.png" alt="" class="h-12 mr-4 align-middle">
            </div>
            <div class="w-2/5 flex">
                <div class="relative self-center w-2/3">
                    <input type="text" name="search" class="w-full ml-4 bg-grey-lighter font-medium px-8 py-3 rounded-full text-sm focus:outline-none focus:shadow-outline leading-tight text-grey-dark" id="search" placeholder="Search">
                    <div class="absolute pin-r pin-t my-3 mr-1">
                        <i class="fas fa-search fa-flip-horizontal text-grey-dark"></i>
                    </div>
                </div>
            </div>
            <div class="w-2/5 flex flex-wrap justify-end">
                <div class="w-3/5 flex justify-end items-center">
                    <div class="relative">
                        <a href="#" class="relative">
                            <i class="fa-bell far text-2xl text-grey-dark"></i>
                            <span class="notification-pill"></span>
                        </a>
                        <div class="notification-box invisible">
                            <div class="notification-title">
                                Notificações
                            </div>
                            <div class="notification-list-box">
                                <ul class="list-reset">
                                    <li class="notification-list-item">
                                        <a href="#" class="notification-link">
                                            <i class="fas fa-video"></i>
                                            Boku no Hero Academia
                                            <span class="badge bg-orange-light">s4</span>
                                            <span class="badge bg-yellow-light">ep10</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-around pr-8 w-2/5">
                    <div class="flex items-center font-medium">
                        <img class="rounded-full mr-2 align-middle w-10" src="https://secure.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50" alt="Usuario">
                        <span>Vitor Hugo</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex">
            <div class="w-1/5 pt-2">
                <ul class="list-reset">
                    <li class="py-2">
                        <a href="" class="text-grey-darker pl-6">Animes</a>
                    </li>
                    <li class="py-2">
                        <a href="" class="text-grey-darker pl-6">Mangás</a>
                    </li>
                    <li class="py-2">
                        <a href="" class="text-grey-darker pl-6">Setup</a>
                    </li>
                </ul>
            </div>
            <div class="w-4/5 mr-8">
                <div class="rounded-lg bg-white mx-auto px-6 p-6 mb-3">
                    <h1 class="text-lg">Animes</h1>
                </div>
                <div class="flex">
                    <div class="w-1/3 bg-white border border-grey-light rounded-lg mr-3">
                        <a href="{{ url('/') }}" class="inline-block text-black hover:opacity-75">
                            <img src="boku-no-hero.jpg" class="rounded-t-lg" alt="Boku no Hero Academia">
                            <div class="px-2 pt-2 pb-3 flex flex-wrap justify-between">
                                <div class="font-bold">Boku no Hero Academia</div>
                                <div class="text-xs">
                                    <span class="badge font-grey-light bg-orange-light">s4</span>
                                    <span class="badge font-grey-light bg-yellow-light">ep10</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="w-1/3 bg-white border border-grey-light rounded-lg mr-3">
                        <a href="{{ url('/') }}" class="inline-block text-black hover:opacity-75">
                            <img src="boku-no-hero.jpg" class="rounded-t-lg" alt="Boku no Hero Academia">
                            <div class="px-2 pt-2 pb-3 flex flex-wrap justify-between">
                                <div class="font-bold">Boku no Hero Academia</div>
                                <div class="text-xs">
                                    <span class="badge font-grey-light bg-orange-light">s4</span>
                                    <span class="badge font-grey-light bg-yellow-light">ep10</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="w-1/3 bg-white border border-grey-light rounded-lg mr-3">
                        <a href="{{ url('/') }}" class="inline-block text-black hover:opacity-75">
                            <img src="boku-no-hero.jpg" class="rounded-t-lg" alt="Boku no Hero Academia">
                            <div class="px-2 pt-2 pb-3 flex flex-wrap justify-between">
                                <div class="font-bold">Boku no Hero Academia</div>
                                <div class="text-xs">
                                    <span class="badge font-grey-light bg-orange-light">s4</span>
                                    <span class="badge font-grey-light bg-yellow-light">ep10</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="mt-4">
                    <ul class="list-reset justify-center flex">
                        <li class="mr-3">
                            <a href="#" class="inline-block border border-blue-light rounded py-1 px-3 bg-blue-light text-white"><</a>
                        </li>
                        <li class="mr-3">
                            <a href="#" class="inline-block border border-blue-light rounded py-1 px-3 bg-blue-light text-white">1</a>
                        </li>
                        <li class="mr-3">
                            <a href="#" class="inline-block border border-blue-light rounded py-1 px-3 bg-blue-light text-white">2</a>
                        </li>
                        <li class="mr-3">
                            <a href="#" class="inline-block border border-blue-light rounded py-1 px-3 bg-blue-light text-white">3</a>
                        </li>
                        <li class="mr-3">
                            <a href="#" class="inline-block border border-blue-light rounded py-1 px-3 bg-blue-light text-white">></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
