<template>
  <div class="common-layout">
    <el-container>
      <el-header>
        <Header />
      </el-header>
      <el-main>
        <Main />
      </el-main>
    </el-container>
  </div>
</template>

<script>
import Header from './Header.vue';
import Main from './Main.vue';

export default {
  name: 'AppComponent',
  data () {
    return {
    }
  },
  components: {
    Header,
    Main
  }
}
</script>
