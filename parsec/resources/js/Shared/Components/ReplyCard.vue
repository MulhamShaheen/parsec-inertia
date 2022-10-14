<template>
<!--  route('reply.view',reply.id)-->
  <a :href="route('reply.view',reply.id)" class="flex flex-col items-center bg-white rounded-lg border shadow-md md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 w-full">
    <img class="object-cover m-4 w-16 h-16 rounded-t-lg md:h-auto md:rounded-none md:rounded-l-lg" :src="'/public/uploads/profiles/' + reply.user_icon" alt="">
    <div class="flex flex-col justify-between p-4 leading-normal relative w-11/12">
      <div class="absolute top-2 right-3">
        <img class="w-10 h-10 rounded" :src="'/public/uploads/projects/' + reply.project_icon" alt="">
      </div>
      <div class="absolute bottom-2 right-2">
        <span :class="'bg-'+statusColor+'-100 text-'+statusColor+'-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-'+statusColor+'-200 dark:text-'+statusColor+'-800'">{{ statusTest }}</span>
      </div>
      <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{reply.user}}</h5>
      <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{reply.message}}</p>
    </div>
  </a>
</template>

<script>
export default {
  name: "ReplyCard",
  props: {
    reply: Object
  },
  setup(props){
    var statusColor = "gray"
    var statusTest = "черновик"
    switch (props.reply.status) {
      case "0":
        statusColor = "gray"
        statusTest = "черновик"
        break
      case "1":
        statusColor = "gray"
        statusTest = "не прочитан"
        break
      case "2":
        statusColor = "yellow"
        statusTest = "прочитан"
        break
      case "3":
        statusColor = "red"
        statusTest = "отменен"
        break
      case "4":
        statusColor = "green"
        statusTest = "принят"
        break
    }
    return {statusColor, statusTest}
  }
}
</script>

<style scoped>

</style>