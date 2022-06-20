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
  name: 'LinkForm',
  data () {
    return {
      submitBtn: getSubmitBtnDefault()
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
        this.submitBtn.icon = ref('CirclePlus');
        this.submitBtn.type = 'primary';
        this.submitBtn.text = 'Create';
      }
    }
  },
  props: {
    form: {
      type: Object,
      required: true
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
      return this.form.title !== '' && !this.form.link !== '' && this.isValidLink(this.form.link);
    },
    isValidLink (string) {
      let url;

      try {
        url = new URL(string);
      } catch (_) {
        return false;
      }

      return url.protocol === "http:" || url.protocol === "https:";
    }
  }
}
</script>
