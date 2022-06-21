<template>
  <el-tab-pane>
    <template #label>
      <span class="custom-tabs-label">
        <el-icon :size="15"><Link /></el-icon>
        <span>Link</span>
      </span>
    </template>
    <el-row v-loading="loading">
      <el-col :sm="24" :md="12">
        <LinkForm
          :form="form"
          @onSubmit="onSubmit"
          @onReset="onReset"
        />
      </el-col>
      <el-col :sm="24" :md="12">
        <LinkList
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
import LinkForm from './LinkForm';
import LinkList from './LinkList';
import { ElMessage } from 'element-plus';

function getDefaultForm() {
  return {
    title: '',
    link: '',
    open_in_new_tab: false,
    isEdit: false,
  };
}

export default {
  name: 'LinkTab',
  data () {
    return {
      url: `http://${window.location.host}/links`,
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
    LinkForm,
    LinkList
  }
}
</script>

<style scoped>
.el-row .el-col {
  padding: 20px;
}
</style>
