<template>
  <Header auth="auth">

  </Header>
  <div class="m-8">
    <slot/>
  </div>
</template>

<script>
import Header  from '../Header'

export default {
  components: {Header},
  props:{
    auth: Object,
  },
  name: "Layout"
}
</script>
