<template>
    <div>
      <p v-html="truncatedText"></p>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      text: {
        type: String,
        required: true
      },
      maxLength: {
        type: Number,
        required:true
      }
    },
    computed: {
      truncatedText() {
        if (this.text.length > this.maxLength) {
          return this.text.substring(0, this.maxLength) + '...';
        }
        return this.text;
      }
    }
  };
  </script>
  
  <style scoped>
  p {
    font-size: 16px;
    color: #333;
  }
  </style>
  