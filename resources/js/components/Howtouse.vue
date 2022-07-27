<template>
    <div class="helptouse  justify-content-center container">
        <div class="row">
            <input autocomplete="off" type="radio" id="lesson" value="1" name="tractor" checked='checked'>
            <input autocomplete="off" type="radio" id="register" value="2" name="tractor">
            <input autocomplete="off" type="radio" id="pay" value="3" name="tractor">

            <nav class="help_nav">
                <label for="lesson" class='fa fa-book nav_label col-lg-4 col-4'></label>
                <label for="register" class='fa fa-lock nav_label col-lg-4 col-4'></label>
                <label for="pay" class='fa fa-credit-card nav_label col-lg-4 col-4'></label>
            </nav>
            <article class='bio container'>
                <div class="help_info row">
                    <h3>{{ text.lesson }}</h3>
                    <p>{{text.lessoncontent}}</p>
                    <footer class="form-group col-lg-12">
                        <label for="register" class='fa fa-arrow-right nav_label col-lg-4 float-right'></label>
                    </footer>
                </div>
            </article>
            <article class='reg container'>
                <div class="help_info row">
                    <h3>{{ text.register }}</h3>
                    <video ref="video" class="view-video col-lg-12" controls >
                        <source :src="path">
                    </video>
                    <footer class="form-group col-lg-12">
                        <label for="pay" class='fa fa-arrow-right nav_label col-lg-4 float-right'></label>
                        <label for="lesson" class='fa fa-arrow-left nav_label col-lg-4 float-left'></label>
                    </footer>
                </div>
            </article>
            <article class='pay container'>
                <div class="help_info row">
                    <h3>{{ text.pay }}</h3>
                    <p>{{text.paycontent}}}</p>
                    <footer class="form-group col-lg-12 reg_thd">
                        <label for="register" class='fa fa-arrow-left nav_label col-lg-4 float-left'></label>
                    </footer>
                </div>
            </article>
        </div>
    </div>
    <!--        </div>-->

</template>

<script>
import howtousetext from './json/howtouse.json';

export default {
    data() {
        return {
            text: howtousetext,
            path:"/videos/user_register_help.mp4"
        };
    },
    name: "Howtouse"
}

</script>

<style scoped>

</style>
