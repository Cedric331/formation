<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="mt-10 sm:mt-0">

                            <div class="mt-5 md:mt-0 md:col-span-2">
                                <div class="ml-2 mt-2">
                                    <h1>Edition de la formation</h1>
                                </div>
                                <form @submit.prevent="submit">
                                    <div class="shadow overflow-hidden sm:rounded-md">
                                        <div class="px-4 py-5 bg-white sm:p-6">
                                            <div class="grid grid-cols-6 gap-6">

                                                <div class="col-span-6 sm:col-span-3">
                                                    <label for="title"
                                                        class="block text-sm font-medium text-gray-700">Titre de la formation :</label>
                                                    <input type="text" v-model="coursData.title" id="title"
                                                        autocomplete="title"
                                                        class="mt-1 border focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                <div v-if="errors.title">{{ errors.title }}</div>
                                                </div>


                                                <div class="col-span-6">
                                                    <label for="description"
                                                        class="block text-sm font-medium text-gray-700">Description de la formation :</label>
                                                    <input type="text" v-model="coursData.description" id="description"
                                                        autocomplete="description"
                                                        class="mt-1 border focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    <div v-if="errors.description">{{ errors.description }}</div>
                                                </div>



                                            </div>
                                        </div>
                                                <hr class="my-5">

                                                <div class="ml-2">
                                                        <h1>Episode de la formation</h1>
                                                </div>

                                                <div class="p-4" v-for="(episode, index) in coursData.episodes" :key="index">
                                                    <div class="col-span-6 mt-2">
                                                    <label :for="'title-'+index"
                                                        class="block text-sm font-medium text-gray-700">Titre de l'épisode n°{{ index + 1}} :</label>
                                                    <input type="text" v-model="coursData.episodes[index].title" :id="'title-'+index"
                                                        autocomplete="title_episode"
                                                        class="mt-1 border focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    <div v-if="errors['episodes.'+index+'.title']">{{ errors['episodes.'+index+'.title'] }}</div>
                                                    </div>

                                                    <div class="col-12 mt-2">
                                                    <label :for="'description-'+index"
                                                        class="block text-sm font-medium text-gray-700">Description de l'épisode n°{{ index + 1}} :</label>
                                                    <input type="text" v-model="coursData.episodes[index].description" :id="'description-'+index"
                                                        autocomplete="description_episode"
                                                        class="mt-1 border focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                       <div v-if="errors['episodes.'+index+'.description']">{{ errors['episodes.'+index+'.description'] }}</div>
                                                    </div>

                                                    <div class="col-12 mt-2">
                                                    <label :for="'video-'+index"
                                                        class="block text-sm font-medium text-gray-700">Url de la vidéo de l'épisode n°{{ index + 1}} :</label>
                                                    <input type="text" v-model="coursData.episodes[index].video_url" :id="'video-'+index"
                                                        autocomplete="video_episode"
                                                        class="mt-1 border focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </div>
                                                    <div v-if="errors['episodes.'+index+'.video_url']">{{ errors['episodes.'+index+'.video_url'] }}</div>
                                                </div>

                                    <button v-if="coursData.episodes.length < 15" @click.prevent="add()" class="rounded ml-2 bg-green-600 py-2 px-4 my-2 block text-white">
                                        +
                                    </button>

                                    <button v-if="coursData.episodes.length > 1" @click.prevent="remove()" class="rounded ml-2 bg-red-600 py-2 px-4 my-2 block text-white">
                                        -
                                    </button>
                                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                            <button type="submit"
                                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                Modifier ma formation
                                            </button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'


    export default {
        components: {
            AppLayout,
        },
          props:['cours', 'errors'],
        data() {
        return {
            coursData: this.cours,
            }
      },
        methods: {
        submit() {
          this.$inertia.patch('/cours/'+ this.coursData.id, this.coursData)
        },

        add(){
            this.coursData.episodes.push({title: null, description: null, video_url: null});
        },

        remove(){
            this.coursData.episodes.pop();
        },
  },
}
</script>
