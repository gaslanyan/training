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
                            <li class="mb-4">
                                <span ref="course_0" @click="allcourses()">{{ text.all }} </span>
                            </li>
                            <li class="mb-4" v-for="(prof) in professions">
                                <span ref="course_" @click="getCoursesByProf(prof.id)">
                                    {{ prof.name }}</span>
                            </li>
                        </ul>
                    </div>
                    <div :key="course.id" class="col-lg-4" v-for="course in courses">
                        <router-link :to="'/coursedetails/'+course.id" class="nav-link">
                            <div class="categories_post">
                                <div class="categories_details">
                                    <img :src="lessonimg"/>
                                    <div class="categories_text">
                                                                                   <p>
                                                {{ course.name }}</p>

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
                    console.log(error);
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
                auth: true,
                mobile: false
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
    /*background-color: rgb(159, 18, 173) ;*/
    background: -webkit-linear-gradient(
        45deg, #5f1b80, #b233c5)!important;
    color: rgb(255, 255, 255);
    display: flex;
    width: 100%;
    height: 100%;
    padding: 10px;
}
</style>
