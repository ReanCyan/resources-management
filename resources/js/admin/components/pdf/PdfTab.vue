<template>
  <el-tab-pane>
    <template #label>
      <span class="custom-tabs-label">
        <el-icon :size="15"><Document /></el-icon>
        <span>PDF</span>
      </span>
    </template>
    <el-row>
      <el-col :sm="24" :md="12">
        <PdfForm />
      </el-col>
      <el-col :sm="24" :md="12">
        <PdfList />
      </el-col>
    </el-row>
  </el-tab-pane>
</template>

<script>
import PdfForm from './PdfForm';
import PdfList from './PdfList';

export default {
  name: 'PdfTab',
  components: {
    PdfForm,
    PdfList
  }
}
</script>

<style scoped>
.el-row .el-col {
  padding: 20px;
}
</style>
