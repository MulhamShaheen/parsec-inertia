<template>
  <a :href="route('project.view',id)" class="flex flex-col items-center bg-white rounded-lg border shadow-md md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
    <img class="object-cover w-32 h-32 rounded-t-lg md:h-auto md:rounded-none md:rounded-l-lg" :src="'/public/uploads/projects/' + icon" alt="">
    <div class="flex flex-col justify-between p-4 leading-normal relative w-11/12">
      <div class="absolute bottom-2 right-2">
        <span :class="'bg-'+statusColor+'-100 text-'+statusColor+'-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-'+statusColor+'-200 dark:text-'+statusColor+'-800'">{{ statusTest }}</span>
      </div>
      <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{title}}</h5>
      <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{description.substr(0,150) + "..."}}</p>
    </div>
  </a>
</template>

<script>
export default {
  name: "ProjectCard",
  props: {
    id: Number,
    title: String,
    employer: String,
    description: String,
    status: Number,
    icon: String,
  },
  setup(props){
    var statusColor = "gray"
    var statusTest = "не начат"
    switch (props.status) {
      case "0":
        statusColor = "gray"
        statusTest = "не начат"
        break
      case "1":
        statusColor = "green"
        statusTest = "активен"
        break
      case "2":
        statusColor = "yellow"
        statusTest = "приостановлен"
        break
      case "3":
        statusColor = "red"
        statusTest = "отменен"
        break
      case "4":
        statusColor = "purple"
        statusTest = "закончен"
        break

    }
    return {statusColor, statusTest}
  }
}
</script>

<style scoped>

</style>