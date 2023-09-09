<template>
    <div>
        <div class="photo">
            <vue-image-zoomer
                v-if="img"
                :regular="patch + img"
                :click-zoom="true"
                :zoom-amount="2"
                img-class="img-fluid"
                @on-zoom="zoom = true"
                @off-zoom="zoom = false"
            />
            <img v-else :src="patch + no_photo" title="No image">
        </div>
        <div class="thumbnails" v-if="photos && photos.length > 1">
            <img v-for="photo in photos" :src="patch + photo.src" @click="changeImage(photo)">
        </div>
    </div>
</template>

<script>

import { VueImageZoomer } from 'vue-image-zoomer'
import 'vue-image-zoomer/dist/style.css';
export default {
    name: "PhotosGood",
    components: {
        VueImageZoomer
    },
    props:{
        'patch':{
            type: String,
            default: ''
        },
        'photos':{
            type: Array,
            default: []
        },
        'no_photo':{
            type: String,
            default: ''
        }
    },
    mounted() {
        if(this.photos && this.photos.length > 0){
            this.img = this.photos[0].src
        }
    },
    data(){
        return{
            img: null,
        }
    },
    methods:{
        changeImage(img){
            this.img = img.src
        }

    }
}
</script>

<style>
.thumbnails img{
    width: 70px;
    border: 1px solid #CCCCCC;
    margin: 3px;
}

</style>
