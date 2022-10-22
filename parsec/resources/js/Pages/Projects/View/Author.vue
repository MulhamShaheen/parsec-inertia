<template>
  <head>
    <title>{{$page.props.project.title}} - Parsec</title>
  </head>
  <div class="grid grid-cols-5 gap-2 w-full">
    <div></div>
    <div class="container col-span-2 mx-auto mt-6 bg-gray-100 rounded p-4">
      <div class="flex flex-col mx-auto items-center">
        <div class="flex gap-6 w-full">
          <img class="object-cover w-32 h-32 rounded-t-lg md:h-auto md:rounded-none md:rounded-l-lg"
               :src="'/public/uploads/projects/' + project.icon" alt="">
          <div class="p-4">
            <h2 class="text-3xl">{{ project.title }}</h2>
            <p>{{ project.description }}</p>
          </div>
        </div>
        <div class="w-3/4 m-4 p-2">
        </div>
      </div>
    </div>
    <div class="container mt-6 bg-gray-100 rounded p-4">
      <div class="flex flex-col gap-6 w-full items-center">
        <img class="object-cover w-32 h-32 rounded-t-lg md:h-auto md:rounded-none md:rounded-l-lg"
             :src="'/public/uploads/profiles/' + employer.icon" alt="">
        <div class="p-4">
          <h2 class="text-3xl">{{ employer.title }}</h2>
        </div>
        <div>
          <Link :href="route('project.edit', project.id)"/>
        </div>
      </div>
    </div>
    <div></div>
    <div></div>
      <div class="container col-span-2 mx-auto mt-6 bg-gray-100 rounded p-4">
        <h1 class="text-xl font-semibold">Отклики на проект</h1>
        <div class="flex flex-col mx-auto items-center">
            <div v-for="reply in replies" class="w-full p-2">
              <!--              {{reply}}-->
              <ReplyCard :reply = reply>

              </ReplyCard>
            </div>
        </div>
      </div>
  </div>
</template>

<script>
import {useForm} from '@inertiajs/inertia-vue3'
import ReplyCard from "../../../Shared/Components/ReplyCard";

export default {
  name: "Employer",
  components:{
    ReplyCard
  },
  props: {
    auth: Object,
    project: Object,
    employer: Object,
    replies: Object,
  },

}
</script>

<style scoped>

</style>