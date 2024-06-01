<template>
  <div>
      <div class="flex justify-between mb-3">
          <h1 class="text-3xl font-semibold">Products</h1>
          <button type="button"
                  @click="createProduct"
                  class="py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-black hover:text-black hover:bg-white focus:outline-none"
          >
          Add new Product
          </button>
      </div>
      <ProductsTable @clickEdit="editProduct"/>
      <!-- <ProductModal v-model="showProductModal" :product="productModel" @close="onModalClose"/>         -->
  </div>

</template>

<script setup>

import {computed, onMounted, ref} from "vue";
import store from "../../store";
import { useRouter } from 'vue-router';
import ProductModal from "./ProductModal.vue";
import ProductView from "./ProductView.vue";
import ProductsTable from "./ProductsTable.vue";

const DEFAULT_PRODUCT = {
id: '',
title: '',
category: '',
categories_id:'',
description: '',
image: '',
prices: ''
}

const router = useRouter();

const productModel = ref({...DEFAULT_PRODUCT});
const showProductModal = ref(false);

function showAddNewModal() {
showProductModal.value = true
}
function createProduct() {
  router.push({ name: 'app.products.view', params: { id: null } });
}

function editProduct(p) {
store.dispatch('getProduct', p.id)
  .then(({data}) => {
    productModel.value = data
    router.push({ name: 'app.products.view', params: { id: p.id } });
  })
}

function onModalClose() {
productModel.value = {...DEFAULT_PRODUCT}
}

</script>

<style>

</style>