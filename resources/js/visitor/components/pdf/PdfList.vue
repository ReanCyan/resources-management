<template>
  <el-table :data="list" style="width: 100%">
    <el-table-column prop="title" label="Title" />
    <el-table-column prop="original_name" label="Name" />
    <el-table-column label="Actions">
      <template #default="scope">
        <el-link
          type="danger"
          :icon="Download"
          :href="scope.row.download_url"
        >
          Download
        </el-link>
      </template>
    </el-table-column>
  </el-table>
</template>

<script>
import { ref } from 'vue';

export default {
  name: 'PdfList',
  data () {
    return {
      Download: ref('Download')
    }
  },
  props: {
    list: {
      type: Array,
      required: true
    }
  }
}
</script>
