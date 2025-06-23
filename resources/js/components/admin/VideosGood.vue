<template>
  <div>
    <div v-for="(video, key) in good_videos" class="mb-2">

      <div class="row mb-3">
        <label class="col-2 star">
          Youtube key
        </label>
        <div class="col-3">
          <input type="text"
                 :name="'videos[' + key + '][youtube]'"
                 v-model="video.youtube"
                 class="form-control"
                 required
          >
        </div>

        <div class="col-3">
          <iframe
              :src="getEmbedUrl(video.youtube)"
              width="300"
              height="170"
              allowfullscreen
          ></iframe>
        </div>

        <div class="col-3">
          <div class="row mb-3">
            <label class="col-2">
              Статус
            </label>
            <div class="col-9">
              <input type="checkbox"
                     :name="'videos[' + key + '][active]'"
                     value="1"
                     v-model="video.active"
                     :true-value="1"
                     :false-value="0"
              />
            </div>
          </div>
        </div>

        <div class="col-1 delete_item">
          <i class="fa fa-times" title="удалить" @click="deleteVideo(key)"/>
        </div>
      </div>

    </div>
    <span class="btn btn-secondary" style="float: right" @click="addVideo()">add video</span>
  </div>
</template>

<script>
export default {
  name: "VideosGood",
  props: [
      'videos'
  ],
  mounted() {
    if (this.videos){
      this.good_videos = this.videos
    }
  },
  data() {
    return {
      good_videos: [],
      newVideoUrl: '',
    };
  },
  methods: {
    // async fetchVideos() {
    //   const response = await fetch(`/api/products/${this.productId}/videos`);
    //   this.videos = await response.json();
    // },

    addVideo() {
      this.good_videos.push({
        youtube: '',
        active: 1
      })

    },

    deleteVideo(index){
      this.good_videos.splice(index, 1);
    },

    getEmbedUrl(url) {
      return `https://www.youtube.com/embed/${url}`;

    },

  },

};

</script>

<style scoped>

</style>