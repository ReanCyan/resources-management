<template>
  <el-form :model="form">

    <el-form-item label="Title">
      <el-input v-model="form.title" />
    </el-form-item>

    <el-form-item label="PDF">
      <el-upload
        action=""
        :auto-upload="false"
        :show-file-list="false"
        :on-change="handleFileChange"
      >
        <template #trigger>
          <el-button plain>Select file</el-button>
        </template>
        <template #tip>
          <div id="file-name">
            No File Chosen
          </div>
          <div class="el-upload__tip">
            PDF files with a size less than 10MB
          </div>
        </template>
      </el-upload>
    </el-form-item>

    <el-form-item>
      <el-button type="primary" @click="onSubmit" :icon="CirclePlus" plain> Create </el-button>
      <el-button @click="resetForm(form)"> Reset </el-button>
    </el-form-item>

  </el-form>
</template>

<script>
import { ref } from 'vue';

function getDefaultForm() {
  return {
    title: '',
    file: ''
  };
}

export default {
  name: 'PdfForm',
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
      document.getElementById('file-name').textContent = 'No File Chosen';
    },
    handleFileChange (file) {
      file = file.raw;
      this.form.file = file;
      document.getElementById('file-name').textContent = file.name;
    }
  }
}
</script>
