<template>
    <div class="relative z-10">
        <div class="fixed inset-0 bg-black bg-opacity-70 transition-opacity" v-if="showLoadingOverlay">
        </div>
        <div class="flex items-center justify-center min-h-full p-4 text-center sm:p-0">
            <div class="relative bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-[700px] sm:w-full">
                <Spinner v-if="loading" class="absolute left-0 top-0 bg-white right-0 bottom-0 flex items-center justify-center"/>
                <header class="py-3 px-4 flex justify-between items-center">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        {{ product.id ? `Update product: "${product.title}"` : 'Create new Product' }}
                    </h3>
                </header>
                <form @submit.prevent="onSubmit">
                    <div class="bg-white px-4 pt-5 pb-4">
                        <CustomInput class="mb-2" v-model="product.title" label="Product Title"/>
                        <div class="my-8 flex flex-col gap-4">
                            <h4 class="text-md leading-6 font-medium text-gray-900">Categories</h4>
                            <ul class="flex justify-between" label="Categories">
                                <li v-for="(category, index) in categories.data" :key="index">
                                    <button :value="category.id" :class="[
                                        'active:bg-black text-base font-medium active:text-white border rounded-md border-gray-300 shadow-sm w-full inline-flex justify-center mt-3 px-4 py-2 hover:bg-black/10 hover:text-black focus:outline-none focus:ring-1 focus:ring-offset-2 focus:ring-black sm:w-auto sm:mt-0 sm:ml-3 sm:text-sm',
                                        {
                                            'bg-black text-white': category.id === product.category_id,
                                            'bg-white border border-gray-300 text-black': category.id !== product.category_id,
                                        }
                                    ]" @click.prevent="updateCategory(category.id)">
                                        {{category.title}}
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <CustomInput type="file" class="mb-2" label="Product Image" @change="file => product.image = file"/>
                        <div class="my-8 flex flex-col gap-4">
                            <h4 class="text-md leading-6 font-medium text-gray-900">Prices</h4>
                            <PricesProduct @clickEdit="editPrice"/>
                            <!-- <div v-for="price in product.prices" :key="price.id">
                                <p class="text-gray-400"><strong class="text-black">€ {{ price.number }}</strong> . {{ price.size }}</p>
                                <button
                                    class="active:bg-black text-base font-medium active:text-white border rounded-md border-gray-300 shadow-sm w-full inline-flex justify-center mt-3 px-4 py-2 hover:bg-black/10 hover:text-black focus:outline-none focus:ring-1 focus:ring-offset-2 focus:ring-black sm:w-auto sm:mt-0 sm:ml-3 sm:text-sm"
                                    @click="editPrice(price)"
                                >
                                    <PencilSquareIcon
                                    
                                    class="mr-2 h-5 w-5 text-gray-500"
                                    aria-hidden="true"
                                    />
                                    Edit
                                </button>
                                <button
                                    :class="[
                                        active ? 'bg-black text-white' : 'text-gray-900', 'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                                    ]"
                                    @click="deletePrice(price)"
                                    >
                                    <TrashIcon
                                        :active="active"
                                        class="mr-2 h-5 w-5 text-gray-500"
                                        aria-hidden="true"
                                        />
                                        Delete
                                </button>
                            </div>
                            <button type="button"
                                    @click="showAddNewModal()"
                                    class="py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-black hover:text-black hover:bg-white focus:outline-none"
                            >
                                Add new Price
                            </button> -->
                            
                        </div>
                        <CustomInput type="textarea" class="mb-2" v-model="product.description" label="Description"/>
                        <CustomInput type="checkbox" class="mb-2" v-model="product.published" label="Published"/>
                    </div>
                    <footer class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="bg-black text-base font-medium text-white border rounded-md border-gray-300 shadow-sm w-full inline-flex justify-center mt-3 px-4 py-2 hover:bg-black/10 hover:text-black focus:outline-none focus:ring-1 focus:ring-offset-2 focus:ring-black sm:w-auto sm:mt-0 sm:ml-3 sm:text-sm">
                            Submit
                        </button>
                        <router-link :to="{name: 'app.products'}" type="button"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                        ref="cancelButtonRef">
                            Cancel
                        </router-link>
                    </footer>
                </form>
            </div>
        </div>
    </div>
    <PriceModal v-model="showPriceModal" :price="priceModel" @close="onModalClose" @priceUpdated="refreshPrices"/>
</template>

<script setup>
import { ref, computed, onMounted, onUpdated } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import CustomInput from "../../components/core/CustomInput.vue";
import store from "../../store/index.js";
import Spinner from "../../components/core/Spinner.vue";
import {EllipsisVerticalIcon, PencilSquareIcon, TrashIcon} from '@heroicons/vue/24/solid';
import PriceModal from "../Prices/PriceModal.vue";
import PricesProduct from "../Prices/PricesProduct.vue";
  
const route = useRoute();
const router = useRouter();
const loading = ref(false);
const showLoadingOverlay = ref(false);
  
const product = ref({
    id: route.params.id || null,
    title: '',
    category: null,
    category_id: null,
    image: null,
    description: '',
    prices: [],
    published: false,
});
  
if (product.value.id) {
    store.dispatch('getProduct', product.value.id).then(response => {
        Object.assign(product.value, response.data);
    });
}
  
const categories = computed(() => store.state.categories);

onMounted(() => {
    getCategories();
});

function getCategories(url = null) {
    store.dispatch("getCategories", {
        url,
    });
}
  
function updateCategory(categoryId) {
    product.value.category_id = categoryId;
}
///

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

function refreshPrices() {
    store.dispatch('getProduct', product.value.id).then(({ data }) => {
        product.value = data;
    });
}

function onModalClose(){
    priceModel.value = {...DEFAULT_PRICE}
}

function deletePrice(price){
    if (!confirm(`Are you sure you want to delete the price?`)) {
        return
    }
    store.dispatch('deletePrice', price.id)
    .then(res => {
        store.dispatch('getProduct', product.value.id).then(({ data }) => {
        product.value = data;
    });
    })
}

///
function onSubmit() {
    loading.value = true
    if (product.value.id) {
        console.log(product.value.status);
        product.value.status = !!product.value.status
        store.dispatch('updateProduct', product.value)
        .then(response => {
            loading.value = false;
            if (response.status === 200) {
                // TODO show notification
                store.dispatch('getProducts')
                router.push({name: 'app.products'})
            }
        })
    } else {
        store.dispatch('createProduct', product.value)
        .then(response => {
            loading.value = false;
            if (response.status === 201) {
                // TODO show notification
                store.dispatch('getProducts')
                router.push({name: 'app.products'})
            }
        })
        .catch(err => {
            loading.value = false;
            debugger;
        })
    }
}

onMounted(() => {
  store.dispatch('getProduct', route.params.id)
    .then(({data}) => {
        product.value = data
    })
})
</script>