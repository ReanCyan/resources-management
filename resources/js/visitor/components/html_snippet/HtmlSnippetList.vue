<template>
  <el-table :data="list" style="width: 100%">
    <el-table-column prop="description" label="Description" />
    <el-table-column label="Actions">
      <template #default="scope">
        <el-link
          type="primary"
          href=""
          :icon="viewIcon"
          @click="viewSnippet(scope.$index, scope.row)"
        >
          View
        </el-link>
        <el-link
          type="warning"
          href=""
          :icon="CopyDocument"
          @click="copySnippet(scope.$index, scope.row)"
        >
          Copy
        </el-link>
      </template>
    </el-table-column>
  </el-table>
</template>

<script>
import { ref } from 'vue';
import { ElMessage, ElMessageBox } from 'element-plus';

export default {
  name: 'HtmlSnippetList',
  data () {
    return {
      viewIcon: ref('View'),
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
    },
    viewSnippet (index, row) {
      const h = this.$createElement;
      ElMessageBox.alert(
        row.html,
        'HTML Snippet',
        {
          dangerouslyUseHTMLString: true,
          callback: (action) =>  console.log(`action: ${action}`)
        }
      );
    }
  }
}
</script>
