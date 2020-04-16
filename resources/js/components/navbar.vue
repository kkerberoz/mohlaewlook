<template>
    <nav class="navbar navbar-expand-sm navbar-dark bg-info mb-2">
        <div class="container">
            <!-- {{ isLogIn }} -->

            <router-link to="/" class="navbar-brand" style="font-weight: bold;"
                >Mohlaewlook</router-link
            >
            <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#collapsibleNavbar"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav ml-auto">
                    <li
                        v-for="(link, i) in links_filtered"
                        :key="i"
                        class="nav-item"
                    >
                        <router-link :to="link.link" class="nav-link">
                            {{link.label}}
                        </router-link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    props: {
        links: Array,
        isLoggedIn: { type: Boolean, default: false }
    },
    computed: {
        links_filtered: function() {
            if (this.isLoggedIn) {
                return this.links.filter(
                    link => link.link !== "/login" && link.link !== "/register"
                );
            } else {
                return this.links;
            }
        }
    }
};
</script>
