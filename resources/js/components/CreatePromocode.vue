<template>
    <div class="col">
        <div class="container">
            <form role="form">
                <div class="form-group">
                    <label for="code">Промокод</label>
                    <input class="form-control" id="code" type="text" v-model.trim="form.code">
                </div>
                <div class="form-check-inline">
                    <input class="form-check-input" name="discount" type="radio" value="1" v-model="active" checked>
                    <label class="form-check-label">Скидка в процентах</label>
                </div>

                <div class="form-check-inline">
                    <input class="form-check-input" name="discount" type="radio" value="2" v-model="active">
                    <label class="form-check-label">Абсолютное значение скидки</label>
                </div>
                <input class="form-control" v-if="active == 1" type="number" v-model.trim="form.percent" key="percent">
                <input class="form-control" v-else type="number" v-model.trim="form.value_abs" key="value_abs">
                <div class="form-group">
                    <label for="min_sum">Минимальная сумма</label>
                    <input class="form-control" id="min_sum" type="number" v-model.trim="form.min_sum">
                </div>
                <div class="form-group">
                    <label for="date_close">Срок действия до</label>
                    <input class="form-control" id="date_close" type="date" v-model.trim="form.date_close">
                </div>
                <div class="form-group">
                    <label for="number_of_uses">Количество использований</label>
                    <input class="form-control" id="number_of_uses" type="number" v-model.trim="form.number_of_uses">
                </div>
                <button type="button" class="btn btn-success" @click.prevent="createPromocode">Создать</button>
            </form>

            <div v-for="msg in message" :key="msg.id" class="alert alert-warning" role="alert">
                {{ msg }}
            </div>

        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            form: {
                code: '',
                percent: '',
                value_abs: '',
                min_sum: '',
                date_close: '',
                number_of_uses: '',
                active: true
            },
            active: 1,
            message: []
        }
    },

    methods: {
        createPromocode() {
            this.valid();
            console.log(this.form);
            axios
                .post('/api/create_promo', this.form)
                .then(res => {
                    if (res.data.status == true) {
                        console.log(res.data.status);
                        this.clearInput();
                        this.message = res.data.post;
                        setTimeout(() => {
                            this.message = ''
                        }, 3000);
                    } else {
                        console.log(res);
                        this.message = res.data.errors;
                    }
                })
                .catch(error => {
                    console.log(error);
                })
        },

        valid() {
            if (this.active == 1) {
                this.form.value_abs = null;
            } else {
                this.form.percent = null;
            }
            if (this.form.number_of_uses == 0) {
                this.form.active = false;
            }
        },

        clearInput() {
            this.form.code = '';
            this.form.percent = '';
            this.form.value_abs = '';
            this.form.min_sum = '';
            this.form.date_close = '';
            this.form.number_of_uses = '';
            this.message = '';
        }
    }
}
</script>

<style>

</style>
