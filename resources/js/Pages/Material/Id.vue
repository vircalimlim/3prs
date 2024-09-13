<script setup>
import { onMounted } from 'vue';
import VuePdfEmbed from 'vue-pdf-embed'

// optional styles
import 'vue-pdf-embed/dist/styles/annotationLayer.css'
import 'vue-pdf-embed/dist/styles/textLayer.css'

// either URL, Base64, binary, or document proxy
const pdfSource = 'https://raw.githubusercontent.com/mozilla/pdf.js/ba2edeae/web/compressed.tracemonkey-pldi-09.pdf';

onMounted(() => {
    document.addEventListener('copy', function (e) {
        e.preventDefault();
    });
});
</script>

<template>
    <div class="pdf-container">
        <VuePdfEmbed annotation-layer text-layer :source="pdfSource" />
        <div class="overlay"></div>
    </div>
</template>

<style>
.pdf-container {
  position: relative;
  user-select: none;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
}

.overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: transparent;
  z-index: 10;
}
</style>