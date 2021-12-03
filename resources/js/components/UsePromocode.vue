<template>
    <div class="container">
        <div class="mb-3 row justify-content-center">
            <div class="col-sm-3">
                <label for="price_start" class="form-label">Цена товара</label>
                <input type="number" class="form-control"
                        id="price_start" placeholder="Введите цену" v-model.trim="form.price_start">
            </div>
            <div class="col-sm-3">
                <label for="promocode" class="form-label">Промокод</label>
                <input type="text" class="form-control"
                        id="promocode" placeholder="Введите промокод" v-model.trim="form.code">
            </div>
        </div>
        <div class="mb-3 row justify-content-center">
            <div class="col-sm-3">
                <label for="price_end" class="form-label">Итоговая стоимость</label>
                <input type="text" class="form-control" id="price_end" v-model="price_end" readonly>
            </div>
            <div class="col-sm-3 align-self-end">
                <button type="button" class="btn btn-success " :disabled="form.price_start == '' || form.code == ''"
                        @click="submit">Расчитать стоимость</button>
            </div>
        </div>
        <div v-show="message != ''" class="alert alert-warning" role="alert">
            {{ this.message }}
        </div>
    </div>
</template>

<script>
import axios from 'axios'

    export default {
        data() {
            return {
                form: {
                    price_start: '',
                    code: ''
                },
                price_end: '',
                message: ''
            }
        },

        methods: {
            submit() {
                this.message = '';
                axios
                    .post('/api/promo', this.form)
                    .then(res => {
                        if (res.data.status == true) {
                            this.price_end = res.data.post;
                            console.log(res);
                        } else {
                            this.message = res.data.post;
                            console.log(res);
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    })
                console.log(this.form);
            }
        }
    }
</script>
