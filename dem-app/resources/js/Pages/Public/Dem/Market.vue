    <template>
  <div class="min-h-screen">
    <div class="relative overflow-hidden">
      <Header />
      <main class="mt-12">
        <div
          class="pt-14 bg-white sm:pt-16 lg:pt-8 lg:pb-14 lg:overflow-hidden"
        >
          <div class="mx-auto max-w-7xl lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8">
              <div
                class="mx-auto max-w-md px-4 sm:max-w-2xl sm:px-6 sm:text-center lg:px-0 lg:text-left lg:flex lg:items-center"
              >
                <div class="lg:py-24">
                  <h1
                    class="mt-4 text-4xl tracking-tight font-extrabold text-cerise-500 sm:mt-5 sm:text-5xl lg:mt-5 xl:text-5xl"
                  >
                    <span class="block text-cerise-500"
                      >Démarche Ménages</span
                    >
                  </h1>
                  <p
                    class="mt-3 text-base text-dark sm:mt-5 sm:text-xl lg:text-lg xl:text-xl"
                  >
                    De la résiliation à la souscription.Demmarcher vous représente
                chez le fournisseurs et vous propose les meilleurs offres
                  </p>
                  <div class="mt-10 sm:mt-12">
                    <div class="mt-3 sm:mt-0">
                      <button
                        type="submit"
                        class="block py-3 px-4 rounded-md shadow bg-cerise-500 text-white font-medium hover:bg-cerise-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cerise-300 focus:ring-offset-cerise-900"
                      >
                        Soumettre
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="mt-12 -mb-16 sm:-mb-48 lg:m-0 lg:relative">
                <div
                  class="mx-auto max-w-md px-4 sm:max-w-2xl sm:px-6 lg:max-w-none lg:px-0"
                >
                  <img
                    class="w-full lg:absolute lg:inset-y-0 lg:left-0 lg:h-full lg:w-auto lg:max-w-none"
                    :src="`assets/images/dem-marc.png`"
                    alt=""
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
            <Footer />
    </div>
  </div>
</template>
<script>
import Header from "../Header";
import Footer from "../Footer"
export default {
  components: {
    Header,
    Footer
  },
};
</script>
