<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 lesson_banner">
                <!--img :src="lesson_banner" alt="" style="width: 100%;"-->
                <h2 class="home_title">{{ text.payment_terms }}</h2>
            </div>
        </div>
        <section class="banner_area">
            <div class="banner_inner d-flex align-items-center">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="banner_content">
                                <div v-for="b in $route.meta.breadCrumbs" :key="b.to" class="page_link">
                                    <router-link :to="{ name: 'home' }" class="nav-link">{{ text.main }}</router-link>
                                    <router-link class="nav-link" to="">{{ b.text }}</router-link>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================ Start About Area =================-->
        <div class="department_area section_gap">
            <div class="container">
                <div class="row ">
                    <div class="col-12 text-left">
                        <h2 class="home_title">{{ text.payment_methods }}</h2>
                    </div>

                    <div class="col-12">
                        <p> {{ text.payment_methods_desc }}</p>
                        <div class="line"></div>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-12 text-left">
                        <h2 class="home_title">{{ text.return_policy }}</h2>
                    </div>

                    <div class="col-12">
                        <p> {{ text.return_policy_desc }}</p>
                        <div class="line"></div>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-12 text-left">
                        <h2 class="home_title">{{ text.shipping_methods }}</h2>
                    </div>

                    <div class="col-12">
                        <p> {{ text.shipping_methods_desc }}</p>
                        <div class="line"></div>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-12 text-left">
                        <h2 class="home_title">{{ text.terms_conditions }}</h2>
                    </div>

                    <div class="col-12">
                        <p> {{ text.terms_conditions_desc }}</p>
                        <div class="line"></div>
                    </div>
                </div>
            </div>
        </div>

        <!--================ End About Area =================-->

    </div>
</template>

<script>

import pagestext from './json/payment.json';

export default {
    data() {
        return {
            datas: [],
            aboutimg: '/css/frontend/img/about_us.jpg',
            lesson_banner: '/css/frontend/img/lessonbanner.png',
            docs: [],
            text: pagestext,
        };
    },

}
</script>
<style>
.home_banner_area {
    min-height: 234px;
}
</style>

