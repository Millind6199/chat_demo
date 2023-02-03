<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
        </div>
    </div> --}}
    <div class="container mx-auto">
      <div class="min-w-full border rounded md:grid md:grid-cols-3">
        <div class="border-r border-gray-300 md:col-span-1">
          <div class="mx-3 my-3 border-b border-gray-300">
            <div class="relative text-gray-600">
              <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  viewBox="0 0 24 24" class="w-6 h-6 text-gray-300">
                  <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
              </span>
              <input type="search" class="block w-full py-2 pl-10 bg-gray-100 rounded outline-none" name="search"
                placeholder="Search" required />
            </div>
          </div>

          <ul id="user-list" class="overflow-auto h-[32rem]">
            <h2 class="my-2 mb-2 ml-2 text-lg text-gray-600">Chats</h2>
            <li>
              <a
                class="flex items-center px-3 py-2 text-sm transition duration-150 ease-in-out border-b border-gray-300 cursor-pointer hover:bg-gray-100 focus:outline-none">
                <img class="object-cover w-10 h-10 rounded-full"
                  src="{{url('no-user-image-icon-27.jpg')}}" alt="username" />
                <div class="w-full pb-2">
                  <div class="flex justify-between">
                    <span class="block ml-2 font-semibold text-gray-600">Jhon Don</span>
                    <span class="block ml-2 text-sm text-gray-600">25 minutes</span>
                  </div>
                  <span class="block ml-2 text-sm text-gray-600">bye</span>
                </div>
              </a>
          </li>
          <li>
              <a
                class="flex items-center px-3 py-2 text-sm transition duration-150 ease-in-out bg-gray-100 border-b border-gray-300 cursor-pointer focus:outline-none">
                <img class="object-cover w-10 h-10 rounded-full"
                  src="https://cdn.pixabay.com/photo/2016/06/15/15/25/loudspeaker-1459128__340.png" alt="username" />
                <div class="w-full pb-2">
                  <div class="flex justify-between">
                    <span class="block ml-2 font-semibold text-gray-600">Same</span>
                    <span class="block ml-2 text-sm text-gray-600">50 minutes</span>
                  </div>
                  <span class="block ml-2 text-sm text-gray-600">Good night</span>
                </div>
              </a>
              </li>
          <li>
              <a
                class="flex items-center px-3 py-2 text-sm transition duration-150 ease-in-out border-b border-gray-300 cursor-pointer hover:bg-gray-100 focus:outline-none">
                <img class="object-cover w-10 h-10 rounded-full"
                  src="no-user-image-icon-27.jpg" alt="username" />
                <div class="w-full pb-2">
                  <div class="flex justify-between">
                    <span class="block ml-2 font-semibold text-gray-600">Emma</span>
                    <span class="block ml-2 text-sm text-gray-600">6 hour</span>
                  </div>
                  <span class="block ml-2 text-sm text-gray-600">Good Morning</span>
                </div>
              </a>
            </li>
          </ul>
        </div>
        <div class="hidden md:col-span-2 md:block">
          <div class="w-full">
            <div class="relative flex items-center p-3 border-b border-gray-300">
              <img class="object-cover w-10 h-10 rounded-full"
                src="no-user-image-icon-27.jpg" alt="username" />
              <span class="block ml-2 font-bold text-gray-600" id="selected-user-name">Emma</span>
              <span class="absolute w-3 h-3 bg-green-600 rounded-full left-10 top-3">
              </span>
            </div>
            <div class="relative w-full p-6 overflow-y-auto h-[40rem]">
              <ul class="space-y-2" id="message-box">
                
              </ul>
            </div>

            <div class="flex items-center justify-between w-full p-3 border-t border-gray-300 border-b border-gray-300">
                <input type="text" placeholder="Message"
                class="block w-full py-2 pl-4 mx-3 bg-gray-100 rounded-full outline-none focus:text-gray-700"
                name="message" id="message" required />
                <input type="hidden" id="selected-user-id">

              <button type="submit" id="sendMessage">
                <svg class="w-5 h-5 text-gray-500 origin-center transform rotate-90" xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20" fill="currentColor">
                  <path
                    d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                </svg>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- template start  --}}
    <template id="user-template">
        <li id="user_##id##" data-id="##id##" data-name="##name##" class="user-item">
          <a  class="flex items-center px-3 py-2 text-sm transition duration-150 ease-in-out border-b border-gray-300 cursor-pointer hover:bg-gray-100 focus:outline-none">
            <img class="object-cover w-10 h-10 rounded-full"
              src="{{url('no-user-image-icon-27.jpg')}}" alt="##name##" />
            <div class="w-full pb-2">
              <div class="flex justify-between">
                <span class="block ml-2 font-semibold text-gray-600">##name##</span>
                <span class="block message-count" style="width: 20px" id="user-message-count-##id##"></span>
              </div>
              {{-- <span class="block ml-2 text-sm text-gray-600">bye</span> --}}
            </div>
          </a>
      </li>
    </template>
    <template id="received-message">
        <li class="flex justify-start">
          <div class="relative max-w-xl px-4 py-2 text-gray-700 rounded shadow">
            <span class="block">##text##</span>
          </div>
        </li>
    </template>
    <template id="sent-message">
        <li class="flex justify-end" id="message_##id##" data-id="##id##">
            <div class="relative max-w-xl px-4 py-2 text-gray-700 rounded shadow">
                <span class="block">##text##</span>
            </div>
            <button class="delete-button" onclick="deleteMessage('##id##')">
                <img src="{{url('icons8-delete.svg')}}" alt="delete" >
            </button>
        </li>
    </template>
    {{-- template end  --}}
</x-app-layout>
