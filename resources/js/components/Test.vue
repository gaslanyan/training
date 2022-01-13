<template>
    <div class="container-fluid">
        <section class="banner_area">
            <div class="banner_inner d-flex align-items-center">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="banner_content text-center">

                                <div class="page_link" v-for="b in $route.meta.breadCrumbs" :key="b.to">
                                    <router-link :to="{ name: 'home' }" class="nav-link">{{
                                            coursetexts.home
                                        }}
                                    </router-link>
                                    <router-link :to="{ name: 'coursedetails'}" class="nav-link">{{
                                            coursetexts.lessons
                                        }}
                                    </router-link>
                                    <router-link to="" class="nav-link">{{ b.text }}</router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================Blog Test Area =================-->
        <section class="blog_categorie_area">
            <div class="container">
                <div class="row align-items-center">

                    <div class="col-lg-12 m-0 pb-5">
                        <h2 class="text-center">
                            <router-link :to="{ name: 'coursedetails', params:{id:this.id}}" class="nav-link title">
                                {{ this.title }}
                            </router-link>
                        </h2>
                        <h4 v-if="this.msg" class="router-link-active text-uppercase">{{ this.msg }}</h4>
                        <h4 v-if="this.again" class="router-link-active ">{{ this.again }}</h4>
                        <form ref="form" @submit.prevent="getResult">
                            <div v-for="(info, index) in tests">
                                <h3 class="question">{{ index + 1 }}. {{ info.question }}</h3>
                                <ul class="test-actual">
                                    <li v-for="(answer, i) in JSON.parse(info.answers)" class="d-flex flex-row">
                                        <label class="test-answer">
                                            <input :type="info.type" :value="(i+1)" class=""
                                                   v-model="formTest[(index +1)+'_'+(i+1)]"
                                                   :name="'test_'+(index +1)" v-validate="'required|included:1,2,3,4'">
                                        </label>
                                        <span class="test" v-if="answer.answer"
                                              v-html="answer.answer">{{ answer.answer }}</span>
                                        <div v-if="answer.img" class="test">
                                            <img :src="answer.img" class="test_img">
                                        </div>
                                        <span v-show="errors.has('test_'+(index +1))"
                                              class="help is-danger">{{ errors.first('test_' + (index + 1)) }}</span>
                                    </li>
                                </ul>
                            </div>
                            <div>
                            <button type="submit" class="btn primary-btn mt-3 float-right">{{
                                    coursetexts.test
                                }}
                            </button>
                            </div>
                        </form>
                        <div class="col-lg-12 m-0 pb-5">
                            <p ref="msg"></p>
                        </div>
                        <div id="certificate" v-if="diploma">
                            <p>{{ coursetexts.cert }}</p>
                            <img v-if="diploma" id="finishimg" v-bind:src="'/uploads/diplomas/' + cert" alt="certificate">
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!--================Blog Categorie Area =================-->
    </div>
</template>

<script>
import coursetexts from './json/course.json';
import {getPromiseResult} from '../partials/help';

export default {
    data() {
        return {
            id: '',
            tests: [],
            coursetexts: coursetexts,
            title: "",
            formTest: {},
            msg: "",
            again: "",
            res: "",
            cert: "",
            // count: 0,
            // percent: 0

        }
    },
    name: 'app-header',
    props: ['count', 'percent'],
    methods: {
        logout() {
            this.$store.commit('logout');
            this.$router.push('/login');
        },
        certificate: function () {
            let credentials = {
                id: this.$route.params.id,
                token: this.currentUser.token,
                user_id: this.currentUser.id,
                auth: true,
                url: "certificate"
            };
            getPromiseResult(credentials)
                .then(res => {
                    this.cert = res.data;
                })
                .catch(error => {
                    console.log(error);
                    // this.$store.commit("registerFailed", {error});
                })
        },
        getTests(id) {
            let credentials = {
                id: id,
                token: this.currentUser.token,
                account_id: this.currentUser.id,
                url: 'gettests',
                auth: true
            };
            getPromiseResult(credentials)
                .then(res => {

                        for (let i of res.tests) {
                            let counter = 0;
                            for (let answer of JSON.parse(i.answers)) {
                                if (answer.check == 1)
                                    counter++;
                            }
                            i.type = (counter > 1) ? 'checkbox' : "radio";
                            this.tests = res.tests;
                        }
                    }
                )
                .catch(err => {
                    console.log(err)
                })
        },
        getResult() {
            this.$validator.validateAll().then((result) => {
                if (result) {
                    let credentials = {
                        id: this.id,
                        user_id: this.currentUser.id,
                        token: this.currentUser.token,
                        model: this.formTest,
                        url: "getresult",
                        auth: true
                    };
                    getPromiseResult(credentials)
                        .then(res => {
                            this.tests = res.percent;

                            // this.$refs.form.style.display = 'none';
                            // this.$refs.msg.innerText = 'none';
                            window.location.reload();

                        })
                        .catch(err => {
                            console.log(err)
                        });
                    console.log('Form Submitted!');
                    return;
                }
                console.log('Correct them errors!');
            });
        },
        getCourseTitle(id) {
            let credentials = {
                id: this.id,
                token: this.currentUser.token,
                url: "gettitle",
                auth: true
            };
            getPromiseResult(credentials)
                .then(res => {
                    this.title = res.title.name;
                })
                .catch(err => {
                    console.log(err)
                })
        },
        getPercentAndCount() {
            let credentials = {
                id: this.id,
                user_id: this.currentUser.id,
                token: this.currentUser.token,
                url: 'getcpcourse',
                auth: true
            };
            getPromiseResult(credentials)
                .then(res => {
                    let info = JSON.parse(res.info);
                    if (!!info) {
                        if (!info.percent)
                            info.percent = 0;
                        this.$props.percent = info.percent;
                        this.$props.count = info.count;
                        console.log('if', this.$props.count)
                        if (this.$props.percent < 50) {
                            if (this.$props.count < 3) {
                                this.msg = coursetexts.result + info.percent + coursetexts.point;
                                this.again = coursetexts.again + (3 - this.$props.count) + coursetexts.possibility;
                                // this.$refs.form.style.display = 'none';
                            } else {
                                this.msg = coursetexts.unsuccess;
                                setTimeout(() => {
                                    // this.logout();
                                }, 1000)
                            }
                        } else {
                            this.msg = coursetexts.result + this.$props.percent + coursetexts.point;
                            this.$refs.form.style.display = 'none';
                        }
                    }

                })
                .catch(err => {
                    console.log(err, err)
                })
        },
        finishedVideo() {
            let credentials = {
                id: this.$route.params.id,
                user_id: this.currentUser.id,
                token: this.currentUser.token,
                url: 'finishedvideo',
                auth: true
            };
            getPromiseResult(credentials)
                .then(res => {
                    if (res === 0)
                        this.$router.push('/coursedetails/' + this.$route.params.id);
                    else if (res === -1)
                        this.$router.push('/404');

                })
                .catch(error => {
                    console.log('error', error);
                    // this.$store.commit("registerFailed", {error});
                })
        },

    },
    computed: {
        currentUser: function () {
            if (!this.$store.getters.currentUser)
                return JSON.parse(localStorage.getItem('user'));
            return this.$store.getters.currentUser
        },
        diploma: function () {
            let isTestFinish = !1;
            if (this.$props.percent < 50) {
                if (this.$props.count < 3)
                    this.getTests(this.id);
            } else {
                this.certificate();
                isTestFinish = 1;
            }
            return isTestFinish;
        }
    },

    beforeMount() {
        this.$props.percent = 0;
        this.$props.count = 0;
        this.id = this.$route.params.id;
        this.getCourseTitle(this.id);
    },
    mounted() {
        this.getPercentAndCount();
        this.finishedVideo();
    },
}
</script>
<style>

.test_img {
    float: left;
    width: 120px;
}

.test {
    width: 100%;
    display: block;
    float: left;
}
</style>
