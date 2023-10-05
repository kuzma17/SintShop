<template>
    <div class="form-group-addon upload_images row" style="position: relative">
        <label style="width: 150px">
            <span class="btn btn-secondary" @click="addFiles()">Add Files</span>
        </label>
        <div class="col">
            <input type="file" id="files" ref="files" @change="uploadFile()" maxlength="5" multiple/>
            <div class="list_images">
                <div class="info">{{ countImages() }}</div>
                <div class="row item_image" v-for="(file, key) in fileList">
                    <div class="col-3 img">
                        <img :src="path + '/' + file.src" >
                    </div>
                    <div class="col-8">
                        <input type="hidden" :name="'images[' + key + '][src]'" v-model="file.src"/>
                        <input type="text" class="form-control" :name="'images[' + key + '][title_ru]'"
                               v-model="file.title_ru" placeholder="title_ru"/>
                        <input type="text" class="form-control" :name="'images[' + key + '][title_ua]'" v-model="file.title_ua"
                               placeholder="title_ua"/>
                    </div>
                    <div class="col-1 delete_item">
                        <i class="fa fa-times" title="удалить" @click="removeFile(key, file.src)"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "InputPhotos",
    props: [
        'max_count_file',
        'path',
        'modelValue',
    ],
    mounted() {
        if (this.modelValue){
            this.fileList = this.modelValue
        }

        if (this.max_count_file) {
            this.maxCountFile = this.max_count_file;
        }

    },

    data() {
        return {
            //token: document.head.querySelector('meta[name="csrf-token"]') ? document.head.querySelector('meta[name="csrf-token"]').content : '',
            fileList: [],
            maxCountFile: 5,
        }
    },
    methods: {

        uploadFile() {
            let files = this.$refs.files.files;
            let formData = new FormData();
            let max = ((this.fileList.length + files.length) < this.maxCountFile)? files.length: this.maxCountFile - this.fileList.length
            for (var i = 0; i < max; i++) {
                let file = files[i];
                formData.append('images[' + i + ']', file);
            }

            axios.post('/photo/upload', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(response => {
               // console.log(response.data);
                this.fileList = this.fileList.concat(response.data);
                this.$emit('update:modelValue', this.fileList)
                this.$refs.files.value=''; // zero input files
            }).catch(error => {
                console.log(error);
            });
        },

        removeFile(key, img) {
            axios.get('/photo/'+img+'/delete')
                .then(response => {
                //console.log(response.data);
                this.fileList.splice(key, 1);
            }).catch(error => {
                console.log(error);
            });
        },
        addFiles(){
            if (this.fileList.length < this.maxCountFile){
                this.$refs.files.click();
            }
        },
        countImages(){
            if (this.fileList.length > 0 && this.fileList.length < this.maxCountFile){
                return 'изображений '+this.fileList.length
            }else if (this.fileList.length >= this.maxCountFile){
                return 'Максимальное число изображений ' + this.maxCountFile;
            }
            return 'Изображения отсутствуют'
        },

    }
}
</script>

<style>
#files{
    visibility: hidden;
}

.upload_images input {
    width: 100%;
}

.upload_images .info {
    font-size: 12px;
    color: darkred;
}

.upload_images .list_images {
    width: 100%;
    padding: 10px 10px 10px 0;
}

.upload_images .list_images .item_image {
    padding: 5px;
}

.upload_images .list_images .item_image:hover {
    border: 1px solid #cccccc;
    border-radius: 10px;
}

.upload_images .list_images .img {
    padding: 10px;
}

.upload_images .list_images .icon {
    width: 30px;
}

.upload_images .list_images img {
    width: 70px;
    height: 70px;
}

.upload_images .list_images input {
    margin-top: 2px;
}

.delete_item i{
    color: darkred;
    cursor: pointer;
    font-size: 16px;
    margin-top: 20px;
}

</style>
