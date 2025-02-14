<script setup>
import TextHeader from '@/Components/TextHeader.vue';
import StudentLayout from '@/Layouts/StudentLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import ContactSection from './ContactSection.vue';

const {about, mission, vision, objectives, contact} = defineProps({
    'about': {
        type: Object,
        required: true,
    },
    'mission': {
        type: Object,
        required: true,
    },
    'vision': {
        type: Object,
        required: true,
    },
    'objectives': {
        type: Object,
        required: true,
    },
    'contact': {
        type: Object,
        required: true,
    },
});

const formAbout = useForm({
  description: '',
  image: null,
  category: 'about',
});

const formMission = useForm({
  description: '',
  image: null,
  category: 'mission',
});

const formVision = useForm({
  description: '',
  image: null,
  category: 'vision',
});

const formObj = useForm({
  description: '',
  image: null,
  category: 'objectives',
});

const updateAbout = (category) => {
    const  form = useForm({
        description: '',
        image: null,
        category: '',
    });

    if(category == 'about'){
        form.description    = formAbout.description;
        form.image          = formAbout.image;
        form.category       = formAbout.category;
    }

    if(category == 'mission'){
        form.description    = formMission.description;
        form.image          = formMission.image;
        form.category       = formMission.category;
    }

    if(category == 'vision'){
        form.description    = formVision.description;
        form.image          = formVision.image;
        form.category       = formVision.category;
    }

    if(category == 'objectives'){
        form.description    = formObj.description;
        form.image          = formObj.image;
        form.category       = formObj.category;
    }


    form.post(route("about.update"), {
        onSuccess: () => {
        form.description = '';
        form.image = null;
        form.category = '';
                    
        toast.success("Saved!", {
            autoClose: 1000,
        });

        },
    });
}

const editImage = () => {
    document.getElementById('fileInput').click();
}


onMounted(() => {
    formAbout.description   = about.description || '';
    formMission.description = mission.description || '';
    formVision.description  = vision.description || '';
    formObj.description     = objectives.description || '';
});
</script>

<template>
    <StudentLayout page-name="About Us">
        <form @submit.prevent="updateAbout('about')">
            <section class="relative grid grid-rows-1 md:grid-cols-2 justify-start gap-10 py-10">
                <div
                  v-if="$page.props.auth.user && $page.props.auth.user.student_id == 0"
                  @click="editImage"
                  class="relative group"
                >
                  <div class="absolute inset-0 md:h-[350px] flex items-center justify-center rounded bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 cursor-pointer">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="40"
                      height="40"
                      fill="currentColor"
                      class="bi bi-camera text-white"
                      viewBox="0 0 16 16"
                    >
                      <path d="M15 12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h1.172a3 3 0 0 0 2.12-.879l.83-.828A1 1 0 0 1 6.827 3h2.344a1 1 0 0 1 .707.293l.828.828A3 3 0 0 0 12.828 5H14a1 1 0 0 1 1 1zM2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4z" />
                      <path d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5m0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7M3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0" />
                    </svg>
                  </div>
                    <img class="w-full md:h-[350px]" :src="`/storage/images/about/${about.thumbnail}`" alt="about image">
                    <input id="fileInput" @input="formAbout.image = $event.target.files[0]" class="hidden" accept="image/png, image/gif, image/jpeg, image/jpg" type="file">
                </div>
                <div v-else>
                    <img class="w-full md:h-[350px]" :src="`/storage/images/about/${about.thumbnail}`" alt="about image">
                </div>

                <div>
                    <TextHeader title="About Us" class="text-[#1034a6]" style="font-size: 40px;"/>
                    <div v-if="$page.props.auth.user && $page.props.auth.user.student_id == 0">
                        <textarea v-model="formAbout.description" class="block mt-5" rows="10" cols="50" name="" id="" required>{{ about.description }}</textarea>
                        <button type="submit" class="mt-2 border border-blue-900 text-blue-800 bg-white-700 hover:bg-blue-800 hover:text-white font-medium rounded-lg text-sm px-5 py-2 me-2 mb-2 focus:outline-none">
                            Save
                        </button>
                    </div>
                    <p v-else class="mt-5">
                        {{ about.description }}
                    </p>
                </div>
            </section>
        </form>

        <!-- <form @submit.prevent="updateAbout('mission')">
            <section class="flex flex-col md:flex-row justify-start gap-10 py-10">
                <img class="w-full h-full md:h-[350px] md:w-[50%]" :src="`/images/about/${mission.thumbnail}`" alt="about image">
                <div>
                    <TextHeader title="Mission" style="font-size: 40px;"/>
                    <div v-if="$page.props.auth.user && $page.props.auth.user.student_id == 0">
                        <textarea v-model="formMission.description" class="block mt-5" rows="10" cols="50" name="" id="" required>{{ mission.description }}</textarea>
                        <button type="submit" class="mt-2 border border-blue-900 text-blue-800 bg-white-700 hover:bg-blue-800 hover:text-white font-medium rounded-lg text-sm px-5 py-2 me-2 mb-2 focus:outline-none">
                            Save
                        </button>
                    </div>
                    <p v-else class="mt-5">
                        {{ mission.description }}
                    </p>
                </div>
            </section>
        </form>

        <form @submit.prevent="updateAbout('vision')">
            <section class="flex flex-col md:flex-row justify-start gap-10 py-10">
                <img class="w-full h-full md:h-[350px] md:w-[50%]" :src="`/images/about/${vision.thumbnail}`" alt="about image">
                <div>
                    <TextHeader title="Vision" style="font-size: 40px;"/>
                    <div v-if="$page.props.auth.user && $page.props.auth.user.student_id == 0">
                        <textarea v-model="formVision.description" class="block mt-5" rows="10" cols="50" name="" id="" required>{{ vision.description }}</textarea>
                        <button type="submit" class="mt-2 border border-blue-900 text-blue-800 bg-white-700 hover:bg-blue-800 hover:text-white font-medium rounded-lg text-sm px-5 py-2 me-2 mb-2 focus:outline-none">
                            Save
                        </button>
                    </div>
                    <p v-else class="mt-5">
                        {{ vision.description }}
                    </p>
                </div>
            </section>
        </form>

        <form @submit.prevent="updateAbout('objectives')">
            <section class="flex flex-col md:flex-row justify-start gap-10 py-10">
                <img class="w-full h-full md:h-[350px] md:w-[50%]" :src="`/images/about/${objectives.thumbnail}`" alt="about image">
                <div>
                    <TextHeader title="Objectives" style="font-size: 40px;"/>
                    <div v-if="$page.props.auth.user && $page.props.auth.user.student_id == 0">
                        <textarea v-model="formObj.description" class="block mt-5" rows="10" cols="50" name="" id="" required>{{ objectives.description }}</textarea>
                        <button type="submit" class="mt-2 border border-blue-900 text-blue-800 bg-white-700 hover:bg-blue-800 hover:text-white font-medium rounded-lg text-sm px-5 py-2 me-2 mb-2 focus:outline-none">
                            Save
                        </button>
                    </div>
                    <p v-else class="mt-5">
                        {{ objectives.description }}
                    </p>
                </div>
            </section>
        </form> -->
        
        <ContactSection :contact="contact"/>
    </StudentLayout>
</template>