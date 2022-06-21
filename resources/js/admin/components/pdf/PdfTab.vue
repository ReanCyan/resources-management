<template>
  <el-tab-pane>
    <template #label>
      <span class="custom-tabs-label">
        <el-icon :size="15"><Document /></el-icon>
        <span>PDF</span>
      </span>
    </template>
    <el-row v-loading="loading">
      <el-col :sm="24" :md="12">
        <PdfForm
          :form="form"
          @onSubmit="onSubmit"
          @onReset="onReset"
        />
      </el-col>
      <el-col :sm="24" :md="12">
        <PdfList
          :list = "list"
          @onEdit="onEdit"
          @onDelete="onDelete"
        />
      </el-col>
    </el-row>
  </el-tab-pane>
</template>

<script>
import { ref } from 'vue';
import axios from 'axios';
import PdfForm from './PdfForm';
import PdfList from './PdfList';
import { ElMessage } from 'element-plus';

function getDefaultForm() {
  return {
    title: '',
    file: null,
    fileName: 'No File Chosen',
    isEdit: false,
  };
}

export default {
  name: 'PdfTab',
  data () {
    return {
      url: `http://${window.location.host}/pdfs`,
      form: getDefaultForm(),
      list: [],
      loading: ref(false)
    }
  },
  methods: {
    onReset () {
      this.form = getDefaultForm();
    },
    getList () {
      this.loading = ref(true);

      axios
      .get(this.url)
      .then(response => {
        this.list = response.data.data;
      })
      .catch(e => {
        ElMessage.error('An error occurred');
        console.log(e);
      })
      .then(() => this.loading = ref(false));
    },
    onSubmit (form) {
      this.loading = ref(true);

      let formData = new FormData();
      formData.append('title', form.title);
      if(form.file) {
        formData.append('file', form.file);
      }

      if(form.isEdit) {
        this.editResource(formData, form.id);
      }
      else {
        this.createResource(formData, form.id);
      }
    },
    createResource (form) {
      axios
      .post(this.url, form)
      .then(response => {
        this.getList();
        this.onReset();
      })
      .catch(e => {
        ElMessage.error('An error occurred');
        console.log(e);
      })
      .then(() => this.loading = ref(false));
    },
    editResource (form, id) {
      axios
      .post(`${this.url}/${id}`, form)
      .then(response => {
        this.getList();
        this.onReset();
      })
      .catch(e => {
        ElMessage.error('An error occurred');
        console.log(e);
      })
      .then(() => this.loading = ref(false));
    },
    onEdit (form) {
      form.isEdit = true;
      form.fileName = form.original_name;
      this.form = form;
    },
    onDelete (id) {
      this.loading = ref(true);

      axios
      .delete(`${this.url}/${id}`)
      .then(response => this.getList())
      .catch(e => {
        ElMessage.error('An error occurred');
        console.log(e);
      })
      .then(() => this.loading = ref(false));
    }
  },
  created() {
    this.getList();
  },
  components: {
    PdfForm,
    PdfList
  }
}
</script>

<style scoped>
.el-row .el-col {
  padding: 20px;
}
</style>
