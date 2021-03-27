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
                    <span class="block">Confiez-nous vos</span>
                    <span class="block text-cerise-500"
                      >démarches d’Entreprises et de Ménages</span
                    >
                  </h1>
                  <p
                    class="mt-3 text-base text-dark sm:mt-5 sm:text-xl lg:text-lg xl:text-xl"
                  >
                    Nous les réalisons à votre place en toute confidentialité
                  </p>
                  <div class="mt-10 sm:mt-12">
                    <div class="mt-3 sm:mt-0">
                      <button
                        type="submit"
                        class="block py-3 px-4 rounded-md shadow bg-cerise-500 text-white font-medium hover:bg-cerise-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cerise-300 focus:ring-offset-cerise-900"
                      >
                        Contactez-nous
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
                    :src="`assets/images/homeL.png`"
                    alt=""
                  />
                </div>
              </div>
            </div>
          </div>
        </div>

        <div>
          <div class="bg-cerise-100">
            <div
              class="max-w-2xl mx-auto text-center py-16 px-4 sm:py-20 sm:px-6 lg:px-8"
            >
              <h2 class="text-3xl font-extrabold text-cerise-500 sm:text-4xl">
                <span class="block">Dem votre assistant personnel</span>
              </h2>
              <p class="mt-4 text-lg leading-6 text-dark">
                Qui réalise vos démarches administrative s'occupe de vos
                abonnements eau, électricité et internet lors de vos
                déménagements vous met en relation avec des médecins
                spécialistes pour des soins de santé de qualité
              </p>
              <a
                href="#"
                class="mt-8 w-full inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-cerise-600 bg-white hover:bg-indigo-50 sm:w-auto"
              >
                Ouvrir un compte Dem
              </a>
            </div>
          </div>
          <div class="py-12 bg-white">
            <div class="max-w-xl mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8">
              <h2 class="sr-only">A better way to send money.</h2>
              <dl
                class="space-y-10 lg:space-y-0 lg:grid justify-items-center lg:grid-cols-3 lg:gap-8"
              >
                <div class="text-center">
                  <div
                    class="flex mx-auto items-center justify-center h-24 w-24 rounded-md text-white"
                  >
                    <img :src="`assets/images/commande.png`" alt="" />
                  </div>
                  <div class="mt-5">
                    <dt class="text-lg leading-6 font-medium text-gray-900">
                      Commande
                    </dt>
                    <dd class="mt-2 text-base text-gray-500">
                      J'envoie ma demande à Dem
                      <br />24h/7j depuis notre plateforme
                    </dd>
                  </div>
                </div>

                <div class="text-center">
                  <div
                    class="flex mx-auto items-center justify-center h-24 w-24 rounded-md text-white"
                  >
                    <img
                      class="w-full"
                      :src="`assets/images/reception.png`"
                      alt=""
                    />
                  </div>
                  <div class="mt-5">
                    <dt class="text-lg leading-6 font-medium text-gray-900">
                      Traitement
                    </dt>
                    <dd class="mt-2 text-base text-gray-500">
                      Nos agent Dem traitent votre commande
                      <br />Vous recevez un sms/email de notification
                    </dd>
                  </div>
                </div>

                <div class="text-center">
                  <div
                    class="flex mx-auto items-center justify-center h-24 w-24 rounded-md text-white"
                  >
                    <img
                      class="w-full"
                      :src="`assets/images/livraison.png`"
                      alt=""
                    />
                  </div>
                  <div class="mt-5">
                    <dt class="text-lg leading-6 font-medium text-gray-900">
                      Livraison
                    </dt>
                    <dd class="mt-2 text-base text-gray-500">
                      Vos documents dans votre compte
                      <br />Vos documents livrés chez vous
                    </dd>
                  </div>
                </div>
              </dl>
            </div>
          </div>
          <div class="bg-cerise-100">
            <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
              <div class="overflow-hidden lg:grid lg:grid-cols-2 lg:gap-4">
                <div
                  class="pt-10 pb-12 px-6 sm:pt-16 sm:px-16 lg:py-16 lg:pr-0 xl:py-20 xl:px-20"
                >
                  <div class="lg:self-center">
                    <h2
                      class="text-3xl font-extrabold text-cerise-500 sm:text-4xl"
                    >
                      <span class="block">Démarches Administratives</span>
                    </h2>
                    <p class="mt-4 text-lg leading-6 text-dark">
                      Besoin d'assistance pour vos formalités administratives &
                      Juridiques, d'Etat civil, fiscales, des ressources
                      humaines ou de toutes autres natures
                    </p>
                    <a
                      href="#"
                      class="mt-8 bg-white border border-transparent rounded-md shadow px-5 py-3 inline-flex items-center text-base font-medium text-white bg-cerise-500"
                      >En savoir plus</a
                    >
                  </div>
                </div>
                <div
                  class="-mt-6 aspect-w-5 aspect-h-3 md:aspect-w-2 md:aspect-h-1"
                >
                  <img
                    class="transform translate-x-6 translate-y-6 rounded-md object-cover object-left-top sm:translate-x-16 lg:translate-y-20"
                    :src="`assets/images/dem-adm.png`"
                    alt="Dem administratives"
                  />
                </div>
              </div>
            </div>
          </div>
          <div class="bg-white">
            <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
              <div class="overflow-hidden lg:grid lg:grid-cols-2 lg:gap-4">
                <div
                  class="-mt-6 aspect-w-5 aspect-h-3 md:aspect-w-2 md:aspect-h-1"
                >
                  <img
                    class="transform translate-x-6 translate-y-6 rounded-md object-cover object-left-top sm:translate-x-16 lg:translate-y-20"
                    :src="`assets/images/dem-dem.png`"
                    alt="Dem administratives"
                  />
                </div>
                <div
                  class="pt-10 pb-12 px-6 sm:pt-16 sm:px-16 lg:py-16 lg:pr-0 xl:py-20 xl:px-20"
                >
                  <div class="lg:self-center">
                    <h2
                      class="text-3xl font-extrabold text-cerise-500 sm:text-4xl"
                    >
                      <span class="block">Démarches Déménagement</span>
                    </h2>
                    <p class="mt-4 text-lg leading-6 text-dark">
                      Vous déménager ? Liberez vous de votre temps, demmarcher
                      s'occupe de tous vos contrat d'abonnement (eau,
                      électricité, wifi, chaine de télévision) tout en un
                    </p>
                    <a
                      href="#"
                      class="mt-8 bg-white border border-transparent rounded-md shadow px-5 py-3 inline-flex items-center text-base font-medium text-white bg-cerise-500"
                      >En savoir plus</a
                    >
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="bg-cerise-100">
            <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
              <div class="overflow-hidden lg:grid lg:grid-cols-2 lg:gap-4">
                <div
                  class="pt-10 pb-12 px-6 sm:pt-16 sm:px-16 lg:py-16 lg:pr-0 xl:py-20 xl:px-20"
                >
                  <div class="lg:self-center">
                    <h2
                      class="text-3xl font-extrabold text-cerise-500 sm:text-4xl"
                    >
                      <span class="block">Démarches Soins médicaux</span>
                    </h2>
                    <p class="mt-4 text-lg leading-6 text-dark">
                      Pour vos besoin de traitement médical, de bilan de santé
                      ou de séjour médical à Dakar, demmarcher vous trouve un
                      rendez-vous avec les meilleurs médecins pour des soins de
                      qualité
                    </p>
                    <a
                      href="#"
                      class="mt-8 bg-white border border-transparent rounded-md shadow px-5 py-3 inline-flex items-center text-base font-medium text-white bg-cerise-500"
                      >En savoir plus</a
                    >
                  </div>
                </div>
                <div
                  class="-mt-6 aspect-w-5 aspect-h-3 md:aspect-w-2 md:aspect-h-1"
                >
                  <img
                    class="transform translate-x-6 translate-y-6 rounded-md object-cover object-left-top sm:translate-x-16 lg:translate-y-20"
                    :src="`assets/images/dem-sant.png`"
                    alt="Dem administratives"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
        <form class="space-y-8 divide-y divide-gray-200">
          <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <div>
              <h3 class="text-lg leading-6 font-medium text-gray-900">
                Formulaire de Contact DEM 📞
              </h3>
              <p class="mt-1 text-sm text-gray-500">
                Décrivez-nous vos besoins nous vous repondrons dans les
                meilleurs délais
              </p>
            </div>
            <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
              <div class="sm:col-span-3">
                <label
                  for="first_name"
                  class="block text-sm font-medium text-gray-700"
                >
                  Nom
                </label>
                <div class="mt-1">
                  <input
                    type="text"
                    name="first_name"
                    id="first_name"
                    autocomplete="given-name"
                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                  />
                </div>
              </div>

              <div class="sm:col-span-3">
                <label
                  for="last_name"
                  class="block text-sm font-medium text-gray-700"
                >
                  Prénom
                </label>
                <div class="mt-1">
                  <input
                    type="text"
                    name="last_name"
                    id="last_name"
                    autocomplete="family-name"
                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                  />
                </div>
              </div>

              <div class="sm:col-span-3">
                <label
                  for="last_name"
                  class="block text-sm font-medium text-gray-700"
                >
                  Numéro de téléphone
                </label>
                <div class="mt-1">
                  <input
                    type="text"
                    name="last_name"
                    id="last_name"
                    autocomplete="family-name"
                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                  />
                </div>
              </div>

              <div class="sm:col-span-3">
                <label
                  for="email"
                  class="block text-sm font-medium text-gray-700"
                >
                  Adresse email
                </label>
                <div class="mt-1">
                  <input
                    id="email"
                    name="email"
                    type="email"
                    autocomplete="email"
                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                  />
                </div>
              </div>

              <div class="sm:col-span-2">
                <label
                  for="last_name"
                  class="block text-sm font-medium text-gray-700"
                >
                  Pays
                </label>
                <div class="mt-1">
                  <input
                    type="text"
                    name="last_name"
                    id="last_name"
                    autocomplete="family-name"
                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                  />
                </div>
              </div>

              <div class="sm:col-span-2">
                <label
                  for="last_name"
                  class="block text-sm font-medium text-gray-700"
                >
                  Entreprise
                </label>
                <div class="mt-1">
                  <input
                    type="text"
                    name="last_name"
                    id="last_name"
                    autocomplete="family-name"
                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                  />
                </div>
              </div>

              <div class="sm:col-span-2">
                <label
                  for="last_name"
                  class="block text-sm font-medium text-gray-700"
                >
                  Profession
                </label>
                <div class="mt-1">
                  <input
                    type="text"
                    name="last_name"
                    id="last_name"
                    autocomplete="family-name"
                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                  />
                </div>
              </div>
              <div class="col-span-6">
                <label
                  for="about"
                  class="block text-sm font-medium text-gray-700"
                >
                  Message
                </label>
                <div class="mt-1">
                  <textarea
                    id="about"
                    name="about"
                    rows="3"
                    class="shadow-sm focus:ring-cerise-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md"
                    placeholder="..."
                  ></textarea>
                </div>
              </div>
            </div>
            <div class="py-4">
              <button
                type="submit"
                class="bg-cerise-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-cerise-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cerise-500"
              >
                Soumettre une demande
              </button>
            </div>
          </div>
        </form>
      </main>
    </div>
  </div>
</template>
<script>
import Header from './Public/Header.vue'

export default {
    components:{
        Header
    },
}
</script>

