<template>
  <TransitionRoot as="template" :show="show">
      <Dialog as="div" class="relative z-10" @close="show = false">
      <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100"
                      leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
          <div class="fixed inset-0 bg-black bg-opacity-70 transition-opacity"/>
      </TransitionChild>

      <div class="fixed z-10 inset-0 overflow-y-auto">
          <div class="flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0">
          <TransitionChild as="template" enter="ease-out duration-300"
                          enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                          enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200"
                          leave-from="opacity-100 translate-y-0 sm:scale-100"
                          leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
              <DialogPanel
              class="relative bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-[700px] sm:w-full">
              <Spinner v-if="loading"
                      class="absolute left-0 top-0 bg-white right-0 bottom-0 flex items-center justify-center"/>
              <header class="py-3 px-4 flex justify-between items-center">
                  <DialogTitle as="h3" class="text-lg leading-6 font-medium text-gray-900">
                  {{ product.id ? `Update product: "${props.product.title}"` : 'Create new Product' }}
                  </DialogTitle>
                  <button
                  @click="closeModal()"
                  class="w-8 h-8 flex items-center justify-center rounded-full transition-colors cursor-pointer hover:bg-[rgba(0,0,0,0.2)]"
                  >
                  <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="h-6 w-6"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                  >
                      <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M6 18L18 6M6 6l12 12"
                      />
                  </svg>
                  </button>
              </header>
              <form @submit.prevent="onSubmit">
                  <div class="bg-white px-4 pt-5 pb-4">
                  <CustomInput class="mb-2" v-model="product.title" label="Product Title"/>
                  <div class="my-8 flex flex-col gap-4">
                    <DialogTitle as="h4" class="text-md leading-6 font-medium text-gray-900">
                      Categories
                    </DialogTitle>
                    <ul class="flex justify-between" label="Categories">
                      <li v-for="(category, index) of categories.data" :key="index">
                        <button :value="category.id" :class="[
                          'active:bg-black text-base font-medium active:text-white border rounded-md border-gray-300 shadow-sm w-full inline-flex justify-center mt-3 px-4 py-2 hover:bg-black/10 hover:text-black focus:outline-none focus:ring-1 focus:ring-offset-2 focus:ring-black sm:w-auto sm:mt-0 sm:ml-3 sm:text-sm',
                          {
                            'bg-black text-white': category.id === product.category_id,
                            'bg-white border border-gray-300 text-black': category.id !== product.category_id,
                          }
                        ]" @click.prevent="updateCategory(category.id)">{{category.title}}</button>
                      </li>
                    </ul>
                  </div>
                  <CustomInput type="file" class="mb-2" label="Product Image" @change="file => product.image = file"/>
                  <div class="my-8 flex flex-col gap-4">
                    <DialogTitle as="h4" class="text-md leading-6 font-medium text-gray-900">
                      Prices
                    </DialogTitle>
                    <div v-for="price in product.prices" :key="price.id">
                      <p class="text-gray-400"><strong class="text-black">€ {{ price.number }}</strong> . {{ price.size }}</p>
                    </div>
                  </div>
                  <CustomInput type="textarea" class="mb-2" v-model="product.description" label="Description"/>
                  <CustomInput type="checkbox" class="mb-2" v-model="product.published" label="Published"/>
                  </div>
                  <footer class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                  <button type="submit"
                          class="bg-black text-base font-medium text-white border rounded-md border-gray-300 shadow-sm w-full inline-flex justify-center mt-3 px-4 py-2 hover:bg-black/10 hover:text-black focus:outline-none focus:ring-1 focus:ring-offset-2 focus:ring-black sm:w-auto sm:mt-0 sm:ml-3 sm:text-sm">
                      Submit
                  </button>
                  <button type="button"
                          class="bg-white text-base font-medium text-gray-700 border rounded-md border-gray-300 shadow-sm w-full inline-flex justify-center mt-3 px-4 py-2 hover:bg-gray-50 focus:outline-none focus:ring-1 focus:ring-offset-1 focus:ring-gray-300 sm:w-auto sm:mt-0 sm:ml-3 sm:text-sm"
                          @click="closeModal" ref="cancelButtonRef">
                      Cancel
                  </button>
                  </footer>
              </form>
              </DialogPanel>
          </TransitionChild>
          </div>
      </div>
      </Dialog>
  </TransitionRoot>
</template>

<script setup>

import {computed, onUpdated, onMounted, ref} from 'vue'
import {Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot} from '@headlessui/vue'
import {ExclamationCircleIcon} from '@heroicons/vue/24/solid';
import CustomInput from "../../components/core/CustomInput.vue";
import store from "../../store/index.js";
import Spinner from "../../components/core/Spinner.vue";

const props = defineProps({
modelValue: Boolean,
product: {
  required: true,
  type: Object,
},
})
const product = ref({
id: props.product.id,
title: props.product.title,
category:props.product.category,
category_id:props.product.category_id,
image: props.product.image,
description: props.product.description,
prices: props.product.prices,
published: props.product.published,
selectedCategoryId: props.product.category_id,
})

const categories = computed(() => store.state.categories);
onMounted(() => {
getCategories();
})
function getCategories(url = null) {
store.dispatch("getCategories", {
  url,
});
}
const loading = ref(false)

const emit = defineEmits(['update:modelValue', 'close'])

const show = computed({
get: () => props.modelValue,
set: (value) => emit('update:modelValue', value)
})

function updateCategory(categoryId) {
  product.value.category_id = categoryId;
}
onUpdated(() => {
product.value = {
  id: props.product.id,
  title: props.product.title,
  category:props.product.category,
  category_id:props.product.category_id,
  image: props.product.image,
  description: props.product.description,
  prices: props.product.prices,
  published: props.product.published,
}
})

function closeModal() {
show.value = false
emit('close')
}


function onSubmit() {
loading.value = true
if (product.value.id) {
  store.dispatch('updateProduct', product.value)
    .then(response => {
      loading.value = false;
      if (response.status === 200) {
        // TODO show notification
        store.dispatch('getProducts')
        closeModal()
      }
    })
} else {
  store.dispatch('createProduct', product.value)
    .then(response => {
      loading.value = false;
      if (response.status === 201) {
        // TODO show notification
        store.dispatch('getProducts')
        closeModal()
      }
    })
    .catch(err => {
      loading.value = false;
      debugger;
    })
}
}
</script>

<style>

</style>