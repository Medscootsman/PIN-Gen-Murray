<template>
    <div class="pin-display">
        <h1>Pin Generator</h1>
        <div class="form-group">
            <label for="getPinBtn">Please enter how many PINs you need.</label>
            <input v-model="totalPins" min="1" max="9974" type="number" name="totalPins" class="form-control">
            <p class="text-danger">{{errors}}</p>
        </div>
        <button class="btn btn-default" v-on:click="getPinNumbers">Get pins</button>
        <h2>PINs</h2>
        <div class="overflow-auto output-window">
            <p v-for="digit in digits" class="pin-text">{{digit}}</p>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Pin-Number',
    props: [
        'csrf_token'
    ],
    data: function() {
        return {
            totalPins: 1,
            digits: [],
            errors: "",
        }
    },
    mounted() {
        //Apply the token so we can make requests to the backend
        axios.defaults.headers.common['X-CSRF-TOKEN'] = this.csrf_token;
    },
    methods: {

        /*
        * Does a post request to get the pins
        */
        getPinNumbers: function (event) {

            if (this.totalPins < 1 || this.totalPins > 9974) {
                this.errors = "please enter a value between 1 and 9974";
            } else {
                this.errors = null;

                axios.post('/pins', {
                    totalPins: this.totalPins
                })
                .then((response) => {
                    this.digits = response.data;
                })
                .catch(function (error) {
                    alert(error.response.data.message);
                });
            }
        }
    }
}
</script>