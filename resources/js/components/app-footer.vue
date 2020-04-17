<template>
    <div id="footers">
        <footer class="pt-xl-5 text-center">
            <p class="mb-1">&copy; 2020 Mohlaewlook</p>
            <ul class="list-inline" style="inline-block">
                <li
                    v-for="(link, i) in links_filtered"
                    :key="i"
                    class="nav-item"
                >
                    <!-- <router-link :to="link.link" class="nav-link">
                        {{ link.label }}
          </router-link>-->
                    <router-link :to="link.link" style="color:#fff;">{{
                        link.label
                    }}</router-link>
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
                    link => link.link !== "/login" && link.link !== "/register"
                );
            } else {
                return this.links;
            }
        }
    }
};
</script>

<style></style>
