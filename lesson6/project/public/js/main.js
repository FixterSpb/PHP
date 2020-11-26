// import products from 'Products';

const app = new Vue({
    el: "#app",

    methods: {
        getJSON(url) {
            // console.log(fetch(url).then(result => result.json))
            return fetch(url)
                .then(result => result.json())
                .catch(error => {
                    console.log(error)
                })
        },

        postJSON(url, data){
            return fetch(url, {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(data)
            })  .then(result => result.json())
                .catch(error => {
                    console.log(error);
                })
        },
        putJSON(url, data) {
            console.dir(data);
            return fetch(url, {
                method: 'PUT',
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(data)
            }).then(result => result.json())
                .catch(error => {
                    console.log(error);
                });
        },
        deleteJSON(url, data) {
            return fetch(url, {
                method: 'DELETE',
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(data)
            }).then(result => result.json())
                .catch(error => {
                    console.log(error);
                });
        }
    }
});
