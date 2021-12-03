<template>
    <div class="col-3">
        <nav class="navbar">
            <div class="container-fluid">
                <ul class="nav">
                    <li
                    v-for="link in links"
                    :key="link.href">
                    <router-link :to="link.href">{{ link.title }}</router-link>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</template>

<script>
export default {
    data() {
        return {
            links: [
                {
                    title: 'Создать промокод',
                    href: '/admin/CreatePromocode'
                },
                {
                    title: 'Таблица промокодов',
                    href: '/admin/ViewPromocodes'
                }
            ]
        }
    }
}
</script>

<style>

</style>
