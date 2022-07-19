<template>
    <!--================ Start Registration Area =================-->
    <div class="section_gap registration_area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="row clock_sec clockdiv" id="clockdiv">
                        <div class="col-lg-12">
                            <h1>{{text.registernow}}</h1>
                            <p>{{text.content}} </p>
                        </div>
                        <div class="col clockinner1 clockinner">
                            <h1>{{count}}</h1>
                            <span class="smalltext">{{text.participants}}</span>
                        </div>
                        <div class="col clockinner clockinner1">
                            <h1>{{coursecount}}</h1>
                            <span class="smalltext">{{text.lessons}}</span>
                        </div>


                    </div>
                </div>
                <div class="col-lg-4 offset-lg-1">
                    <div class="register_form">
                        <h4>{{text.title}}</h4>
                        <p>{{text.time}}</p>
                        <video ref="video" class="view-video col-lg-12" controls >
                            <source :src="path">
                        </video>
                            <div class="col-lg-12 text-center">
                                <router-link to="/login" class="primary-btn">{{text.login}}</router-link>
                                <router-link to="/register" class="primary-btn">{{text.register}}</router-link>

                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--================ End Registration Area =================-->
</template>

<script>
    import {getPromiseResult} from '../partials/help';
    import pagestext from './json/pages.json';

    export default {
        data() {
            return {
                nurse: '/css/template/img/nurse.svg',
                doctor: '/css/template/img/doctor.png',
                pharmacy: '/css/template/img/pharmacy-symbol.svg',
                phar: '/css/template/img/pharmacy.png',
                count: "",
                coursecount: "",
                text: pagestext,
                path:"https://natmedpalace.s3.us-west-2.amazonaws.com/videos/user_register_help.mp4"
            };
        },
        methods: {
            appcount: function () {
                let credentials = {
                    auth: false,
                    url: 'applicantcount'
                };
                getPromiseResult(credentials)
                    .then(res => {
                        this.count = res.data;
                    })
                    .catch(error => {
                        console.log('errorsss');
                        // this.$store.commit("registerFailed", {error});
                    })
            },
            ccount: function () {

                let credentials = {
                    auth: false,
                    url: 'coursescount'
                };
                getPromiseResult(credentials)
                    .then(res => {
                        this.coursecount = res.data;
                    })
                    .catch(error => {
                        console.log('errorsss');
                        // this.$store.commit("registerFailed", {error});
                    })
            }

        },
        beforeMount() {
            this.appcount(),
                this.ccount()
        },

    }
</script>
