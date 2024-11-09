<template>
    <div class="my-12">      
      <!-- Indicador de carga -->
      <div v-if="loading">Cargando productos...</div>
      
      <!-- Mensaje de error -->
      <div v-if="error" class="error">{{ error }}</div>
      
      <!-- Productos -->
      <div v-if="!loading && !error">
        <div class="max-w-screen-xl mx-auto flex gap-8">
            <aside class="w-1/6">
                <h3>Productos</h3>
            </aside>
            <div class="flex-1">
                <ul class="grid gap-4 grid-cols-2 sm:grid-cols-2 md:grid-cols-4">
                    <li class="border-transparent relative overflow-hidden rounded-lg bg-white dark:bg-black flex" v-for="product in products" :key="product.id">
                        <a :href="'/products/' + product.categories[0]?.slug + '/' + product.slug" class="aspect-w-3 aspect-h-2 block overflow-hidden">
                            <img
                                :src="product.image_url"
                                alt=""
                                class="card-image object-cover hover:scale-105 hover:rotate-1 transition-transform"
                            />
                            <div class="p-4 card-listing">
                                <div>
                                    <h6 class="underline-hover w-fit">
                                        {{ product.title }}
                                    </h6>
                                </div>
                                <!-- Mostrar los precios asociados -->
                                <div v-if="product.prices && product.prices.length > 0" class="my-2 text-xs flex gap-2">
                                    <strong>Precio:</strong>
                                    <ul>
                                        <li v-for="price in product.prices" :key="price.id">
                                            ${{ price.number }} ({{ price.size }})
                                        </li>
                                    </ul>
                                </div>
                                <!-- Mostrar la cantidad si está disponible -->
                                <p class="text-xs" v-if="product.quantity">Stock: {{ product.quantity }}</p>
                                <p class="text-xs" v-else>Sin cantidad disponible</p>
                                
                                <!-- Mostrar las categorías asociadas -->
                                <div v-if="product.categories && product.categories.length > 0" class="mt-2 text-xs flex gap-2">
                                    <strong>Marca:</strong>
                                    <ul>
                                        <li v-for="category in product.categories" :key="category.id">
                                            {{ category.name }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
      </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            products: [],  // Para almacenar los productos
            loading: true,  // Para manejar el estado de carga
            error: null,    // Para manejar errores de la API
        };
    },
    mounted() {
        // Llamamos a la función que obtiene los productos cuando el componente se monta
        this.fetchProducts();
    },
    methods: {
        fetchProducts() {
            axios.get('/api/products')  // Hacemos la petición a la API de productos
            .then(response => {
                this.products = response.data.data;  // Asignamos los productos (data está envuelto en 'data')
                this.loading = false;  // Cambiamos el estado de carga
            })
            .catch(error => {
                console.error("Error al obtener productos:", error);
                this.error = "Ocurrió un error al cargar los productos.";  // Mostramos un mensaje de error
                this.loading = false;  // Terminamos el estado de carga
            });
        },
    }
};
</script>

<style scoped>
.error {
    color: red;
}
</style>
