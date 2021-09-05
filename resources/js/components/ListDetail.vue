<template>
  <div class="ListDetail">
    <div class="list-group">
      <a
        href="#"
        class="list-group-item list-group-item-action"
        aria-current="true"
        v-for="item in items"
        :key="item.id"
      >
        <div class="d-flex w-100 justify-content-between">
          <h5 class="mb-1">{{ item.status }}</h5>
          <small>
            {{ item.created_at }}
          </small>
        </div>
        <small>
          <button
            type="button"
            class="btn btn-outline-primary"
            @click="show(item, false)"
          >
            Visualizar Conteúdo
          </button>
        </small>
        <small>
          <button
            type="button"
            class="btn btn-outline-primary"
            @click="show(item, true)"
          >
            Visualizar HTML
          </button>
        </small>
      </a>
    </div>
    <div v-if="showModal">
      <transition name="modal">
        <div class="modal-mask">
          <div class="modal-wrapper">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Visualizar</h5>
                  <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                    @click="showModal = false"
                  >
                    <span aria-hidden="true">&times</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="col" v-if="isHtml" v-html="body"></div>
                  <p v-else>
                    {{ body }}
                  </p>
                </div>
                <div class="modal-footer">
                  <button
                    type="button"
                    class="btn btn-secondary"
                    @click="showModal = false"
                  >
                    Fechar
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </transition>
    </div>
  </div>
</template>

<script>
export default {
  name: "ListTable",
  props: ["url"],
  data: () => ({
    items: {},
    showModal: false,
    body: "",
    isHtml: false
  }),
  mounted() {
    this.getData()
    setInterval(this.getData, 5000)
  },
  methods: {
    getData() {
      axios.get(this.url).then((response) => {
        this.items = response.data
      })
    },
    show(item, isHtml) {
      this.body      = item.body
      this.isHtml    = isHtml
      this.showModal = true
    },
  },
}
</script>

<style scoped>
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: table;
  transition: opacity 0.3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}

.modal{
  display: block !important; /* I added this to see the modal, you don't need this */
}

/* Important part */
.modal-dialog{
  overflow-y: initial !important
}
.modal-body{
  height: 80vh;
  overflow-y: auto;
}
</style>