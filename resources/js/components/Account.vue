<template>
    <div class="container">
        <section class="banner_area">
            <div class="banner_inner d-flex align-items-center">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="banner_content text-center">
                                <div class="page_link" v-for="b in $route.meta.breadCrumbs" :key="b.to">
                                    <router-link :to="{ name: 'home' }" class="nav-link">{{texts.main}}</router-link>
                                    <router-link to="" class="nav-link">{{b.text}}</router-link>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================ Start Course Details Area =================-->
        <section class="course_details_area section_gap">

            <div class="container">
                <div class="row">
                    <div class="col-lg-6 course_details_left">
                        <div class="main_image">
                            <p class="pb-4"> {{texts.hint}}</p>
                            <div id="preview">
                                <img v-bind:src="imgName" class="avatar">
                                <i class="fa fa-camera-retro fa-2x icon"></i>
                                <input type="file" @change="onFileChange"/>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 right-contents">
                        <ul>
                            <li>
                                <div class="justify-content-between d-flex">
                                    <p>{{texts.profilename}}</p>
                                    <span class="or text-capitalize text-right">{{account.name}} {{account.surname}} {{account.father_name}}</span>
                                </div>
                            </li>
                            <li>
                                <div class="justify-content-between d-flex">
                                    <p>{{texts.profession}} </p>
                                    <span class="or text-capitalize text-right">{{account.profession}}</span>
                                </div>
                            </li>
                            <li>
                                <div class="justify-content-between d-flex text-right">
                                    <p>{{texts.email}}</p>
                                    <span>{{account.email}}</span>
                                </div>
                            </li>
                        </ul>
                        <router-link :to="'/edit/'+account.id" class="primary-btn text-uppercase enroll">
                            {{texts.edit}}
                        </router-link>
                    </div>
                </div>
            </div>
        </section>
        <section class="course_details_area section_gap d-flex flex-column" v-if="tests">

            <h2 class="col-12 or">{{texts.testsresult}}</h2>

            <ul>
                <li v-for="(info, i) in this.tests" class="d-flex flex-column test-actual">
                    <div class="row media post_item">
                        <img class="col-2" v-bind:src="certificateName">
                        <div class="col-10 media-body">
                            <p class="router-link-active">{{info.course.name}}</p>
                            <div class="row">
                                <div class="col-6">
                        <span v-for="c in JSON.parse(info.course.credit)">
                            <i>{{c.name}} - </i>
                            <span>{{c.credit}}</span>
                            <br>
                        </span>
                                </div>
                                <ul class="col-6">
                                    <li><i>{{texts.result}} - {{info.percent}}%</i></li>
                                    <li><span>{{info.updated_at.substr(0, 10)}}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>

            </ul>
        </section>
    </div>
</template>

<script>
    import {uploadAvatar} from '../partials/auth';
    import registertexts from './json/registertexts.json';
    import {getPromiseResult} from '../partials/help';

    export default {
        data() {
            return {
                avatar: [],
                url: null,
                texts: registertexts,
                account: '',
                tests: []
            }
        },

        computed: {
            currentUser: function () {
                if (!this.$store.getters.currentUser)
                    return JSON.parse(localStorage.getItem('user'));
                return this.$store.getters.currentUser
            },

            imgName: function () {
                let src = "";
                let img_name = this.account.image_name;
                let pattern = /\d+/ig;
                if (pattern.exec(img_name))
                    src = "/uploads/images/avatars/" + img_name;
                else
                    src = "/images/avatars/" + img_name;
                console.log(this.account);
                return src;
            },
            certificateName: function () {
                return "/images/logos/logo_new_sm.jpg";
            }
        },
        beforeMount() {
            this.getTestsResultById(this.currentUser.id);
            this.getAccountById();
        },
        methods: {
            getAccountById: function () {
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
            },
            getSpecialties(id) {
                let credential = {
                    id: id,
                    url: 'spec',
                    auth: false
                };
                getPromiseResult(credential)
                    .then(res => {
                        this.account.profession = res.spec[0].name;
                    })
                    .catch(error => {
                        this.$store.commit("getContentFailed", {error});
                    });
            },
            upload(file) {
                // let file = this.$refs.avatar.files[0];
                uploadAvatar(file, this.currentUser.id, this.currentUser.token)
                    .then(res => {
                        this.$store.commit("uploadSuccess", res);
                        this.$nextTick(() => {
                            let ls = JSON.parse(localStorage.getItem('user'));
                            ls.image_name = res.user.image_name;
                            localStorage.setItem('user', JSON.stringify(ls))
                        })
                        // this.$router.push({path: '/dashboard'});
                    })
                    .catch(error => {
                        this.$store.commit("uploadFailed", {error});
                    });
            },
            onFileChange(e) {
                const file = e.target.files[0];
                // this.url = URL.createObjectURL(file);

                this.upload(file);
            },
            getTestsResultById(id) {
                let credentials = {
                    id: id,
                    token: this.currentUser.token,
                    url: 'gettestsbyaid',
                    auth: true
                };
                getPromiseResult(credentials)
                    .then(res => {
                        this.tests = res.tests;
                    })
                    .catch(error => {
                        this.$store.commit("getContentFailed", {error});
                    });
            }
        }
    }
</script>


