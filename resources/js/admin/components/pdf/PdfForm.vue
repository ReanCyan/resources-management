<template>
  <el-form :model="form">

    <el-form-item label="Title">
      <el-input v-model="form.title" />
    </el-form-item>

    <el-form-item label="PDF">
      <el-upload
        accept=".pdf"
        action=""
        :auto-upload="false"
        :show-file-list="false"
        :multiple="false"
        :on-change="handleFileChange"
      >
        <template #trigger>
          <el-button plain>Select file</el-button>
        </template>
        <template #tip>
          <div>
            {{ form.fileName }}
            <el-link v-if="this.form.url" :href="this.form.url" :icon="viewIcon" target="_blank">
              View
            </el-link>
          </div>
          <div class="el-upload__tip">
            PDF files with a size less than 10MB
          </div>
        </template>
      </el-upload>
    </el-form-item>

    <el-form-item>
      <el-button :type="submitBtn.type" @click="handleSubmit()" :icon="submitBtn.icon" plain> {{ submitBtn.text }} </el-button>
      <el-button @click="handleReset()"> Reset </el-button>
    </el-form-item>

  </el-form>
</template>

<script>
import { ref } from 'vue';
import { ElMessage } from 'element-plus';

function getSubmitBtnDefault () {
  return {
    icon: ref('CirclePlus'),
    type: 'primary',
    text: 'Create'
  }
}

export default {
  name: 'PdfForm',
  data () {
    return {
      viewIcon: ref('View'),
      submitBtn: getSubmitBtnDefault()
    }
  },
  props: {
    form: {
      type: Object,
      required: true
    }
  },
  watch: {
    form (newVal, oldVal) {
      if(newVal.isEdit) {
        this.submitBtn.icon = ref('Edit');
        this.submitBtn.type = 'warning';
        this.submitBtn.text = 'Edit';
      }
      else {
        this.submitBtn = getSubmitBtnDefault();
      }
    }
  },
  methods: {
    handleSubmit () {
      if (!this.validateForm()) {
        ElMessage.error('Please fill all fields correctly!');
        return;
      }
      this.$emit('onSubmit', this.form);
    },
    handleReset () {
      this.$emit('onReset');
    },
    handleFileChange (file) {
      this.form.file = file.raw;
      this.form.fileName = file.raw.name;
    },
    validateForm () {
      if(this.form.isEdit && !this.form.file) {
        return this.form.title !== '';
      }
      return this.form.title !== '' && this.form.file && this.checkMaxSize(10);
    },
    // size in MB
    checkMaxSize (size) {
      return this.form.file.size < 1024 * 1024 * size;
    }
  }
}
</script>
