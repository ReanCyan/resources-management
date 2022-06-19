<template>
  <el-tab-pane>
    <template #label>
      <span class="custom-tabs-label">
        <el-icon :size="15"><Link /></el-icon>
        <span>Link</span>
      </span>
    </template>
    <el-row>
      <el-col :sm="24" :md="12">
        <LinkForm />
      </el-col>
      <el-col :sm="24" :md="12">
        <LinkList />
      </el-col>
    </el-row>
  </el-tab-pane>
</template>

<script>
import LinkForm from './LinkForm';
import LinkList from './LinkList';

export default {
  name: 'LinkTab',
  components: {
    LinkForm,
    LinkList
  }
}
</script>

<style scoped>
.el-row .el-col {
  padding: 20px;
}
</style>
