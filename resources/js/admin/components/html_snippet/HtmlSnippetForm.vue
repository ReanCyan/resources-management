<template>
  <el-form :label-position="labelPosition" :model="form">

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
  name: 'HtmlSnippetForm',
  data () {
    return {
      submitBtn: getSubmitBtnDefault(),
      labelPosition: ref('top')
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
    validateForm () {
      return this.form.title !== '' && this.form.description !== '' && this.form.html !== '';
    }
  }
}
</script>
