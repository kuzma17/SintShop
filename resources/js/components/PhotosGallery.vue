<template>
    <div>
        <div class="gallery-photos">
            <div :id="key" v-for="(image, key) in images" class="layer-image" :class="{ active: image.active === 1 }"
                 @click="showModal(key)">
                <img :src="patch + image.src">
            </div>
        </div>
        <div class="thumbnails" v-if="images && images.length > 1">
            <img v-for="(image, key) in images" :src="patch + 'small_'+image.src" @click="changeImage(key)"
                 :class="{ active_thumbnails: image.active ===1 }">
        </div>

        <transition name="modal-fade">
            <div v-if="show" class="modal-image" @click.self="closeModal">
                <div class="body">
                    <div class="modal-close" @click="closeModal">&#10006;</div>
                    <div class="box-image" @click.self="closeModal">
                        <div :key="image.id" v-for="(image, key) in images" class="layer-image"
                             :class="{ active: image.active === 1}">
                            <img :src="patch + 'big_'+image.src" class="img-modal">
                            <div class="nav-modal">
                                <div v-if="key > 0" class="prev" @click="prev(key)">&#8249;</div>
                                <div v-if="key < images.length-1" class="next" @click="next(key)">&#8250;</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
export default {
    name: "PhotosGallery",
    props:{
        'patch':{
            type: String,
            default: ''
        },
        'photos':{
            type: Array,
            default: []
        }
    },
    mounted() {
        if (this.photos && this.photos.length > 0){
            this.cleanActive()
            this.images[0]['active'] = 1
        }

    },
    data(){
        return{
            images: [],
            show: false,
        }
    },
    methods:{
        cleanActive(){
            this.images = this.photos.map(function(item) {
                return {
                    'id': item.id,
                    'src': item.src,
                    'active': 0
                };
            });
        },

        changeImage(key){
            this.cleanActive()
            this.images[key]['active'] = 1
        },

        showModal() {
            this.show = true
        },
        closeModal(){
            this.show = false
        },

        prev(key){
            key--
            this.cleanActive()
            this.images[key]['active'] = 1
        },
        next(key){
            key++
            this.cleanActive()
            this.images[key]['active'] = 1
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
.layer-image{
    display: none;
}
.active{
    display: block!important;
}

.modal-image{
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background: rgba(0, 0, 0, 0.8);
    padding: 10px;
    z-index: 100;
}

.modal-image .modal-close {
    /*border-radius: 50%;*/
    color: #818181;
    /*background: #2a4cc7;*/
    display: flex;
    align-items: center;
    justify-content: center;
    position: absolute;
    font-size: 24px;
    top: 0;
    right: 0;
    width: 50px;
    height: 50px;
    cursor: pointer;
}
.modal-image .body{
    /*min-width: 360px;*/
    position: relative;
    height: 100%;
    background-color: #000000;
}
.modal-image .box-image{
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    width: 100%;
    height: 100%;
    margin: auto;
    text-align: center;
    display: flex;
    justify-content: center;
}
.modal-image .img-modal{
    position: absolute;
    top: 50%;
    transform: translate(-50%,-50%);
    max-width:100%;
    height:auto;
    max-height: 100%;

}
.modal-image .nav-modal{
    position: absolute;
    width: 100%;
    color: #818181;
    font-size: 64px;
    top: 50%;
    transform: translate(-50%,-50%);
    max-width:100%;
    height:auto;
}

.modal-image .prev{
    position: absolute;
    top: -75px;
    left: 0;
    cursor: pointer;
    width: 150px;
    height: 150px;
    text-align: center;
    padding: 20px;
}
.modal-image .next{
    position: absolute;
    top: -75px;
    right: 0;
    cursor: pointer;
    width: 150px;
    height: 150px;
    text-align: center;
    padding: 20px;
}
.active_thumbnails{
    border: 2px #000000 solid!important;
}
@media (min-width: 992px) {
    .modal-image{
        padding: 40px!important;
    }
    .modal-image .box-image{
        width: 90%!important;
        height: 90%!important;
    }

}
.modal-fade-enter-from,
.modal-fade-leave-to {
    opacity: 0;
}
.modal-fade-enter-active,
.modal-fade-leave-active {
    transition: 0.5s ease all;
}

</style>
