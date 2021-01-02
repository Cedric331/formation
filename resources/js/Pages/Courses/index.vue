<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Les formations
            </h2>
        </template>
        <div v-for="cours in coursList" :key="cours.id">
            <section class="text-gray-600 body-font overflow-hidden">
                <div class="container px-5 py-5 mx-auto">
                    <div class="-my-4 divide-y-2 divide-gray-100 p-5">
                        <div class="py-8 flex flex-wrap md:flex-nowrap bg-gray-100 p-5 rounded-xl shadow-xl border-2">
                            <div class="md:flex-grow">
                                <h2 class="text-2xl font-medium text-gray-900 title-font mb-2">{{cours.title}}</h2>
                                <hr class="my-2">
                                <p class="leading-relaxed">{{cours.description}}</p>
                            </div>
                            <p class="inline-flex items-center mt-2">
                                <img alt="blog" src="https://dummyimage.com/104x104"
                                    class="w-12 h-12 rounded-full flex-shrink-0 object-cover object-center">
                                <span class="flex-grow flex flex-col pl-4">
                                    <span class="title-font font-medium text-gray-900">{{ cours.user.name }}</span>
                                    <span class="text-gray-400 text-xs tracking-widest mt-0.5">Posté il y a {{ cours.human_created_at }}</span>
                                    <span class="text-gray-400 text-xs tracking-widest mt-0.5">Nombre d'épisode {{ cours.episodes_count }} </span>
                                </span>
                            </p>
                        </div>
                        <a :href="'cours/'+cours.id" class="text-indigo-500 inline-flex items-center mt-2">Accéder au cours
                            <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"></path>
                                <path d="M12 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </section>
            <hr class="mx-8">
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'

    export default {
        data() {
            return {
                coursList: this.cours,
            }
        },
        props: ['cours'],
        components: {
            AppLayout,
        },
    }
</script>
