<template>
  <div>
    <k-select-field
    v-if="content"
    v-model="content.question"
    :options="options"
    :required="false"
    label="Kysymys"
    name="select"
    :endpoints="endpoints"
    @input="updateAll()"
    />
  </div>
</template>

<script>
export default {
  props: ['endpoints'],
  data() {
    return {
      jotform: [],
      options: []
    };
  },
  created() {
    this.load();
  },
  methods: {
    updateAll() {
      this.content.questiontext = this.jotform[this.content.question].text;
      this.update();
    },
    load() {
      this.$api
        .get("jotform")
        .then(jotform => {
          this.jotform = jotform;
          this.options = Object.keys(jotform).map((id) => {
            return { value: jotform[id].qid, text: jotform[id].text };
          });
        });
    },
  }
}
</script>
