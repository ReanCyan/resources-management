<template>
  <el-tab-pane>
    <template #label>
      <span class="custom-tabs-label">
        <el-icon :size="15"><Tickets /></el-icon>
        <span>HTML snippet</span>
      </span>
    </template>
    <el-row v-loading="loading">
      <el-col>
        <HtmlSnippetList :list="list"/>
      </el-col>
    </el-row>
  </el-tab-pane>
</template>

<script>
import { ref } from 'vue';
import axios from 'axios';
import HtmlSnippetList from './HtmlSnippetList';
import { ElMessage } from 'element-plus';

export default {
  name: 'HtmlSnippetTab',
  data () {
    return {
      url: `http://${window.location.host}/html_snippets`,
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
    HtmlSnippetList
  }
}
</script>

<style scoped>
.el-row .el-col {
  padding: 20px;
}
</style>
