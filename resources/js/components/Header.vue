<template>
    <div class="container-fluid m-0 p-0">

        <!--================ Start Header Menu Area =================-->

        <header ref="navbar" class="header_area" :class="{'navbar_fixed': scrolled}" v-on:scroll="handleScroll">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <router-link :to="{ name: 'home' }" class="navbar-brand logo_h col-lg-2 col-4">
                        <img :src="image_src" alt="" style="width:100%;">
                        <!--span class="shmz">ՇՄԶ</span-->

                    </router-link>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent" aria-expanded="false"
                            aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset col-lg-10 col-12" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto col-9">
                            <li class="nav-item" v-for="menu in menuitems">
                                <router-link :ref="menu" :to="{ name: menu }" class="nav-link"
                                             v-on:click.native="setActive(menu)" :class="{ active: isActive(menu) }">
                                    {{ text[menu] }}
                                </router-link>
                            </li>
                        </ul>
                        <div class="navbar-collapse" id="navbarContent">
                            <div class="navbar-nav ml-auto m_navbar">
                                <template v-if="!currentUser">
                                    <li class="nav-item">
                                        <router-link to="/login" class="nav-link">
                                            <img :src="stethoscope" style="height: 30px;"/>{{ text.login }}
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link to="/register" class="nav-link"><img
                                            :src="ekg"/>{{ text.register }}
                                        </router-link>
                                    </li>
                                </template>
                                <template v-else>
                                    <li class="nav-item dropdown">
                                        <router-link to="/account" id="navbarDropdown" class="nav-link dropdown-toggle"
                                                     data-toggle="dropdown"
                                                     aria-haspopup="true" aria-expanded="false">
                                            {{ account.name }} {{ account.father_name }} {{ account.surname }}<span
                                            class="caret"></span>
                                        </router-link>

                                        <div class="dropdown-menu dropdown-menu-right"
                                             aria-labelledby="navbarDropdown">
                                            <a href="#!" @click.prevent="logout"
                                               class="dropdown-item">{{ text.logout }}</a>
                                        </div>
                                    </li>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
    </div>
    <!--================ End Header Menu Area =================-->
</template>

<script>
import pagestext from './json/pages.json';
import {getPromiseResult} from "../partials/help";

export default {
    name: 'app-header',
    props: [],
    methods: {
        isActive: function (menuItem) {
            return this.activeItem === menuItem
        },
        setActive: function (menuItem) {
            if (this.$route.path !== "/")
                this.$refs.home[0].$el.classList.remove('router-link-active')
            this.activeItem = menuItem // no need for Vue.set()
        },
        handleScroll() {
            if (this.$refs.navbar.clientHeight < window.scrollY) {
                this.scrolled = true;
                this.$refs.navbar.style.position = "fixed";
                this.$refs.navbar.style.top = 0;
                this.$refs.navbar.style.background = '#fff';
            } else {
                this.scrolled = false;
                this.$refs.navbar.style.position = "relative";

            }

            this.lastPosition = window.scrollY;
            // this.scrolled = window.scrollY > 50;
        },
        logout() {
            this.$store.commit('logout');
            this.$router.push('/login');
            location.reload();
        },
        getAccountById: function () {
            if (this.currentUser) {
                let credentials = {
                    id: this.currentUser.id,
                    token: this.currentUser.token
                };
                axios.post('/api/auth/getaccountbyid',
                    credentials)
                    .then(response => {
                        this.account = response.data.account;
                        this.getSpecialties(this.account.profession);
                    })
                    .catch(err => {
                        console.log(err)
                    })
            }
        },
        getSpecialties(id) {
            let credentials = {
                id: id,
                auth: false,
                url: 'spec'
            };
            getPromiseResult(credentials)
                .then(res => {
                    this.specialties = res.spec;
                })
                .catch(error => {
                    this.$store.commit("getContentFailed", {error});
                });
        },
    },
    beforeMount() {
        this.getAccountById();
    },
    created() {
        window.addEventListener("scroll", this.handleScroll);
    },
    destroyed() {
        window.removeEventListener("scroll", this.handleScroll);
    },
    computed: {
        currentUser() {
            return this.$store.getters.currentUser
        },
    },
    data() {
        return {
            image_src: '/css/frontend/img/logo.jpg',
            ekg: '/css/frontend/img/ekg_new.png',
            stethoscope: '/css/frontend/img/stethoscope_new.png',
            limitPosition: 2000,
            scrolled: false,
            lastPosition: 0,
            text: pagestext,
            account: "",
            activeItem: '',
            menuitems: ['home', 'about', 'lessons', 'contact', 'howtouse']
        };
    },
}
</script>
