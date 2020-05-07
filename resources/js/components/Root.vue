<template>
  <div>
    <Introduction />
    <Coffeecollection />
  </div>
</template>

<script>
import Introduction from "./Introduction.vue";
import Coffeecollection from "./Coffeecollection.vue";

export default {
  name: "Root",
  components: {
    Introduction,
    Coffeecollection
  }
};
</script>
