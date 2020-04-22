<template>
    <div>
        <nav class="navbar navbar-expand-sm navbar-dark bg-info fixed-top">
            <div class="container">
                <!-- {{ isLogIn }} -->

                <router-link
                    to="/"
                    class="navbar-brand"
                    style="font-weight: bold;"
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
                                {{ link.label }}
                            </router-link>
                        </li>
                        <li class="nav-item" v-if="isLoggedIn">
                            <a @click="logout" class="nav-link">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
export default {
    data() {
        return {
            isLoggedIn: false
        };
    },
    props: {
        links: Array
        // isLoggedIn: { type: Boolean, default: false }
    },
    mounted() {
        this.isLoggedIn = localStorage.getItem("isLoggedIn");
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
    },
    methods: {
        logout() {
            axios.get("/sanctum/csrf-cookie").then(response => {
                axios.post("/api/logout").then(() => {
                    localStorage.removeItem("isLoggedIn");
                    this.$router.go({ name: "userLogin" });
                });
            });
        }
    }
};
</script>
