<template>
    <div id="wrapper" v-if="$store.state.user">
        <!--  BEGIN SIDEBAR   -->
        <nav
            class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0"
        >
            <div class="container-fluid d-flex flex-column p-0">
                <a
                    class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0"
                    href="#"
                >
                    <div class="sidebar-brand-icon rotate-n-15">
                        <Icon type="logo-rss" size="30" />
                    </div>
                    <div class="sidebar-brand-text mx-3">
                        <span>Blog</span>
                    </div>
                </a>
                <hr class="sidebar-divider my-0" />
                <ul class="nav navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item">
                        <router-link class="nav-link active" to=dashboard><Icon type="ios-speedometer-outline" size="25" /><span>Dashboard</span></router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link active" to=users><Icon type="md-person-add" size="25" /><span>Admin Users</span></router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link active" to=role><Icon type="ios-pricetags-outline" size="25" /><span>Role</span></router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link active" to=assignRole><Icon type="ios-pricetags-outline" size="25" /><span>Assign Role</span></router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link active" to=tag><Icon type="ios-pricetags-outline" size="25" /><span>Tags</span></router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link active" to=category><Icon type="ios-apps" size="25" /><span>Category</span></router-link>
                    </li>
                </ul>
            </div>
        </nav>

        <!--  END SIDEBAR   -->

        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <!--  BEGIN HEADER   -->
                <nav
                    class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top"
                >
                    <div class="container-fluid">
                        <button
                            class="btn btn-link d-md-none rounded-circle mr-3"
                            id="sidebarToggleTop"
                            type="button"
                        >
                            <Icon type="ios-menu" />
                        </button>
                        <form
                            class="form-inline d-none d-sm-inline-block mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
                        >
                            <div class="input-group">
                                <input
                                    class="bg-light form-control border-0 small"
                                    type="text"
                                    placeholder="Search for ..."
                                />
                                <div class="input-group-append">
                                    <button
                                        class="btn btn-primary py-0"
                                        type="button"
                                    >
                                        <Icon type="ios-search" />
                                    </button>
                                </div>
                            </div>
                        </form>
                        <ul class="nav navbar-nav flex-nowrap ml-auto">
                            <li class="nav-item dropdown d-sm-none no-arrow">
                                <a
                                    class="dropdown-toggle nav-link"
                                    data-toggle="dropdown"
                                    aria-expanded="false"
                                    href="#"
                                    ><Icon type="ios-search" /></a>
                                <div
                                    class="dropdown-menu dropdown-menu-right p-3 animated--grow-in"
                                    aria-labelledby="searchDropdown"
                                >
                                    <form
                                        class="form-inline mr-auto navbar-search w-100"
                                    >
                                        <div class="input-group">
                                            <input
                                                class="bg-light form-control border-0 small"
                                                type="text"
                                                placeholder="Search for ..."
                                            />
                                            <div class="input-group-append">
                                                <button
                                                    class="btn btn-primary py-0"
                                                    type="button"
                                                >
                                                    <Icon type="ios-notifications" />
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li>

                            <li class="nav-item dropdown no-arrow mx-1">
                                <div class="nav-item dropdown no-arrow">
                                    <a
                                        class="dropdown-toggle nav-link"
                                        data-toggle="dropdown"
                                        aria-expanded="false"
                                        href="#"
                                        ><span
                                            class="badge badge-danger badge-counter"
                                            >3+</span
                                        ><Icon type="ios-notifications" size="24" /></a>
                                    <div
                                        class="dropdown-menu dropdown-menu-right dropdown-list dropdown-menu-right animated--grow-in"
                                    >
                                        <h6 class="dropdown-header">
                                            alerts center
                                        </h6>
                                        <a
                                            class="d-flex align-items-center dropdown-item"
                                            href="#"
                                        >
                                            <div class="mr-3">
                                                <div
                                                    class="bg-primary icon-circle"
                                                >
                                                    <Icon type="ios-document-outline" size="24" color="white" />
                                                </div>
                                            </div>
                                            <div>
                                                <span
                                                    class="small text-gray-500"
                                                    >December 12, 2019</span
                                                >
                                                <p>
                                                    A new monthly report is
                                                    ready to download!
                                                </p>
                                            </div>
                                        </a>
                                        <a
                                            class="d-flex align-items-center dropdown-item"
                                            href="#"
                                        >
                                            <div class="mr-3">
                                                <div
                                                    class="bg-success icon-circle"
                                                >
                                                    <Icon type="ios-cash-outline" size="24" />
                                                </div>
                                            </div>
                                            <div>
                                                <span
                                                    class="small text-gray-500"
                                                    >December 7, 2019</span
                                                >
                                                <p>
                                                    $290.29 has been deposited
                                                    into your account!
                                                </p>
                                            </div>
                                        </a>
                                        <a
                                            class="d-flex align-items-center dropdown-item"
                                            href="#"
                                        >
                                            <div class="mr-3">
                                                <div
                                                    class="bg-warning icon-circle"
                                                >
                                                    <Icon type="ios-warning-outline" size="24" />
                                                </div>
                                            </div>
                                            <div>
                                                <span
                                                    class="small text-gray-500"
                                                    >December 2, 2019</span
                                                >
                                                <p>
                                                    Spending Alert: We've
                                                    noticed unusually high
                                                    spending for your account.
                                                </p>
                                            </div> </a
                                        ><a
                                            class="text-center dropdown-item small text-gray-500"
                                            href="#"
                                            >Show All Alerts</a
                                        >
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item dropdown no-arrow mx-1">
                                <div class="nav-item dropdown no-arrow">
                                    <a
                                        class="dropdown-toggle nav-link"
                                        data-toggle="dropdown"
                                        aria-expanded="false"
                                        href="#"
                                        ><Icon type="ios-mail" size="24" /><span
                                            class="badge badge-danger badge-counter"
                                            >7</span
                                        ></a
                                    >
                                    <div
                                        class="dropdown-menu dropdown-menu-right dropdown-list dropdown-menu-right animated--grow-in">
                                        <h6 class="dropdown-header">
                                            alerts center
                                        </h6>
                                        <a
                                            class="d-flex align-items-center dropdown-item"
                                            href="#"
                                        >
                                            <div
                                                class="dropdown-list-image mr-3"
                                            >
                                                <img
                                                    class="rounded-circle"
                                                    src="/img/avatar.jpeg"
                                                />
                                                <div
                                                    class="bg-success status-indicator"
                                                ></div>
                                            </div>
                                            <div class="font-weight-bold">
                                                <div class="text-truncate">
                                                    <span
                                                        >Hi there! I am
                                                        wondering if you can
                                                        help me with a problem
                                                        I've been having.</span
                                                    >
                                                </div>
                                                <p
                                                    class="small text-gray-500 mb-0"
                                                >
                                                    Emily Fowler - 58m
                                                </p>
                                            </div>
                                        </a>
                                        <a
                                            class="text-center dropdown-item small text-gray-500"
                                            href="#"
                                            >Show All Alerts</a>
                                    </div>
                                </div>
                                <div
                                    class="shadow dropdown-list dropdown-menu dropdown-menu-right"
                                    aria-labelledby="alertsDropdown"
                                ></div>
                            </li>

                            <div class="d-none d-sm-block topbar-divider"></div>

                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow">
                                    <a
                                        class="dropdown-toggle nav-link"
                                        data-toggle="dropdown"
                                        aria-expanded="false"
                                        href="#"
                                        ><span
                                            class="d-none d-lg-inline mr-2 text-gray-600 small"
                                            >Valerie Luna</span
                                        ><img
                                            class="border rounded-circle img-profile"
                                            src="/img/avatar.jpeg"
                                    /></a>
                                    <div
                                        class="dropdown-menu shadow dropdown-menu-right animated--grow-in"
                                    >
                                        <a class="dropdown-item" href="#"
                                            ><i
                                                class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"
                                            ></i
                                            >&nbsp;Profile</a
                                        ><a class="dropdown-item" href="#"
                                            ><i
                                                class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"
                                            ></i
                                            >&nbsp;Settings</a
                                        >
                                        <a class="dropdown-item" href="#"
                                            ><i
                                                class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"
                                            ></i
                                            >&nbsp;Activity log</a
                                        >
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="/logout"
                                            ><i
                                                class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"
                                            ></i
                                            >&nbsp;Logout</a
                                        >
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>
                </nav>
                <!--  END HEADER   -->

                <router-view></router-view>

            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright">
                        <span>Copyright © 2021</span>
                    </div>
                </div>
            </footer>
        </div>

        <a class="border rounded d-inline scroll-to-top" href="#page-top"
            ><Icon type="ios-arrow-up" size="25" /></a>
    </div>
    <div id="wrapper" v-else>
        <router-view></router-view>
    </div>
</template>
<script>
export default {
    props: ['user'],
    data() {
        return {

        };
    },
    created() {
        this.$store.commit('updateUser', this.user)
    }
}
</script>
