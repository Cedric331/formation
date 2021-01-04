<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Les formations
            </h2>
        </template>

            <section class="text-gray-600 body-font overflow-hidden">
                <div class="container px-5 py-5 mx-auto">
                    <div class="-my-4 divide-y-2 divide-gray-100 p-5">
                        <div class="py-8 flex flex-wrap md:flex-nowrap bg-gray-100 p-5 rounded-xl shadow-xl border-2">
                            <div class="md:flex-grow">
                                <h2 class="text-2xl font-medium text-gray-900 title-font mb-2">{{listEpisodes[this.numberEpisode].title}}</h2>
                                <hr class="my-2">
                                <p class="leading-relaxed">{{listEpisodes[this.numberEpisode].description}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="container px-5 py-5 mx-auto">
                        <iframe class="mx-auto" width="900" height="506" :src="listEpisodes[this.numberEpisode].video_url" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </section>

        <div class="container my-4 mx-auto">
            <progress-bar :listEp="listEpisodes" :watchedEp="watch"/>
        </div>
            <hr class="mx-8">

        <div v-for="(episode, index) in listEpisodes" :key="episode.id">
            <section class="text-gray-600 body-font overflow-hidden">
                <div class="container px-5 py-5 mx-auto">
                    <div class="-my-4 divide-y-2 divide-gray-100 p-5">
                        <div class="py-8 flex flex-wrap md:flex-nowrap bg-gray-100 p-5 rounded-xl shadow-xl border-2">
                            <div class="md:flex-grow">
                                <div class="flex justify-between items-center">
                                    <h2 class="text-2xl font-medium text-gray-900 title-font mb-2">Episode {{index+1}} - {{episode.title}}</h2>
                                    <hr class="my-2">
                                    <button @click="switchEpisode(index)" class="leading-relaxed text-blue-600">Voir l'épisode</button>
                                </div>
                                <progress-button :watched="watch" :episode-id="episode.id"/>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <hr class="mx-8">
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import ProgressButton from '@/Pages/Courses/progressButton'
    import ProgressBar from '@/Pages/Courses/progressBar'

    export default {
        data() {
            return {
                listEpisodes: this.episodes,
                numberEpisode: 0,
            }
        },
        props: ['cours', 'episodes', 'watch'],
        components: {
            AppLayout,
            ProgressButton,
            ProgressBar,
        },

          methods: {
    switchEpisode : function (index) {
      this.numberEpisode = index,
      window.scrollTo({top:0,left:0, behavior:'smooth'});
    }
  }
    }
</script>
