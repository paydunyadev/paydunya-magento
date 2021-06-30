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
                      >Démarche Administratives</span
                    >
                  </h1>
                  <p
                    class="mt-3 text-base text-dark sm:mt-5 sm:text-xl lg:text-lg xl:text-xl"
                  >
                    Besoin d'assistance pour vos formalités administratives
                    Juridiques, permis, extrait de naissance
                  </p>
                  <div class="mt-10 sm:mt-12">
                    <div class="mt-3 sm:mt-0">
                      <button
                        type="submit"
                        href="/institutionnelle"
                        class="block py-3 px-4 rounded-md shadow bg-cerise-500 text-white font-medium hover:bg-cerise-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cerise-300 focus:ring-offset-cerise-900"
                      >
                        Faire une démarche
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
                    :src="`assets/images/dem-adm.png`"
                    alt=""
                  />
                </div>
              </div>
            </div>
          </div>
        </div>

        <div>
          <div class="bg-cerise-100">
            <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
                                  <h1
                    class="mt-4 text-3xl tracking-tight font-extrabold text-cerise-500 "
                  >
                    <span class="block text-cerise-500"
                      >Création d'entreprise</span
                    >
                  </h1>
              <div class="flex flex-wrap -m-3 mt-4">
                <div class="w-full sm:w-1/2 md:w-1/3 flex flex-col p-3">
                  <div
                    class="bg-white rounded-lg shadow-lg overflow-hidden flex-1 flex flex-col"
                  >
                    <div class="p-4 flex-1 flex flex-col" style="">
                      <h3 class="mb-4 text-2xl">ENTREPRISES INDIVIDUELLES</h3>
                      <div class="mb-4 text-grey-darker text-sm flex-1">
                        <p>
                            Une entreprise individuelle est une entreprise dirigée par une seule personne, et qui n'a pas de personnalité morale, bien qu'elle soit parfois inscrite au répertoire des métiers (pour les artisans), au registre du commerce et des sociétés (pour les commerçants et industriels), ou exercée en profession libérale (réglementé ou non).
                        </p>
                      </div>
                      <inertia-link :active="route().current('individuelle')" href="/individuelle " class="block py-3 px-4 rounded-md shadow bg-cerise-500 text-white font-medium hover:bg-cerise-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cerise-300 focus:ring-offset-cerise-900">Soumettre</inertia-link>
                    </div>
                  </div>
                </div>

                <div class="w-full sm:w-1/2 md:w-1/3 flex flex-col p-3">
                  <div
                    class="bg-white rounded-lg shadow-lg overflow-hidden flex-1 flex flex-col"
                  >
                    <div class="p-4 flex-1 flex flex-col" style="">
                      <h3 class="mb-4 text-2xl">SCI</h3>
                      <div class="mb-4 text-grey-darker text-sm flex-1">
                        <p>
La SCI est une société ! A ce titre, un minimum de 2 personnes (physiques ou morales) est requis pour la créer. Comme toute société, la SCI requiert que vous établissiez des statuts qui détermineront les apports de chaque associé, le nom de votre SCI, le siège social, le capital (aucun minimum), la durée de vie de la SCI (maximum 99 ans) et les modalités de son fonctionnement.
                        </p>
                      </div>
                      <button
                        type="submit"
                        href="/institutionnelle"
                        class="block py-3 px-4 rounded-md shadow bg-cerise-500 text-white font-medium hover:bg-cerise-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cerise-300 focus:ring-offset-cerise-900"
                      >
                        Soumettre
                      </button>
                    </div>
                  </div>
                </div>

                <div class="w-full sm:w-1/2 md:w-1/3 flex flex-col p-3">
                  <div
                    class="bg-white rounded-lg shadow-lg overflow-hidden flex-1 flex flex-col"
                  >
                    <div class="p-4 flex-1 flex flex-col" style="">
                      <h3 class="mb-4 text-2xl">SA</h3>
                      <div class="mb-4 text-grey-darker text-sm flex-1">
                        <p>SA (ou société anonyme) est une société dites de capitaux : elle rassemble des personnes qui peuvent ne pas se connaître et dont la participation est fondée sur les capitaux qu'ils investissent dans l'entreprise. Elle concerne donc les projets ambitieux.</p>
                      </div>
                      <button
                        type="submit"
                        href="/institutionnelle"
                        class="block py-3 px-4 rounded-md shadow bg-cerise-500 text-white font-medium hover:bg-cerise-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cerise-300 focus:ring-offset-cerise-900"
                      >
                        Soumettre
                      </button>
                    </div>
                  </div>
                </div>

                <div class="w-full sm:w-1/2 md:w-1/3 flex flex-col p-3">
                  <div
                    class="bg-white rounded-lg shadow-lg overflow-hidden flex-1 flex flex-col"
                  >
                    <div class="p-4 flex-1 flex flex-col" style="">
                      <h3 class="mb-4 text-2xl">SAS</h3>
                      <div class="mb-4 text-grey-darker text-sm flex-1">
                        <p>L’avantage principal dans la création d'une SAS est la souplesse de son fonctionnement : les associés peuvent décider de l’organisation de leur société dans un grand niveau de détails.

Le statut SAS encourage une forte variabilité de capital, c’est-à-dire que le montant du capital peut facilement être modifié à la hausse ou à la baisse sans avoir à convoquer d’assemblée générale extraordinaire. Cela permet à la société de développer très rapidement sa taille et son activité.</p>
                      </div>
                      <button
                        type="submit"
                        href="/institutionnelle"
                        class="block py-3 px-4 rounded-md shadow bg-cerise-500 text-white font-medium hover:bg-cerise-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cerise-300 focus:ring-offset-cerise-900"
                      >
                        Soumettre
                      </button>
                    </div>
                  </div>
                </div>

                <div class="w-full sm:w-1/2 md:w-1/3 flex flex-col p-3">
                  <div
                    class="bg-white rounded-lg shadow-lg overflow-hidden flex-1 flex flex-col"
                  >
                    <div class="p-4 flex-1 flex flex-col" style="">
                      <h3 class="mb-4 text-2xl">SARL-SUARL</h3>
                      <div class="mb-4 text-grey-darker text-sm flex-1">
                        <p>
La société unipersonnelle à responsabilité limitée, en abrégé SURL ou encore SUARL est une SARL dans laquelle les parts sociales sont détenues  par un seul associé.La SARL Unipersonnelle, plus communément appelée EURL (Entreprise Unipersonnelle à Responsabilité Limitée), est une SARL constituée d’un unique associé. Vous pouvez y assurer vous-même les fonctions de gérant, ou encore les confier à un tiers.
                        </p>
                      </div>
                      <button
                        type="submit"
                        href="/institutionnelle"
                        class="block py-3 px-4 rounded-md shadow bg-cerise-500 text-white font-medium hover:bg-cerise-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cerise-300 focus:ring-offset-cerise-900"
                      >
                        Soumettre
                      </button>
                    </div>
                  </div>
                </div>

                <!-- <div class="w-full sm:w-1/2 md:w-1/3 flex flex-col p-3">
                  <div
                    class="bg-white rounded-lg shadow-lg overflow-hidden flex-1 flex flex-col"
                  >
                    <div class="p-4 flex-1 flex flex-col" style="">
                      <h3 class="mb-4 text-2xl">My heading</h3>
                      <div class="mb-4 text-grey-darker text-sm flex-1">
                        <p>Longer content.</p>
                        <p>
                          Lorem ipsum dolor sit amet, consectetur adipisicing
                          elit. Quasi, tempore sapiente eveniet quibusdam ab ea,
                          quaerat placeat numquam aspernatur, accusamus magnam
                          neque.
                        </p>
                        <p>
                          Lorem ipsum dolor sit amet, consectetur adipisicing
                          elit. Quasi, tempore sapiente eveniet quibusdam ab ea,
                          quaerat placeat numquam aspernatur, accusamus magnam
                          neque.
                        </p>
                      </div>
                      <button
                        type="submit"
                        href="/institutionnelle"
                        class="block py-3 px-4 rounded-md shadow bg-cerise-500 text-white font-medium hover:bg-cerise-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cerise-300 focus:ring-offset-cerise-900"
                      >
                        Soumettre
                      </button>
                    </div>
                  </div>
                </div> -->
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
import Footer from "../Footer";

export default {
  components: {
    Header,
    Footer,
  },
};
</script>
