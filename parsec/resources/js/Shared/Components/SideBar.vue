<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <aside class="w-64" aria-label="Sidebar">
    <div class="overflow-y-auto py-4 px-3 bg-gray-100 rounded dark:bg-gray-800">

      <ul class="space-y-2">
        <slot name="upper">

        </slot>

      </ul>
      <ul class="pt-4 mt-4 space-y-2 border-t border-gray-200 dark:border-gray-700">
        <slot name="lower">

        </slot>

      </ul>
    </div>
  </aside>
</template>
<script>

export default {
  props: {
    auth: Object,
  },

}
</script>
<script setup>

</script>