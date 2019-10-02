import axios from 'axios'
import { router } from '../main.js'

function genericGetWithToken(url) {
    return axios.get(url, {
        headers: {'Authorization': 'Bearer '.concat(localStorage.getItem('token'))}
    })
}

function genericPostWithToken(url, data) {
    return axios.post(url, data, {
        headers: {'Authorization': 'Bearer '.concat(localStorage.getItem('token'))},
    })
}

function genericResolve(res, resolve, reject) {
    if (res.status === 200) {
        resolve(res.data)
    }
    reject(res)
}

function genericReject(err, reject) {
    const res = err.response
    if (res.status === 401) {
        localStorage.clear()
        router.push('/login')
    }
    reject({status: res.status})
}

export class HumansixApi {

    static login(username, password) {
        return new Promise(function (resolve, reject) {
            axios.post('http://localhost:81/login', { username, password })
                .then(res => genericResolve(res, resolve, reject))
                .catch(err => genericReject(err, reject))
        })
    }

    static orders() {
        return new Promise(function (resolve, reject) {
            genericGetWithToken('http://localhost:81/api/orders')
                .then(res => genericResolve(res, resolve, reject))
                .catch(err => genericReject(err, reject))
        })
    }

    static products() {
        return new Promise(function (resolve, reject) {
            genericGetWithToken('http://localhost:81/api/products')
                .then(res => genericResolve(res, resolve, reject))
                .catch(err => genericReject(err, reject))
        })
    }

    static customers() {
        return new Promise(function (resolve, reject) {
            genericGetWithToken('http://localhost:81/api/customers')
                .then(res => genericResolve(res, resolve, reject))
                .catch(err => genericReject(err, reject))
        })
    }

    static createOrder(form) {
        return new Promise(function (resolve, reject) {
            genericPostWithToken('http://localhost:81/api/createorder', form)
                .then(res => genericResolve(res, resolve, reject))
                .catch(err => genericReject(err, reject))
        })
    }

    static uploadFile(form) {
        return new Promise(function (resolve, reject) {
            genericPostWithToken('http://localhost:81/api/uploadorder', form)
                .then(res => genericResolve(res, resolve, reject))
                .catch(err => genericReject(err, reject))
        })
    }
}