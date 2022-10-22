<template>
  <div class="ml-4 bg-gray-100 rounded min-h-full p-4">
    <div class="m-auto" v-if="!replies.length">
      У вас нет откликов
    </div>
    <div v-else>
      <div v-for="reply in replies">
        <ReplyCard :reply = reply>

        </ReplyCard>
      </div>
    </div>
  </div>
</template>

<script>
import Activist from "../../../../Shared/Layouts/Account/Activist";
import ReplyCard from "../../../../Shared/Components/ReplyCard";

export default {
  name: "Activist",
  layout: Activist,
  components: {ReplyCard},
  props: {
    auth: Object,
    replies: Array,
  },
}
</script>

<style scoped>

</style>