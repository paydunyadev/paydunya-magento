<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Demarches déménagement
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div v-if="data" class="overflow-hidden  sm:rounded-lg">
          <div class="flex flex-wrap -m-3 mt-2">
            <div class="w-full sm:w-1/2 md:w-1/3 flex flex-col p-3">
              <div class="max-w-lg w-full rounded-lg shadow-lg bg-white p-4">
<div class="flex flex-inline justify-between">
                    <h3 class="font-semibold text-lg tracking-wide mb-4">
                  #02DEM-ADM-12/2021
                </h3>
                                    <span class="flex items-center align-center px-2 py-0.5 rounded text-xs font-bold bg-green-300 text-white">
                    Done
                  </span>
</div>

                <p class="text-gray-500 my-1">
                    <ul class="list-inside divide-y-2 divide-dashed">
                        <li>Type: Entreprise Individuelle</li>
                        <li>Date : ...</li>
                    </ul>
                </p>
                <div class="mt-2">
                  <a
                    href="#"
                    class="text-blue-700 inline-flex items-center font-semibold tracking-wide"
                  >
                    <span class="hover:underline"> Consulter </span>
                    <span class="text-xl ml-2">&#8594;</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
          <div v-if="!data" class="flex items-center justify-center">

	<div class="border-dotted border-2 border-cerise-500 shadow-lg rounded-lg p-10 w-full">
		Aucune démarches de déménagement n'est disponible !
        <inertia-link  :href="route('password.request')" class="underline text-sm text-cerise-600 hover:text-cerise-900">
                    Soumettre une démarche de déménagement
                </inertia-link>
	</div>

  </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Welcome from "@/Jetstream/Welcome";

export default {
  components: {
    AppLayout,
    Welcome,
  },
  data() {
    return {
        data:false,
      confirmingUserDeletion: true,
    };
  },
};
</script>
