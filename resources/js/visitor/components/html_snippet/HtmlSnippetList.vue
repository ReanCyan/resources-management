<template>
  <el-table :data="list" style="width: 100%">
    <el-table-column prop="title" label="Title" />
    <el-table-column prop="description" label="Description" />
    <el-table-column label="Actions">
      <template #default="scope">
        <el-link
          type="warning"
          href=""
          :icon="CopyDocument"
          @click="copySnippet(scope.$index, scope.row)"
        >
          Copy HTML Snippet
        </el-link>
      </template>
    </el-table-column>
  </el-table>
</template>

<script>
import { ref } from 'vue';
import { ElMessage } from 'element-plus';

export default {
  name: 'HtmlSnippetList',
  data () {
    return {
      CopyDocument: ref('CopyDocument')
    }
  },
  props: {
    list: {
      type: Array,
      required: true
    }
  },
  methods: {
    copySnippet (index, row) {
      navigator.clipboard.writeText(row.html);
      ElMessage.success('Snippet Copied to Clipboard');
    }
  }
}
</script>
