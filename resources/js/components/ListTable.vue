<template>
  <div class="ListTable">
    <div class="list-group">
      <a
        href="#"
        class="list-group-item list-group-item-action"
        aria-current="true"
        v-for="item in items"
        :key="item.id"
      >
        <div class="d-flex w-100 justify-content-between">
          <h5 class="mb-1">{{ item.description }}</h5>
        </div>
        <small>
          <a
            type="button"
            class="btn btn-outline-primary"
            :href="`${url}/show/${item.id}`"
          >
            Visualizar
          </a>
        </small>
        <small>
          <a
            type="button"
            class="btn btn-outline-success"
            :href="`${url}/edit/${item.id}`"
          >
            Editar
          </a>
        </small>
      </a>
    </div>
  </div>
</template>

<script>
export default {
  name: "ListTable",
  props: ["url"],
  data: () => ({
    items: {},
  }),
  mounted() {
    this.getData();
    setInterval(this.getData, 5000);
  },
  methods: {
    getData() {
      axios.get(`${this.url}/refresh`).then( response => {
        this.items = response.data;
      });
    }
  },
};
</script>