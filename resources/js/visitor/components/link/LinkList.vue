<template>
  <el-table :data="list" style="width: 100%">
    <el-table-column prop="title" label="Title" />
    <el-table-column label="Open In New Tab" >
      <template #default="scope">
        <el-icon v-if="scope.row.open_in_new_tab" color="#67C23A"><Check /></el-icon>
        <el-icon v-else color="#F56C6C"><Close /></el-icon>
      </template>
    </el-table-column>
    <el-table-column label="Actions">
      <template #default="scope">
        <el-link
          type="primary"
          :icon="TopRight"
          :href="scope.row.link"
          :target="scope.row.open_in_new_tab ? '_blank' : ''"
        >
          Visit
        </el-link>
      </template>
    </el-table-column>
  </el-table>
</template>

<script>
import { ref } from 'vue';

export default {
  name: 'LinkList',
  data () {
    return {
      TopRight: ref('TopRight')
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
