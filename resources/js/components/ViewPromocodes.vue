<template>
    <div class="col">
        <table class="table">
            <thead>
                <tr>
                    <th>№</th>
                    <th>Промокод</th>
                    <th>Процент скидки, %</th>
                    <th>Абсолютное значение, руб</th>
                    <th>Минимальная сумма</th>
                    <th>Дата окончания</th>
                    <th>Количество использований</th>
                    <th>Активен</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="str in table" :key="str.id">
                    <td v-for="el in str">
                        {{ el }}
                        <span v-if="str.percent == el && str.percent != null">%</span>
                        <span v-else-if="str.value_abs == el && str.value_abs != null">руб.</span>
                        <span v-else-if="str.min_sum == el"> руб.</span>
                    </td>
                </tr>
            </tbody>
        </table>

        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item"
                    :class="{ 'disabled': !pagination.prev_page }"
                    @click.prevent="loadTable(pagination.first_page_url)">
                    <a class="page-link" href="">В начало</a>
                </li>

                <li class="page-item" v-for="temp in pagination.links" :key="temp.id"
                    @click.prevent="loadTable(temp.url)">
                    <a class="page-link" href="">{{ temp.label }}</a>
                </li>

                <li class="page-item"
                    :class="{ 'disabled': !pagination.next_page }"
                    @click.prevent="loadTable(pagination.last_page_url)">
                    <a class="page-link" href="">В конец</a>
                </li>
            </ul>
        </nav>

    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            pagination: [],
            table: []
        }
    },

    mounted() {
        this.loadTable();
    },

    methods: {
        loadTable(page_url) {
        page_url = page_url || '/api/promo';
        console.log(page_url);
        axios
            .get(page_url)
            .then(res => {
                this.table = res.data.data;
                this.makePagination(res.data);
                console.log(this.table);
            })
            .catch(error => {
                if (error.res) {
                    console.log(error.res.data);
                }
            })
        },

        makePagination(res) {
            this.pagination = {
                current_page: res.current_page,
                next_page: res.next_page_url,
                prev_page: res.prev_page_url,
                first_page_url: res.first_page_url,
                last_page_url: res.last_page_url
            }
            if (res.links.length <= 7) {
                this.pagination.links = res.links.slice(1, res.links.length - 1)
            } else {
                if ((this.pagination.current_page - 3) <= 0) {
                    this.pagination.links = res.links.slice(1, 6)
                } else if ((this.pagination.current_page - 3) > 0 && (this.pagination.current_page + 3) <= res.links.   length - 2) {
                    this.pagination.links = res.links
                    .slice((this.pagination.current_page - 2), (this.pagination.current_page + 3))
                } else {
                    this.pagination.links = res.links
                    .slice(res.links.length - 6, res.links.length - 1)
                }
            }
        },
    }
}
</script>

<style>

</style>
