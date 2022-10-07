import axios from "axios";

export const getProducts = ({ commit }) => {
    axios.get(process.env.MIX_SENTRY_DSN_PUBLIC + '/api/product/')
        .then(response => {
            commit('SET_PRODUCTS', response.data.data);
        })
}

export const getProduct = ({ commit}, id) => {
    axios.get(process.env.MIX_SENTRY_DSN_PUBLIC + `/api/product/${id}`)
        .then(response => {
            commit('SET_PRODUCT', response.data.data);
        })
}
