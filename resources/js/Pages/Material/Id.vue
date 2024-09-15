<script setup>
import { onMounted } from "vue";
import VuePdfEmbed from "vue-pdf-embed";
import "vue-pdf-embed/dist/styles/annotationLayer.css";
import "vue-pdf-embed/dist/styles/textLayer.css";

const {} = defineProps({
  pdfSource: {
    type: String,
    required: true,
  },
});
// either URL, Base64, binary, or document proxy
// const pdfSource =
//   "https://raw.githubusercontent.com/mozilla/pdf.js/ba2edeae/web/compressed.tracemonkey-pldi-09.pdf";

onMounted(() => {
  document.addEventListener("copy", function (e) {
    e.preventDefault();
  });

  document.addEventListener("contextmenu", function (e) {
    e.preventDefault();
  });

  window.print = function () {
    alert("Printing is disabled on this page.");
  };

  document.onkeydown = (e) => {
    if (e.key == 123) {
      e.preventDefault();
    }
    if (e.ctrlKey && e.shiftKey && e.key == "I") {
      e.preventDefault();
    }
    if (e.ctrlKey && e.shiftKey && e.key == "C") {
      e.preventDefault();
    }
    if (e.ctrlKey && e.shiftKey && e.key == "J") {
      e.preventDefault();
    }
    if (e.ctrlKey && e.key == "U") {
      e.preventDefault();
    }
    if ((e.ctrlKey || e.metaKey) && e.key === "p") {
      e.preventDefault();
    }
    if (e.ctrlKey && (e.key === "p" || e.key === "s")) {
      e.preventDefault();
    }
  };
});
</script>

<template>
  <div class="pdf-container w-[100%]">
    <VuePdfEmbed
      class="w-[100%]"
      annotation-layer
      text-layer
      :source="pdfSource"
    />
    <div class="overlay">
      <div class="copyright-text">
        <h1 class="text-[150px] md:text-[300px]">3PRS</h1>
      </div>
    </div>
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

.copyright-text {
  color: gray;
  opacity: 0.3;
  position: fixed;
  top: 50vh;
  left: 0;
  width: 100%;
}

.copyright-text h1 {
  transform: rotate(30deg);
  text-align: center;
  font-weight: bolder;
}
</style>