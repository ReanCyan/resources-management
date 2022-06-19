<template>
  <el-form :model="form" status-icon>

    <el-form-item label="Title">
      <el-input v-model="form.title" />
    </el-form-item>

    <el-form-item label="Link">
      <el-input v-model="form.link" />
    </el-form-item>

    <el-form-item label="Open in a new tab">
      <el-switch v-model="form.open_in_new_tab" />
    </el-form-item>

    <el-form-item>
      <el-button type="primary" @click="onSubmit()" :icon="CirclePlus" plain> Create </el-button>
      <el-button @click="resetForm()"> Reset </el-button>
    </el-form-item>

  </el-form>
</template>

<script>
import { ref } from 'vue';

function getDefaultForm() {
  return {
    title: '',
    link: '',
    open_in_new_tab: false
  };
}

export default {
  name: 'LinkForm',
  data () {
    return {
      CirclePlus: ref('CirclePlus'),
      form: getDefaultForm()
    }
  },
  methods: {
    onSubmit () {
      console.log(this.form);
    },
    resetForm () {
      this.form = getDefaultForm();
    }
  }
}
</script>
