<template>
  <el-table :data="list" style="width: 100%">
    <el-table-column prop="title" label="Title" />
    <el-table-column label="Actions">
      <template #default="scope">
        <el-button
          plain
          type="warning"
          :icon="Edit"
          @click="handleEdit(scope.$index, scope.row)"
        >
        </el-button>
        <el-button
          plain
          type="danger"
          :icon="Delete"
          @click="handleDelete(scope.$index, scope.row)"
        >
        </el-button>
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
      Delete: ref('Delete')
    }
  },
  props: {
    list: {
      type: Array,
      required: true
    }
  },
  methods: {
    handleEdit (index, row) {
      this.$emit('onEdit', row);
    },
    handleDelete (index, row) {
      this.$emit('onDelete', row.id);
    }
  }
}
</script>
