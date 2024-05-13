<template>
    <TransitionRoot as="template" :show="show">
        <Dialog as="div" class="relative z-10" @close="show = false">
            <TransitionChild as="template" enter="ease-out duration-300" 
                            enter-from="opacity-0" enter-to="opacity-100"
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
                        <DialogPanel class="relative bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-[700px] sm:w-full">
                            <Spinner v-if="loading" class="absolute left-0 top-0 bg-white right-0 bottom-0 flex items-center justify-center"/>
                            <header class="py-3 px-4 flex justify-between items-center">
                                <DialogTitle as="h3" class="text-lg leading-6 font-medium text-gray-900">
                                {{ price.id ? `Update price: "${props.price.product.title}"` : 'Create new price' }}
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
                            <div class="bg-white px-4">
                                <DialogTitle as="h4" class="text-sm leading-6 font-medium text-gray-900">
                                Producto: {{ props.price.product.title }}
                                </DialogTitle>
                            </div>
                            <form @submit.prevent="onSubmit">
                                <div class="bg-white px-4 pt-5 pb-4">
                                    <CustomInput class="mb-2" v-model="price.size" label="Price size"/>
                                    <CustomInput type="number"  class="mb-2" v-model="price.number" label="Price" prepend="€"/>
                                    <!-- <CustomInput class="mb-2" v-model="price.product" label="Product"/> -->
                                    <CustomInput type="select" :select-options="products" v-model="price.product" label="Products">
                                        <option selected>Choose an option</option>
                                    </CustomInput>
                                    <!-- <CustomInput type="select" :select-options="products" v-model="price.product_id" label="Products" :value="product_id" /> -->
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
    price: {
        required:true,
        type: Object,
    },
})

const price = ref({
    id: props.price.id,
    number:props.price.number,
    size: props.price.size,
    product: props.price.product
})

const products = computed(() => store.state.products.data.map(p => ({key: p.id, text: p.title})));
console.log(products)
onMounted(() => {
    getProducts();
})
function getProducts(url = null) {
    store.dispatch("getProducts", {
        url,
    });
}

const loading = ref(false)

const emit = defineEmits(['update:modelValue', 'close'])

const show = computed({
    get: () => props.modelValue,
    set: (value) => emit('update:modelValue', value)
})

onUpdated(() => {
    price.value = {
        id: props.price.id,
        number:props.price.number,
        size: props.price.size,
        product: props.price.product
    }
})

function closeModal() {
    show.value = false
    emit('close')
}

function onSubmit() {
    loading.value = true
    if (price.value.id) {
        store.dispatch('updatePrice', price.value)
        .then(response => {
            loading.value = false;
            if (response.status === 200) {
                // TODO show notification
                store.dispatch('getPrices')
                closeModal()
            }
        })
    } else {
        store.dispatch('createPrice', price.value)
        .then(response => {
            loading.value = false;
            if (response.status === 201) {
                // TODO show notification
                store.dispatch('getPrices')
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