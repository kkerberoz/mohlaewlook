<template>
  <nav class="navbar navbar-expand-sm navbar-dark bg-info mb-2">
    <div class="container">
      <!-- {{ isLogIn }} -->
      <a href="/" class="navbar-brand">Mohlaewlook</a>
      <ul class="navbar-nav">
        <!-- <li class="nav-item active">
          <a class="nav-link" href="/login">login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/register">register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/info">info</a>
        </li>-->
        <li v-for="(link,i) in links_filtered" :key="i" class="nav-item">
          <a :href="link.link" class="nav-link">{{link.label}}</a>
        </li>
      </ul>
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
