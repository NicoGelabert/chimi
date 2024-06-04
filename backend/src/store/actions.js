import axiosClient from "../axios";

export function getCurrentUser({commit}, data) {
  return axiosClient.get('/user', data)
    .then(({data}) => {
      commit('setUser', data);
      return data;
    })
}

export function login({commit}, data) {
  return axiosClient.post('/login', data)
    .then(({data}) => {
      commit('setUser', data.user);
      commit('setToken', data.token)
      return data;
    })
}

export function logout({commit}) {
  return axiosClient.post('/logout')
    .then((response) => {
      commit('setToken', null)

      return response;
    })
}

export function getCountries({commit}) {
  return axiosClient.get('countries')
    .then(({data}) => {
      commit('setCountries', data)
    })
}

export function getOrders({commit, state}, {url = null, search = '', per_page, sort_field, sort_direction} = {}) {
  commit('setOrders', [true])
  url = url || '/orders'
  const params = {
    per_page: state.orders.limit,
  }
  return axiosClient.get(url, {
    params: {
      ...params,
      search, per_page, sort_field, sort_direction
    }
  })
    .then((response) => {
      commit('setOrders', [false, response.data])
    })
    .catch(() => {
      commit('setOrders', [false])
    })
}

export function getOrder({commit}, id) {
  return axiosClient.get(`/orders/${id}`)
}

// HOMEHEROBANNERS
export function getHomeHeroBanners({commit, state}, {url = null, search = '', per_page, sort_field, sort_direction} = {}) {
  commit('setHomeHeroBanners', [true])
  url = url || '/homeherobanners'
  const params = {
    per_page: state.homeHeroBanners.limit,
  }
  return axiosClient.get(url, {
    params: {
      ...params,
      search, per_page, sort_field, sort_direction
    }
  })
    .then((response) => {
      commit('setHomeHeroBanners', [false, response.data])
    })
    .catch(() => {
      commit('setHomeHeroBanners', [false])
    })
}

export function getHomeHeroBanner({commit}, id) {
  return axiosClient.get(`/homeherobanners/${id}`)
}

export function createHomeHeroBanner({commit}, homeHeroBanner) {
  if (homeHeroBanner.image instanceof File) {
    const form = new FormData();
    form.append('image', homeHeroBanner.image);
    form.append('headline', homeHeroBanner.headline);
    form.append('description', homeHeroBanner.description);
    form.append('link', homeHeroBanner.link);
    form.append('background', homeHeroBanner.background);
    homeHeroBanner = form;
  }
  return axiosClient.post('/homeherobanners', homeHeroBanner)
}

export function updateHomeHeroBanner({commit}, homeHeroBanner) {
  const id = homeHeroBanner.id
  if (homeHeroBanner.image instanceof File) {
    const form = new FormData();
    form.append('id', homeHeroBanner.id);
    form.append('image', homeHeroBanner.image);
    form.append('headline', homeHeroBanner.headline);
    form.append('description', homeHeroBanner.description);
    form.append('link', homeHeroBanner.link);
    form.append('background', homeHeroBanner.background);
    form.append('_method', 'PUT');
    homeHeroBanner = form;
  } else {
    homeHeroBanner._method = 'PUT'
  }
  return axiosClient.post(`/homeherobanners/${id}`, homeHeroBanner)
}

export function deleteHomeHeroBanner({commit}, id) {
  return axiosClient.delete(`/homeherobanners/${id}`)
}

// CATEGORIES
export function getCategories({commit, state}, {sort_field, sort_direction} = {}) {
  commit('setCategories', [true])
  return axiosClient.get('/categories', {
    params: {
      sort_field, sort_direction
    }
  })
    .then((response) => {
      commit('setCategories', [false, response.data])
    })
    .catch(() => {
      commit('setCategories', [false])
    })
}

export function createCategory({commit}, category) {
  return axiosClient.post('/categories', category)
}

export function updateCategory({commit}, category) {
  return axiosClient.put(`/categories/${category.id}`, category)
}

export function deleteCategory({commit}, category) {
  return axiosClient.delete(`/categories/${category.id}`)
}

// PRODUCTS
export function getProducts({commit, state}, {url = null, search = '', per_page, sort_field, sort_direction} = {}) {
  commit('setProducts', [true])
  url = url || '/products'
  const params = {
    per_page: state.products.limit,
  }
  return axiosClient.get(url, {
    params: {
      ...params,
      search, per_page, sort_field, sort_direction
    }
  })
    .then((response) => {
      commit('setProducts', [false, response.data])
    })
    .catch(() => {
      commit('setProducts', [false])
    })
}

export function getProduct({commit}, id) {
  return axiosClient.get(`/products/${id}`)
}

export function createProduct({commit}, product) {
  if (product.images && product.images.length) {
    const form = new FormData();
    form.append('title', product.title);
    product.images.forEach(im => form.append('images[]', im))
    form.append('description', product.description || '');
    form.append('published', product.published ? 1 : 0);
    form.append('price', product.price);
    product = form;
  }
  return axiosClient.post('/products', product)
}

export function updateProduct({commit}, product) {
  const id = product.id
  if (product.images && product.images.length) {
    const form = new FormData();
    form.append('id', product.id);
    form.append('title', product.title);
    product.images.forEach(im => form.append(`images[${im.id}]`, im))
    if (product.deleted_images) {
      product.deleted_images.forEach(id => form.append('deleted_images[]', id))
    }
    for (let id in product.image_positions) {
      form.append(`image_positions[${id}]`, product.image_positions[id])
    }
    form.append('description', product.description || '');
    form.append('published', product.published ? 1 : 0);
    form.append('price', product.price);
    form.append('_method', 'PUT');
    product = form;
  } else {
    product._method = 'PUT'
  }
  return axiosClient.post(`/products/${id}`, product)
}

export function deleteProduct({commit}, id) {
  return axiosClient.delete(`/products/${id}`)
}

// PRICES
export function getPrices({commit, state}, {url = null, search = '', per_page, sort_field, sort_direction} = {}) {
  commit('setPrices', [true])
  url = url || '/prices'
  const params = {
    per_page: state.prices.limit,
  }
  return axiosClient.get(url, {
    params: {
      ...params,
      search, per_page, sort_field, sort_direction
    }
  })
    .then((response) => {
      commit('setPrices', [false, response.data])
    })
    .catch(() => {
      commit('setPrices', [false])
    })
}


export function getPrice({commit}, id) {
  return axiosClient.get(`/prices/${id}`)
}

export function createPrice({commit}, price) {
  if (price.image instanceof File) {
    const form = new FormData();
    form.append('number', price.number);
    form.append('size', price.size);
    form.append('product', price.product);
    
    price = form;
  }
  return axiosClient.post('/prices', price)
}

export function updatePrice({commit}, price) {
  const id = price.id
  if (price.image instanceof File) {
    const form = new FormData();
    form.append('id', price.id);
    form.append('number', price.number);
    form.append('size', price.size);
    form.append('product_id', price.product_id);
    form.append('_method', 'PUT');
    price = form;
  } else {
    price._method = 'PUT'
  }
  return axiosClient.post(`/prices/${id}`, price)
}

export function deletePrice({commit}, id) {
  return axiosClient.delete(`/prices/${id}`)
}

// USERS
export function getUsers({commit, state}, {url = null, search = '', per_page, sort_field, sort_direction} = {}) {
  commit('setUsers', [true])
  url = url || '/users'
  const params = {
    per_page: state.users.limit,
  }
  return axiosClient.get(url, {
    params: {
      ...params,
      search, per_page, sort_field, sort_direction
    }
  })
    .then((response) => {
      commit('setUsers', [false, response.data])
    })
    .catch(() => {
      commit('setUsers', [false])
    })
}

export function createUser({commit}, user) {
  return axiosClient.post('/users', user)
}

export function updateUser({commit}, user) {
  return axiosClient.put(`/users/${user.id}`, user)
}

export function getCustomers({commit, state}, {url = null, search = '', per_page, sort_field, sort_direction} = {}) {
  commit('setCustomers', [true])
  url = url || '/customers'
  const params = {
    per_page: state.customers.limit,
  }
  return axiosClient.get(url, {
    params: {
      ...params,
      search, per_page, sort_field, sort_direction
    }
  })
    .then((response) => {
      commit('setCustomers', [false, response.data])
    })
    .catch(() => {
      commit('setCustomers', [false])
    })
}

export function getCustomer({commit}, id) {
  return axiosClient.get(`/customers/${id}`)
}

export function createCustomer({commit}, customer) {
  return axiosClient.post('/customers', customer)
}

export function updateCustomer({commit}, customer) {
  return axiosClient.put(`/customers/${customer.id}`, customer)
}

export function deleteCustomer({commit}, customer) {
  return axiosClient.delete(`/customers/${customer.id}`)
}

//ALERGENS
export function getAlergens({commit, state}, {sort_field, sort_direction} = {}) {
  commit('setAlergens', [true])
  return axiosClient.get('/alergens', {
    params: {
      sort_field, sort_direction
    }
  })
    .then((response) => {
      commit('setAlergens', [false, response.data])
    })
    .catch(() => {
      commit('setAlergens', [false])
    })
}

export function createAlergen({commit}, alergen) {
  return axiosClient.post('/alergens', alergen)
}

export function updateAlergen({commit}, alergen) {
  return axiosClient.put(`/alergens/${alergen.id}`, alergen)
}

export function deleteAlergen({commit}, alergen) {
  return axiosClient.delete(`/alergens/${alergen.id}`)
}