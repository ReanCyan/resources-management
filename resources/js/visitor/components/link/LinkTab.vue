<template>
  <el-tab-pane>
    <template #label>
      <span class="custom-tabs-label">
        <el-icon :size="15"><Link /></el-icon>
        <span>Link</span>
      </span>
    </template>
    <el-row v-loading="loading">
      <el-col>
        <LinkList :list="list"/>
      </el-col>
    </el-row>
  </el-tab-pane>
</template>

<script>
import { ref } from 'vue';
import axios from 'axios';
import LinkList from './LinkList';
import { ElMessage } from 'element-plus';

export default {
  name: 'LinkTab',
  data () {
    return {
      url: 'http://localhost:8000/links',
      list: [],
      loading: ref(false)
    }
  },
  methods: {
    getList () {
      this.loading = ref(true);

      axios
      .get(this.url)
      .then(response => {
        this.list = response.data.data;
      })
      .catch(e => {
        ElMessage.error('An error occurred');
        console.log(e);
      })
      .then(() => this.loading = ref(false));
    }
  },
  created() {
    this.getList();
  },
  components: {
    LinkList
  }
}
</script>

<style scoped>
.el-row .el-col {
  padding: 20px;
}
</style>
