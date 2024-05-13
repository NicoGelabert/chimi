<template>
    <div>
      <div class="flex justify-between mb-3">
          <h1 class="text-3xl font-semibold">Prices</h1>
          <button type="button"
                  @click="showAddNewModal()"
                  class="py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-black hover:text-black hover:bg-white focus:outline-none"
          >
          Add new Price
          </button>
      </div>
      <PricesTable @clickEdit="editPrice"/>
      <PriceModal v-model="showPriceModal" :price="priceModel" @close="onModalClose"/>        
  </div>
    
</template>
<script setup>
import {ref} from "vue";
import store from "../../store";
import PricesTable from "./PricesTable.vue";
import PriceModal from "./PriceModal.vue";

const DEFAULT_PRICE = {
    id: '',
    number: '',
    size: '',
    product: '',
}

const priceModel = ref({...DEFAULT_PRICE});
const showPriceModal = ref(false);

function showAddNewModal(){
    showPriceModal.value = true
}

function editPrice(pr){
    store.dispatch('getPrice', pr.id)
    .then(({data}) => {
        priceModel.value = data
        showAddNewModal();
    })
}

function onModalClose(){
    priceModel.value = {...DEFAULT_PRICE}
}
</script>