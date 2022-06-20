<template>
  <el-tab-pane>
    <template #label>
      <span class="custom-tabs-label">
        <el-icon :size="15"><Tickets /></el-icon>
        <span>HTML snippet</span>
      </span>
    </template>
    <el-row v-loading="loading">
      <el-col :sm="24" :md="12">
        <HtmlSnippetForm
          :form="form"
          @onSubmit="onSubmit"
          @onReset="onReset"
        />
      </el-col>
      <el-col :sm="24" :md="12">
        <HtmlSnippetList
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
import HtmlSnippetForm from './HtmlSnippetForm';
import HtmlSnippetList from './HtmlSnippetList';
import { ElMessage } from 'element-plus';

function getDefaultForm() {
  return {
    title: '',
    html: '',
    description: '',
    isEdit: false,
  };
}

export default {
  name: 'HtmlSnippetTab',
  data () {
    return {
      url: 'http://localhost:8000/html_snippets',
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

      if(form.isEdit) {
        this.editResource(form);
      }
      else {
        this.createResource(form);
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
    editResource (form) {
      axios
      .put(`${this.url}/${form.id}`, form)
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
    HtmlSnippetForm,
    HtmlSnippetList
  }
}
</script>

<style scoped>
.el-row .el-col {
  padding: 20px;
}
</style>
