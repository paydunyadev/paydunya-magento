<template>
  <app-layout>
    <template #header>
      <div class="flex flex-inline justify-around">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Demarches administratives
        </h2>
        <jet-nav-link
           href="/individuelle"
          :active="route().current('individuelle')"
        >
          Creer
        </jet-nav-link>
      </div>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <!-- <div class="flex flex-wrap -m-3 mt-4">


  <div class="w-full sm:w-1/2 md:w-1/3 flex flex-col p-3">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden flex-1 flex flex-col">
      <div class="bg-cover h-48" style="background-image: url(https://images.unsplash.com/photo-1523978591478-c753949ff840?w=900);"></div>
      <div class="p-4 flex-1 flex flex-col" style="
">
        <h3 class="mb-4 text-2xl">My heading</h3>
        <div class="mb-4 text-grey-darker text-sm flex-1">
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
        </div>
        <a href="#" class="border-t border-grey-light pt-2 text-xs text-grey hover:text-red uppercase no-underline tracking-wide" style="
">Twitter</a>
      </div>
    </div>
  </div>

  <div class="w-full sm:w-1/2 md:w-1/3 flex flex-col p-3">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden flex-1 flex flex-col">
      <div class="bg-cover h-48" style="background-image: url(https://images.unsplash.com/photo-1497398276231-94ff5dc90217?w=900);"></div>
      <div class="p-4 flex-1 flex flex-col" style="
">
        <h3 class="mb-4 text-2xl">My much longer heading</h3>
        <div class="mb-4 text-grey-darker text-sm flex-1">
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi, tempore sapiente eveniet quibusdam ab ea, quaerat placeat numquam aspernatur, accusamus magnam neque.</p>
        </div>
        <a href="#" class="border-t border-grey-light pt-2 text-xs text-grey hover:text-red uppercase no-underline tracking-wide" style="
">Twitter</a>
      </div>
    </div>
  </div>

  <div class="w-full sm:w-1/2 md:w-1/3 flex flex-col p-3">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden flex-1 flex flex-col">
      <div class="bg-cover h-48" style="background-image: url(https://images.unsplash.com/photo-1503863937795-62954a3c0f05?w=900);"></div>
      <div class="p-4 flex-1 flex flex-col" style="
">
        <h3 class="mb-4 text-2xl">My heading</h3>
        <div class="mb-4 text-grey-darker text-sm flex-1">
          <p>Shorter text.</p>
        </div>
        <a href="#" class="border-t border-grey-light pt-2 text-xs text-grey hover:text-red uppercase no-underline tracking-wide" style="
">Twitter</a>
      </div>
    </div>
  </div>

  <div class="w-full sm:w-1/2 md:w-1/3 flex flex-col p-3">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden flex-1 flex flex-col">
      <div class="bg-cover h-48" style="background-image: url(https://images.unsplash.com/photo-1511084901824-1c57f5a16c98?w=900);"></div>
      <div class="p-4 flex-1 flex flex-col" style="
">
        <h3 class="mb-4 text-2xl">My heading</h3>
        <div class="mb-4 text-grey-darker text-sm flex-1">
          <p>Shorter text.</p>
        </div>
        <a href="#" class="border-t border-grey-light pt-2 text-xs text-grey hover:text-red uppercase no-underline tracking-wide" style="
">Twitter</a>
      </div>
    </div>
  </div>

  <div class="w-full sm:w-1/2 md:w-1/3 flex flex-col p-3">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden flex-1 flex flex-col">
      <div class="bg-cover h-48" style="background-image: url(https://images.unsplash.com/photo-1525935944571-4e99237764c9?w=900);"></div>
      <div class="p-4 flex-1 flex flex-col" style="
">
        <h3 class="mb-4 text-2xl">My heading</h3>
        <div class="mb-4 text-grey-darker text-sm flex-1">
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi, tempore sapiente eveniet quibusdam ab ea, quaerat placeat numquam aspernatur, accusamus magnam neque.</p>
        </div>
        <a href="#" class="border-t border-grey-light pt-2  text-xs text-grey hover:text-red uppercase no-underline tracking-wide" style="
">Twitter</a>
      </div>
    </div>
  </div>

  <div class="w-full sm:w-1/2 md:w-1/3 flex flex-col p-3">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden flex-1 flex flex-col">
      <div class="bg-cover h-48" style="background-image: url(https://images.unsplash.com/photo-1486506574467-c44963fc7876?w=900);"></div>
      <div class="p-4 flex-1 flex flex-col" style="
">
        <h3 class="mb-4 text-2xl">My heading</h3>
        <div class="mb-4 text-grey-darker text-sm flex-1">
          <p>Longer content.</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi, tempore sapiente eveniet quibusdam ab ea, quaerat placeat numquam aspernatur, accusamus magnam neque.</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi, tempore sapiente eveniet quibusdam ab ea, quaerat placeat numquam aspernatur, accusamus magnam neque.</p>
        </div>
        <a href="#" class="border-t border-grey-light pt-2  text-xs text-grey hover:text-red uppercase no-underline tracking-wide" style="
">Twitter</a>
      </div>
    </div>
  </div>


</div> -->
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
      confirmingUserDeletion: true,
    };
  },
};
</script>
