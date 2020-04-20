<template>
    <div class="admin ">
        <div class="page-wrapper default-theme sidebar-bg bg1 toggled ">
            <div class="btn btn-lg btn-dark btn-admin">
                <a id="show-sidebar" @click="closeMenu">
                    <i class="fas fa-compress-alt fa-2x"></i>
                </a>
            </div>

            <nav id="sidebar" class="sidebar-wrapper">
                <div class="sidebar-content hide-scroll">
                    <!-- sidebar-brand  -->
                    <div class="sidebar-item sidebar-brand">
                        <a>Admin Control</a>

                        <div id="close-sidebar" @click="closeMenu">
                            <i class="fas fa-times"></i>
                        </div>
                    </div>
                    <!-- sidebar-header  -->
                    <div class="sidebar-item sidebar-header">
                        <!-- <div class="user-pic">
                            <img
                                class="img-responsive img-rounded"

                                alt="User picture"
                            />
                        </div> -->
                        <div class="user-info">
                            <span class="user-name"
                                >Boss
                                <strong>Germany</strong>
                            </span>
                            <span class="user-status">
                                <i class="fa fa-circle"></i>
                                <span>Online</span>
                            </span>
                        </div>
                    </div>
                    <!-- sidebar-menu  -->
                    <div class=" sidebar-item sidebar-menu">
                        <ul>
                            <li class="header-menu">
                                <span>Menu</span>
                            </li>

                            <li>
                                <a
                                    :href="
                                        $router.resolve({ name: 'newEmployee' })
                                            .href
                                    "
                                >
                                    <i class="far fa-address-card"></i>
                                    <span>Add Employee</span>
                                </a>
                            </li>

                            <li>
                                <a
                                    :href="
                                        $router.resolve({
                                            name: 'addFlight'
                                        }).href
                                    "
                                >
                                    <i class="fas fa-plane-departure"></i>

                                    <span>Add Flight</span>
                                </a>
                            </li>
                            <li>
                                <a
                                    :href="
                                        $router.resolve({ name: 'addAircraft' })
                                            .href
                                    "
                                >
                                    <i class="fas fa-plane"></i>
                                    <span>Add Aircraft</span>
                                </a>
                            </li>

                            <li>
                                <router-link to="/">
                                    <i class="fas fa-home"></i>
                                    <span>Homepage</span>
                                </router-link>
                            </li>
                        </ul>
                    </div>
                    <!-- sidebar-menu  -->
                </div>
            </nav>
            <!-- sidebar-content  -->
            <main class="page-content">
                <router-view></router-view>
                <hr />
                <footer class="pt-xl-5 text-center">
                    <p class="mb-1">&copy; 2020 Mohlaewlook</p>
                </footer>
            </main>
            <!-- page-content" -->
        </div>
        <!-- page-wrapper -->
    </div>
</template>

<script>
export default {
    methods: {
        closeMenu() {
            $(".page-wrapper").toggleClass("toggled");
        }
    }
};
</script>
<style>
.btn-admin {
    color: #fff;
    border: none;
    border-radius: 0px;
    display: inline-flex;
}
.btn-admin:hover {
    color: #fff;
    border: none;
    border-radius: 0px;
    font-size: 30px;
    transition: 0.3s;
    display: inline-flex;
}
.hide-scroll::-webkit-scrollbar {
    overflow-y: hidden; /* Hide vertical scrollbar */
    overflow-x: hidden;
    display: none;
}
</style>
