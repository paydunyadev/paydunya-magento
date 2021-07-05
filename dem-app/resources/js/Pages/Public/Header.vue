<template>
  <header class="fixed top-0 z-50 w-full shadow-lg">
    <div class="py-4 bg-cerise-100">
      <nav
        class="relative flex items-center justify-between px-4 mx-auto max-w-7xl sm:px-6"
        aria-label="Global"
      >
        <div class="flex items-center flex-1">
          <div class="flex items-center justify-between w-full md:w-auto">
            <a href="/">
              <span class="sr-only">Dem</span>
              <img
                class="w-auto h-8 sm:h-10"
                :src="`assets/images/lg0.svg`"
                alt=""
              />
            </a>
            <div class="flex items-center -mr-2 md:hidden">
              <button
                type="button"
                class="inline-flex items-center justify-center p-2 text-white rounded-md bg-cerise-500 hover:bg-cerise-900 focus:outline-none focus:ring-2 focus-ring-inset focus:ring-white"
                aria-expanded="false"
              >
                <span class="sr-only">Open main menu</span>
                <svg
                  class="w-6 h-6"
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
            <!-- <a
              href="/dem-administrative"
              class="text-base font-medium text-black hover:text-cerise-900"
              >Dem administrative</a
            > -->
            <inertia-link :active="route().current('administrative')" href="/administrative">Entreprise</inertia-link>

            <inertia-link :active="route().current('demenagement')" href="/demenagement">Administrative</inertia-link>

            <inertia-link :active="route().current('marketplace')" href="/marketplace">Déménagement</inertia-link>

          </div>
        </div>
        <div class="hidden md:flex md:items-center md:space-x-6">
            <inertia-link  :active="route().current('login')" href="/login">
                <span
                    class="inline-flex items-center px-4 py-2 text-base font-medium border rounded-md text-cerise-600 border-cerise-600 hover:text-white hover:bg-cerise-600"
                >
                    Se connecter
                </span>
            </inertia-link>
            <inertia-link  :active="route().current('register')" href="/register">
            <a
                href="#"
                class="inline-flex items-center px-4 py-2 text-base font-medium text-white border border-transparent rounded-md bg-cerise-600 hover:bg-cerise-700"
            >
                Créer un compte
            </a>
          </inertia-link>
        </div>
      </nav>
    </div>

    <div
      class="absolute inset-x-0 top-0 p-2 transition origin-top transform md:hidden"
    >
      <div
        class="overflow-hidden bg-white rounded-lg shadow-md ring-1 ring-black ring-opacity-5"
      >
        <div class="flex items-center justify-between px-5 pt-4">
          <div>
            <img
              class="w-auto h-8"
              src="https://tailwindui.com/img/logos/workflow-mark-cerise-600.svg"
              alt=""
            />
          </div>
          <div class="-mr-2">
            <button
              type="button"
              class="inline-flex items-center justify-center p-2 text-gray-400 bg-white rounded-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-cerise-600"
            >
              <span class="sr-only">Close menu</span>
              <svg
                class="w-6 h-6"
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
              class="block px-3 py-2 text-base font-medium text-gray-900 rounded-md hover:bg-gray-50"
              >Dem administrative</a
            >

            <a
              href="#"
              class="block px-3 py-2 text-base font-medium text-gray-900 rounded-md hover:bg-gray-50"
              >Dem Déménagement</a
            >

            <a
              href="#"
              class="block px-3 py-2 text-base font-medium text-gray-900 rounded-md hover:bg-gray-50"
              >Dem Santé</a
            >

            <a
              href="#"
              class="block px-3 py-2 text-base font-medium text-gray-900 rounded-md hover:bg-gray-50"
              >Dem Marché</a
            >
          </div>
          <div class="px-5 mt-6">
            <a
              href="#"
              class="block w-full px-4 py-3 font-medium text-center text-white rounded-md shadow bg-cerise-600 hover:bg-cerise-700"
              >Créer un compte</a
            >
          </div>
          <div class="px-5 mt-6">
            <p class="text-base font-medium text-center text-gray-500">
              Vous avez déja un compte ?
              <a href="#" class="text-gray-900 hover:underline">Se connecter</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </header>
</template>
