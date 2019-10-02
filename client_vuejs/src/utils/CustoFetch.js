import axios from 'axios'

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

export class HumansixApi {

    static login(username, password) {
        return new Promise(function (resolve, reject) {
            axios.post('http://localhost:81/login', {
                username, password
            }).then(res => {
                if (res.status === 200) {
                    resolve(res.data)
                } else {
                    reject({status: res.status})
                }
            }).catch(reject)
        })
    }

    static orders() {
        return new Promise(function (resolve, reject) {
            genericGetWithToken('http://localhost:81/api/orders')
                .then(res => {
                    if (res.status === 200) {
                        resolve(res.data)
                    } else {
                        reject({status: res.status})
                    }
                }).catch(reject)
        })
    }

    static products() {
        return new Promise(function (resolve, reject) {
            genericGetWithToken('http://localhost:81/api/products')
                .then(res => {
                    if (res.status === 200) {
                        resolve(res.data)
                    } else {
                        reject({status: res.status})
                    }
                }).catch(reject)
        })
    }

    static uploadFile(form) {
        return new Promise(function (resolve, reject) {
            genericPostWithToken('http://localhost:81/api/uploadorder', form)
                .then(res => {
                    if (res.status === 200) {
                        resolve(res.data)
                    } else {
                        reject({status: res.status})
                    }
                })
                .catch(reject)
        })
    }
}