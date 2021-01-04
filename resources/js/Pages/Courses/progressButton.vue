<template>
    <div>
        <button v-if="this.isWatched ? this.button = 'Indiquer que l\'épisode n\'est pas terminé': this.button = 'Indiquer que l\'épisode est terminé'" class="bg-green-400 mt-2 px-2 px-3 text-white rounded" @click="progress()">
            {{ this.button }}
        </button>
    </div>
</template>

<script>
    export default {
  data () {
    return {
        watchEpisode: this.watched,
        'isWatched': null,
        'button': null
    }
  },
  methods: {
      progress: function(){
          axios.post('/toggleProgress',{
              episode : this.episodeId
          }).then(response => { if (response.status == 200){
              this.isWatched = !this.isWatched
              eventBus.$emit('progressBar', response.data);
          }
          });
      },

      isWatchedEpisode: function(){
          return this.watched.find(episode => episode.id == this.episodeId) ? true : false;
      }
  },
  props: ['episodeId', 'watched'],

    mounted() {
       this.isWatched = this.isWatchedEpisode();
    },
}
</script>
