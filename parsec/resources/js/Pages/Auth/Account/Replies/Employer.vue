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
import Employer from "../../../../Shared/Layouts/Account/Employer";
import ReplyCard from "../../../../Shared/Components/ReplyCard";

export default {
  name: "Employer",
  layout: Employer,
  components: {ReplyCard},
  props: {
    auth: Object,
    replies: Array,
  },
}
</script>

<style scoped>

</style>