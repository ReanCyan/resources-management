<template>
  <el-table :data="tableData" style="width: 100%">
    <el-table-column prop="title" label="Title" />
    <el-table-column label="Actions">
      <template #default="scope">
        <el-button
          plain
          type="warning"
          :icon="Edit"
          @click="handleEdit(scope.$index, scope.row)"
        >
        </el-button
        >
        <el-button
          plain
          type="danger"
          :icon="Delete"
          @click="handleDelete(scope.$index, scope.row)"
        >
        </el-button
        >
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
      Edit: ref('Edit'),
      Delete: ref('Delete'),
      tableData: [
        {
          title: 'Title 1'
        },
        {
          title: 'Title 2'
        },
        {
          title: 'Title 3'
        }
      ]
    }
  },
  methods: {
    handleEdit (index, row) {
      console.log(index, row);
    },
    handleDelete (index, row) {
      console.log(index, row);
    }
  }
}
</script>
