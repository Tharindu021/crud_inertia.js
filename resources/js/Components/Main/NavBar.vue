<template>
        <nav class="navbar navbar-expand-lg bg-primary">
            <div class="container-fluid">
            <Link class="navbar-brand fw-semibold p-2 text-white" :href="route('show')">Dashboard</Link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class=" d-flex justify-content-end collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                <li class="nav-item">
                    <ResponsiveNavLink class="nav-link fw-semibold badge bg-danger p-2" :href="route('logout')" method="post">Log Out</ResponsiveNavLink>
                </li>
                </ul>
            </div>
            </div>
        </nav>

</template>

<script>
import { Link } from '@inertiajs/vue3';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

export default {
    components :{
        Link,
        ResponsiveNavLink
    }
}
</script>

<style lang="scss" scoped>

</style>