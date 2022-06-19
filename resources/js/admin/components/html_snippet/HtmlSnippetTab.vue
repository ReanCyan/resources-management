<template>
  <el-tab-pane>
    <template #label>
      <span class="custom-tabs-label">
        <el-icon :size="15"><Tickets /></el-icon>
        <span>HTML snippet</span>
      </span>
    </template>
    <el-row>
      <el-col :sm="24" :md="12">
        <HtmlSnippetForm />
      </el-col>
      <el-col :sm="24" :md="12">
        <HtmlSnippetList />
      </el-col>
    </el-row>
  </el-tab-pane>
</template>

<script>
import HtmlSnippetForm from './HtmlSnippetForm';
import HtmlSnippetList from './HtmlSnippetList';

export default {
  name: 'HtmlSnippetTab',
  components: {
    HtmlSnippetForm,
    HtmlSnippetList
  }
}
</script>

<style scoped>
.el-row .el-col {
  padding: 20px;
}
</style>
