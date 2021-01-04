<template>
    <div>
        <div class="shadow bg-gray-200 ">
          <div class="bg-blue-400 text-xs leading-none py-1 text-center text-white transition-width duration-500" :style="'width:'+ percentage+'%'">{{ percentage }}%</div>
        </div>
    </div>
</template>

<script>
    export default {
  data () {
    return {
        watchedEpisodeData: this.watchedEp
    }
  },
  props: ['listEp', 'watchedEp'],

    computed: {
        percentage()
       {
        return Math.round((this.watchedEpisodeData.length * 100) / this.listEp.length);
           }
    },
    mounted(){
        eventBus.$on('progressBar', data => this.watchedEpisodeData = data)
    }
}
</script>
