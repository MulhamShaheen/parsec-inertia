<template>

  <div v-if="$page.props.auth.user.role === null"
       class="flex flex-col content-center items-center w-full rounded-lg bg-gray-100 p-5">
    <ul class="flex flex-wrap text-l font-medium text-center text-gray-500 dark:text-gray-400">
      <li class="mr-2">
        <Link :href="route('account.info', 'activist')" class="inline-block py-3 px-4 rounded-lg"
              :class="[ $page.component === 'Auth/Info/Activist' ? 'bg-indigo-600 hover:bg-indigo-700 text-white':'text-gray-800 bg-gray-400 hover:bg-gray-600 '  ]">
          <span>Активист</span>
        </Link>
        <!--      <a href="#" class="inline-block py-3 px-4 text-white bg-blue-600 rounded-lg active" aria-current="page">Tab 1</a>-->
      </li>
      <li class="mr-2">
        <Link :href="route('account.info', 'employer')" class="inline-block py-3 px-4 rounded-lg"
              :class="[ $page.component === 'Auth/Info/Employer' ? 'bg-indigo-600 hover:bg-indigo-700  text-white':'text-gray-800 bg-gray-400 hover:bg-gray-600 '  ]">
          <span>Организации</span>
        </Link>
      </li>
    </ul>
  </div>
  <div class="w-full bg-gray-100 m-0">
    <div class="mr-8 ml-8">
      <div class="mr-8 ml-8">
        <div class="md:grid md:grid-cols-3 md:gap-6">
          <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
              <h3 class="text-lg font-medium leading-6 text-gray-900">Profile</h3>
              <p class="mt-1 text-sm text-gray-600">Эта информация будет доступна другим пользователям</p>
            </div>
          </div>
          <div class="mt-5 md:col-span-2 md:mt-0">
            <form action="#" method="POST">
              <div class="shadow sm:overflow-hidden sm:rounded-md">
                <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                  <div class="grid grid-cols-3 gap-6">
                    <div class="col-span-3 sm:col-span-2">
                      <label for="company-website" class="block text-sm font-medium text-gray-700">Ссылка на Соц.
                        сети</label>
                      <div class="mt-1 flex rounded-md shadow-sm">
                    <span
                        class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-gray-50 px-3 text-sm text-gray-500">http://</span>
                        <input type="text" name="company-website" id="company-website"
                               class="block w-full flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                               placeholder="www.example.com">
                      </div>
                    </div>
                  </div>

                  <div>
                    <label for="about" class="block text-sm font-medium text-gray-700">О себе</label>
                    <div class="mt-1">
                  <textarea id="about" name="about" rows="3"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            placeholder="you@example.com"></textarea>
                    </div>
                    <p class="mt-2 text-sm text-gray-500">Кратко расскажите про себя</p>
                  </div>

                  <div>
                    <label class="block text-sm font-medium text-gray-700">Фотография</label>
                    <div class="mt-1 flex items-center">
                    <span class="inline-block h-12 w-12 overflow-hidden rounded-full bg-gray-100">
                  <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z"/>
                  </svg>
                </span>
                      <button type="button"
                              class="ml-5 rounded-md border border-gray-300 bg-white py-2 px-3 text-sm font-medium leading-4 text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Change
                      </button>
                    </div>
                  </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                  <button type="submit"
                          class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Сохранить
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="hidden sm:block" aria-hidden="true">
        <div class="py-5">
          <div class="border-t border-gray-200"></div>
        </div>
      </div>

      <div class="m-8 mt-10 sm:mt-0 ">
        <div class="md:grid md:grid-cols-3 md:gap-6">
          <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
              <h3 class="text-lg font-medium leading-6 text-gray-900">Personal Information</h3>
              <p class="mt-1 text-sm text-gray-600">Use a permanent address where you can receive mail.</p>
            </div>
          </div>
          <div class="mt-5 md:col-span-2 md:mt-0">
            <form @submit.prevent="postForm()">
              <input name="username" id="username" v-model="form.username" hidden>
              <input name="password" id="password" v-model="form.password" hidden>
              <input name="email" id="email" v-model="form.email" hidden>
              <div class="overflow-hidden shadow sm:rounded-md">
                <div class="bg-white px-4 py-5 sm:p-6">
                  <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-3">
                      <label for="title" class="block text-sm font-medium text-gray-700">Название организации</label>
                      <input type="text" name="title" id="title" v-model="form.title"
                             autocomplete="title"
                             class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                      <label for="description" class="block text-sm font-medium text-gray-700">Краткое описание</label>
                      <input type="text-area" name="description" id="description" v-model="form.description"
                             autocomplete="family-name"
                             class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>
                  </div>
                  <div class="col-span-6 sm:col-span-3 mt-6">
                    <label class="block text-sm font-medium text-gray-700">Фотография</label>
                    <div class="mt-1 flex items-center">
                      <span class="inline-block h-12 w-12 overflow-hidden rounded-full bg-gray-100">
                        <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                          <path
                              d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                      </span>
                      <button type="button"
                              class="ml-5 rounded-md border border-gray-300 bg-white py-2 px-3 text-sm font-medium leading-4 text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                              data-modal-toggle="photo-model">

                        Change
                      </button>
                    </div>
                  </div>
                </div>
                <MyModal :modalId="'photo-model'" :modal-text="''" :modal-title="'Загрузка фотографии'">
                  <div class="p-6 space-y-6">
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                      Тут загрзить фото
                    </p>
                    <form @submit.prevent="postPhoto()">
                      <input type="file" name="photo" id="photo" @input="photoForm.photo = $event.target.files[0]">
                      <progress v-if="photoForm.progress" :value="photoForm.progress.percentage" max="100">
                        {{ photoForm.progress.percentage }}%
                      </progress>
                      <button type="submit">Submit</button>
                    </form>
                  </div>
<!--                  <div-->
<!--                      class="flex justify-center items-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">-->
<!--                    <Link :data-modal-toggle="modalId" href="/logout" as="button"-->
<!--                          class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">-->
<!--                      Выходить-->
<!--                    </Link>-->
<!--                    <Link :data-modal-toggle="modalId" href="#" as="button"-->
<!--                          class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">-->
<!--                      Отмена-->
<!--                    </Link>-->
<!--                  </div>-->
                </MyModal>
                <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                  <button type="submit"
                          class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Сохранить
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="flex justify-center">
        <Link
            as="button"
            type="button"
            :href="route('homepage')"
            :disabled="beforeNext()"
            class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
          Заверщить
        </Link>
      </div>
      <div class="hidden sm:block" aria-hidden="true">
        <div class="py-5">
          <div class="border-t border-gray-200"></div>
        </div>
      </div>
      <!--  <pre>-->
      <!--    {{$page.props}}-->
      <!--    {{data}}-->
      <!--    {{form}}-->
      <!--  </pre>-->
    </div>
  </div>

</template>

<script>

import {useForm} from '@inertiajs/inertia-vue3'
import {Link} from '@inertiajs/inertia-vue3'

export default {
  layout: null,
  components: {
    Link
  },
  props: {
    hasInfo: Object,
  },
  setup(props) {
    const form = useForm({
      title: props.hasInfo.title ?? null,
      description: props.hasInfo.description ?? null,
      username: null,
      password: null,
      email: null,
    })

    const photoForm = useForm({
      photo: null,
    })
    return {form,photoForm}
  },
  mounted() {
    console.log(this.hasInfo)
    console.log(this.beforeNext())
  },
  methods: {
    postForm() {
      this.form.post('/account/info/employer')

      // this.form.transform((data) => ({
      //   ...data,
      //   username: this.user.name,
      //   password: this.user.password,
      //   email: this.user.email,
      // })).post('/account/info/personal')
    },
    postPhoto(){
      this.photoForm.post('/updateProfPicture')
    },
    beforeNext() {
      return this.hasInfo === false
    }
  },
  data() {
    return ({
      hasPersonal: false,
      hasProfile: false,
    })
  }
}
</script>
