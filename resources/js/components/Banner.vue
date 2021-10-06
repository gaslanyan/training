<template>
    <div class="container-fluid m-0 p-0">
        <!--================ Start Home Banner Area =================-->
        <section class="home_banner_area">
            <div class="banner_inner">
                <div class="container-fluid">
                    <div class="row">
<!--                        <video ref="video" class="view-video col-lg-12 p-0" controls>-->
<!--                            <source :src="path">-->
<!--                        </video>-->

                        <hooper :itemsToShow="1">
                            <slide style="withd:100%;">
                                <img :src="banner_src_one" alt="ԲՈՒԺԱՇԽԱՏՈՂՆԵՐԻ ՇԱՐՈՒՆԱԿԱԿԱՆ ՄԱՍՆԱԳԻՏԱԿԱՆ ԶԱՐԳԱՑՄԱՆ ԿԵՆՏՐՈՆ" title="ԲՈՒԺԱՇԽԱՏՈՂՆԵՐԻ ՇԱՐՈՒՆԱԿԱԿԱՆ ՄԱՍՆԱԳԻՏԱԿԱՆ ԶԱՐԳԱՑՄԱՆ ԿԵՆՏՐՈՆ">
                                <!--video ref="video" class="view-video col-lg-12" controls
                                       v-on:loadeddata="manageEvents(info.id)">
                                    <source :src="info.path">
                                </video-->
                                <!--div class="col-lg-12">
                                    <h5 class="title">test1</h5>

                                </div-->
                            </slide>
<!--                            <slide>-->
<!--&lt;!&ndash;                            <iframe width="100%" height="576px" :src="path"  style="border:none;overflow:hidden" scrolling="no" frameborder="0" allow="autoplay"></iframe>&ndash;&gt;-->

<!--                            &lt;!&ndash;video ref="video" class="view-video col-lg-12" controls-->
<!--                                   v-on:loadeddata="manageEvents(info.id)">-->
<!--                                <source :src="info.path">-->
<!--                            </video&ndash;&gt;-->
<!--                            <div class="col-lg-12">-->
<!--                                &lt;!&ndash;h5 class="title">test</h5&ndash;&gt;-->

<!--                            </div>-->
<!--                        </slide>-->
                            <!--   <slide>
                                 <img :src="banner_src" alt="ԲՈՒԺԱՇԽԱՏՈՂՆԵՐԻ ՇԱՐՈՒՆԱԿԱԿԱՆ ՄԱՍՆԱԳԻՏԱԿԱՆ ԶԱՐԳԱՑՄԱՆ ԿԵՆՏՐՈՆ" title="ԲՈՒԺԱՇԽԱՏՈՂՆԵՐԻ ՇԱՐՈՒՆԱԿԱԿԱՆ ՄԱՍՆԱԳԻՏԱԿԱՆ ԶԱՐԳԱՑՄԱՆ ԿԵՆՏՐՈՆ">
                                   <!--video ref="video" class="view-video col-lg-12" controls
                                          v-on:loadeddata="manageEvents(info.id)">
                                       <source :src="info.path">
                                   </video-->
                            <!--    <div class="col-lg-12">
                                 <!--h5 class="title">test1</h5-->

                                    <!--        </div>
                                     <!--     </slide>-->

                            <hooper-pagination slot="hooper-addons"></hooper-pagination>
                        </hooper>

                    </div>
                </div>

            </div>
        </section>
        <!--================ End Home Banner Area =================-->


    </div>
</template>

<script>
    import {Hooper, Pagination as HooperPagination, Slide} from 'hooper';
    import 'hooper/dist/hooper.css';
    export default {
        data() {
            return {
                path:"https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2Fnational.medical.palace.armenia%2Fvideos%2F1156056018093516%2F&show_text=0",
                image_src: '/css/frontend/img/logo.png',
                banner_src: '/css/frontend/img/banner/banner.jpeg',
                banner_src_one: '/css/frontend/img/banner/slide3.png',
                isActive: false,
                objects: [
                    {id: 1},
                    {id: 2},
                    {id: 3},
                    {id: 4},
                    {id: 5},
                    {id: 6}


                ],
            };
        },
        components: {
            Hooper,
            Slide, HooperPagination
        },
    }
</script>
