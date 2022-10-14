<template>
  <div class="container w-1/2 mx-auto my-12 bg-gray-100 rounded p-4">
    <div class="flex flex-col mx-auto items-center">
      <div class="w-11/12">
        <div v-for="project in projects" class="w-full p-2 m-2 bg-gray-100">
          <ProjectCard :id="project.id" :title="project.title" :description="project.description" :icon="project.icon" :employer="project.employer_id" :status="project.status">

          </ProjectCard>
        </div>
      </div>

    </div>
  </div>

</template>

<script>
import ProjectCard from "../../Shared/Components/ProjectCard";

export default {
  name: "List",
  components: {ProjectCard},
  props: {
    projects: Array
  },
}
</script>

<style scoped>

</style>