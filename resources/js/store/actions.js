import axios from "axios";

export const getProducts = ({ commit }) => {
    axios.get('https://ecommerce.test/api/product/')
        .then(response => {
            commit('SET_PRODUCTS', response.data.data);
        })
}

export const getProduct = ({ commit}, id) => {
    axios.get(`https://ecommerce.test/api/product/${id}`)
        .then(response => {
            commit('SET_PRODUCT', response.data.data);
        })
}
