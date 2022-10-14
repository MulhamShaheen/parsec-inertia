<template>
  <div class="grid grid-cols-5  gap-4 w-full">
    <div></div>
    <div class="container col-span-2 mx-auto my-12 bg-gray-100 rounded p-4">
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
          <div class="flex content-between">
            <Link class="rounded bg-indigo-600 text-white p-2" as="button" href="#">
              Откликнуться
            </Link>
          </div>
        </div>
      </div>

    </div>
    <div class="container my-12 bg-gray-100 rounded p-4">
      <div class="flex flex-col gap-6 w-full items-center">
        <img class="object-cover w-32 h-32 rounded-t-lg md:h-auto md:rounded-none md:rounded-l-lg"
             :src="'/public/uploads/profiles/' + employer.icon" alt="">
        <div class="p-4">
          <h2 class="text-3xl">{{ employer.title }}</h2>
        </div>
      </div>
    </div>

  </div>
<!--  <div>-->
<!--    {{ project }}-->
<!--  </div>-->
</template>

<script>
export default {
  name: "View",
  props: {
    project: Object,
    employer: Object,
  }
}
</script>

<style scoped>

</style>