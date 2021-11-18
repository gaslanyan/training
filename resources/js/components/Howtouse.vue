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
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua.</p>
                    <footer class="form-group col-lg-12">
                        <label for="register" class='fa fa-arrow-right nav_label col-lg-4 float-right'></label>
                    </footer>
                </div>
            </article>
            <article class='reg container'>
                <div class="help_info row">
                    <h3>{{ text.register }}</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua.</p>
                    <footer class="form-group col-lg-12">
                        <label for="pay" class='fa fa-arrow-right nav_label col-lg-4 float-right'></label>
                        <label for="lesson" class='fa fa-arrow-left nav_label col-lg-4 float-left'></label>
                    </footer>
                </div>
            </article>
            <article class='pay container'>
                <div class="help_info row">
                    <h3>{{ text.pay }}</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua.</p>
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
        };
    },
    name: "Howtouse"
}

</script>

<style scoped>

</style>
