<template>
  <el-tabs :tab-position="tabPosition" style="100%" class="tabs" type="border-card">

    <PdfTab />
    <HtmlSnippetTab />
    <LinkTab />

  </el-tabs>
</template>

<script>
import {ref} from 'vue';
import PdfTab from './pdf/PdfTab';
import LinkTab from './link/LinkTab';
import HtmlSnippetTab from './html_snippet/HtmlSnippetTab';

export default {
  name: 'Main',
  data () {
    return {
      tabPosition: ref('top'),
    }
  },
  components: {
    PdfTab,
    LinkTab,
    HtmlSnippetTab
  }
}
</script>

<style scoped>
.tabs > .el-tabs__content {
  padding: 32px;
  color: #6b778c;
  font-size: 32px;
  font-weight: 600;
}
.tabs .custom-tabs-label .el-icon {
  vertical-align: middle;
}
.tabs .custom-tabs-label span {
  vertical-align: middle;
}
</style>
