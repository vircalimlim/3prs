<script setup>
import { ref, onMounted } from 'vue';
import { Carousel, Slide } from 'vue3-carousel'
import 'vue3-carousel/dist/carousel.css'

const {images, image} = defineProps({
    images: {
        type: Array,
        required: true,
    },
    image: {
        type: String,
        required: true,
    },
    category: {
        type: String,
        required: true,
    }
});

const currentSlide = ref(0);


const slideTo = (val) => {
    currentSlide.value = val
}

onMounted(() => {
    images.unshift({id: 0, category: '', file_name: image})
})
</script>

<template>
    <Carousel id="gallery" :items-to-show="1" :wrap-around="false" v-model="currentSlide">
      <Slide v-for="image in images" :key="image.id">
        <div class="carousel__item w-full">
            <img class="object-cover w-full md:w-full" :src="`/storage/images/${category}/${image.file_name}`" alt="image-item">
        </div>
      </Slide>
    </Carousel>
  
    <Carousel
      id="thumbnails"
      :items-to-show="4"
      :wrap-around="true"
      v-model="currentSlide"
      ref="carousel"
    >
      <Slide v-if="images.length > 1" v-for="image in images" :key="image">
        <div class="carousel__item py-4 mx-2" @click="slideTo(currentSlide - 1)">
            <img class="object-cover w-full h-32 bg-red-600 m-2" :src="`/storage/images/${category}/${image.file_name}`" alt="image-item">
        </div>
      </Slide>
    </Carousel>
</template>