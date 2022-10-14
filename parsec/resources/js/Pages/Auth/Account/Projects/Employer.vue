<template>
<div class="ml-4 bg-gray-100 rounded min-h-full p-4">
  <div v-if="!hasProjects.length">
    <Link as="button" :href="route('project.create')">
      Add projects
    </Link>
  </div>
  <div v-else>
    <div v-for="project in hasProjects">
      <ProjectCard :id="project.id" :title="project.title" :description="project.description" :icon="project.icon" :employer="project.employer_id" :status="project.status">

      </ProjectCard>
    </div>
  </div>
</div>
</template>

<script>
import Employer from "../../../../Shared/Layouts/Account/Employer";
import ProjectCard from "../../../../Shared/Components/ProjectCard";

export default {
  name: "Employer",
  layout: Employer,
  components: {ProjectCard},
  props: {
    auth: Object,
    hasProjects: Array,
  },

}
</script>

<style scoped>

</style>