<template>
  <el-form :label-position="labelPosition" :model="form" status-icon>

    <el-form-item label="Title">
      <el-input v-model="form.title" />
    </el-form-item>

    <el-form-item label="Description">
      <el-input v-model="form.description" type="textarea" :rows="4" />
    </el-form-item>

    <el-form-item label="HTML">
      <el-input v-model="form.html" type="textarea" :rows="4" />
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
    html: '',
    description: ''
  };
}

export default {
  name: 'HtmlSnippetForm',
  data () {
    return {
      CirclePlus: ref('CirclePlus'),
      labelPosition: ref('top'),
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
