<template>

  <div class="ml-4 bg-blue-200 rounded">
    <div class="container flex flex-col content-center items-center">
      <div class="w-2/12 ">
        <img class="rounded-full" :src="'public/uploads/profiles/' + auth.user.photo" alt="">
      </div>
      <div class="flex flex-col content-center items-center">
        <h1 class="text-xl">{{auth.user.username}}</h1>
        <h3 class="text-gray-500">{{auth.user.email}}</h3>
      </div>
    </div>
  </div>

</template>

<script>
import Activist from "../../../Shared/Layouts/Account/Activist";

export default {
  layout: Activist,
  name: "Activist",
  props:{
    auth:Object,
  }
}
</script>

<style scoped>

</style>