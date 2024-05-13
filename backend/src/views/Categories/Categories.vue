<template>
    <div>
        <div class="flex justify-between mb-3">
            <h1 class="text-3xl font-semibold">Categories</h1>
            <button type="button"
                    @click="showAddNewModal()"
                    class="py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-black hover:text-black hover:bg-white focus:outline-none"
            >
            Add new Category
            </button>
        </div>
        <CategoriesTable @clickEdit="editCategory"/>
        <CategoryModal v-model="showCategoryModal" :category="categoryModel" @close="onModalClose" />
    </div>

</template>

<script setup>
import {computed, onMounted, ref} from "vue";
import store from "../../store";
import CategoryModal from "./CategoryModal.vue";
import CategoriesTable from "./CategoriesTable.vue";
const DEFAULT_CATEGORY = {
  id: '',
  title: '',
  description: '',
  image: '',
}
const categories = computed(() => store.state.categories);
const categoryModel = ref({...DEFAULT_CATEGORY})
const showCategoryModal = ref(false);
function showAddNewModal() {
  showCategoryModal.value = true
}
function editCategory(p) {
  store.dispatch('getCategory', p.id)
    .then(({data}) => {
      categoryModel.value = data
      showAddNewModal();
    })
}
function onModalClose() {
  categoryModel.value = {...DEFAULT_CATEGORY}
}
</script>

<style>
</style>