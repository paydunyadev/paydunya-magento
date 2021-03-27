<template>
  <header class="fixed w-full shadow-lg z-50 top-0">
    <div class="bg-cerise-100 py-4">
      <nav
        class="relative max-w-7xl mx-auto flex items-center justify-between px-4 sm:px-6"
        aria-label="Global"
      >
        <div class="flex items-center flex-1">
          <div class="flex items-center justify-between w-full md:w-auto">
            <a href="/">
              <span class="sr-only">Dem</span>
              <img
                class="h-8 w-auto sm:h-10"
                :src="`assets/images/lg0.svg`"
                alt=""
              />
            </a>
            <div class="-mr-2 flex items-center md:hidden">
              <button
                type="button"
                class="bg-cerise-500 rounded-md p-2 inline-flex items-center justify-center text-white hover:bg-cerise-900 focus:outline-none focus:ring-2 focus-ring-inset focus:ring-white"
                aria-expanded="false"
              >
                <span class="sr-only">Open main menu</span>
                <svg
                  class="h-6 w-6"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  aria-hidden="true"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"
                  />
                </svg>
              </button>
            </div>
          </div>
          <div class="hidden space-x-8 md:flex md:ml-10">
            <a
              href="/dem-administrative"
              class="text-base font-medium text-black hover:text-cerise-900"
              >Dem administrative</a
            >

            <a
              href="/dem-demenagement"
              class="text-base font-medium text-black hover:text-cerise-900"
              >Dem Déménagement</a
            >

            <a
              href="/dem-market"
              class="text-base font-medium text-black hover:text-cerise-900"
              >Dem Marché</a
            >
          </div>
        </div>
        <div class="hidden md:flex md:items-center md:space-x-6">
            <inertia-link :href="route('login')">
                <span
                    class="inline-flex items-center px-4 py-2 border text-base font-medium rounded-md text-cerise-600 border-cerise-600 hover:text-white hover:bg-cerise-600"
                >
                    Se connecter
                </span>
            </inertia-link>
            <inertia-link :href="route('register')">
            <a
                href="#"
                class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white bg-cerise-600 hover:bg-cerise-700"
            >
                Créer un compte
            </a>
          </inertia-link>
        </div>
      </nav>
    </div>

    <div
      class="absolute top-0 inset-x-0 p-2 transition transform origin-top md:hidden"
    >
      <div
        class="rounded-lg shadow-md bg-white ring-1 ring-black ring-opacity-5 overflow-hidden"
      >
        <div class="px-5 pt-4 flex items-center justify-between">
          <div>
            <img
              class="h-8 w-auto"
              src="https://tailwindui.com/img/logos/workflow-mark-cerise-600.svg"
              alt=""
            />
          </div>
          <div class="-mr-2">
            <button
              type="button"
              class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-cerise-600"
            >
              <span class="sr-only">Close menu</span>
              <svg
                class="h-6 w-6"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                aria-hidden="true"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M6 18L18 6M6 6l12 12"
                />
              </svg>
            </button>
          </div>
        </div>
        <div class="pt-5 pb-6">
          <div class="px-2 space-y-1">
            <a
              href="#"
              class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-gray-50"
              >Dem administrative</a
            >

            <a
              href="#"
              class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-gray-50"
              >Dem Déménagement</a
            >

            <a
              href="#"
              class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-gray-50"
              >Dem Santé</a
            >

            <a
              href="#"
              class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-gray-50"
              >Dem Marché</a
            >
          </div>
          <div class="mt-6 px-5">
            <a
              href="#"
              class="block text-center w-full py-3 px-4 rounded-md shadow bg-cerise-600 text-white font-medium hover:bg-cerise-700"
              >Créer un compte</a
            >
          </div>
          <div class="mt-6 px-5">
            <p class="text-center text-base font-medium text-gray-500">
              Vous avez déja un compte ?
              <a href="#" class="text-gray-900 hover:underline">Se connecter</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </header>
</template>
