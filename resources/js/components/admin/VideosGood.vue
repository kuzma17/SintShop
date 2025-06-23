<template>
  <div>
    <div v-for="(video, index) in good_videos" :key="index" class="mb-2">
      <iframe
          :src="getEmbedUrl(video.youtube)"
          width="300"
          height="170"
          allowfullscreen
      ></iframe>
      <input type="text" name="video[]" v-model="video.youtube" class="form-control">
      <input type="checkbox" name="active[]" v-model="video.active" class="form-control">
      <span>X delete</span>
    </div>
    <span class="btn btn-blue" @click="addVideo()">add video</span>
  </div>
</template>

<script>
export default {
  name: "VideosGood",
  props: [
      'videos'
  ],
  mounted() {
    //this.fetchVideos();

    console.log(this.videos);
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
    async fetchVideos() {
      const response = await fetch(`/api/products/${this.productId}/videos`);
      this.videos = await response.json();

    },

    addVideo() {

      this.good_videos.push({ id: '', good_id: 341, youtube: '', active: 1 })

      console.log(this.this.good_videos);

    },

    getEmbedUrl(url) {
      //const videoId = url.split('v=')[1]?.split('&')[0];
      return `https://www.youtube.com/embed/${url}`;

    },
  },

};

</script>

<style scoped>

</style>