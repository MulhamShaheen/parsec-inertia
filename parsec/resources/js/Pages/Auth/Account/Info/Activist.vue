<template>

  <div class="w-full bg-gray-100 m-0">
    <div class="mr-8 ml-8">
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
                      <label for="first-name" class="block text-sm font-medium text-gray-700">Имя</label>
                      <input type="text" name="first-name" id="first-name" v-model="form.firstname"
                             autocomplete="given-name"
                             class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                      <label for="last-name" class="block text-sm font-medium text-gray-700">Фамилия</label>
                      <input type="text" name="last-name" id="last-name" v-model="form.lastname"
                             autocomplete="family-name"
                             class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                      <label for="middle-name" class="block text-sm font-medium text-gray-700">Отчество</label>
                      <input type="text" name="last-name" id="middle-name" v-model="form.middlename"
                             autocomplete="middle-name"
                             class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>
                    <br>
                    <div class="col-span-6 sm:col-span-3">
                      <label for="phone" class="block text-sm font-medium text-gray-700">Номер Телефона</label>
                      <input type="text" name="phone" id="phone" v-model="form.phone"
                             autocomplete="phone"
                             class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                      <label for="birthdate" class="block text-sm font-medium text-gray-700">Дата рождения</label>
                      <input type="date" name="birthdate" id="birthdate" v-model="form.birthdate"
                             autocomplete="birthdate"
                             class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
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
      <div class="mr-8 ml-8">
        <div class="md:grid md:grid-cols-3 md:gap-6">
          <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
              <h3 class="text-lg font-medium leading-6 text-gray-900 ">Profile</h3>
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

      <div class="hidden sm:block" aria-hidden="true">
        <div class="py-5">
          <div class="border-t border-gray-200"></div>
        </div>
      </div>
    </div>
  </div>

</template>

<script>

import {useForm} from '@inertiajs/inertia-vue3'
import {Link} from '@inertiajs/inertia-vue3'
import Activist from "../../../../Shared/Layouts/Account/Activist";

export default {
  layout: Activist,
  components:{
    Link
  },
  props: {
    user: Object,
    hasInfo: Object,
  },
  setup(props) {
    const form = useForm({
      firstname: props.hasInfo.firstname ?? null,
      lastname: props.hasInfo.lastname ?? null,
      middlename: props.hasInfo.middlename ?? null,
      about: props.hasInfo.about ?? null,
      phone: props.hasInfo.phone ?? null,
      birthdate: props.hasInfo.birthdate ?? null,
      username: null,
      password: null,
      email: null,
    })
    const  photoForm = useForm({
      photo: null,
    })
    return {form, photoForm}
  },
  mounted() {
    console.log(this.hasInfo)
    console.log(this.beforeNext())
  },
  methods: {
    postForm() {
      this.form.post('/account/info/personal')

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
    beforeNext(){
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
