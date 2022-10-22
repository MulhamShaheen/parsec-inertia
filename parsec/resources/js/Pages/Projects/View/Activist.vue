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
            <button class="rounded p-2" :class="[form.processing || repliedTo !== false? 'bg-gray-200 ' : 'bg-indigo-600 text-white'] " :disabled="form.processing || repliedTo !== false" data-modal-toggle="reply-model">
              Откликнуться
            </button>
          </div>
        </div>
        <MyModal :modalId="'reply-model'" :modal-text="''" :modal-title="'Отклик на проект'">
          <div class="p-6 space-y-6">
            <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
              Напиши сопровождающее сообщение
            </p>
          </div>

          <form @submit.prevent="postForm()">
            <div class="p-6 space-y-6">
              <textarea id="message" rows="4" v-model="form.message"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="..."></textarea>
            </div>
            <div
                class="flex justify-center items-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
              <button type="submit" data-modal-toggle="reply-model"
                      class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Откликнуться
              </button>
              <Link data-modal-toggle="reply-model" href="#" as="button"
                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                Отмена
              </Link>
            </div>
          </form>
        </MyModal>
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
import {useForm} from '@inertiajs/inertia-vue3'

export default {
  name: "View",
  props: {
    auth: Object,
    project: Object,
    employer: Object,
    repliedTo: Object,
  },
  setup(props) {
    const form = useForm({
      user_id: props.auth.user.id,
      project_id: props.project.id,
      message: null,
    })

    return {form}
  },
  methods: {
    postForm() {

      this.form.post(route('project.reply', this.project.id))
    }
  }
}
</script>

<style scoped>

</style>