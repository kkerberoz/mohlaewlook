<template>
    <div id="footers">
        <footer class=" pt-xl-5 text-center">
            <p class="mb-1">&copy; 2017-2018 Company Name</p>
            <ul class="list-inline">
                <li
                    v-for="(link, i) in links_filtered"
                    :key="i"
                    class="nav-item"
                >
                    <!-- <router-link :to="link.link" class="nav-link">
                        {{ link.label }}
                    </router-link> -->
                    <router-link
                        :to="{ name: link.name }"
                        style="color:#fff;"
                        >{{ link.label }}</router-link
                    >
                </li>
            </ul>
        </footer>
    </div>
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
                    link => link.name !== "login" && link.name !== "register"
                );
            } else {
                return this.links;
            }
        }
    }
};
</script>

<style></style>
