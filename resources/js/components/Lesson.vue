<template>
    <div class="container-fluid m-0 p-0 overflow-hidden">

        <div class="row">
            <div class="col-12 lesson_banner">
                <!--img :src="lesson_banner" alt="" style="width: 100%;"-->
                <h2>{{ texts.lessons }}</h2>
            </div>
        </div>

        <section class="banner_area">
            <div class="banner_inner d-flex align-items-center">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="banner_content">
                                <div :key="b.to" class="page_link" v-for="b in $route.meta.breadCrumbs">
                                    <router-link :to="{ name: 'home' }" class="nav-link">{{ text.main }}</router-link>
                                    <router-link class="nav-link" to="">{{ b.text }}</router-link>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================Blog Categorie Area =================-->
        <section class="blog_categorie_area">
            <div class="container">
                <div class="row">
                    <div class="col-12" v-if="!currentUser">
                        <ul v-if="professions" class="lesson_filter col-12">
                            <li ref="course_0" @click="allcourses()">{{ text.all }}</li>
                            <li ref="course_" @click="getCoursesByProf(prof.id)" v-for="(prof) in professions">
                                {{ prof.name }}
                            </li>
                        </ul>
                    </div>
                    <div :key="course.id" class="col-lg-4" v-for="course in courses">

                        <router-link :to="'/coursedetails/'+course.id" class="nav-link">
                            <div class="categories_post">
                                <div class="categories_details">
                                    <img :src="lessonimg"/>
                                    <div class="categories_text">
                                        <div>
                                            <p>
                                                {{ course.name }}</p>
                                        </div>
                                        <!--                                    <div v-if="!currentUser">-->
                                        <!--                                        <div class="border_line yellow"></div>-->
                                        <!--                                        <span class="fa fa-lock yellow"></span>-->
                                        <!--                                        <div class='d-flex justify-content-center'>-->
                                        <!--                                            <router-link class="nav-link" to="/login">{{ texts.login }}</router-link>-->
                                        <!--                                            <p class="nav-link">կամ</p>-->

                                        <!--                                            <router-link class="nav-link" to="/register"> {{ text.register }}-->
                                        <!--                                            </router-link>-->

                                        <!--                                        </div>-->
                                        <!--                                    </div>-->
                                        <!--                                    <div v-else>-->
                                        <!--                                        <div v-if="!isOpened && course.account_course === null">-->
                                        <!--                                            <div class="border_line yellow"></div>-->
                                        <!--                                            <span class="fa fa-lock yellow"></span>-->
                                        <!--                                            <div class='d-flex justify-content-center'>-->
                                        <!--                                                <div>-->
                                        <!--                                                    <button id="show-modal" class="text-uppercase enroll nav-link btn"-->
                                        <!--                                                            @click="payment(course.id)">{{ texts.pay }}-->
                                        <!--                                                    </button>-->
                                        <!--                                                </div>-->
                                        <!--                                            </div>-->
                                        <!--                                        </div>-->
                                        <!--                                    </div>-->
                                    </div>
                                </div>
                            </div>
                        </router-link>
                        <!-- single course -->
                        <div class="row" v-if="currentUser">
                            <div class="col-lg-12 col-md-12">
                                <div class="single_course">
                                    <div class="course_content">
                                        <div class="course_meta d-flex justify-content-between">
                                            <div>
                                                <span ref="price" class="price">{{ course.cost }} AMD</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--        <pagination align="center" :data="courses" @pagination-change-page="list"></pagination>-->
    </div>
</template>

<script>
import {getPromiseResult} from '../partials/help';
import pagetexts from './json/pages.json'
import text from './json/registertexts.json';
import Swal from 'sweetalert2';
// import pagination from 'laravel-vue-pagination'

export default {
    data() {
        return {
            courses: [],
            image_src: '/css/frontend/img/background.png',
            lesson_banner: '/css/frontend/img/lessonbanner.png',
            lessonimg: '/css/frontend/img/lessonimg.png',
            texts: pagetexts,

            text: text,
            cost: "",
            course_id: "",
            professions: ""
        }
    },
    methods: {
        beforeunloadFn(e) {
            console.log('refresh or close')
            // ...
        },
        created() {
            window.addEventListener('beforeunload', e => this.beforeunloadFn(e))
        },
        destroyed() {
            window.removeEventListener('beforeunload', e => this.beforeunloadFn(e))
        },
        logout() {
            this.$store.commit('logout');
            this.$router.push('/login');
        },
        allcourses() {
            let credentials = {
                url: 'allcourses',
                auth: false
            };
            getPromiseResult(credentials)
                .then(res => {
                    this.courses = res.data;
                    this.toggleActiveClass(0);
                })
                .catch(error => {
                    console.log('errorsss');
                    // this.$store.commit("registerFailed", {error});
                })
        },
        getProfessions() {
            let credentials = {
                auth: false,
                url: 'prof'
            };
            getPromiseResult(credentials)
                .then(res => {
                    this.professions = res.prof;
                })
                .catch(error => {
                    this.$store.commit("getContentFailed", {error});
                });

        },
        toggleActiveClass(id) {
            Object.keys(this.$refs).forEach((el) => {
                const e = this.$refs[el];
                this.$refs.course_0.classList.remove('active')
                for (const eKey in e) {
                    if (e.hasOwnProperty(eKey))
                        e[eKey].classList.remove('active')
                }
            })
            let r = (id === 0) ?
                this.$refs.course_0 :
                this.$refs.course_[id - 1];
            r.classList.add('active')
        },
        getCoursesByProf(id) {

            let credentials = {
                id: id,
                url: 'getcoursebyprof',
                auth: false
            };
            getPromiseResult(credentials)
                .then(res => {
                    this.courses = res.courses;
                    this.toggleActiveClass(id)
                })
                .catch(err => {
                })
        },
        getCourses(id) {
            console.log(id)
            let credentials = {
                id: id,
                token: this.currentUser.token,
                url: 'getcoursebyspec',
                auth: true
            };
            getPromiseResult(credentials)
                .then(res => {
                    this.courses = res.courses;
                })
                .catch(err => {
                })
        },

    },
    computed: {
        currentUser: function () {
            if (!this.$store.getters.currentUser)
                return JSON.parse(localStorage.getItem('user'));
            return this.$store.getters.currentUser
        },
    },
    components: {
        'Swal': Swal,
        // pagination
    },
    beforeMount() {
        if (!this.$store.getters.currentUser) {
            this.allcourses();
        } else {
            this.getCourses(this.$store.getters.currentUser.id);
            if (this.$store.getters.currentUser.prof.member_of_palace === 1)
                this.isOpened = true;
        }
        this.getProfessions();
    },
    mounted() {

        if (!this.currentUser)
            this.allcourses();
    }
}
</script>

<style>
.active {
    background-color: rgb(159, 18, 173) !important;
    color: rgb(255, 255, 255)
}
</style>
