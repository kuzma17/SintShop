<template>
    <div>
        <input class="file" type="file" name="file" ref="file" @change="uploadFile()" />
        <div @mouseover="edit = true" @mouseleave="edit=false" class="image_container">
            <img v-if="image" :src="image" style="width: 290px; height: 290px">
            <div v-if="edit" @click="addFiles()" class="edit-bg">
                редактировать
            </div>
        </div>

    </div>
</template>

<script>
export default {
    name: "inputImage",
    props: [
        'path',
        'modelValue',
    ],
    mounted() {
        if (this.modelValue){
            this.image = this.path+'/'+this.modelValue
        }

    },

    data() {
        return {
            //token: document.head.querySelector('meta[name="csrf-token"]') ? document.head.querySelector('meta[name="csrf-token"]').content : '',
            image: '',
            edit: false
        }
    },
    methods: {
        uploadFile(){
            this.file = this.$refs.file.files[0];
            let reader = new FileReader();
            reader.addEventListener("load", function () {
                this.image = reader.result;
            }.bind(this), false);
            if (this.file) {
                if (/\.(jpe?g|png|gif|webp)$/i.test(this.file.name)) {
                    reader.readAsDataURL(this.file);
                }
            }
        },
        addFiles(){
            this.$refs.file.click();
        },

    }
}
</script>

<style>
.file{
    visibility: hidden;
}
.image_container{
    position: relative;
    width: 290px; height:
    290px;
    background-color: #CCCCCC;
}
.edit-bg{
    position: absolute;
    top:0;
    width: 100%;
    height:100%;
    background: rgba(0, 0, 0, 0.5);
    color: #ffffff;
    opacity: 0.7;
    text-align: center;
    font-size: 24px;
    padding-top: 120px;
    cursor: pointer;
}
</style>
