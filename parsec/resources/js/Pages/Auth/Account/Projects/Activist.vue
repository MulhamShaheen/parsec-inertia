<template>
<div class="ml-4 bg-gray-100 rounded min-h-full p-4">
  <div v-if="!hasProjects.length">
    <Link as="button" :href="route('projects.list')">
      Add projects
    </Link>
  </div>
  <div v-else>
    <div v-for="project in hasProjects">
      <ProjectCard :id="project.id" :title="project.title" :description="project.description" :icon="project.icon" :employer="project.employer_id">

      </ProjectCard>
    </div>
  </div>
</div>
</template>

<script>
import Activist from "../../../../Shared/Layouts/Account/Activist";
import ProjectCard from "../../../../Shared/Components/ProjectCard";

export default {
  name: "Activist",
  layout: Activist,
  components: {ProjectCard},
  props: {
    auth: Object,
    hasProjects: Array,
  },

}
</script>

<style scoped>

</style>