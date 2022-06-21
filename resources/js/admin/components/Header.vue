<template>
  <el-icon :size="20"><HomeFilled/></el-icon>

  <el-link :href="homeUrl">
    Go to Home
  </el-link>

  <el-switch
    v-model="isLight"
    style="margin-left: 24px"
    inline-prompt
    :active-icon="Sunny"
    :inactive-icon="Moon"
  />
</template>

<script>
import { ref } from 'vue';

export default {
  name: 'Header',
  data () {
    return {
      isLight: false,
      Moon: ref('Moon'),
      Sunny: ref('Sunny'),
      homeUrl: `http://${window.location.host}/`
    }
  },
  watch: {
    isLight(value){
      let element = document.documentElement;
      value ? element.classList.remove("dark") : element.classList.add("dark");
    }
  }
}
</script>
