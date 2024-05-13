<template>
  <div>
      <div class="flex justify-between mb-3">
          <h1 class="text-3xl font-semibold">Alergens</h1>
          <button type="button"
                  @click="showAddNewModal()"
                  class="py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-black hover:text-black hover:bg-white focus:outline-none"
          >
          Add new Alergen
          </button>
      </div>
      <AlergensTable @clickEdit="editAlergen"/>
      <AlergenView v-model="showAlergenModal" :alergen="alergenModel" @close="onModalClose" />
  </div>

</template>

<script setup>
import {computed, onMounted, ref} from "vue";
import store from "../../store";
import AlergenView from "./AlergenView.vue";
import AlergensTable from "./AlergensTable.vue";
const DEFAULT_ALERGEN = {
id: '',
name: '',
image: '',
}
const alergens = computed(() => store.state.alergens);
const alergenModel = ref({...DEFAULT_ALERGEN})
const showAlergenModal = ref(false);
function showAddNewModal() {
showAlergenModal.value = true
}
function editAlergen(a) {
store.dispatch('getAlergen', a.id)
  .then(({data}) => {
    alergenModel.value = data
    showAddNewModal();
  })
}
function onModalClose() {
alergenModel.value = {...DEFAULT_ALERGEN}
}
</script>

<style>
</style>