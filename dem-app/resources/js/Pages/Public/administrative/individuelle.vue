<template>
  <div class="h-screen">
    <div>
      <div class="max-w-3xl px-4 py-10 mx-auto">
        <div v-if="step == 'complete'">
          <div
            class="flex items-center justify-between p-10 bg-white rounded-lg shadow"
          >
            <div>
              <svg
                class="w-20 h-20 mx-auto mb-4 text-green-500"
                viewBox="0 0 20 20"
                fill="currentColor"
              >
                <path
                  fill-rule="evenodd"
                  d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                  clip-rule="evenodd"
                />
              </svg>

              <h2 class="mb-4 text-2xl font-bold text-center text-gray-800">
                Votre demande a été bien soumise
              </h2>

              <div class="mb-8 text-gray-600">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam,
                corrupti quae praesentium facere labore saepe minima alias, ea
                doloremque rerum unde deleniti quidem pariatur error mollitia
                voluptates cum harum a?
              </div>

              <button
                class="block w-40 px-5 py-2 mx-auto font-medium text-center text-gray-600 bg-white border rounded-lg shadow-sm focus:outline-none hover:bg-gray-100"
              >
                Acceder au tableau de board
              </button>
            </div>
          </div>
        </div>

        <div>
          <!-- Top Navigation -->
          <div class="py-4 border-b-2 border-cerise-500">
            <div
              class="mb-1 text-xs font-bold leading-tight tracking-wide text-gray-500 uppercase"
            >
              ETAPE 1 SUR 3
            </div>
            <div
              class="flex flex-col md:flex-row md:items-center md:justify-between"
            >
              <div class="flex-1">
                <div v-if="step === 1">
                  <div class="text-lg font-bold leading-tight text-cerise-500">
                    IDENTIFICATION DE L’ENTREPRISE
                  </div>
                </div>

                <div v-if="step === 2">
                  <div class="text-lg font-bold leading-tight text-cerise-500">
                    IDENTIFICATION DU REPRESENTANT LEGAL
                  </div>
                </div>

                <div v-if="step === 3">
                  <div class="text-lg font-bold leading-tight text-cerise-500">
                    IDENTIFICATION DU CONJOINT
                  </div>
                </div>
              </div>

              <!-- <div class="flex items-center md:w-64">
                                          <div class="w-full mr-2 bg-white rounded-full">
                                              <div class="h-2 text-xs leading-none text-center text-white bg-green-500 rounded-full" :style="'width: '+ parseInt(step / 3 * 100) +'%'"></div>
                                          </div>
                                          <div class="w-10 text-xs text-gray-600" v-text="parseInt(step / 3 * 100) +'%'"></div>
                                      </div> -->
            </div>
          </div>
          <!-- /Top Navigation -->

          <!-- Step Content -->
          <div class="py-10">
            <div v-if="step === 1">
              <div class="mb-5">
                <label class="block mb-1 font-bold text-gray-700"
                  >Dénomination sociale
                </label>
                <input
                  type="text"
                  v-model="denomination"
                  class="w-full px-4 py-3 font-medium text-gray-600 rounded-lg shadow-sm focus:outline-none focus:shadow-outline"
                  placeholder="Dénomination sociale"
                />
              </div>

              <div class="mb-5">
                <label class="block mb-1 font-bold text-gray-700">Sigle </label>
                <input
                  v-model="sigle"
                  type="email"
                  class="w-full px-4 py-3 font-medium text-gray-600 rounded-lg shadow-sm focus:outline-none focus:shadow-outline"
                  placeholder="Votre sigle"
                />
              </div>
              <div class="mb-5">
                <label class="block mb-1 font-bold text-gray-700"
                  >Activités
                </label>
                <smart-tagz
                  :theme="{
                    primary: '#de3496',
                    tagTextColor: '#fff',
                  }"
                  editable
                  inputPlaceholder="Nom de l'activité"
                  :allowPaste="{ delimiter: ',' }"
                  :on-changed="logChange"
                  :allowDuplicates="false"
                  :maxTags="20"
                  :defaultTags="['Tourisme', 'Import/Export']"
                />
              </div>
              <div class="mb-5">
                <label class="block mb-1 font-bold text-gray-700"
                  >Adresse de l’établissement
                </label>
                <input
                  v-model="addressEstablishment"
                  type="email"
                  class="w-full px-4 py-3 font-medium text-gray-600 rounded-lg shadow-sm focus:outline-none focus:shadow-outline"
                  placeholder="Adresse"
                />
              </div>
              <div class="mb-5">
                <label class="block mb-1 font-bold text-gray-700"
                  >Avez-vous déjà eu un Registre de Commerce ?</label
                >
                <div class="flex">
                  <label
                    class="flex items-center justify-start py-3 pl-4 pr-6 mr-4 bg-white rounded-lg shadow-sm text-truncate"
                  >
                    <div class="mr-3 text-teal-600">
                      <input
                        type="radio"
                        v-model="ifHaveRegisterTrade"
                        value="true"
                        class="form-radio focus:outline-none focus:shadow-outline"
                      />
                    </div>
                    <div class="text-gray-700 select-none">Oui</div>
                  </label>

                  <label
                    class="flex items-center justify-start py-3 pl-4 pr-6 bg-white rounded-lg shadow-sm text-truncate"
                  >
                    <div class="mr-3 text-teal-600">
                      <input
                        type="radio"
                        v-model="ifHaveRegisterTrade"
                        value="false"
                        class="form-radio focus:outline-none focus:shadow-outline"
                      />
                    </div>
                    <div class="text-gray-700 select-none">Non</div>
                  </label>
                </div>
              </div>
            </div>
            <div v-if="step === 2">
              <div class="mb-5">
                <label class="block mb-1 font-bold text-gray-700">Nom </label>
                <input
                  type="text"
                  v-model="firstNameRepresentativeLegal"
                  class="w-full px-4 py-3 font-medium text-gray-600 rounded-lg shadow-sm focus:outline-none focus:shadow-outline"
                  placeholder="Nom"
                />
              </div>
              <div class="mb-5">
                <label class="block mb-1 font-bold text-gray-700"
                  >Prénoms
                </label>
                <input
                  type="text"
                  v-model="lastNameRepresentativeLegal"
                  class="w-full px-4 py-3 font-medium text-gray-600 rounded-lg shadow-sm focus:outline-none focus:shadow-outline"
                  placeholder="Prénoms"
                />
              </div>
              <div class="mb-5">
                <label class="block mb-1 font-bold text-gray-700"
                  >Nationalité
                </label>
                <input
                  v-model="nationalityRepresentativeLegal"
                  type="text"
                  class="w-full px-4 py-3 font-medium text-gray-600 rounded-lg shadow-sm focus:outline-none focus:shadow-outline"
                  placeholder="Nationalité"
                />
              </div>
              <div class="mb-5">
                <label class="block mb-1 font-bold text-gray-700"
                  >Situation matrimonial</label
                >

                <div class="flex">
                  <label
                    v-for="stats in martial_status"
                    :key="stats.id"
                    class="flex items-center justify-start py-3 pl-4 pr-6 bg-white rounded-lg shadow-sm text-truncate"
                  >
                    <div class="mr-3 text-teal-600">
                      <input
                        type="radio"
                        v-model="marital_statuse_id"
                        :value="stats.id"
                        class="form-radio focus:outline-none focus:shadow-outline"
                      />
                    </div>
                    <div
                      class="text-gray-700 select-none"
                      v-text="stats.name"
                    ></div>
                  </label>
                </div>
              </div>
              <div class="mb-5">
                <label class="block mb-1 font-bold text-gray-700"
                  >Adresse du domicile
                </label>
                <input
                  type="text"
                  v-model="domicilAddressRepresentativeLegal"
                  class="w-full px-4 py-3 font-medium text-gray-600 rounded-lg shadow-sm focus:outline-none focus:shadow-outline"
                  placeholder="Adresse du domicile"
                />
              </div>
              <div class="mb-5">
                <label class="block mb-1 font-bold text-gray-700"
                  >Téléphone
                </label>
                <input
                  v-model="phoneRepresentativeLegal"
                  type="text"
                  class="w-full px-4 py-3 font-medium text-gray-600 rounded-lg shadow-sm focus:outline-none focus:shadow-outline"
                  placeholder="Téléphone"
                />
              </div>
              <div class="mb-5">
                <label class="block mb-1 font-bold text-gray-700">Email </label>
                <input
                  type="email"
                  v-model="emailRepresentativeLegal"
                  class="w-full px-4 py-3 font-medium text-gray-600 rounded-lg shadow-sm focus:outline-none focus:shadow-outline"
                  placeholder="Email"
                />
              </div>
            </div>
            <div v-if="step === 3">
              <div class="mb-5">
                <label class="block mb-1 font-bold text-gray-700">Nom </label>
                <input
                  type="text"
                  v-model="spouseFirstName"
                  class="w-full px-4 py-3 font-medium text-gray-600 rounded-lg shadow-sm focus:outline-none focus:shadow-outline"
                  placeholder="Nom"
                />
              </div>
              <div class="mb-5">
                <label class="block mb-1 font-bold text-gray-700"
                  >Prénoms
                </label>
                <input
                  v-model="spouseLastName"
                  type="text"
                  class="w-full px-4 py-3 font-medium text-gray-600 rounded-lg shadow-sm focus:outline-none focus:shadow-outline"
                  placeholder="Prénom"
                />
              </div>
              <div class="mb-5">
                <label class="block mb-1 font-bold text-gray-700"
                  >Date et lieu du mariage
                </label>
                <input
                  v-model="weddingDate"
                  type="date"
                  class="w-full px-4 py-3 font-medium text-gray-600 rounded-lg shadow-sm focus:outline-none focus:shadow-outline"
                  placeholder="Date et lieu du mariage"
                />
              </div>
              <div class="mb-5">
                <label class="block mb-1 font-bold text-gray-700"
                  >Option matrimonial</label
                >

                <div class="flex">
                  <label
                    v-for="stats in martial_art"
                    :key="stats.id"
                    class="flex items-center justify-start py-3 pl-4 pr-6 bg-white rounded-lg shadow-sm text-truncate"
                  >
                    <div class="mr-3 text-teal-600">
                      <input
                        type="radio"
                        v-model="marital_option_id"
                        :value="stats.id"
                        class="form-radio focus:outline-none focus:shadow-outline"
                      />
                    </div>
                    <div
                      class="text-gray-700 select-none"
                      v-text="stats.name"
                    ></div>
                  </label>
                </div>
              </div>
              <div class="mb-5">
                <label class="block mb-1 font-bold text-gray-700"
                  >Régime matrimonial</label
                >

                <div class="flex">
                  <label
                    v-for="stats in martial_regime"
                    :key="stats.id"
                    class="flex items-center justify-start py-3 pl-4 pr-6 bg-white rounded-lg shadow-sm text-truncate"
                  >
                    <div class="mr-3 text-teal-600">
                      <input
                        type="radio"
                        v-model="marital_regime_id"
                        :value="stats.id"
                        class="form-radio focus:outline-none focus:shadow-outline"
                      />
                    </div>
                    <div
                      class="text-gray-700 select-none"
                      v-text="stats.name"
                    ></div>
                  </label>
                </div>
              </div>
              <div class="mb-5">
                <label class="block mb-1 font-bold text-gray-700"
                  >Signature
                </label>
                <vueSignature
                  ref="signature"
                  class="border border-dashed rounded-lg border-cerise-500"
                  :sigOption="option"
                  :w="'800px'"
                  :h="'100px'"
                  :disabled="disabled"
                  :defaultUrl="dataUrl"
                ></vueSignature>
                <!-- <vueSignature ref="signature1" :sigOption="option"></vueSignature> -->
                <!-- <button @click="save">Save</button>
                                <button @click="clear">Clear</button>
                                <button @click="undo">Undo</button>
                                <button @click="addWaterMark">addWaterMark</button>
                                <button @click="handleDisabled">disabled</button> -->
              </div>
            </div>
          </div>
          <!-- / Step Content -->
        </div>
      </div>

      <!-- Bottom Navigation -->
      <div
        class="fixed bottom-0 left-0 right-0 py-5 bg-white shadow-md"
        v-if="step != 'complete'"
      >
        <div class="max-w-3xl px-4 mx-auto">
          <div class="flex justify-between">
            <div class="w-1/2">
              <button
                v-if="step > 1"
                @click="step--"
                class="w-32 px-5 py-2 font-medium text-center text-gray-600 bg-white border rounded-lg shadow-sm focus:outline-none hover:bg-gray-100"
              >
                Précedant
              </button>
            </div>

            <div class="w-1/2 text-right">
              <button
                v-if="step < 3"
                @click="step++"
                class="w-32 px-5 py-2 font-medium text-center text-white border border-transparent rounded-lg shadow-sm focus:outline-none bg-cerise-500 hover:bg-cerise-600"
              >
                Suivant
              </button>

              <button
                @click="SEND_INDIVIDUELLE_SUBMISSION"
                v-if="step === 3"
                class="w-32 px-5 py-2 font-medium text-center text-white border border-transparent rounded-lg shadow-sm focus:outline-none bg-cerise-500 hover:bg-cerise-600"
              >
                Soumettre
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- / Bottom Navigation https://placehold.co/300x300/e2e8f0/cccccc -->
    </div>
  </div>
</template>

<style>
[type="checkbox"] {
  box-sizing: border-box;
  padding: 0;
}
.form-checkbox,
.form-radio {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  -webkit-print-color-adjust: exact;
  color-adjust: exact;
  display: inline-block;
  vertical-align: middle;
  background-origin: border-box;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  flex-shrink: 0;
  color: currentColor;
  background-color: #fff;
  border-color: #e2e8f0;
  border-width: 1px;
  height: 1.4em;
  width: 1.4em;
}
.form-checkbox {
  border-radius: 0.25rem;
}
.form-radio {
  border-radius: 50%;
}
.form-checkbox:checked {
  background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M5.707 7.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4a1 1 0 0 0-1.414-1.414L7 8.586 5.707 7.293z'/%3e%3c/svg%3e");
  border-color: transparent;
  background-color: currentColor;
  background-size: 100% 100%;
  background-position: center;
  background-repeat: no-repeat;
}
.form-radio:checked {
  background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3ccircle cx='8' cy='8' r='3'/%3e%3c/svg%3e");
  border-color: transparent;
  background-color: currentColor;
  background-size: 100% 100%;
  background-position: center;
  background-repeat: no-repeat;
}
</style>

<script>
import axios from "axios";
import { SmartTagz } from "smart-tagz";
import "smart-tagz/dist/smart-tagz.css";
import vueSignature from "vue-signature";
export default {
  components: {
    SmartTagz,
    vueSignature,
  },
  data() {
    return {
      martial_art: [],
      denomination: "",
      sigle: "",
      marital_statuse_id: 1,
      marital_option_id: 1,
      marital_regime_id: 1,
      activities: [],
      addressEstablishment: "",
      ifHaveRegisterTrade: true,
      firstNameRepresentativeLegal: "",
      lastNameRepresentativeLegal: "",
      nationalityRepresentativeLegal: "",
      phoneRepresentativeLegal: "",
      domicilAddressRepresentativeLegal: "",
      emailRepresentativeLegal: "",
      spouseFirstName: "",
      spouseLastName: "",
      weddingDate: "",
      isSign:"",

      option: {
        penColor: "rgb(0, 0, 0)",
        backgroundColor: "rgb(255,255,255)",
      },
      disabled: false,
      step: 1,
    };
  },
  async mounted() {
            axios.get('api/user')
        .then(function (response) {
            console.log(response);
        })
        .catch(function (error) {
            console.log(error);
        });
      axios.post('http://localhost:8000/api/tokens/create')
          .then(function (response) {
              console.log(response);
          })
          .catch(function (error) {
              console.log(error);
          });
    const martial = await axios.get("api/dashboard/marital_option");
    this.martial_art = martial.data;

    const martials = await axios.get("api/dashboard/marital_status");
    this.martial_status = martials.data;

    const martialr = await axios.get("api/dashboard/marital_regime");
    this.martial_regime = martialr.data;
  },
  computed: {
    filteredItems() {
      return this.autocompleteItems.filter((i) => {
        return i.text.toLowerCase().indexOf(this.tag.toLowerCase()) !== -1;
      });
    },
  },
  methods: {
    save() {
      var _this = this;
      var png = _this.$refs.signature.save();
       var jpeg = _this.$refs.signature.save("image/jpeg");
    //   var svg = _this.$refs.signature.save("image/svg+xml");
      this.isSign = _this.$refs.signature.save();

    },
    clear() {
      var _this = this;
      _this.$refs.signature.clear();
    },
    undo() {
      var _this = this;
      _this.$refs.signature.undo();
    },

    fromDataURL(url) {
      var _this = this;
      _this.$refs.signature.fromDataURL("data:image/png;base64,iVBORw0K...");
    },
    handleDisabled() {
      var _this = this;
      _this.disabled = !_this.disabled;
    },
    logChange(result) {
      let length = result.length;
      result.forEach((element) => {
        this.activities.push(element);
      });
    },
    SEND_INDIVIDUELLE_SUBMISSION() {
        this.save();
        const data = new FormData();
        data.append('denomination',this.denomination);
        data.append('sigle',this.sigle);
        data.append('addressEstablishment',this.addressEstablishment);
        data.append('activities',this.activities);
        data.append('ifHaveRegisterTrade',this.ifHaveRegisterTrade);
        data.append('firstNameRepresentativeLegal',this.firstNameRepresentativeLegal);
        data.append('lastNameRepresentativeLegal',this.lastNameRepresentativeLegal);
        data.append('nationalityRepresentativeLegal',this.nationalityRepresentativeLegal);
        data.append('phoneRepresentativeLegal',this.phoneRepresentativeLegal);
        data.append('domicilAddressRepresentativeLegal',this.domicilAddressRepresentativeLegal);
        data.append('emailRepresentativeLegal',this.emailRepresentativeLegal);
        data.append('spouseFirstName',this.spouseFirstName);
        data.append('spouseLastName',this.spouseLastName);
        data.append('weddingDate',this.weddingDate);
        // data.append('martial_art',this.martial_art);
        data.append('marital_statuse_id',this.marital_statuse_id);
        data.append('marital_option_id',this.marital_option_id);
        data.append('marital_regime_id',this.marital_regime_id);
        data.append('isSign',1);
        data.append('signature',this.isSign);

        axios.post('api/dashboard/request/individual', data)
        .then(function (response) {
            console.log(response);
        })
        .catch(function (error) {
            console.log(error);
        });
    },
  },
};
</script>
