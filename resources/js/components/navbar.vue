<template>
    <div>
        <nav class="navbar navbar-expand-sm navbar-dark fixed-top">
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
                            @click="closeMenu"
                            v-for="(link, i) in links_filtered"
                            :key="i"
                            class="nav-item"
                        >
                            <router-link :to="link.link" class="nav-link">
                                {{ link.label }}
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <a
                                href="#"
                                @click.prevent="logout"
                                class=" nav-link"
                                v-if="isLoggedIn"
                            >
                                Logout
                            </a>
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
            user: "",
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
                return this.links.filter(
                    link =>
                        link.link !== "/info" && link.link !== "/reservation"
                );
            }
        }
    },
    methods: {
        closeMenu() {
            $("#collapsibleNavbar").collapse("hide");
        },
        logout() {
            axios.get("/sanctum/csrf-cookie").then(response => {
                axios.post("/api/user/logout").then(() => {
                    localStorage.removeItem("isLoggedIn");
                    this.$router.go({ name: "userLogin" });
                });
            });
        }
    }
};
</script>
<style>
.navbar {
    background-color: #3b84c4;
}
/* 4699c2 */
</style>
